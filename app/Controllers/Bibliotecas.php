<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\BibliotecasModel;
use App\Models\RolesModel;
use App\Models\ComunidadModel;
use ZipArchive;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class Bibliotecas extends BaseController
{
    /**============================================================================================
    /  Inicio Categoria de documentos
    /  ============================================================================================
    */

    function __construct() {
        // $this->usuarioActual = $this->actualUser();
        // $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
        // helper('bread');

        $this->path_scorm = 'scorm/';
    }

    public function index($oid=0)
    {
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Bibliotecas de mi Comunidad');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $obj = new BibliotecasModel($db);

        $datos['profile_data'] = $findUsuario;
        $datos['bibliotecas'] = $obj->obtenerBiblioCategoria($session->grupo_id,$oid);
        $datos['categorias'] = $this->getItem();

        return view('bibliotecas/index', $datos);
    }

    public function biblioCateAdd($oid=0)
    {
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar Categoria de Documentos');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $datos['oid_padre'] = $oid; 
        $datos['id_categoria'] =  $oid;

        $session->id_categoria = $oid;

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getPost();
            $data['oid_grupo']   = $session->grupo_id;
            $data['oid_padre'] = $oid;
            $data['oid_usuario'] = $session->user_id;
            $data['fecha']       = date('Y-m-d H:i:s');


            $obj = new BibliotecasModel($db);

            $respuesta = $obj->crear_biblio_categoria_model($data);

            if ($respuesta == TRUE){

                //$datos['id_categoria'] =  $obj->ultima_biblio_categoria()[0]->oid;

                $datos['mensaje_servidor'] = 'La categoria ha sido creado correctamente!';
                return redirect()->to(base_url('public/Bibliotecas'));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear la categoria!';
            }
        }

        return view('bibliotecas/categoria-doc/crear-categoria', $datos);
    }

    /******************************************************************/
    function biblioCateUpd($id){

        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Modificar Noticia');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;

        $findedit = new BibliotecasModel($db);
        $findedit = $findedit->find($id);
        $datos['edit'] = $findedit;
        $datos['id_categoria'] = $id;
        session()->id = $id;

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getPost();
            $data['oid'] = $id;

            $editar = new BibliotecasModel($db);
            $respuesta = $editar->editar_biblio_categoria_model( $data );
        

            if ($respuesta == TRUE){
                $datos['mensaje_servidor'] = 'La categoria ha sido actualizado correctamente!';

               

                return redirect()->to(base_url('public/Bibliotecas/'));

            }else{
                $datos['mensaje_servidor'] = 'No se ha podido actualizar la categoria!';
            }
        }

        return view('bibliotecas/categoria-doc/editar-categoria', $datos);
    }

    function biblioCateDelete( $id ){
        $obj = new BibliotecasModel($db);
        $obj->eliminar_biblio_categoria_model($id);

        return redirect()->to(base_url('public/Bibliotecas'));
    }

    function biblioCateAcceder( $id ){
        $obj = new BibliotecasModel($db);
        $obj->eliminar_biblio_categoria_model($id);
        

        return redirect()->to(base_url('public/bibliotecas/doc'));
    }

    /**============================================================================================
    /  Inicio Carga de documentos
    /  ============================================================================================
    */

    public function docVisitas()
    {
        $id   = $this->request->getPost('id');
        $obj  = new BibliotecasModel($db);
        $find = $obj->find_doc( $id );
        $data['oid'] = $id;
        $data['hits'] = $find['hits'] + 1;
        $respuesta = $obj->docVisitas( $data );
    }

    public function doc($oid_categoria)
    {
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Bibliotecas de mi Comunidad');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $obj = new BibliotecasModel($db);
        $datos['profile_data']  = $findUsuario;
        $datos['oid_categoria'] = $oid_categoria;
        $datos['categoria']     = $obj->find($oid_categoria);
        $datos['bibliotecas'] = $obj->obtenerBiblioCategoria($session->grupo_id,$oid_categoria);
        $datos['archivo']       = $obj->obtenerBiblioArchivo($oid_categoria);

        foreach ($datos['archivo'] as $archivo) {
            if($archivo->oid){
                $archivo->count_comen = $obj->count_comentarios($archivo->oid)->cantidad;
            }
        }

        return json_encode(array_values($datos['archivo']));
        //return view('bibliotecas/doc/index', $datos);
    }

    public function child($oid_padre)
    {
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Bibliotecas de mi Comunidad');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $obj = new BibliotecasModel($db);
        $datos['profile_data']  = $findUsuario;
        $datos['bibliotecas']   = $obj->biblio_categoria_padre($oid_padre);
        $datos['oid_padre'] = $oid_padre;
        return view('bibliotecas/doc/join-child', $datos);
    }

    /******************************************************************/
    // Envio de correo
    /******************************************************************/
    function send_email( $destinatario ){

        $email = \Config\Services::email();

        $email->setFrom('consultora.bioit@gmail.com', 'Notificación DGAC');
        $email->setTo($destinatario);
        //$email->attach(base_url().'/assets/images/users/5.jpg');
        // $email->setCC('consultora.bioit@gmail.com');
        $email->setSubject('Bienvenido');
        $setMessage = "Hola, sea bienvenido";
        $email->setMessage($setMessage);

        $email->send();

    }

    public function biblioFileAdd( $oid_categoria )
    {
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar Documento');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $grupo = new RolesModel($db);
        $datos['grupo'] = $grupo->obtenerRules();
        $comunidad = new ComunidadModel($db);
        $datos['comunidad'] = $comunidad->obtenerComunidades();


        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getPost();
            if( isset($data['grupo_ids']) ){
                $grupo_ids = implode(',', $data['grupo_ids']);
            }else{
                $grupo_ids = NULL;
            }
            if( isset($data['comunidad_ids']) ){
                $data['comunidad_ids'] = implode(',', $data['comunidad_ids']);
            }else{
                $data['comunidad_ids'] = '';
            }
            $data['grupo_ids'] = $grupo_ids;
            $data['oid_categoria']   = $oid_categoria;
            $data['oid_usuario'] = $session->user_id;
            $data['fecha']       = date('Y-m-d H:i:s');

            if($imagefile = $this->request->getFiles())
            {
                if($img = $imagefile['archivo'])
                {
                    if ($img->isValid() && ! $img->hasMoved())
                    {
                        $archivo = $img->getClientName(); //This is if you want to change the file name to encrypted 
                        $img->move(realpath(FCPATH . '../assets/uploads/bibliotecas/doc'), $archivo);
                        $data['archivo'] = $archivo;
                        $data['archivo_disco'] = $archivo;
                    }
                }
            }

            $obj = new BibliotecasModel($db);

            $respuesta = $obj->crear_biblio_archivo_model($data);

            if ($respuesta == TRUE){
            
                /******************************************************************/
                // estos se envian al crearse los registros y seleccionar la opcion de notificar.
                // cuando se seleciona una o mas comunidades se debe buscar todos los usuarios que cumplan con los criterios de la comunidad seleccionada y los perfiles seleccionados, esto aplica tanto para noticias como biblioteca
                /******************************************************************/
                $obj = new BibliotecasModel($db);

                if( $data['comunidad_ids'] == 'all' ){
                    $data['grupo_ids']     = $data['grupo_ids'];
                    $destinatario = $obj->all_buscar_usuario_model( array($data['grupo_ids']) );
                }else if( $data['comunidad_ids'] == 0 ){
                    $data['grupo_ids']     = $data['grupo_ids'];
                    $data['comunidad_ids'] = $session->grupo_id;
                    $destinatario = $obj->buscar_usuario_model( array($data['grupo_ids']), array($data['comunidad_ids']) );
                }else{
                    $data['grupo_ids']     = $data['grupo_ids'];
                    $data['comunidad_ids'] = $data['comunidad_ids'];
                    $destinatario = $obj->buscar_usuario_model( array($data['grupo_ids']), array($data['comunidad_ids']) );
                }

                // Preparacion de los datos para ser enviados
                foreach ($destinatario as $key => $value) {
                    $this->send_email( array($value->email) );
                }

                $datos['mensaje_servidor'] = 'El documento ha sido creado correctamente!';
                $datos['url_retorno'] = 'bibliotecas/index';
                return view('respuestas_servidor/exito', $datos);

            }else{
                $datos['mensaje_servidor'] = 'No se ha podido cargar el documento!';
            }
        }

        $datos['oid_categoria'] = $oid_categoria;
        session()->id = $oid_categoria;

        return view('bibliotecas/doc/crear-doc', $datos);
    }

    public function biblioFileEdit( $id )
    {
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Modificar Documento');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $obj = new BibliotecasModel($db);
        $datos['biblio_categoria'] = $obj->biblio_categoria($session->grupo_id);
        $datos['edit'] = $obj->find_doc($id);

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getPost();
            $data['oid']   = $id;
            $data['fecha'] = date('Y-m-d H:i:s');

            if($imagefile = $this->request->getFiles())
            {
                if($img = $imagefile['archivo'])
                {
                    if ($img->isValid() && ! $img->hasMoved())
                    {
                        // Borra archivo
                        $archivo_old = $datos['edit']['archivo'];
                        unlink(realpath(FCPATH . '../assets/uploads/bibliotecas/doc/'.$archivo_old));
                        $archivo = $img->getClientName(); //This is if you want to change the file name to encrypted 
                        $img->move(realpath(FCPATH . '../assets/uploads/bibliotecas/doc'), $archivo);
                        $data['archivo'] = $archivo;
                        $data['archivo_disco'] = $archivo;
                    }
                }
            }

            $respuesta = $obj->editar_biblio_archivo_model($data);

            if ($respuesta == TRUE){
                $datos['mensaje_servidor'] = 'El documento ha sido actualizado correctamente!';
                $datos['id_categoria'] = $id;

                return redirect()->to(base_url('public/bibliotecas/doc/'.$datos['edit']['oid_categoria']), $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido actualizar el documento!';
            }
        }

        session()->id = $datos['edit']['oid_categoria'];

        return view('bibliotecas/doc/editar-doc', $datos);
    }

    function biblioFileDelete( $oid, $oid_categoria ){
        $obj = new BibliotecasModel($db);
        $find = $obj->find_doc($oid);
        // Borrado de archivo
        $archivo_old = $find['archivo'];
        if( $archivo_old !="" ){
            unlink(realpath(FCPATH . '../assets/uploads/bibliotecas/doc/'.$archivo_old));
        }
        
        $obj->eliminar_biblio_doc_model($oid);

        session()->id = $oid_categoria;

        return redirect()->to(base_url('public/bibliotecas/index'));
    }

    function biblioComment( $oid_objeto ){

        $obj = new BibliotecasModel($db);
        
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Bibliotecas de mi Comunidad');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $obj = new BibliotecasModel($db);
        $datos['profile_data']  = $findUsuario;
        $datos['oid_objeto']    = $oid_objeto;
        $datos['preview']       = $obj->find_doc($oid_objeto);
        $datos['comentarios']   = $obj->obtenerComentariosDoc($oid_objeto);
        $datos['id_categoria'] = $datos['preview']['oid_categoria'];

        return view('bibliotecas/doc/ver-doc', $datos);
    }

    /**
    / Comentarios
    */
    public function docComentario($oid_objeto)
    {
        $session = session();

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getPost();
            $data['oid_objeto']  = $oid_objeto;
            $data['oid_usuario'] = $session->user_id;
            $data['oid_grupo']   = $session->grupo_id;
            $data['fecha']       = date('Y-m-d H:i:s');

            // Envio de correo
            if( $data['notificar'] == "-1" ){
                echo "Envio";
            }else{
                unset($data['notificar']);
            }

            $obj = new BibliotecasModel($db);
            
            $respuesta = $obj->crear_doc_comentario_model($data);
        }

        return redirect()->to(base_url('public/bibliotecas/biblioComment/'.$oid_objeto));
    }

    function ComentarioDelete( $oid_objeto, $id ){
        $eliminar = new BibliotecasModel($db);
        $eliminar->eliminar_comentario_model($id);

        return redirect()->to(base_url('public/bibliotecas/biblioComment/'.$oid_objeto));
    }

    /**============================================================================================
    /  Agregar MicroSitio
    /  ============================================================================================
    */
    public function biblioMicroSitioAdd( $oid_categoria )
    {
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar MicroSitio');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;


        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getPost();
            $data['esmicrositio']  = 1;
            $data['oid_categoria'] = $oid_categoria;
            $data['oid_usuario']   = $session->user_id;
            $data['fecha']         = date('Y-m-d H:i:s');

            // $data_busqueda = $this->request->getPost();
            $archivo = $this->request->getFiles()['archivo'];
            $path = $this->path_scorm;
            $dirname = md5(uniqid(rand(),1));
            $zipName = $archivo->getName(); //nombre archivo zip
            $file = $archivo->store($path.$dirname, $zipName);//se sube el archivo .zip en writable/uploads/scorm
            $esScorm = FALSE;
            $message = $this->unzipSco( $zipName, $path, $dirname, $esScorm );

            if($message == "OK"){/* si todo sale bien en la descompresión, se inserta en la base de datos */
                $data['archivo'] = $dirname;
                $data["fecha"] = date("Y-m-d H:i:s");
                // $respuesta = $scormModel->insertScorm($data_busqueda);
                $obj = new BibliotecasModel($db);
                unset($data['notificar']);
                $respuesta = $obj->crear_micrositio_model($data);
                return redirect()->to(base_url('public/bibliotecas/doc/'.$oid_categoria));
            }else{/* sino se eliminan los directorios y envía ventana de error */
                $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Error Scorm');
                $datos['mensaje_servidor'] = $message;
                $datos['url_redirect'] = 'bibliotecas/index';
                $this->deleteDirScorm(getcwd().'/../assets/uploads/'.$path.$dirname);
                $this->deleteDirScorm(getcwd().'/../writable/uploads/'.$path.$dirname);
                return view('respuestas_servidor/error_params', $datos);
            }

        }

        session()->id = $oid_categoria;
        $datos['oid_categoria'] = $oid_categoria;

        return view('bibliotecas/micro-sitio/crear-micro-sitio', $datos);
    }

    function unzipSco( $zipName, $path, $dirname, $is_scorm ){
        $tmp = getcwd().'/../assets/uploads/'.$path.$dirname;
        $zip = new ZipArchive;
        if($zip->open(getcwd().'/../writable/uploads/'.$path.$dirname."/".$zipName) === TRUE){
            $zip->extractTo($tmp);
            $zip->close(); 
        }else{
            return "Error al leer ZIP";
        }      
        // es SCORM, debemos encontrar y validar el imsmanifest.xml
        if( $is_scorm && !@is_file( $tmp."/imsmanifest.xml" ))
            return "Error, no se encuentra manifest.xml";
        //eso es todo
        return "OK";
      }
      /* elimina el directorio de forma recursiva */
      function deleteDirScorm($dir){
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) {
            if ($file->isDir()){
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        rmdir($dir);
      }
      /* vacía el directorio de forma recursiva */
      function cleanDirScorm($dir){
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) {
            if ($file->isDir()){
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
      }

    public function biblioUrlAdd( $oid_categoria )
    {
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar MicroSitio');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $grupo = new RolesModel($db);
        $datos['grupo'] = $grupo->obtenerRules();

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getPost();

            if( isset($data['grupo_ids']) ){
                $grupo_ids = $data['grupo_ids'];
            }else{
                $grupo_ids = NULL;
            }

            $data['esurl']         = 1;
            $data['grupo_ids']     = $grupo_ids;
            $data['oid_categoria'] = $oid_categoria;
            $data['oid_usuario']   = $session->user_id;
            $data['fecha']         = date('Y-m-d H:i:s');

            $obj = new BibliotecasModel($db);

            $respuesta = $obj->crear_url_model($data);

            if ($respuesta == TRUE){
                $datos['mensaje_servidor'] = 'URL ha sido creado correctamente!';
                return redirect()->to(base_url('public/bibliotecas/doc/'.$oid_categoria));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido cargar la URL!';
            }
        }

        $datos['oid_categoria'] = $oid_categoria;
        session()->id = $oid_categoria;

        return view('bibliotecas/sitio-url/crear-sitio-url', $datos);
    }


    public function getItem()
    {
        $session = session();
        $data = [];
        $parent_key = '0';
        $obj = new BibliotecasModel($db);
        $categorias = $obj->obtenerCategoria($session->grupo_id,0);


            
          if(count($categorias) > 0)
          {
              $data = $this->membersTree($parent_key);
          }else{
              $data=["id"=>"0","name"=>"No Members presnt in list","text"=>"No Members is presnt in list","nodes"=>[]];
          }
   
          return  json_encode(array_values($data));
    }
   
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function membersTree($parent_key)
    {
        $session = session();
        $obj = new BibliotecasModel($db);
        
        $row1 = [];
        $row = $obj->obtenerBiblioCategoria($session->grupo_id, $parent_key);

        foreach($row as $key => $value)
        {
            $delete = "";
            $edit = "";

            /*if(MostrarElemento(array('bibliotecas/biblioCateDelete'))){
                $delete = "<a  class='icon-trash text-danger' title='Borrar Categoria' data-id='".$value->oid."' href='".base_url('public/bibliotecas/biblioCateDelete/'.$value->oid) ."'>
                    <i></i>
                </a>";
            }

            if(MostrarElemento(array('bibliotecas/biblioCateUpd'))){
                $edit = "<a class='ti-pencil-alt' title='Editar Categoria' href='' data-id='".$value->oid."' style='z-index:100'>
                    <i></i>
                </a>";
            }*/

            if(MostrarElemento(array('bibliotecas/doc'))){
                $row1[$key]['id'] = $value->oid;
                $row1[$key]['name'] = $value->nombre;
                $row1[$key]['text'] = $value->nombre;
                $row1[$key]['nodes'] = $this->membersTree($value->oid);
           }
        }

        return $row1;
    }
}
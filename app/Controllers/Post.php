<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ForoCategoriaModel;
use App\Models\ForoForoModel;
use App\Models\ForoPostModel;
use App\Models\RolesModel;

class Post extends BaseController
{
    private $dir_view = 'foro_post';
    private $findUsuario ="";
    private $datos = array();

    function __construct() {
        $session = session();
        $this->findUsuario = new UsuarioModel($db);
        $user = new UsuarioModel($db);
        $this->findUsuario = $this->findUsuario->find($session->user_id);
        $rol =  $user->buscar_rol($session->user_id, $session->grupo_id);

        $this->datos['profile_data'] = $this->findUsuario;
        $this->datos['oid_usuario']=$session->user_id;
        $this->datos['oid_grupo']=$session->grupo_id;
        $this->datos['rol']=$rol->rol;

        $this->datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $this->datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Gestion de Categoria de Foros');

    }

    public function index(){
        $obj = new ForoForoModel($db);
        $datos = $this->datos;

        $datos['foros'] = $obj->getAllElement($this->datos['oid_grupo']);  

        return view('foro_foro/index', $datos);
    }

    public function add($idForo){
        $oForo = new ForoForoModel($db);
        $oCategoria = new ForoCategoriaModel($db);
        $oPost = new ForoPostModel($db);
        $grupo     = new RolesModel($db);
        $datos = $this->datos; 

        $foro = $oForo->getElement($idForo);

    
        if($datos['rol'] !== 'ADM' && $datos['rol'] !== 'PRO')
        {
            $respuesta = false;
      
            $error = "Rol no autorizado para esta operación";
            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
       
            return view($datos['vista_respuesta'], $datos);
        } 

        if( $foro->oid > 0){
            $categoria = $oCategoria->getElement($foro->oid_categoria);
            $datos['oid_categoria'] = $categoria->oid;
            $datos['category_name'] = $categoria->nombre;
            $datos['foro_name']     = $foro->nombre;
            $datos['oid_foro']      = $idForo;

            if ($this->request->getMethod() == 'post') {

                $fields = $this->request->getPost();
                $fields['oid_foro']      = $idForo;
                $fields['jerarquia']     = 0;


                $existe = $oPost->getElementFindName($fields['asunto'], $idForo);

                if($existe->oid >= 1){
                    $respuesta = false;
                    $error = "Existe un tema con el mismo asunto en este foro";
                    $datos = array_merge($datos,$this->respuesta($respuesta, $error));
                    return view($datos['vista_respuesta'], $datos);
                }
                    
                if($imagefile = $this->request->getFiles()){
                    if($img = $imagefile['archivo'])
                    {
                        if ($img->isValid() && ! $img->hasMoved())
                        {
                            $archivo = $img->getClientName(); //This is if you want to change the file name to encrypted 
                            $img->move(realpath(FCPATH . '../assets/uploads/foro'), $archivo);
                            $fields['archivo'] = $archivo;

                        }
                    }
                }
                $fields['fecha'] = date('Y-m-d H:i:s');
                $respuesta = $oPost->addElement($fields);

                $fields = array(
                    'oid' => $respuesta,
                    'jerarquia' => sprintf( "/%010d", $respuesta )
                );
                $oPost->setElement($fields);

                $datos = array_merge($datos,$this->respuesta($respuesta));
              
                return view($datos['vista_respuesta'], $datos);
            }

            return view('foro_post/add', $datos);

        }else {
            $respuesta = false;
            $error = "No existe el foro, para agregar un tema";
            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
        }
        
 
        
        return view('foro_post/add', $datos);
    }


    //Editar tema(post)
    public function edit($id){
  
        $oForo = new ForoForoModel($db);
        $oCategoria = new ForoCategoriaModel($db);
        $oPost = new ForoPostModel($db);
        $grupo     = new RolesModel($db);
        $datos = $this->datos; 


        if($datos['rol'] !== 'ADM' && $datos['rol'] !== 'PRO')
        {
            $respuesta = false;
      
            $error = "Rol no autorizado para esta operación";
            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
       
            return view($datos['vista_respuesta'], $datos);
        } 

        if(!$id){
            $respuesta = false;
            $error = "No envio el id del Tema";
            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
            return view($datos['vista_respuesta'], $datos);
        }else{

            $tema = $oPost->getElement($id);

            //Si existe el tema
            if($tema->oid > 0){

                $foro = $oForo->getElement($tema->oid_foro);
                $categoria = $oCategoria->getElement($foro->oid_categoria);

                if ($this->request->getMethod() == 'post') {
                    $fields = $this->request->getPost();

                    //Si existe otra categoria con el mismo nombre
                    $existe = $oPost->getElementFindNameEdit($fields['asunto'], $foro->oid, $id);

                    if($existe->oid >= 1){
                            $respuesta = false;
                            $error = "Existe un tema con el mismo nombre dentro del foro";
                            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
                            return view($datos['vista_respuesta'], $datos);
                    }

                    $respuesta = $oPost->setElement($fields);
                    $datos = array_merge($datos,$this->respuesta($respuesta));
                    return view($datos['vista_respuesta'], $datos);
                }else{

                    $datos['resultado_busqueda'] =  $tema;
                    $datos['oid_categoria']  = $categoria->oid;
                    $datos['grupo']          = $grupo->obtenerRules();
                    $datos['category_name']  = $categoria->nombre;
                    $datos['foro_name']  = $foro->nombre;
                    $datos['foro_categoria'] = $oCategoria->getAllElement($this->datos['oid_grupo']);

                    return view('foro_post/edit', $datos);
                }
            }else{
                $respuesta = false;
                $error = "No existe ese Tema";
                $datos = array_merge($datos,$this->respuesta($respuesta, $error));
                return view($datos['vista_respuesta'], $datos);
            }

        }
        
       
        return view('foro_categoria/index', $datos);
    }

    //Eliminar tema padre (Tema)
    public function delete(){
  
        $oForo = new ForoForoModel($db);
        $oPost = new ForoPostModel($db);
        $grupo     = new RolesModel($db);
        $oCategoria = new ForoCategoriaModel($db);
        $datos = $this->datos; 
        $fields = $this->request->getPost();
        $datos['categorias'] = $oCategoria->getAllElement($this->datos['oid_grupo']);


        if($datos['rol'] !== 'ADM' && $datos['rol'] !== 'PRO')
        {
            $respuesta = false;
      
            $error = "Rol no autorizado para esta operación";
            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
       
            return view($datos['vista_respuesta'], $datos);
        } 

        if(!$fields['id_tema']){
            $respuesta = false;
            $error = "No envio el id del Tema";
            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
            return view($datos['vista_respuesta'], $datos);
        }else{

            $tema = $oPost->getElement($fields['id_tema']);

            //Si existe el tema
            if($tema->oid > 0){

                if ($this->request->getMethod() == 'post') {

                    //elimino los archivos de los hijos del post
                    $hijos = $oPost->getPostResponse($tema->oid);

                    foreach ($hijos as $p) {
                        if( $p->archivo!="" ) @unlink( "realpath(FCPATH . '../assets/uploads/foro/'.$p->archivo" );
                    }

                    //elimino el archivo del tema 
                    if( $tema->archivo!="" ) @unlink( "realpath(FCPATH . '../assets/uploads/foro/'.$tema->archivo" );
                  
                    $respuesta = $oPost->deleteElement($fields['id_tema']);


                    $datos = array_merge($datos,$this->respuesta($respuesta));
                    //return view($datos['vista_respuesta'], $datos);

                    return $this->response->setJSON(['exito' => 1]);
                }

            }else{
                $respuesta = false;
                $error = "No existe ese Tema";
                $datos = array_merge($datos,$this->respuesta($respuesta, $error));
                
                return $this->response->setJSON(['exito' => 0]);

            }

        }
       
        return $this->response->setJSON(['exito' => 2]);
    }

    //Detalle de foro
    public function tema_detalle($id_foro, $id_tema){
        $oForo = new ForoForoModel($db);
        $oPost = new ForoPostModel($db);
        $grupo     = new RolesModel($db);
        $oCategoria = new ForoCategoriaModel($db);
        $datos = $this->datos; 
        $fields = $this->request->getPost();
        $datos['categorias'] = $oCategoria->getAllElement($this->datos['oid_grupo']);



        if(!$id_tema || !$id_foro){
            $respuesta = false;
            $error = "No envio el id del Tema o el id del Foro";
            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
            return view($datos['vista_respuesta'], $datos);
        }else{


            $tema = $oPost->getElement($id_tema);
            $foro = $oForo->getElement($tema->oid_foro);
            $categoria = $oCategoria->getElement($foro->oid_categoria);

            $datos['tema']  =  $tema;
            $datos['foro']  =  $foro;
            $datos['oid_padre']  =  $tema->oid_padre;
            $datos['grupo'] = $grupo->obtenerRules();
            //Si existe el tema
            if($tema->oid > 0){
                //busco la cantidad de post  post

                $datos['cantidad_post'] = $oPost->getCountPost($tema->oid);
                
                $pager = \Config\Services::pager();


                $datos['post'] = $oPost->getPostResponse($tema->oid)->paginate(20, 'post');


                $pager->setPath(base_url('/')."public", 'post');

                $datos['currentPage'] = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

                $datos['pager'] =  $oPost->pager;
      
                return view('foro_post/foro_tema_detalle', $datos);

            }else{
                $respuesta = false;
                $error = "No existe ese Tema";
                $datos = array_merge($datos,$this->respuesta($respuesta, $error));
                
               return view($datos['vista_respuesta'], $datos);

            }

            return view('foro_post/foro_tema_detalle', $datos);
        }
       
    }

   public function add_response(){
        $oForo = new ForoForoModel($db);
        $oCategoria = new ForoCategoriaModel($db);
        $oPost = new ForoPostModel($db);
        $grupo     = new RolesModel($db);
        $datos = $this->datos; 
        $fields = $this->request->getPost();
        
        //tema padre
        $tema = $oPost->getElement($fields['oid_tema']);
        $foro = $oForo->getElement($tema->oid_foro);

        $foro_padre = $foro->oid;
 
        if ($this->request->getMethod() == 'post') {

            //$fields['oid_padre']      = $tema->oid;

            if($file = $this->request->getFiles()){
                if($arch = $file['archivo'])
                {
                    if ($arch->isValid() && ! $arch->hasMoved())
                    {
                        $archivo = $arch->getClientName(); //This is if you want to change the file name to encrypted 
                        $arch->move(realpath(FCPATH . '../assets/uploads/foro'), $archivo);
                        $fields['archivo'] = $archivo;

                    }
                }
            }

            $fields['fecha'] = date('Y-m-d H:i:s');
            $fields['oid_usuario'] = $this->datos['profile_data']['oid']; 

            unset($fields['oid_tema'], $fields['jerarquia'], $fields['foro_id']);


            if($tema->oid_padre == 0){
                $fields['oid_padre'] = $tema->oid;
            }else{
                $fields['oid_padre'] = $tema->oid_padre;
            }

            $oid_padre = $fields['oid_padre'];
            $respuesta = $oPost->addElement($fields);

            $fields = array(
                'oid' => $respuesta,
                'oid_foro' => $foro->oid,
                'jerarquia' => $tema->jerarquia.sprintf( "/%010d", $respuesta )
            );
            $oPost->setElement($fields);

    
            $datos = array_merge($datos,$this->respuesta_tema($respuesta, '',  $foro_padre,  $oid_padre));
          
            return view($datos['vista_respuesta'], $datos);
        }


        return view('foro_post/foro_tema_detalle', $datos);
    }

     
    //Delete post
    public function delete_post(){
  
        $oForo = new ForoForoModel($db);
        $oPost = new ForoPostModel($db);
        $grupo     = new RolesModel($db);
        $oCategoria = new ForoCategoriaModel($db);
        $datos = $this->datos; 
        $fields = $this->request->getPost();
        $datos['categorias'] = $oCategoria->getAllElement($this->datos['oid_grupo']);


        if(!$fields['id_tema']){
            $respuesta = false;
            $error = "No envio el id del Tema";
            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
            return view($datos['vista_respuesta'], $datos);
        }else{

            $post = $oPost->getElement($fields['id_tema']);

            //Si existe el tema
            if($post->oid > 0){

                if ($this->request->getMethod() == 'post') {

                    //elimino los archivos de los hijos del post
                    /*$hijos = $oPost->getPostResponse($post->oid);

                    foreach ($hijos as $p) {
                        if( $p->archivo!="" ) @unlink( "realpath(FCPATH . '../assets/uploads/foro/'.$p->archivo" );
                    }*/

                    //elimino el archivo del tema 
                    if( $post->archivo!="" ) @unlink( "realpath(FCPATH . '../assets/uploads/foro/'.$tema->archivo" );
                  
                    $respuesta = $oPost->deletePost($fields['id_tema']);


                    $datos = array_merge($datos,$this->respuesta($respuesta));
                    //return view($datos['vista_respuesta'], $datos);

                    return $this->response->setJSON(['exito' => 1]);
                }

            }else{
                $respuesta = false;
                $error = "No existe ese Post";
                $datos = array_merge($datos,$this->respuesta($respuesta, $error));
                
                return $this->response->setJSON(['exito' => 0]);

            }

        }
       
        return $this->response->setJSON(['exito' => 2]);
    }

    //Enviar email de respuesta
    public function mostrar_email($id_foro, $id_post){
        $oForo = new ForoForoModel($db);
        $oPost = new ForoPostModel($db);
        $session = session();
        $datos = $this->datos; 
        $fields = $this->request->getPost();

        if(!$id_foro or !$id_post){
            $respuesta = false;
            $error = "No envio el id del Tema";
            $datos['url_retorno'] = redirect()->back();
            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
            return view($datos['vista_respuesta'], $datos);
        }else{

            $post = $oPost->getElement($id_post);

            
            //Si existe el tema
            if($post->oid > 0){


                if ($this->request->getMethod() == 'post') {
                    $fields = $this->request->getPost();
                  
                    //Armar y enviar el email
                    $user = new UsuarioModel($db);
                    $usu = $user->getUsuario2($session->user_id);

                    $email = \Config\Services::email();

                    $email->setFrom($usu->email, $usu->nombres." ".$usu->apellidos);
                    $email->setTo($fields['email_post']);

                    $email->setSubject('Respuesta tema');
                    $email->setMessage($fields['asunto']);

                    //si tiene archivo
                    if($file = $this->request->getFiles()){
                        if($arch = $file['archivo'])
                        {
                            if ($arch->isValid() )
                            {
                                $archivo = $arch->getClientName(); //This is if
                                $arch->move(realpath(FCPATH . '../assets/uploads/foro'), $archivo);
                                $adjunto = FCPATH . '../assets/uploads/foro/'.$archivo; 
                                $email->attach($adjunto);
                            }
                        }
                    }


                    $email->send();

                    $currentURL = "Post/tema_detalle/".$post->oid_foro."/".$post->oid_padre; 
                    $params   = $_SERVER['QUERY_STRING']; 

                    $fullURL = $currentURL . '?' . $params; 
                    $fullURL;  

                    $respuesta = 1;
                    $datos['p'] = $post;

                    $datos = array_merge($datos, $this->respuesta($respuesta,'',  $fullURL));
                    return view($datos['vista_respuesta'], $datos);

                }else{


                    $datos['p'] =  $post;
                  
                    return view('foro_post/email', $datos);
                }
            }else{
                $respuesta = false;
                $error = "No existe ese Tema";
                $datos = array_merge($datos,$this->respuesta($respuesta, $error));
                return view($datos['vista_respuesta'], $datos);
            }

        }

    }

    function respuesta($respuesta, $error='',$url=''){
        
        if($respuesta){
           
            $datos['mensaje_servidor'] = 'El registro ha sido procesado correctamente!';

            if($url!=''){
                 $datos['url_retorno'] = $url;
            }else{
                $datos['url_retorno'] = 'CategoriasForos/index';
            }
        
            $datos['vista_respuesta'] = 'respuestas_servidor/exito';
        }else{

            if($error!= ''){
                $datos['mensaje_servidor'] = $error;
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido procesar el registro!';
            }
            
            $datos['url_retorno'] = 'CategoriasForos/index';
            $datos['vista_respuesta'] = 'respuestas_servidor/error';
        }
        return $datos;
    }

    function respuesta_tema($respuesta, $error='',  $id_foro, $id_tema){
        
        if($respuesta){
            $datos['mensaje_servidor'] = 'El registro ha sido procesado correctamente!';
            $datos['url_retorno'] = 'Post/tema_detalle/'.$id_foro.'/'.$id_tema;
            $datos['vista_respuesta'] = 'respuestas_servidor/exito';
        }else{
            if($error!= ''){
                $datos['mensaje_servidor'] = $error;
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido procesar el registro!';
            }
            
            $datos['url_retorno'] = 'Post/tema_detalle/'. $id_foro.'/'.$id_tema;
            $datos['vista_respuesta'] = 'respuestas_servidor/error';
        }
        return $datos;
    }

}
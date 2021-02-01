<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\NoticiasModel;
use App\Models\RolesModel;
use App\Models\ComunidadModel;
use App\Controllers\Postulaciones;

class Noticias extends BaseController
{
    /******************************************************************/

    public function index()
    {
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Noticias de mi Comunidad');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $obj = new NoticiasModel($db);
        $datos['profile_data'] = $findUsuario;
        $datos['noticias'] = $obj->obtenerNoticiasTodas($session->grupo_id);

        return view('noticias/index', $datos);
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

	public function noticiaAdd()
	{
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar Noticia');
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
                $data['grupo_ids'] = implode(',', $data['grupo_ids']);
            }else{
                $data['grupo_ids'] = '';
            }

            if( isset($data['comunidad_ids']) ){
                $listado_comunidad = $data['comunidad_ids'];
                $data['comunidad_ids'] = implode(',', $data['comunidad_ids']);
            }else{
                $data['comunidad_ids'] = '';
            }
            $data['oid_grupo'] = $session->grupo_id;
            $data['oid_usuario']  = $session->user_id;

            $obj = new NoticiasModel($db);
            
            if($imagefile = $this->request->getFiles())
            {
                //print_r($imagefile);
                if($img = $imagefile['foto_chica'])
                {
                    if ($img->isValid() && ! $img->hasMoved())
                    {
                        $foto_chica = $img->getClientName(); //This is if you want to change the file name to encrypted 
                        $img->move(realpath(FCPATH . '../assets/uploads/noticias'), $foto_chica);
                        $data['foto_chica'] = $foto_chica;

                        // You can continue here to write a code to save the name to database
                        // db_connect() or model format

                    }
                }
                if($img = $imagefile['foto_grande'])
                {
                    if ($img->isValid() && ! $img->hasMoved())
                    {
                        $foto_grande = $img->getClientName(); //This is if you want to change the file name to encrypted 
                        $img->move(realpath(FCPATH . '../assets/uploads/noticias'), $foto_grande);
                        $data['foto_grande'] = $foto_grande;

                        // You can continue here to write a code to save the name to database
                        // db_connect() or model format

                    }
                }
                if($img = $imagefile['attach'])
                {
                    if ($img->isValid() && ! $img->hasMoved())
                    {
                        $attach = $img->getClientName(); //This is if you want to change the file name to encrypted 
                        $img->move(realpath(FCPATH . '../assets/uploads/noticias'), $attach);
                        $data['attach'] = $attach;
                        // You can continue here to write a code to save the name to database
                        // db_connect() or model format

                    }
                }
            }

            $respuesta = $obj->crear_noticia_model($data,$listado_comunidad);


            if ($respuesta == TRUE){

                /******************************************************************/
                // estos se envian al crearse los registros y seleccionar la opcion de notificar.
                // cuando se seleciona una o mas comunidades se debe buscar todos los usuarios que cumplan con los criterios de la comunidad seleccionada y los perfiles seleccionados, esto aplica tanto para noticias como biblioteca
                /******************************************************************/
                $obj = new NoticiasModel($db);

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

                $datos['mensaje_servidor'] = 'La noticia ha sido creado correctamente!';
                $datos['url_retorno'] = 'noticias/index';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear la noticia!';
            }
        }



		return view('noticias/crear-noticia', $datos);
	}

    /******************************************************************/
    function noticiaModificar($id){

        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Modificar Noticia');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $grupo = new RolesModel($db);
        $datos['grupo'] = $grupo->obtenerRules();
        $comunidad = new ComunidadModel($db);
        $datos['comunidad'] = $comunidad->obtenerComunidades();
        $findedit = new NoticiasModel($db);
        $findedit = $findedit->find($id);
        $datos['edit'] = $findedit;

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getPost();
            if( isset($data['grupo_ids']) ){
                $data['grupo_ids'] = implode(',', $data['grupo_ids']);
            }else{
                $data['grupo_ids'] = '';
            }
            if( isset($data['comunidad_ids']) ){
                $data['comunidad_ids'] = implode(',', $data['comunidad_ids']);
            }else{
                $data['comunidad_ids'] = '';
            }
            $data['oid_grupo'] = $session->grupo_id;
            $data['oid'] = $id;

            if($imagefile = $this->request->getFiles())
            {
                //print_r($imagefile);
                if($img = $imagefile['foto_chica'])
                {
                    if ($img->isValid() && ! $img->hasMoved())
                    {
                        // Borra archivo
                        $foto_chica_old = $datos['edit']['foto_chica'];
                        if( $foto_chica_old !="" ){
                            unlink(realpath(FCPATH . '../assets/uploads/noticias/'.$foto_chica_old));
                        }
                        $foto_chica = $img->getClientName(); //This is if you want to change the file name to encrypted 
                        $img->move(realpath(FCPATH . '../assets/uploads/noticias'), $foto_chica);
                        $data['foto_chica'] = $foto_chica;

                        // You can continue here to write a code to save the name to database
                        // db_connect() or model format

                    }
                }
                if($img = $imagefile['foto_grande'])
                {
                    if ($img->isValid() && ! $img->hasMoved())
                    {   
                        // Borra archivo
                        $foto_grande_old = $datos['edit']['foto_grande'];
                        if( $foto_grande_old !="" ){
                            unlink(realpath(FCPATH . '../assets/uploads/noticias/'.$foto_grande_old));
                        }
                        $foto_grande = $img->getClientName(); //This is if you want to change the file name to encrypted 
                        $img->move(realpath(FCPATH . '../assets/uploads/noticias'), $foto_grande);
                        $data['foto_grande'] = $foto_grande;

                        // You can continue here to write a code to save the name to database
                        // db_connect() or model format

                    }
                }
                if($img = $imagefile['attach'])
                {
                    if ($img->isValid() && ! $img->hasMoved())
                    {   
                        // Borra archivo
                        $attach_old = $datos['edit']['attach'];
                        unlink(realpath(FCPATH . '../assets/uploads/noticias/'.$attach_old));
                        $attach = $img->getClientName(); //This is if you want to change the file name to encrypted 
                        $img->move(realpath(FCPATH . '../assets/uploads/noticias'), $attach);
                        $data['attach'] = $attach;
                        // You can continue here to write a code to save the name to database
                        // db_connect() or model format

                    }
                }
            }

            $editar = new NoticiasModel($db);
            $respuesta = $editar->editar_noticia_model( $data );

            if ($respuesta == TRUE){
                $datos['mensaje_servidor'] = 'La noticia ha sido actualizado correctamente!';
                return redirect()->to(base_url('public/Noticias'));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido actualizar la noticia!';
            }
        }
        return view('noticias/editar-noticia', $datos);
    }

    function noticiaPreview($id){
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $obj = new NoticiasModel($db);
        $datos['profile_data'] = $findUsuario;
        $obj = new NoticiasModel($db);
        $preview = $obj->obtenerNoticiasPreview($id);
        // print_r($preview);
        // return;
        $datos['preview'] = $preview;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'<a>'.$preview->titulo.'</a>');
        $datos['comentarios'] = $obj->obtenerComentarios($id);

        return view('noticias/ver-noticia', $datos);
    }

    function noticiaPreviewPublic($id){
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $obj = new NoticiasModel($db);
        $datos['profile_data'] = $findUsuario;
        $obj = new NoticiasModel($db);
        $preview = $obj->obtenerNoticiasPreviewPublic( $id );
        $datos['preview'] = $preview;
        $datos['comentarios'] = $obj->obtenerComentarios($id);

        return view('noticias/ver-noticia', $datos);
    }

    function noticiaDelete( $id ){
        $obj = new NoticiasModel($db);
        // Buscamos las imagenes que tenga asociadas para ser borradas
        $find = $obj->find($id);
        try {
            $foto_chica = $find['foto_chica'];
            unlink(realpath(FCPATH . '../assets/uploads/noticias/'.$foto_chica));
            $foto_grande = $find['foto_grande'];
            unlink(realpath(FCPATH . '../assets/uploads/noticias/'.$foto_grande));
            $attach = $find['attach'];
            unlink(realpath(FCPATH . '../assets/uploads/noticias/'.$attach));
        }catch (\Exception $e)
        {
            //die($e->getMessage());
        }
       
        $obj->eliminar_noticia_model($id);
        
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Noticias de mi Comunidad');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $obj = new NoticiasModel($db);
        $datos['profile_data'] = $findUsuario;
        $datos['noticias'] = $obj->obtenerNoticias($session->grupo_id);

        return redirect()->to(base_url('public/Noticias'));
    }

    public function noticiaVisitas()
    {
        $id   = $this->request->getPost('id');
        $obj  = new NoticiasModel($db);
        $find = $obj->find( $id );
        $data['oid'] = $id;
        $data['hits'] = $find['hits'] + 1;
        $respuesta = $obj->noticiaVisitas( $data );
    }

    /**
    / Comentarios
    */
    public function noticiaComentario($oid_objeto)
    {
        $session = session();

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getPost();
            $data['oid_objeto']  = $oid_objeto;
            $data['oid_usuario'] = $session->user_id;
            $data['oid_grupo']   = $session->grupo_id;
            $data['fecha']       = date('Y-m-d H:i:s');

            $obj = new NoticiasModel($db);
            
            $respuesta = $obj->crear_noticia_comentario_model($data);
        }

        return $this->noticiaPreview($oid_objeto);
    }

    function ComentarioDelete( $oid_objeto, $id ){
        $eliminar = new NoticiasModel($db);
        $eliminar->eliminar_comentario_model($id);

        return $this->noticiaPreview($oid_objeto);
    }


    public function enviarCorreo(){
        $mail = new Postulaciones();
        $mail->enviarEmailTest();
    }

}
<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\AccesoModel;
use App\Models\MensajesModel;
use App\Models\RolesModel;

class Mensajeria extends BaseController
{
    
    public function enviar(){
        $email = \Config\Services::email();
        $email->setFrom('soporte@bioit.cl', 'Omar Orozco');
        $email->setTo('ing.omar.orozco@gmail.com');
        $email->setSubject('Envio desde Xampp');
        $email->setMessage('Prueba de mensajeria');

        $email->send();
        echo "controller enviar";
        return;
    }

    public function ver($oid){
        $session = session();
        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mi comunidad','ubicacion_url'=>'public/usuario/mi_comunidad');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $oid_grupo = $session->grupo_id;
        $datos['oid_grupo'] = $session->grupo_id;
        $mensajes = new MensajesModel($db);
        $datos['resultado_busqueda'] =  $mensajes->get_mensaje($oid);
        return view('mensajeria/ver', $datos);

    }

    public function index(){
        return redirect()->to(base_url('public/Mensajeria/inbox'));
    }


    public function inbox($rol='ALU'){
        $session = session();
        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mi comunidad','ubicacion_url'=>'public/usuario/mi_comunidad');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $oid_grupo = $session->grupo_id;
        $datos['oid_grupo'] = $session->grupo_id;
        $datos['rol'] = $rol;
        $mensajes = new MensajesModel($db);
        $datos['box']='inbox'; 
        $datos['resultado_busqueda'] =  $mensajes->get_my_mensajes($session->user_id);
        // print_r($lisado_mensajes);
        // return;
        return view('mensajeria/inbox', $datos);
    }

    public function sendbox($rol='ALU'){
        $session = session();
        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mi comunidad','ubicacion_url'=>'public/usuario/mi_comunidad');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $oid_grupo = $session->grupo_id;
        $datos['oid_grupo'] = $session->grupo_id;
        $datos['rol'] = $rol;
        $datos['box']='sendbox'; 
        $mensajes = new MensajesModel($db);
        $datos['resultado_busqueda'] =  $mensajes->get_send_mensajes($session->user_id);
        // print_r($lisado_mensajes);
        // return;
        return view('mensajeria/inbox', $datos);
    }
    
    public function json() { 

        $session = session();
        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mi comunidad','ubicacion_url'=>'public/usuario/mi_comunidad');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $oid_grupo = $session->grupo_id;
        $datos['oid_grupo'] = $session->grupo_id;
      
        $mensajes = new MensajesModel($db);

        // $data_usuario=[];
        $respuesta = $mensajes->get_usuarios();

        
        echo json_encode($respuesta);
        return;

        // exit;
      
    } 

    public function new(){
        $session = session();
        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mi comunidad','ubicacion_url'=>'public/usuario/mi_comunidad');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $mensajes = new MensajesModel($db);
        $datos['users_com'] = $mensajes->obtenerComunidad($session->grupo_id);

        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $mensajes = new MensajesModel($db);

            foreach ($data_post['oid_destino'] as $key => $oid_destino) {
                # code...
                $message['oid_origen']  = $session->user_id;
                $message['oid_destino'] = $oid_destino;
                $message['texto']       = $data_post['texto'];
                $message['fecha']       = date("Y-m-d H:i:s");
                $respuesta            = $mensajes->agregar($message);
            }

            if ($respuesta == TRUE){
                $datos['mensaje_servidor'] = 'Mensaje ha sido creada correctamente!';
                $datos['url_retorno'] = 'mensajeria/inbox';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el mensaje!';
                $datos['url_retorno'] = 'mensajeria/inbox';
                return view('respuestas_servidor/error', $datos);
            }
        }
        
        return view('mensajeria/new', $datos);
    }

    public function redactar(){
        $session = session();
        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mi comunidad','ubicacion_url'=>'public/usuario/mi_comunidad');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $oid_grupo = $session->grupo_id;
        $datos['oid_grupo'] = $session->grupo_id;
        // $datos['rol'] = $rol;
        $datos['disabled'] = '';
        $datos['adjunto'] = false;
        $datos['asunto'] = false;
        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $mensajes = new MensajesModel($db);
            $listado_user =  $mensajes->lists_user_rol($rol,$oid_grupo);
            // echo var_dump($listado_user);
            foreach($listado_user as $valor){
                $datos_insert = ['oid_origen'=>'1','oid_destino'=>$valor->oid,'texto'=>$data_post['mensaje'],'fecha'=>date("Y-m-d H:i:s")];
                $respuesta = $mensajes->agregar($datos_insert);
            }
            // return;
            // $respuesta = $mensajes->agregar($data_post);

            if ($respuesta == TRUE){
                $datos['mensaje_servidor'] = 'La carrera ha sido creada correctamente!';
                $datos['url_retorno'] = 'usuario/mi_comunidad';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear la carrera!';
                $datos['url_retorno'] = 'usuario/mi_comunidad';
                return view('respuestas_servidor/error', $datos);
            }
        }
        
        return view('mensajeria/composer', $datos);
    }

    public function mensaje_masivo($rol='ALU'){
        $session = session();
        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mi comunidad','ubicacion_url'=>'public/usuario/mi_comunidad');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $oid_grupo = $session->grupo_id;
        $datos['oid_grupo'] = $session->grupo_id;
        $datos['rol'] = $rol;
        $datos['disabled'] = 'disabled';
        $datos['adjunto'] = false;
        $datos['asunto'] = false;
        switch($rol){
            case 'ALU':
                $rol_text = "Alumnos";
                break;
            case 'TUT':
                $rol_text = "Gestor Administrativo";
                break;
            case 'PRO':
                $rol_text = "Profesores";
                break;
            case 'PUB':
                $rol_text = "Coordinadores";
                break;
            case 'VIS':
                $rol_text = "Curricular";
                break;
            case 'ADM':
                $rol_text = "Administradores";
                break;
            case 'POS':
                $rol_text = "Administrador de Admision";
                break;
        }
        $datos['rol_text'] = $rol_text;
        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $mensajes = new MensajesModel($db);
            $listado_user =  $mensajes->lists_user_rol($rol,$oid_grupo);
            // echo var_dump($listado_user);
            foreach($listado_user as $valor){
                $datos_insert = ['oid_origen'=>'1','oid_destino'=>$valor->oid,'texto'=>$data_post['mensaje'],'fecha'=>date("Y-m-d H:i:s")];
                $respuesta = $mensajes->agregar($datos_insert);
            }
            // return;
            // $respuesta = $mensajes->agregar($data_post);

            if ($respuesta == TRUE){
                $datos['mensaje_servidor'] = 'La carrera ha sido creada correctamente!';
                $datos['url_retorno'] = 'usuario/mi_comunidad';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear la carrera!';
                $datos['url_retorno'] = 'usuario/mi_comunidad';
                return view('respuestas_servidor/error', $datos);
            }
        }
        
        return view('mensajeria/composer', $datos);
    }

    public function correo_masivo($rol='ALU'){
        $session = session();
        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mi comunidad','ubicacion_url'=>'public/usuario/mi_comunidad');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $oid_grupo = $session->grupo_id;
        $datos['oid_grupo'] = $session->grupo_id;
        $datos['rol'] = $rol;
        $datos['disabled'] = 'disabled';
        $datos['adjunto'] = true;
        $datos['asunto'] = true;
        switch($rol){
            case 'ALU':
                $rol_text = "Alumnos";
                break;
            case 'TUT':
                $rol_text = "Gestor Administrativo";
                break;
            case 'PRO':
                $rol_text = "Profesores";
                break;
            case 'PUB':
                $rol_text = "Coordinadores";
                break;
            case 'VIS':
                $rol_text = "Curricular";
                break;
            case 'ADM':
                $rol_text = "Administradores";
                break;
            case 'POS':
                $rol_text = "Administrador de Admision";
                break;
        }
        $datos['rol_text'] = $rol_text;
        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $mensajes = new MensajesModel($db);
            $listado_user =  $mensajes->lists_user_rol($rol,$oid_grupo);
            // echo var_dump($listado_user);
            foreach($listado_user as $valor){
                $datos_insert = ['oid_origen'=>'1','oid_destino'=>$valor->oid,'texto'=>$data_post['mensaje'],'fecha'=>date("Y-m-d H:i:s")];
                $respuesta = $mensajes->agregar($datos_insert);
            }
            // return;
            // $respuesta = $mensajes->agregar($data_post);

            if ($respuesta == TRUE){
                $datos['mensaje_servidor'] = 'La carrera ha sido creada correctamente!';
                $datos['url_retorno'] = 'usuario/mi_comunidad';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear la carrera!';
                $datos['url_retorno'] = 'usuario/mi_comunidad';
                return view('respuestas_servidor/error', $datos);
            }
        }
        
        return view('mensajeria/composer', $datos);
    }


    function send(){
        // Load PHPMailer library
        $this->load->library('phpmailer_lib');
        
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        return;
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.example.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'user@example.com';
        $mail->Password = '********';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        
        $mail->setFrom('info@example.com', 'Programacion.net');
        $mail->addReplyTo('info@example.com', 'Programacion.net');
        
        // Add a recipient
        $mail->addAddress('john.doe@gmail.com');
        
        // Add cc or bcc 
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
        $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
    }

    // Elimiminar de forma simultanea lote de mensajes
    function delete_messages(){
        if ($this->request->getMethod() == 'post') {
            $obj = $this->request->getPost();
            $eliminar = new MensajesModel($db);

            foreach ($obj as $ids){
                $respuesta = $eliminar->delete_messages($ids);
                var_dump($respuesta);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    

}
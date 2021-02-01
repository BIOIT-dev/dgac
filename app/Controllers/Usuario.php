<?php namespace App\Controllers;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ComunidadModel;
use App\Models\AccesoModel;
use App\Models\RolesModel;
use App\Models\MensajesModel;
use App\Libraries\Spreadsheet_Excel_Writer;

class Usuario extends BaseController
{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        //$session = session();
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
        //$datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        //$datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Noticias de mi Comunidad');
    }
    /******************************************************************/
    /******************************************************************/

    public function mi_comunidad($rol='ALU')
    {
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mi Comunidad');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        // $obj = new NoticiasModel($db);
        $datos['profile_data'] = $findUsuario;
        $datos['oid_grupo'] = $session->grupo_id;
        $data_busqueda['comunidad']=$session->grupo_id;
        $data_busqueda['rol']=$rol;
        $datos['rol'] = $rol;

        $buscarUsuario = new UsuarioModel($db);
        $datos['resultado_busqueda'] = $buscarUsuario->buscar_usuario_mi_comunidad($data_busqueda);
        // print_r($datos['resultado_busqueda'] );
        // return;
        // return view('usuario/listado-usuario', $datos);

        return view('usuario/mi-comunidad', $datos);
    }


    public function usuarioscomunidadjson() { 

        #header('Content-Type: application/json');
      
        $crearUsuario = new UsuarioModel($db);
        $data_usuario=[];
        $respuesta = $crearUsuario->usuarios_json();
        
        echo var_dump($respuesta);
      
      } 

	public function crear_usuario()
	{
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Crear Usuario');

        if ($this->request->getMethod() == 'post') {
            $data_usuario = $this->request->getPost();
            $data_usuario['clave'] = md5($data_usuario['clave']);

			$crearUsuario = new UsuarioModel($db);
			$respuesta = $crearUsuario->validarUserid($data_usuario['userid'], $data_usuario['rut']);
			if(count($respuesta) >= 1){
				$datos['mensaje_servidor'] = "El usuario ingresado ya existe";
				$datos['url_redirect'] = 'usuario/crear_usuario';
				return view('respuestas_servidor/error_params', $datos);
			}
			// var_dump(count($respuesta));
			// return;
            $usuario_id = $crearUsuario->crear_usuario_model($data_usuario);

            if($usuario_id > 0){
                $db = \Config\Database::connect();
				
				//~ // Asignación de permisos (Administrador)
				//~ // Búsqueda de rol 'Administradores'
				//~ $buscarRole = new RolesModel($db);
				//~ $data_role = array('name' => 'Administradores');
				//~ $datosRole = $buscarRole->buscar_role_model($data_role);
				//~ // Búsqueda de grupo 'Comunidad Abierta'
				//~ $buscarGrupo = new UsuarioModel($db);
				//~ $data_grupo = array('grupo_name' => 'Comunidad Abierta');
				//~ $datosGrupo = $buscarGrupo->find_grupo($data_grupo);
				//~ // Búsqueda de usuarios asociados al rol y grupo seleccionados ('Administradores' y 'Comunidad Abierta')
				//~ $buscarRoleGrupo = new AccesoModel($db);
				//~ $data_role_grupo = array(
					//~ 'role_id' => $datosRole[0]->id,
					//~ 'grupo_id' => $datosGrupo[0]->oid
				//~ );
				//~ $datosRoleGrupo = $buscarRoleGrupo->PermisosRoleGrupo($data_role_grupo);
				//~ // Asociación del nuevo usuario al rol/grupo
				//~ $usuarios_actuales = explode(",", $datosRoleGrupo[0]->usuario_ids);
				//~ $usuarios_actuales[] = $respuesta;
				//~ $nuevos_usuarios = $usuarios_actuales;
				//~ $data_acceso['id'] =  $datosRoleGrupo[0]->id;
				//~ $data_acceso['role_id'] =  $datosRoleGrupo[0]->role_id;
				//~ $data_acceso['grupo_id'] =  $datosRoleGrupo[0]->grupo_id;
				//~ $data_acceso['usuario_ids'] =  implode( ',', $nuevos_usuarios );
				//~ $editaracceso = new AccesoModel($db);
				//~ $ejecucion = $editaracceso->editar_acceso_model($data_acceso);

                $new_data = array(
                    'oid_usuario' => $usuario_id,
                    'oid_grupo' => 1,
                    'rol' => 'ALU',
                    'oid_tutor' => 0,
                    'conexiones' => 0,
                    'hits_click' => 0,
                    'hits_download' => 0,
                    'hits_post' => 0,
                    'hits_scorm' => 0
                );
                
                $db->table('usuario_grupo')->insert($new_data);
				
				$datos['url_retorno'] = 'profile/administracion';
                $datos['mensaje_servidor'] = 'El usuario ha sido creado correctamente!</br>Click "OK" para ingresar datos.';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el usuario!';
                return view('respuestas_servidor/error', $datos);
            }
        }
		return view('usuario/crear-usuario', $datos);
	}
    /******************************************************************/
    /******************************************************************/
    function eliminar_usuario(){
        if ($this->request->getMethod() == 'post') {
            $usuarios_recibidos = $this->request->getPost();
            $eliminarUsuario = new UsuarioModel($db);

            foreach ($usuarios_recibidos as $id_usuario){
                $respuesta = $eliminarUsuario->eliminar_usuario_model($id_usuario);
                var_dump($respuesta);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function buscar_usuario(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Buscar Usuario');

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();
			
            $buscarUsuario = new UsuarioModel($db);
            $datos['resultado_busqueda'] = $buscarUsuario->buscar_usuario_model($data_busqueda);
            // echo var_dump($datos['resultado_busqueda']);
			// return;
            return view('usuario/listado-usuario', $datos);
        }

        $findComunidades = new ComunidadModel($db);
        $query = $findComunidades->obtenerComunidades();
        $datos['query'] = $query;

        return view('usuario/buscar-usuario', $datos);
    }
    /******************************************************************/
    function editar($id_usuario){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Usuario');

        $obj = new UsuarioModel($db);
        $findUsuario_edit = $obj->find($id_usuario);
        $datos['profile_data_edit'] = $findUsuario_edit;
        $datos['profile_foto_edit'] = array('foto'=>base_url().'/assets/images/users/4.jpg');
        $roles = new RolesModel($db);
        $datos['roles'] = $roles->obtenerRules();
        $datos['grupo'] = $obj->obtenerComunidades();
        $datos['access_users'] = $obj->list_access_users($findUsuario_edit['oid']);

        if ($this->request->getMethod() == 'post') {
            $data_usuario = $this->request->getPost();
            $editarUsuario = new UsuarioModel($db);
            $data_acceso['grupos_id'] = $data_usuario['grupos_id'];
            $data_acceso['roles_id']  = $data_usuario['roles_id'];
            $data_acceso['id_usuario']  = $id_usuario;
            $editarUsuario->editar_usuario_permisos_model($data_acceso);
            unset($data_usuario['grupos_id']);
            unset($data_usuario['roles_id']);
            $respuesta = $editarUsuario->editar_usuario_model($data_usuario);

            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'Usuario/editar/'.$id_usuario;
                $datos['mensaje_servidor'] = 'El usuario se editó correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
				$datos['url_retorno'] = 'Usuario/editar/'.$id_usuario;
                $datos['mensaje_servidor'] = 'No se ha podido editar el usuario!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        return view('usuario/editar-usuario', $datos);
    }

    function crear_usuario_permisos(){
        $data = $this->request->getPost();
        $obj = new UsuarioModel($db);
        $new_data = array(
			'oid_usuario' => $data['usuario_ids'],
			'oid_grupo' => $data['grupo_id'],
			'rol' => $data['role_id'],
			'oid_tutor' => 0,
			'conexiones' => 0,
			'hits_click' => 0,
			'hits_download' => 0,
			'hits_post' => 0,
			'hits_scorm' => 0
        );
        $respuesta = $obj->crear_usuario_permisos_model($new_data);
        if ($respuesta == 'ok'){
            $datos['res'] = "success";
            $datos['message'] = 'El acceso al grupo se registró correctamente!';
        }else if($respuesta == 'existe'){
            $datos['res'] = "error";
            $datos['message'] = 'El acceso al grupo ya existe!';
        }else{
            $datos['res'] = "error";
            $datos['message'] = 'No se ha podido registrar el El Nivel de Acceso!';
        }

        echo json_encode($datos);

    }

    function find_grupo(){
        $data = $this->request->getPost();
        $obj = new UsuarioModel($db);
        $res = $obj->find_grupo( $data );
        echo json_encode($res);
    }
    /******************************************************************/
    /******************************************************************/
    function actualUser(){
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find(1);
        return $findUsuario;
    }
    /** Menu **/
    public function menu( $user_id )
    {
        /** Permisos de usuario **/
        $instance = new AccesoModel($db);
        $data['permisos'] = $instance->UsuarioPermisos( $user_id );

        /**
        / Permisos por Role
        */
        if($data['permisos'] != "" && $data['permisos'] != null){
			$role_id               = $data['permisos']->role_id;
			$data['role_id']       = $data['permisos']->role_id;
			$data['grupo_id']      = $data['permisos']->grupo_id;
		}else{
			$role_id               = 0;
			$data['role_id']       = 0;
			$data['grupo_id']      = 0;
		}
        $data['panel_admin']   = $instance->PanelAdmin( $role_id );
        $data['role_permisos'] = $instance->RolePermisos( $role_id ,$data['grupo_id']);
        
        //echo "<pre>";
        //print_r($data);
        return $data;
    }

    function set_cookie( $userid, $password ) {
      $cookie_userid              = "userid";
      $cookie_value_cookie_userid = $userid;
      setcookie($cookie_userid, $cookie_value_cookie_userid, time() + (86400 * 30), "/"); // 86400 = 1 day
      $cookie_password            = "password";
      $cookie_value_password      = $password;
      setcookie($cookie_password, $cookie_value_password, time() + (86400 * 30), "/"); // 86400 = 1 day

    }

    /** Procesar datos de logeo **/
    function iniciar_login(){
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $datos = $this->request->getPost();

            // Almacenar datos en cookie
            if( isset($datos['checkbox-signup']) && $datos['checkbox-signup'] > 0 ){
                $this->set_cookie( $datos['userid'], $datos['clave'] );
            }
            isset($datos['checkbox-signup']);
            $login = new UsuarioModel($db);
            $login = $login->login_validar_model( $datos );
            
            if( $login > 0 ){
                $findUsuario = new UsuarioModel($db);
                $findUsuario = $findUsuario->getUsuario( $datos['userid'] );
                $headers['profile_data'] = $findUsuario;
                $headers['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
                $headers['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Noticias ');
                $buscarComunidad = new ComunidadModel($db);
				// $grupo_id = $this->menu( $findUsuario['oid'] )['grupo_id'];
				$grupo_id = $buscarComunidad->getLastGrupoId($headers['profile_data']['oid']);

                $datos['resultado_busqueda'] = $buscarComunidad->buscarComunidadId($grupo_id->oid_grupo);
                
                $newdata = [
                    'sessionExpiration'  => 7200,
                    'user_id'  => $findUsuario['oid'],
                    'username'  => $datos['userid'],
                    'menu'  => $this->menu( $findUsuario['oid'] ),
                    'role_id'  => $this->menu( $findUsuario['oid'] )['role_id'],
                    'aulavirtual'  => $datos['resultado_busqueda'][0]->aulavirtual,
                    'grupo_nombre' => $datos['resultado_busqueda'][0]->nombre,
					// 'grupo_id'  => $this->menu( $findUsuario['oid'] )['grupo_id'],
					'grupo_id'  => $grupo_id->oid_grupo,
					'mostrar_encuestas' => "1"
                ];

                $session->set($newdata);

                $headers['username'] = $session->username;
				// return redirect()->to(base_url('public/Home'));
				return redirect()->to(base_url('public/Comunidad/iniciar_comunidad/'.$grupo_id->oid_grupo));                
            }else{
                $headers['mensaje_servidor'] = 'Usuario o contrase&ntilde;a incorrectos!';
                return redirect()->to(base_url('public/login'));
            }
        }else{
            return redirect()->to(base_url('public/login'));
        }
    }
    /******************************************************************/
    // Recuperar contraseña
    /******************************************************************/
    function recover_user(){

        $obj    = new UsuarioModel($db);
        
        $email        = \Config\Services::email();
        $destinatario = $this->request->getPost('email_user');
        $verify       = $obj->getUsuarioEmail( $destinatario );

        $email->setFrom('consultora.bioit@gmail.com', 'Restablece la contraseña de tu cuenta');
        $email->setTo($destinatario);
        //$email->attach(base_url().'/assets/images/users/5.jpg');
        // $email->setCC('consultora.bioit@gmail.com');

        $email->setSubject('Restablecer contraseña');
        $setMessage = "Hola $destinatario,\n\n";
        $setMessage .= "Has solicitado restablecer la contraseña de tu cuenta. Para verificar que la solicitud fue hecha por ti, por favor haz clic en el enlace a continuación y sigue los pasos para restablecer.\n\n";
        
        $token = bin2hex(random_bytes(64));
        $redirect_url = base_url('public/login?token='.$token.'&email_user='.$destinatario);
        
        $setMessage .= "<a href=".$redirect_url.">Restablecer contraseña</a>";
        $email->setMessage($setMessage);

        $email->send();


        //if( $verify[0]['oid'] > 0 ){
        //    return redirect()->to(base_url('public/login?token='.$token.'&email_user='.$destinatario));
        //}else{
        //    return redirect()->to(base_url('public/login?error=1'));
        //}
        //return redirect()->to(base_url('public/login?token='.$token.'&email_user='.$destinatario));

    }

    /******************************************************************/
    // Envio de correo electronico para un usuario en particular
    /******************************************************************/
    function send_email_user( $rol ){

        $session = session();
        
        $email = \Config\Services::email();
        $data  = $this->request->getPost();
    
        $email->setFrom('consultora.bioit@gmail.com', 'Mensaje DGAC');
        $email->setTo($data['email']);
        //$email->attach(base_url().'/assets/images/users/5.jpg');
        // $email->setCC('consultora.bioit@gmail.com');

        $email->setSubject('Mensaje');
        $setMessage = $data['message'];
        $email->setMessage($setMessage);

        $email->send();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Envio E-mail');
        $datos['mensaje_servidor'] = 'Se envio e-Mail correctamente!';
        $datos['url_retorno'] = 'usuario/mi_comunidad/'.$rol;
        return view('respuestas_servidor/exito', $datos);

    }
    /******************************************************************/
    // Envio de mensaje para un usuario en particular
    /******************************************************************/
    function send_message_user( $rol ){

        $session = session();

        $data     = $this->request->getPost();
        $mensajes = new MensajesModel($db);

        $message['oid_origen']  = 1;
        $message['oid_destino'] = $data['oid_destino'];
        $message['texto']       = $data['message'];
        $message['fecha']       = date("Y-m-d H:i:s");
        $respuesta            = $mensajes->agregar($message);

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Envio Mensaje');
        $datos['mensaje_servidor'] = 'Se envio mensaje correctamente!';
        $datos['url_retorno'] = 'usuario/mi_comunidad/'.$rol;
        return view('respuestas_servidor/exito', $datos);

    }
    /******************************************************************/
    // Cambio de contraseña
    /******************************************************************/
    function change_password(){
        $obj          = new UsuarioModel($db);
        $data         = $this->request->getPost();
        return $obj->change_password( $data );
    }
    /******************************************************************/
    function refresh_session(){
        $session = session();

        $data = $this->request->getPost();
        $sessionExpiration = $data['sessionExpiration'];
        
        $newdata = [
            'sessionExpiration'  => $sessionExpiration
        ];
        return $session->set($newdata);
    }

    function acceso_modulo(){

        $session = session();

        $data = $this->request->getPost();
        $acceso = explode(',', $data['acceso']);

        $data = array(
            'lectura' => (isset($acceso[0]) ? $acceso[0] : 0),
            'escritura' => (isset($acceso[1]) ? $acceso[1] : 0),
            'eliminar' => (isset($acceso[2]) ? $acceso[2] : 0)
        );
        
        $newdata = [
            'accesos'  => $data
        ];

        //print_r($newdata);

        return $session->set($newdata);

    }

    function close_session(){
        $session = session();
        $session->destroy();
        echo 'success';
    }
    /******************************************************************/
    function cerrar(){
        $session = session();
        $session->destroy();
        $headers['mensaje_servidor'] = 'Se ha cerrado la sesi&oacute;n';
        return redirect()->to(base_url('public/login'));

	}
	
	function index(){
		return redirect()->to(base_url('public/usuario/buscar_usuario'));
	}
    
    /******************************************************************/
    /* MÉTODOS DE IMPORTACIÓN Y EXPORTACIÓN MASIVA */
    /******************************************************************/
    /* MÉTODO DE IMPORTACIÓN MASIVA */
    public function carga()
	{
		$datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Carga Masiva de Usuarios');
		
		$session = session();
		$findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->getUsuario( $session->username );
        
        $objComunidad = new ComunidadModel($db);
        $datos['comunidades'] = $objComunidad->obtenerComunidades();

        $objRol = new RolesModel($db);
        $datos['roles'] = $objRol->obtenerRules();
        
        $campos = array();
		$campos[1] = array( 1, "UserId" );
		$campos[2] = array( 1, "Clave" );
		$campos[3] = array( 0, "RUT", "( 98765432-K )" );
		$campos[4] = array( 1, "Nombres" );
		$campos[5] = array( 1, "Apellido Paterno" );
		$campos[6] = array( 0, "Apellido Materno" );
		$campos[7] = array( 1, "Sexo", "( M o F )" );
		$campos[8] = array( 0, "Fecha de Nacimiento", "( dd/mm/aaaa )" );
		$campos[9] = array( 0, "Profesión" );
		$campos[10] = array( 0, "e-Mail", "( nombre@dominio.cl )" );
		$campos[11] = array( 0, "Teléfono" );
		$campos[12] = array( 0, "Dirección" );
		$campos[13] = array( 0, "Comuna" );
		$campos[14] = array( 0, "Ciudad" );
		$campos[15] = array( 0, "Cargo en la Empresa" );
		$campos[16] = array( 0, "Unidad en la Empresa" );
		$campos[17] = array( 0, "Teléfono en la Empresa" );
		$campos[18] = array( 0, "Dirección en la Empresa" );
		$campos[19] = array( 0, "Comuna en la Empresa" );
		$campos[20] = array( 0, "Ciudad en la Empresa" );
		
		$datos['campos'] = $campos;

        if ($this->request->getMethod() == 'post') {
            $data_form['datos'] = $this->request->getPost();
            
            $uid_grupo = $findUsuario['oid_grupo'];
            
            $data_form['archivo'] = $_FILES;
            
            // Validación de la data y el archivo
            $validate = $this->data_validate($uid_grupo, $data_form['datos'], $data_form['archivo']);
            
            $data_form['result'] = $validate;
            
            return view('usuario/carga_result', $data_form);
        }
        return view('usuario/carga', $datos);
	}
	/* FUNCIÓN DE EJECUCIÓN DE LA EXPORTACIÓN MASIVA */
	public function data_validate( $uid_grupo, $datos, $file ){
		
		//~ echo "<pre>";
		//~ print_r($datos);
		//~ exit();
				
		// recuperamos los datos del formulario
		//~ $authInterna = $this->getPageParam( "authInterna", $datos );
		//~ $goid = $this->getPageParam( "goid", $datos );
		//~ $grol = $this->getPageParam( "grol", $datos );
		//~ // $gfile = $this->getPageParam( "gfile", $data );
		//~ $gcod = $this->getPageParam( "gcod", $datos );
		//~ $gsep = $this->getPageParam( "gsep", $datos );
		//~ $gsepotro = $this->getPageParam( "gsepotro", $datos );
		//~ $geol = $this->getPageParam( "geol", $datos );
		//~ $glin = $this->getPageParam( "glin", $datos );
		//~ $incorporar = $this->getPageParam( "incorporar", $datos );
		$authInterna = $datos['authInterna'];
		$goid = $datos['goid'];
		$grol = $datos['grol'];
		$gcod = $datos['gcod'];
		$gsep = $datos['gsep'];
		$gsepotro = $datos['gsepotro'];
		$geol = $datos['geol'];
		$glin = $datos['glin'];
		$incorporar = $datos['incorporar'];

		// la comunidad debe existir
		// $sql="select 1 from grupo where oid=$goid";
		// $r=$_Db->query( $sql );
		// if( !$r ) $goid=0;
		$objComunidad = new ComunidadModel($db);
        $comunidad = $objComunidad->buscarComunidadId($goid);
        if( count($comunidad) == 0 ) $goid = 0;

		// el rol debe existir
		// if( !@$roles[ $grol ] ) $grol="";
		$objRol = new RolesModel($db);
        $rol = $objRol->buscar_role_clave($grol);
        if( count($rol) == 0 ) $grol = "";

		// el archivo debe contener data
		$gfile_name=@$this->cleanPageParam($file["gfile"]["name"]);
		$gfile_size=@trim($file["gfile"]["size"])+0;
		$gfile_type=@trim($file["gfile"]["type"]);
		$gfile_tmp =@trim($file["gfile"]["tmp_name"]);

		// los campos deben estar especificados correctamente
		$campos = array();
		$campos[1] = array( 1,"userid", "" );
		$campos[2] = array( $authInterna, "clave", "" );
		$campos[3] = array( 0, "rut", "" );
		$campos[4] = array( 1, "nombres", "" );
		$campos[5] = array( 1, "apellido_paterno", "" );
		$campos[6] = array( 0, "apellido_materno", "" );
		$campos[7] = array( 1, "sexo", "" );
		$campos[8] = array( 0, "fecnac", "" );
		$campos[9] = array( 0, "profesion", "" );
		$campos[10] = array( 0, "email", "" );
		$campos[11] = array( 0, "fono", "" );
		$campos[12] = array( 0, "direccion", "" );
		$campos[13] = array( 0, "comuna", "" );
		$campos[14] = array( 0, "ciudad", "" );
		$campos[15] = array( 0, "empresa_cargo", "" );
		$campos[16] = array( 0, "empresa_unidad", "" );
		$campos[17] = array( 0, "empresa_telefono", "" );
		$campos[18] = array( 0, "empresa_direccion", "" );
		$campos[19] = array( 0, "empresa_comuna", "" );
		$campos[20] = array( 0, "empresa_ciudad", "" );
		$campo = $this->getPageParam( "campo", $datos );
		if( !is_array( $campo ) ) $campo = array();
		foreach( $campos as $idx => $a ){
			if( $campos[ $idx ][ 0 ] ) continue;
			if( isset( $campo[ $idx ] ) && $idx != 2 ) continue;
			unset( $campos[ $idx ] );
		}

		$msg="";
		if( !$goid )
		$msg = 'No Existe el Elemento Solicitado';
		elseif( $uid_grupo != 1 && $uid_grupo != $goid )
		$msg = 'Los Parámetros Recibidos son Incorrectos.';
		elseif( $grol == "" )
		$msg = 'Debe seleccionar un rol';
		elseif( $goid == 1 && $grol == "ADM" )
		$msg = 'Los Parámetros Recibidos son Incorrectos.';
		elseif( $gfile_size <= 0 )
		$msg = 'El archivo se encuentra Vacio';
		else{
			if( $gcod != "latin1" ) $gcod = "utf-8";

			if( $gsep == "TAB" ) $gsepotro = "\t";
			elseif( $gsep != "OTRO" ) $gsepotro = $gsep;

			if( $geol=="CR" ) $geolotro="\r";
			elseif( $geol == "CRLF" ) $geolotro = "\r\n";
			else $geolotro = "\n";

			if( $glin < 0 ) $glin = 0;

			$data = file_get_contents( $gfile_tmp );
			if( $data === false ) $msg = 'Error al Cargar Elemento';
			if( $gcod == "latin1" ) $data = utf8_encode( $data );
			elseif( $gcod == "utf-8" && substr( $data, 0, 3 ) == "\xef\xbb\xbf" ) $data = substr( $data, 3 );
			$lines = mb_split( $geolotro, $data );
			unset( $data );

			$nLines = 0;
			$badLines = 0;
			$goodLines = 0;
			$skipLines = 0;
			$nullLines = 0;
			$bigErr = "";
			foreach( $lines as $k => $line ){
			  $nLines++;

			  if( $nLines <= $glin ){
				$skipLines++;
				continue;
			  }

			  $line = str_replace( "\n", "", $line );
			  $line = str_replace( "\r", "", $line );
			  //$line=trim( $line );
			  if( $line == "" ){
				$nullLines++;
				continue;
			  }

			  $err = "";
			  $fields = mb_split( $gsepotro, $line );
			  if( count( $fields )!=count( $campos ) ){
				$err .= " [# de Campos es Insuficiente: " . count( $fields ) . " recibidos de " . count( $campos ) . " esperados] ";
			  }
			  else{
				foreach( $campos as $idx => $a ){
				  //~ $v = $this->sqlEscape( @trim( array_shift( $fields ) ) );
				  $v = @trim( array_shift( $fields ) );
				  if( $idx == 3 ) $v = mb_strtoupper( $v );
				  elseif( $idx == 7 ) $v = mb_strtolower( $v );
				  $campos[ $idx ][ 2 ] = $v;
				  //~ echo $campos[ $idx ][ 2 ]."<br>";
				}
				//~ exit();

				$xuserid = $campos[ 1 ][ 2 ];
				if( $xuserid == "" ) $err .= " [Debe Ingresar UserId] ";
				elseif( !preg_match( "/^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ][a-zA-Z0-9áéíóúñÁÉÍÓÚÑ._@-]+$/u", $xuserid ) ) $err .= " [Usuario Inválido '$xuserid'] ";
				else{
				  //~ $sql = "select oid from usuario where userid='$xuserid'";
				  //~ $r=$_Db->query( $sql );
				  $findUsuario = new UsuarioModel($db);
				  $findUsuario = $findUsuario->getUsuario( $xuserid );
				  
				  if( isset($findUsuario) ){
					//~ $sql="select 1 from usuario_grupo where oid_usuario=$r->oid and oid_grupo=$goid";
					//~ $rr=$_Db->query( $sql );
					$findUsuarioGrupo = new UsuarioModel($db);
				    $findUsuarioGrupo = $findUsuarioGrupo->verificarUsuarioGrupo( $findUsuario['oid'], $goid);
					//~ if( $rr )
					if( count($findUsuarioGrupo) > 0 )
					  $err .= " [Userid ya existe en la Comunidad] ";
					elseif( $incorporar ){
					  //~ $sql="insert into usuario_grupo( oid_usuario, oid_grupo, rol, oid_tutor ) " .
						   //~ "values( $r->oid, $goid, '$grol', 0 )";
					  //~ $_Db->query( $sql );
					  $datos_usuario_grupo = array(
						'oid_usuario' => $findUsuario['oid'],
						'oid_grupo' => $goid,
						'rol' => $grol,
						'oid_tutor' => 0						
					  );
					  $objUsuario = new UsuarioModel($db);
				      $insertUsuarioGrupo = $objUsuario->registrarUsuarioGrupo( $datos_usuario_grupo );
					  $goodLines++;
					}
					else
					  $err .= " [El usuario ya existe] ";

					if( $err ){
					  $badLines++;
					  $bigErr .= "<p>Línea $nLines: $err</p>";
					}
					continue;
				  }
				}
				if( ($f = @$campos[ 2 ][ 2 ]) == "" && $authInterna ) $err .= " [Debe Ingresar Clave] ";
				if( ($f = @$campos[ 3 ][ 2 ]) != "" && !$this->validaRUT( $f )  ) $err .= " [RUT Inválido '$f'] ";
				if( ($f = @$campos[ 4 ][ 2 ]) == "" ) $err .= " [Debe Ingresar Nombres] ";
				if( ($f = @$campos[ 5 ][ 2 ]) == "" ) $err .= " [Debe Ingresar Apellido Paterno] ";
				if( ($f = @$campos[ 7 ][ 2 ]) != "m" && $f != "f" ) $err .= " [Sexo incorrecto '$f'] ";
				if( ($f = @$campos[ 8 ][ 2 ]) != "" && !preg_match( "/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/", $f ) ) $err .= " [Fecha de Nacimiento incorrecta '$f'] ";
				if( ($f = @$campos[ 10 ][ 2 ]) != "" && !preg_match( "/^([ñ\w-]+(?:\.[ñ\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i", $f ) ) $err .= " [Correo Electrónico incorrecto '$f'] ";
			  }

			  if( $err == "" ){
				if( $authInterna ) $campos[ 2 ][ 2 ] = md5( $campos[ 2 ][ 2 ] );
				$xapellidos = trim( @$campos[ 5 ][ 2 ] . " " . @$campos[ 6 ][ 2 ] );
				if( @$campos[ 8 ][ 2 ] != "" ) $campos[ 8 ][ 2 ] = $this->dateToDB( $campos[ 8 ][ 2 ] );
				$sql = "insert into usuario( inactivo, ";
				foreach( $campos as $idx=>$a ) $sql .= $campos[ $idx ][ 1 ] . ", ";
				$sql .= "apellidos ) " ;
				$sql .= "values( '0', ";
				foreach( $campos as $idx=>$a ) $sql .= "'" . $campos[ $idx ][ 2 ] . "', ";
				$sql .= "'$xapellidos' )" ;
				//~ $_Db->query( $sql );
				//~ $xoid=$_Db->getInsertId();
				$objUsuario = new UsuarioModel($db);
				$xoid = $objUsuario->registrarUsuarioAlt( $sql );
				
				//~ $sql="insert into usuario_grupo( oid_usuario, oid_grupo, rol, oid_tutor ) " .
					 //~ "values( $xoid, $goid, '$grol', 0 )";
				//~ $_Db->query( $sql );
				$datos_usuario_grupo = array(
				  'oid_usuario' => $xoid,
				  'oid_grupo' => $goid,
				  'rol' => $grol,
				  'oid_tutor' => 0						
				);
				$objUsuario = new UsuarioModel($db);
				$insertUsuarioGrupo = $objUsuario->registrarUsuarioGrupo( $datos_usuario_grupo );
				
				$goodLines++;
			  }

			  if( $err ){
				$badLines++;
				$bigErr .= "<p>Línea $nLines: $err</p>";
			  }
			}

			$msg=strtr( '<p>La Carga Masiva a Finalizado:</p><p>{nLines} Línea(s) Leidas<br />{goodLines} Línea(s) Ingresadas como Usuario<br />{skipLines} Línea(s) Iniciales no Procesadas<br />{nullLines} Línea(s) Vacía<br />{badLines} Línea(s) con Error<br /></p>', array( '{nLines}'=>$nLines, '{goodLines}'=>$goodLines, '{skipLines}'=>$skipLines, '{nullLines}'=>$nullLines, '{badLines}'=>$badLines, ) );
			if( $bigErr != "" ) $msg .= "$bigErr";

			//~ logEvento( $_SEC, "ADDMASIVOSAVE", "$goid", "$grol" );
		}
		
		return $msg;
	}
	
	// MÉTODOS DE LIMPIEZA DE DATOS
	// simplificamos la recuperación de parámetros métodos POST/GET
	public function getPageParam($name, $datos, $toDb = true)
	{
		$s = $datos[$name];
		if (is_array($s))
			return $s;
		$s = $this->cleanPageParam($s);
		return $toDb ? $this->sqlEscape($s) : $s;
	}

	// Quita las barras de un string con comillas escapadas
	public function cleanPageParam($s)
	{
		$s = @trim($s);
		if (get_magic_quotes_gpc())
			$s = stripslashes($s);
		return $s;
	}

	// escape para la base de datos
	public function sqlEscape($s)
	{
		$db = \Config\Database::connect();
		return $db->escape($s);
	}
	
	// Formatea una fecha de dd/mm/yyyy a yyyy-mm-dd
	public function dateToDB( $d ){
		return date("Y-m-d", strtotime($d) );
	}
	
	// Valida el campo RUT
	public function validaRUT($rut)
	{
		$arr = array();
		$re = "/^([0-9]{7,8})-([0-9K])$/";
		if (! preg_match($re, $rut, $arr))
			return false;
		$rut = $arr[1];
		$dv = $arr[2];
		if (mb_strlen($rut) == 7)
			$rut = "0" . $rut;
		$suma = 0;
		$suma += (mb_substr($rut, 0, 1)) * 3;
		$suma += (mb_substr($rut, 1, 1)) * 2;
		$suma += (mb_substr($rut, 2, 1)) * 7;
		$suma += (mb_substr($rut, 3, 1)) * 6;
		$suma += (mb_substr($rut, 4, 1)) * 5;
		$suma += (mb_substr($rut, 5, 1)) * 4;
		$suma += (mb_substr($rut, 6, 1)) * 3;
		$suma += (mb_substr($rut, 7, 1)) * 2;
		$dvr = 11 - ($suma % 11);
		if ($dvr == 10)
			$dvr = 'K';
		elseif ($dvr == 11)
			$dvr = '0';
		return $dv == $dvr;
	}
	
    /******************************************************************/
    /* MÉTODO DE EXPORTACIÓN MASIVA */
    public function exportar()
	{
		$session = session();
		
		// Datos del usuario actual
        $objUsuario = new UsuarioModel($db);
        $findUsuario = $objUsuario->find($session->user_id);
		
		// Datos de su grupo
        $objGrupo = new ComunidadModel($db);
        $findGrupo = $objGrupo->find($findUsuario['oid_grupo']);
        
        // Fecha actual en dos formatos
        $fecha_actual = $objUsuario->fecha_actual();
        
        $ahora=$fecha_actual->ahora;
		$today=$fecha_actual->today;
        
        $uid_grupo = $findUsuario['oid_grupo'];

		// la comunidad a desplegar
		$coid = $uid_grupo;
		$cnombre = $findGrupo['nombre'];
        
        //~ echo "<pre>";
        //~ print_r($findUsuario);
        
        //~ echo "<pre>";
        //~ print_r($findGrupo);
        
        //~ echo "<pre>";
        //~ print_r($fecha_actual);
        
		//~ $objUsuario = new UsuarioModel($db);
		//~ $UsuariosGrupoRol = $objUsuario->obtenerUsuariosGrupoRol($coid, 'ALU');
		
		//~ $i = 0;
		//~ foreach( $UsuariosGrupoRol as $r ){
		  //~ echo $r->userid." - ";
		  //~ echo $r->rut." - ";
		  //~ echo $r->apellido_paterno." - ";
		  //~ echo $r->apellido_materno." - ";
		  //~ echo $r->nombres." - ";
		  //~ echo $r->sexo=="m" ? 'Masculino' : 'Femenino'." - ";
		  //~ echo $r->fecnac." - ";
		  //~ echo $r->profesion." - ";
		  //~ echo $r->email." - ";
		  //~ echo $r->fono." - ";
		  //~ echo $r->direccion." - ";
		  //~ echo $r->comuna." - ";
		  //~ echo $r->ciudad." - ";
		  //~ $i++;
		//~ }
        
        // El texto por defecto de los roles
		$roles = array();
		$roles["ALU"] = 'Alumnos';
		$roles["TUT"] = 'Gestor Administrativo';
		$roles["PRO"] = 'Profesores';
		$roles["PUB"] = 'Coordinadores';
		$roles["VIS"] = 'Curricular';
		$roles["ADM"] = 'Administradores';
		$roles["POS"] = 'Administrador de Admisión';
		
		// Deshabilitamos el límite de memoria
		ini_set('memory_limit', '-1');
		// Deshabilitamos el límite de tiempo
		set_time_limit(0);
		
		// iniciamos el excel
		$fnameXLS=sprintf( "UsuariosComunidad.G%s.F%s.xls", $coid, preg_replace( "/[^0-9]/u", "", $today ) );
		$workbook = new Spreadsheet_Excel_Writer();
		//~ $workbook->Spreadsheet_Excel_Writer();
		$workbook->setVersion(8);
		$workbook->send( $fnameXLS );
		
		foreach( $roles as $kr=>$rr ){
			$this->doExport( $kr, $coid, $cnombre, $ahora, $workbook, $roles );
		}
		
		// eso es todo
		$workbook->close();
	}
	/* FUNCIÓN DE EJECUCIÓN DE LA EXPORTACIÓN MASIVA */
	public function doExport( $rol, $coid, $cnombre, $ahora, &$workbook, $roles ){

	  $format_bold =& $workbook->addFormat();
	  $format_bold->setBold();

	  $format_tlabel =& $workbook->addFormat();
	  $format_tlabel->setBold();
	  $format_tlabel->setAlign('center');
	  $format_tlabel->setBorder('1');
	  $format_tlabel->setVAlign('vcenter');
	  $format_tlabel->setTextWrap('1');

	  $format_lcell =& $workbook->addFormat();
	  $format_lcell->setAlign('left');
	  $format_lcell->setBorder('1');
	  $format_lcell->setVAlign('top');
	  $format_lcell->setTextWrap('1');

	  $format_ccell =& $workbook->addFormat();
	  $format_ccell->setAlign('center');
	  $format_ccell->setBorder('1');
	  $format_ccell->setVAlign('top');

	  $pagina=1;
	  while( true ){
		$worksheet =& $workbook->addWorksheet( $this->excelSheetName( $roles[ $rol ] . '-' . $pagina ) );
		$worksheet->setInputEncoding( 'UTF-8' );

		$n=1;
		$col=1;
		$worksheet->writeString( $n, $col++, 'Comunidad:' );
		$worksheet->writeString( $n, $col++, trim( $cnombre ) );
		$n++;

		$col=1;
		$worksheet->writeString( $n, $col++, 'Fecha Actual:' );
		$worksheet->writeString( $n, $col++, $ahora );
		$n++;

		$col=1;
		$worksheet->writeString( $n, $col++, 'Rol:' );
		$worksheet->writeString( $n, $col++, trim( $roles[ $rol ] ) );
		$n++;

		$n+=2;
		$col=0;
		$worksheet->setColumn( $col+1, $col+20, 20 );
		$worksheet->writeString( $n, $col++, '#', $format_tlabel );
		$worksheet->writeString( $n, $col++, 'Userid', $format_tlabel );
		$worksheet->writeString( $n, $col++, 'R.U.T', $format_tlabel );
		$worksheet->writeString( $n, $col++, 'Nombres', $format_tlabel );
		$worksheet->writeString( $n, $col++, 'Apellido Paterno', $format_tlabel );
		$worksheet->writeString( $n, $col++, 'Apellido Materno', $format_tlabel );
		$worksheet->writeString( $n, $col++, 'Sexo', $format_tlabel );
		$worksheet->writeString( $n, $col++, 'Fecha de Nacimiento', $format_tlabel );
		$worksheet->writeString( $n, $col++, 'Profesión', $format_tlabel );
		$worksheet->writeString( $n, $col++, 'Correo Electrónico', $format_tlabel );
		$worksheet->writeString( $n, $col++, 'Teléfono', $format_tlabel );
		$worksheet->writeString( $n, $col++, 'Dirección', $format_tlabel );
		$worksheet->writeString( $n, $col++, 'Comuna', $format_tlabel );
		$worksheet->writeString( $n, $col++, 'Ciudad', $format_tlabel );
		$n++;

		if( $pagina==1 ){
		  $objUsuario = new UsuarioModel($db);
		  $UsuariosGrupoRol = $objUsuario->obtenerUsuariosGrupoRol($coid, $rol);
		  $cnt=1;
		}
		// while( $r=$UsuariosGrupoRol ){
		foreach( $UsuariosGrupoRol as $r ){
		  $col=0;
		  $worksheet->writeNumber( $n, $col++, $cnt++, $format_ccell );
		  $worksheet->writeString( $n, $col++, $r->userid, $format_lcell );
		  $worksheet->writeString( $n, $col++, $r->rut, $format_lcell );
		  $worksheet->writeString( $n, $col++, $r->apellido_paterno, $format_lcell );
		  $worksheet->writeString( $n, $col++, $r->apellido_materno, $format_lcell );
		  $worksheet->writeString( $n, $col++, $r->nombres, $format_lcell );
		  $worksheet->writeString( $n, $col++, $r->sexo=="m" ? 'Masculino' : 'Femenino' , $format_lcell );
		  $worksheet->writeString( $n, $col++, $r->fecnac, $format_lcell );
		  $worksheet->writeString( $n, $col++, $r->profesion, $format_lcell );
		  $worksheet->writeString( $n, $col++, $r->email, $format_lcell );
		  $worksheet->writeString( $n, $col++, $r->fono, $format_lcell );
		  $worksheet->writeString( $n, $col++, $r->direccion, $format_lcell );
		  $worksheet->writeString( $n, $col++, $r->comuna, $format_lcell );
		  $worksheet->writeString( $n, $col++, $r->ciudad, $format_lcell );
		  $n++;

		  if( $n>65500 ) break;
		}
		//~ if( count($UsuariosGrupoRol) > 65500 ) $pagina++;
		//~ // if( $r ) $pagina++;
		//~ else break;
		break;
	  }
	  
	}
	// Filtra nombre de hoja excel
	public function excelSheetName($name)
	{
		$name = mb_substr($name, 0, 31);
		$name = utf8_decode($name);
		$name = str_replace(array(
			'\'',
			'\\',
			'/',
			'?',
			'*',
			'[',
			']'
		), '_', $name);
		return $name;
	}
}

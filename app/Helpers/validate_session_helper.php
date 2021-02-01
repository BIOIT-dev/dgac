<?php 

use App\Models\AccesoModel;

// namespace App\Controllers;
if(!function_exists("validarSesion"))
{
 
	function validarSesion()
	{
		
		// Capturamos el REQUEST_URI
		$request_uri = explode(base_url(), current_url());
		
		// Capturamos la variable de sesión
		$session = \Config\Services::session();
		
		// Rutas libres
		$free_routes = array('/login', '/Usuario/iniciar_login', '/postulaciones', '/Postulaciones', '/Postulaciones/usuario', '/Postulaciones/usuario_nuevo', '/Postulaciones/crear_usuario');
		
		// Si no se ha iniciado sesión y se intenta ingresar a una url protegida, 
		// se redirige al login.
		if(!isset($session->menu)){
		//~ if(!isset($_SESSION['menu'])){
			// var_dump($request_uri[1]);
			// return;
			if(!in_array($request_uri[1], $free_routes)){
				
				echo "<script>
					window.location.href = '".base_url('public/login')."';
				</script>";
				
				//~ return header("Location: ".base_url('public/login'));
				//~ return redirect()->to(base_url('public/login'));
			}
			
		}else{
			
			// Redireccionamos al Home si ya está logueado e intenta ir al login
			if($request_uri[1] == "/login"){
				echo "<script>
					window.location.href = '".base_url('public/Home')."';
				</script>";
			}
			
			//~ echo "<pre>";
			//~ print_r($session->menu);
			
			// Si se ha iniciado sesión pero el usuario no tiene rol asignado, se redirige al login
			if($session->menu['role_id'] == 0){
				$session->destroy();
				echo "<script>
					window.location.href = '".base_url('public/login')."';
				</script>";
			}
			
			// Si no es un administrador
			if($session->menu['permisos']->rol != 'ADM'){
				
				if($request_uri[1] != "/" && $request_uri[1] != "/Home"){
					// VALIDAMOS LOS MÓDULOS PERMITIDOS		
				
					// Primero capturamos los enlaces de los módulos asociados al rol del usuario
					$urls_permitidas = array();
					foreach($session->menu['role_permisos'] as $module){
						$urls_permitidas[] = $module->url;
					}
					
					// Validamos las urls permitidas contra la url a la que se intenta acceder
					$permitir_acceso = "No";
					foreach($urls_permitidas as $url){
						$pos = strpos($request_uri[1], $url);
						if ($pos !== false) {
							$permitir_acceso = "Sí";
						}
					}

					//~ $log = new AccesoModel($db);
        			//~ $respuesta = $log->RegistroLog($session->user_id);
					
					if($permitir_acceso == "No"){
						echo "<script>
							alert('No tiene acceso a la ruta solicitada');
							window.location.href = '".base_url('public/Home')."';
						</script>";
					}
				}
				
				//~ exit();
			}
			
		}
		
		return;
		
	}
 
}

validarSesion();
?>

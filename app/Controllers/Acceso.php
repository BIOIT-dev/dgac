<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\AccesoModel;
use App\Models\RolesModel;

class Acceso extends BaseController
{
    /******************************************************************/

    public function ajax_usuario()
    {   
        $usuario = new UsuarioModel($db);
        $obj = $usuario->getAllUsuario();
        echo json_encode( $obj );
    }

	public function crear_acceso()
	{   
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Crear Acceso');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $roles = new RolesModel($db);
        $datos['roles'] = $roles->obtenerRules();
        $grupo = new AccesoModel($db);
        $datos['grupo'] = $grupo->obtenerComunidades();
        $usuario = new UsuarioModel($db);
        if ($this->request->getMethod() == 'post') {
            $fields = $this->request->getPost();

            $obj = new AccesoModel($db);
            //~ $fields['usuario_ids'] = implode( ',',  $fields['usuario_ids'] );
            $respuesta = $obj->crear_acceso_model($fields);
            if ($respuesta[0] == 0){
				if($respuesta[1] == 0){
					$datos['mensaje_servidor'] = 'Permiso otorgado correctamente!';
				}else{
					$datos['mensaje_servidor'] = $respuesta[1].' de los usuarios que indicó ya están en el grupo seleccionado!';
				}
                $findaccesos = new AccesoModel($db);
                $query = $findaccesos->obtenerAcceso();
                $datos['query'] = $query;

                return view('acceso/buscar-acceso', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el permiso!';
            }
        }
		return view('acceso/crear-acceso', $datos);
	}
    /******************************************************************/
    function editar_acceso($id){

        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar acceso');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
		
		$datos_busqueda['ids'] = $id;  // La clave del rol y el id del grupo
        $findacceso_edit = new AccesoModel($db);
        $role_grupo_usuarios = $findacceso_edit->buscar_acceso_model($datos_busqueda);
        $usuario_ids = $findacceso_edit->buscar_acceso_model_usuarios($datos_busqueda);
        $array_usuario_ids = array();
        foreach($usuario_ids as $oid_usuario){
			$array_usuario_ids[] = $oid_usuario->oid_usuario;
		}
        $role_grupo_usuarios[0]->usuario_ids = implode(',', $array_usuario_ids);
        $datos['acceso_data_edit'] = $role_grupo_usuarios;
        $roles = new RolesModel($db);
        $datos['roles'] = $roles->obtenerRules();
        $grupo = new AccesoModel($db);
        $datos['grupo'] = $grupo->obtenerComunidades();
        $usuario = new UsuarioModel($db);
        //$datos['profile_foto_edit'] = array('foto'=>base_url().'/assets/images/users/4.jpg');

        if ($this->request->getMethod() == 'post') {
            $data_acceso = $this->request->getPost();
            $editaracceso = new AccesoModel($db);
            //~ $data_acceso['usuario_ids'] =  implode( ',',  $data_acceso['usuario_ids'] );
			// Usuarios actuales del grupo/rol seleccionado
            $grupo_role['ids'] = $id;  // La clave del rol y el id del grupo
			$new_acces_model = new AccesoModel($db);
			$usuario_ids_actuales = $new_acces_model->buscar_acceso_model_usuarios($grupo_role);
			$array_usuario_ids_actuales = array();
			foreach($usuario_ids_actuales as $oid_usuario){
				$array_usuario_ids_actuales[] = $oid_usuario->oid_usuario;
			}
            $data_acceso['usuario_ids_actuales'] = $array_usuario_ids_actuales;
            // Ejecución de la edición
            $respuesta = $editaracceso->editar_acceso_model($data_acceso);

            if ($respuesta == 0){
                $datos['mensaje_servidor'] = 'El grupo ha sido actualizado correctamente!';
                $findaccesos = new AccesoModel($db);
                $query = $findaccesos->obtenerAcceso();
                $datos['query'] = $query;

                return view('acceso/buscar-acceso', $datos);
            }else{
                $datos['mensaje_servidor'] = 'Ocurrió un error durante la actualización!';
            }
        }
        return view('acceso/editar-acceso', $datos);
    }
    /******************************************************************/

	// public function login()
	// {
	// 	return view('login');
    // }
    /******************************************************************/
    function eliminar_acceso(){
        if ($this->request->getMethod() == 'post') {
            $accesos_recibidos = $this->request->getPost();
            $eliminarUsuario = new AccesoModel($db);

            foreach ($accesos_recibidos as $id_accesos){
                $respuesta = $eliminarUsuario->eliminar_acceso_model($id_accesos);
                var_dump($respuesta);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function buscar_acceso(){

        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Búsqueda Acceso');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();
            $buscaracceso = new AccesoModel($db);
            $datos['resultado_busqueda'] = $buscaracceso->buscar_acceso_model($data_busqueda);
            
            return view('acceso/listado-acceso', $datos);
        }

        $findaccesos = new AccesoModel($db);
        $query = $findaccesos->obtenerAcceso();
        $datos['query'] = $query;

        return view('acceso/buscar-acceso', $datos);
    }

}

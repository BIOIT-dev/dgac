<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\RolesModel;
use App\Models\RolePermisosModel;
use App\Models\ModuloModel;

class Roles extends BaseController
{
    /******************************************************************/
	public function crear_role()
	{   
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Crear Rol');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $modulo = new ModuloModel($db);
        $datos['modulo'] = $modulo->obtenerModulos();
        if ($this->request->getMethod() == 'post') {
            $fields = $this->request->getPost();

            $obj = new RolesModel($db);
            $fields['name'];
            $fields['is_active'];
            $fields['user_id'];
            $fields['modulo_id'];
            $fields['acceso'];
            $respuesta = $obj->crear_role_model($fields);

            if ($respuesta == TRUE){
                $datos['mensaje_servidor'] = 'El rol ha sido creado correctamente!';
                $findRoles = new RolesModel($db);
                $query = $findRoles->obtenerRules();
                $datos['query'] = $query;

                return view('roles/buscar-role', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el usuario!';
            }
        }
		return view('roles/crear-role', $datos);
	}
    /******************************************************************/
    function editar_role($id){

        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Role');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;

        $findRole_edit_ = new RolesModel($db);
        $findRole_edit = $findRole_edit_->find($id);
        $datos['role_data_edit'] = $findRole_edit;


        if ($this->request->getMethod() == 'post') {
            $fields = $this->request->getPost();
            $respuesta = $findRole_edit_->update($id,$fields);

            if ($respuesta == TRUE){
                $datos['mensaje_servidor'] = 'El rol ha sido actualizado correctamente!';
                $findRoles = new RolesModel($db);
                $query = $findRoles->obtenerRules();
                $datos['query'] = $query;
                return redirect()->to(base_url('public/Roles/editar_role/'.$id));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido actualizar el rol!';
            }
        }
        return view('roles/editar-role', $datos);
    }
    /******************************************************************/

	// public function login()
	// {
	// 	return view('login');
    // }
    /******************************************************************/
    function eliminar_role(){
        if ($this->request->getMethod() == 'post') {
            $roles_recibidos = $this->request->getPost();
            $eliminarUsuario = new RolesModel($db);

            foreach ($roles_recibidos as $id_roles){
                $respuesta = $eliminarUsuario->eliminar_role_model($id_roles);
                var_dump($respuesta);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function index(){

        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Búsqueda Rol');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;

        // $data_busqueda = $this->request->getPost();
        $buscarRole = new RolesModel($db);
        $datos['resultado_busqueda'] = $buscarRole->buscar_role_model();
        
        return view('roles/listado-role', $datos);
    }

    function gestionmodulos($id){
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Role');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;

        $findRole_edit_ = new RolesModel($db);
        $findRole_edit = $findRole_edit_->find($id);
        $datos['role_data_edit'] = $findRole_edit;
        $datos['id']=$id;
        $datos['modulos']= $findRole_edit_->modulos($id);

        if ($this->request->getMethod() == 'post') {
            $fields = $this->request->getPost();
            $respuesta = $findRole_edit_->update($id,$fields);
            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/Roles/gestionmodulos/'.$id));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido actualizar el rol!';
            }
        }
        return view('roles/editar-modulos', $datos);

    }

    function guardar_modulos($role){
        if ($this->request->getMethod() == 'post') {
            $modulos = $this->request->getPost();
            foreach($modulos as $modulo){
                $datos = ['role_id'=>$role,'modulo_id'=>$modulo];
                $crear_modulos = new RolePermisosModel($db);
                $respuesta = $crear_modulos->where($datos)
                ->first();
                if($respuesta){
                    $respuesta = $crear_modulos->delete($respuesta['id']);
                }else{
                    $respuesta = $crear_modulos->insert($datos);
                }
                // $respuesta = $crear_modulos->insert($datos);
                // if(!$respuesta){
                //     $respuesta = $crear_modulos->delete($datos);
                // }
                // try{
                //     $respuesta = $crear_modulos->insert($datos);
                
                // }catch (\Exception $e)
                // {
                //     $respuesta = false;
                // }
                // if(!$respuesta){
                //     $respuesta = $crear_modulos->delete($datos['']);
                // }
            }
            return true;
        }else{
            return false;
        }
    }

}

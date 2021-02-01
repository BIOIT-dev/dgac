<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ModuloModel;

class Modulo extends BaseController
{
    public function panel_admin($accion,$id=null){
        $session = session();
        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Gestion de Modulos');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $obj = new ModuloModel($db);
        switch($accion){
            case 'add':
                if ($this->request->getMethod() == 'post') {
                    $fields = $this->request->getPost();
                    $respuesta = $obj->addPanelAdmin($fields);
                    if($respuesta){
                        $datos['mensaje_servidor'] = 'El registro ha sido creado correctamente!';
                        $datos['url_retorno']='modulo/panel_admin/index';
                        return view('respuestas_servidor/exito', $datos);
                    }else{
                        $datos['mensaje_servidor'] = 'No se ha podido crear el registro!';
                        $datos['url_retorno']='modulo/panel_admin/index';
                        return view('respuestas_servidor/error', $datos);
                    }
                }
                return view('modulo/panel_admin/add', $datos);
            break;
            case 'edit':
                if($id){
                    $datos['resultado_busqueda'] = $obj->getPanelAdmin($id);
                    if($datos['resultado_busqueda']){
                        if ($this->request->getMethod() == 'post') {
                            $fields = $this->request->getPost();
                            $respuesta = $obj->setPanelAdmin($fields);
                            if($respuesta){
                                $datos['mensaje_servidor'] = 'El registro ha sido creado correctamente!';
                                $datos['url_retorno']='modulo/panel_admin/index';
                                return view('respuestas_servidor/exito', $datos);
                            }else{
                                $datos['mensaje_servidor'] = 'No se ha podido crear el registro!';
                                $datos['url_retorno']='modulo/panel_admin/index';
                                return view('respuestas_servidor/error', $datos);
                            }
                        }else{
                            return view('modulo/panel_admin/edit', $datos);
                        }
                    }
                }
                return redirect()->to(base_url('public/modulo/panel_admin/index'));
            break;
            case 'delete':
                if ($this->request->getMethod() == 'post') {
                    $data = $this->request->getPost();
                    foreach ($data as $id){
                        $respuesta = $obj->deletePanelAdmin($id);
                    }
                }
                return redirect()->to(base_url('public/modulo/panel_admin/index'));
            break;
            case 'index':
                $datos['resultado_busqueda'] = $obj->obtenerPanelAdmin();
                return view('modulo/panel_admin/index', $datos);
            break;
        }
    }
    /******************************************************************/
	public function crear_modulo()
	{   
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Crear Módulo');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $obj = new ModuloModel($db);
        $datos['panel_admin'] = $obj->obtenerPanelAdmin();
        if ($this->request->getMethod() == 'post') {
            $fields = $this->request->getPost();
            $respuesta = $obj->crear_modulo_model($fields);

            if ($respuesta == TRUE){
                $datos['mensaje_servidor'] = 'El módulo ha sido creado correctamente!';
                $findModulos = new ModuloModel($db);
                $query = $findModulos->obtenerModulos();
                $datos['query'] = $query;

                return redirect()->to(base_url('public/Modulo/buscar_modulo'));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el módulo!';
            }
        }
		return view('modulo/crear-modulo', $datos);
	}
    /******************************************************************/
    function editar_modulo($id){

        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Módulo');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;

        $obj = new ModuloModel($db);
        $findRole_edit = $obj->find($id);
        $datos['modulo_data_edit'] = $findRole_edit;
        $datos['panel_admin'] = $obj->obtenerPanelAdmin();
        //$datos['profile_foto_edit'] = array('foto'=>base_url().'/assets/images/users/4.jpg');

        if ($this->request->getMethod() == 'post') {
            $data_modulo = $this->request->getPost();
            // $data_modulo['activo'];
            // $data_modulo['icono'];
            // $data_modulo['tipo'];
            // $data_modulo['panel_admin'];
            // $data_modulo['nombre'];
            // $data_modulo['url'];
            // $data_modulo['orden'];
            
            $editarRole = new ModuloModel($db);
            $respuesta = $editarRole->editar_modulo_model($data_modulo);

            if ($respuesta == TRUE){
                $datos['mensaje_servidor'] = 'El módulo ha sido actualizado correctamente!';
                $findModulos = new ModuloModel($db);
                $query = $findModulos->obtenerModulos();
                $datos['query'] = $query;

                return redirect()->to(base_url('public/Modulo/buscar_modulo'));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido actualizar el módulo!';
            }
        }
        return view('modulo/editar-modulo', $datos);
    }
    /******************************************************************/

	// public function login()
	// {
	// 	return view('login');
    // }
    /******************************************************************/
    function eliminar_modulo(){
        //echo "entro";
        if ($this->request->getMethod() == 'post') {
            
            $modulo_recibidos = $this->request->getPost();
            $eliminarModulo = new ModuloModel($db);
            //print_r($modulo_recibidos);
            foreach ($modulo_recibidos as $id_modulos){
                $respuesta = $eliminarModulo->eliminar_modulo_model($id_modulos);
                //var_dump($respuesta);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function buscar_modulo(){

        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Búsqueda Módulo');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();
            $buscarModulo = new ModuloModel($db);
            $datos['resultado_busqueda'] = $buscarModulo->buscar_modulo_model($data_busqueda);
            
            return view('modulo/listado-modulo', $datos);
        }

        $buscarModulo = new ModuloModel($db);
        $datos['resultado_busqueda'] = $buscarModulo->buscar_modulo_model_all();    
        return view('modulo/listado-modulo', $datos);
        // $query = $findModulos->obtenerModulos();
        // $datos['query'] = $query;

        // return view('modulo/buscar-modulo', $datos);
    }

    public function index(){
        return redirect()->to(base_url('public/Modulo/buscar_modulo'));
    }

}
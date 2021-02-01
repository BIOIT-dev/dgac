<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ComunidadModel;
use App\Models\CarreraModel;
use App\Models\SedeModel;

class Sede extends BaseController
{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
    }
    /******************************************************************/
    /******************************************************************/
	public function index_sede()
	{
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Gestionar Sedes');
		return view('sede/index-sede', $datos);
	}
    /******************************************************************/
	public function crear_sede()
	{
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar Sede');

        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();

            $crearSede = new SedeModel($db);
            $respuesta = $crearSede->crear_sede($data_post);

            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'profile/administracion';
                $datos['mensaje_servidor'] = 'La sede ha sido creada correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear la sede!';
                return view('respuestas_servidor/error', $datos);
            }
        }
		return view('sede/agregar-sede', $datos);
	}
    /******************************************************************/
    /******************************************************************/
    function eliminar_sede(){
        if ($this->request->getMethod() == 'post') {
            $sedes_recibidas = $this->request->getPost();
            $eliminarSede = new SedeModel($db);

            foreach ($sedes_recibidas as $id_sede){
                $respuesta = $eliminarSede->eliminar_sede($id_sede);
                var_dump($respuesta);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function buscar_sede(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Buscar Sede');

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();

            $buscarSede = new SedeModel($db);
            $datos['resultado_busqueda'] = $buscarSede->buscar_sede($data_busqueda);
            
            return view('sede/listado-sede', $datos);
        }

        return view('sede/buscar-sede', $datos);
    }
    /******************************************************************/
    function editar($id_sede){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Sede');

        $findSede_edit = new SedeModel($db);
        $findSede_edit = $findSede_edit->find($id_sede);
        $datos['profile_data_edit'] = $findSede_edit;
        $datos['profile_foto_edit'] = array('foto'=>base_url().'/assets/images/users/4.jpg');

        if ($this->request->getMethod() == 'post') {
            $data_sede = $this->request->getPost();
            if($data_sede['inactivo'] == 'on') $data_sede['inactivo'] = '0';
            else $data_sede['inactivo'] = '1';
            $editarSede = new SedeModel($db);
            $respuesta = $editarSede->editar_sede($data_sede);

            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'profile/administracion';
                $datos['mensaje_servidor'] = 'La sede se editó correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar la sede!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        return view('sede/editar-sede', $datos);
    }
    /******************************************************************/
    /******************************************************************/
    /******************************************************************/
    function actualUser(){
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find(1);
        return $findUsuario;
    }

}

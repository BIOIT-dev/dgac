<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ComunidadModel;
use App\Models\CarreraModel;

class Carrera extends BaseController
{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
    }
    /******************************************************************/
    /******************************************************************/
	public function index_carrera()
	{
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Gestionar Carreras');
		return view('carrera/index-carrera', $datos);
	}
    /******************************************************************/
	public function crear_carrera()
	{
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar Carrera');

        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();

            $crearCarrera = new CarreraModel($db);
            $respuesta = $crearCarrera->crear_carrera($data_post);

            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'profile/administracion';
                $datos['mensaje_servidor'] = 'La carrera ha sido creada correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear la carrera!';
                return view('respuestas_servidor/error', $datos);
            }
        }
		return view('carrera/agregar-carrera', $datos);
	}
    /******************************************************************/
    /******************************************************************/
    function eliminar_carrera(){
        if ($this->request->getMethod() == 'post') {
            $carreras_recibidas = $this->request->getPost();
            $eliminarCarrera = new CarreraModel($db);

            foreach ($carreras_recibidas as $id_carrera){
                $respuesta = $eliminarCarrera->eliminar_carrera($id_carrera);
                var_dump($respuesta);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function buscar_carrera(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Buscar Carrera');

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();

            $buscarCarrera = new CarreraModel($db);
            $datos['resultado_busqueda'] = $buscarCarrera->buscar_carrera($data_busqueda);
            
            return view('carrera/listado-carrera', $datos);
        }

        return view('carrera/buscar-carrera', $datos);
    }
    /******************************************************************/
    function editar($id_carrera){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Carrera');

        $findCarrera_edit = new CarreraModel($db);
        $findCarrera_edit = $findCarrera_edit->find($id_carrera);
        $datos['profile_data_edit'] = $findCarrera_edit;
        $datos['profile_foto_edit'] = array('foto'=>base_url().'/assets/images/users/4.jpg');

        if ($this->request->getMethod() == 'post') {
            $data_carrera = $this->request->getPost();
            
            $editarCarrera = new CarreraModel($db);
            $respuesta = $editarCarrera->editar_carrera($data_carrera);

            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'profile/administracion';
                $datos['mensaje_servidor'] = 'La carrera se editó correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar la carrera!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        return view('carrera/editar-carrera', $datos);
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

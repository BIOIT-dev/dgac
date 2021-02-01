<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ComunidadModel;
use App\Models\CarreraModel;
use App\Models\AsignaturaModel;

class Asignatura extends BaseController
{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
    }
    /******************************************************************/
    /******************************************************************/
	public function index_asignatura()
	{
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Gestionar Asignaturas');
		return view('asignatura/index-asignatura', $datos);
	}
    /******************************************************************/
	public function crear_asignatura()
	{
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar Asignatura');

        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();

            $crearAsignatura = new AsignaturaModel($db);
            $respuesta = $crearAsignatura->crear_asignatura($data_post);

            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'profile/administracion';
                $datos['mensaje_servidor'] = 'La asignatura ha sido creada correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear la asignatura!';
                return view('respuestas_servidor/error', $datos);
            }
        }

        $r_carreras = new CarreraModel($db);
        $datos['r_carreras'] = $r_carreras->getCarreras();

		return view('asignatura/agregar-asignatura', $datos);
	}
    /******************************************************************/
    /******************************************************************/
    function eliminar_asignatura(){
        if ($this->request->getMethod() == 'post') {
            $asignaturas_recibidas = $this->request->getPost();
            $eliminarAsignatura = new AsignaturaModel($db);

            foreach ($asignaturas_recibidas as $id_asignatura){
                $respuesta = $eliminarAsignatura->eliminar_asignatura($id_asignatura);
                var_dump($respuesta);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function buscar_asignatura(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Buscar Asignatura');

        // if ($this->request->getMethod() == 'post') {
        //     $data_busqueda = $this->request->getPost();

        //     $buscarAsignatura = new AsignaturaModel($db);
        //     $datos['resultado_busqueda'] = $buscarAsignatura->buscar_asignatura($data_busqueda);
            
        //     return view('asignatura/listado-asignatura', $datos);
        // }
        $buscarAsignatura = new AsignaturaModel($db);
        $datos['resultado_busqueda'] = $buscarAsignatura->listado_asignatura();

        // var_dump($datos['resultado_busqueda']);
        // return($datos['resultado_busqueda']);
        return view('asignatura/listado-asignatura', $datos);
    }
    /******************************************************************/
    function editar($id_asignatura){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Asignatura');

        $findAsignatura_edit = new AsignaturaModel($db);
        $findAsignatura_edit = $findAsignatura_edit->find($id_asignatura);
        $datos['profile_data_edit'] = $findAsignatura_edit;
        $datos['profile_foto_edit'] = array('foto'=>base_url().'/assets/images/users/4.jpg');

        if ($this->request->getMethod() == 'post') {
            $data_asignatura = $this->request->getPost();
            
            $editarAsignatura = new AsignaturaModel($db);
            $respuesta = $editarAsignatura->editar_asignatura($data_asignatura);

            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'profile/administracion';
                $datos['mensaje_servidor'] = 'La asignatura se editó correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar la asignatura!';
                return view('respuestas_servidor/error', $datos);
            }
        }

        $r_carreras = new CarreraModel($db);
        $datos['r_carreras'] = $r_carreras->getCarreras();

        return view('asignatura/editar-asignatura', $datos);
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

<?php namespace App\Controllers;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ComunidadModel;
use App\Models\CarreraModel;
use App\Models\ProgPresencialModel;
use App\Models\AdmisionCarreraModel;
use App\Models\PeriodoModel;

class AdmisionCarrera extends BaseController
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
    public function agregar_examen($id_comunidad){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar Exámen');

        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $agregarExamen = new AdmisionCarreraModel($db);
            foreach ($data_post as $id_pregunta){
                $respuesta = $agregarExamen->agregar_examen($id_pregunta, $id_comunidad);
            }
        }
        $r_examenes = new AdmisionCarreraModel($db);
        $datos['r_examenes'] = $r_examenes->getAllExamenes($id_comunidad);
        $datos['oid_grupo'] = $id_comunidad;

		return view('admision_carrera/agregar-examen', $datos);
    }
    /******************************************************************/
    public function agregar_carrera($id_comunidad){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Crear Carrera');
        
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            // var_dump($data_post);
            // return;
            $agregarCarrera = new AdmisionCarreraModel($db);
            $respuesta = $agregarCarrera->agregar_carrera($dataForm);
            // return;
            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/admisionCarrera/editar/'.$dataForm['oid_grupo']));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar el documento!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $datos['oid_grupo'] = $id_comunidad;

		return view('admision_carrera/agregar-carrera', $datos);
	}
    /******************************************************************/
    function eliminar_carrera(){
        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $eliminarCarrera = new AdmisionCarreraModel($db);
            foreach ($data_post as $id_carrera){
                $respuesta = $eliminarCarrera->eliminar_carrera($id_carrera);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function eliminar_examen(){
        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $eliminarExamen = new AdmisionCarreraModel($db);
            foreach ($data_post as $id_pregunta){
                $respuesta = $eliminarExamen->eliminar_examen($id_pregunta);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function buscar(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        // $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Buscar Admisión Carrera');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Postulaciones a Programas Presenciales');

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();

            $buscar = new AdmisionCarreraModel($db);
            $datos['resultado_busqueda'] = $buscar->getAdmisionCarrera($data_busqueda);
            return view('admision_carrera/listado-admision-carrera', $datos);
        }
        $r_periodos = new PeriodoModel($db);
        $datos['r_periodos'] = $r_periodos->getPeriodos();

        return view('admision_carrera/buscar-admision-carrera', $datos);
    }
    /******************************************************************/
    function editar($id_comunidad){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Carrera');

        $findEdit = new ComunidadModel($db);
        $findEdit = $findEdit->find($id_comunidad);
        $datos['profile_data_edit'] = $findEdit;
        $datos['profile_foto_edit'] = array('foto'=>base_url().'/assets/images/users/4.jpg');

        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            if (isset($dataForm['inactivo'])){
                if($dataForm['inactivo'] == 'on') $dataForm['inactivo'] = '0';
                else $dataForm['inactivo'] = '1';
            }
            $editar = new ProgPresencialModel($db);
            $respuesta = $editar->editar_carrera_general($dataForm);

            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/admisionCarrera/editar/'.$id_comunidad));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar el documento!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $datos['resultado_busqueda'] = [];
        $r_periodos = new PeriodoModel($db);
        $datos['r_periodos'] = $r_periodos->getPeriodos();
        $r_clasificacion = new ProgPresencialModel($db);
        $datos['r_clasificacion'] = $r_clasificacion->getGrupoClasificacion();
        $r_profesores = new ProgPresencialModel($db);
        $datos['r_profesores'] = $r_profesores->getProfesores($id_comunidad);
        $r_cursos = new ProgPresencialModel($db);
        $datos['r_cursos'] = $r_cursos->getCursos($id_comunidad);
        $r_alumnos = new ProgPresencialModel($db);
        $datos['r_alumnos'] = $r_alumnos->getAlumnos($id_comunidad);
        $r_examenes = new AdmisionCarreraModel($db);
        $datos['r_examenes'] = $r_examenes->getExamenes($id_comunidad);
        $r_carreras = new AdmisionCarreraModel($db);
        $datos['r_carreras'] = $r_carreras->getCarreras($id_comunidad);
        $r_postulantes = new AdmisionCarreraModel($db);
        $datos['r_postulantes'] = $r_postulantes->getPostulantes($id_comunidad);
        $r_matriculados = new AdmisionCarreraModel($db);
        $datos['r_matriculados'] = $r_matriculados->getMatriculados($id_comunidad);

        return view('admision_carrera/editar-admision-carrera', $datos);
    }
    /******************************************************************/
    function actualUser(){
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find(1);
        return $findUsuario;
    }

}

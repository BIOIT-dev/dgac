<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ComunidadModel;
use App\Models\CarreraModel;
use App\Models\GestionAlumnosModel;
use App\Models\EncuestasModel;

class GestionAlumnos extends BaseController
{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
    }
    /******************************************************************/
    function buscar(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Consultar Registro');

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();
            
            //~ echo "<pre>";
            //~ print_r($data_busqueda);
            //~ exit();
            // var_dump($data_busqueda);
            // return;

            $buscar_usuario = new GestionAlumnosModel($db);
            $datos['info_alumno'] = $buscar_usuario->buscarUsuario($data_busqueda);
            #si no se devuelve ningún usuario redigir a buscar-alumno
            if (empty($datos['info_alumno'])){
                return redirect()->to(base_url('public/gestionAlumnos/buscar'));
            }
            $buscar_carreras = new GestionAlumnosModel($db);
            $datos['listado_carreras'] = $buscar_carreras->buscarCarreras($data_busqueda, $datos['info_alumno']['usuario_id'], "ALU");
            $datos['listado_carreras_pro'] = $buscar_carreras->buscarCarreras($data_busqueda, $datos['info_alumno']['usuario_id'], "PRO");
            $datos['listado_carreras_fun'] = $buscar_carreras->buscarCarreras($data_busqueda, $datos['info_alumno']['usuario_id'], "FUN");
            $datos['info_beca'] = $buscar_carreras->buscarBeca($datos['info_alumno']['usuario_id']);
            
            return view('gestion_alumnos/index-alumno', $datos);
        }
        return view('gestion_alumnos/buscar-alumno', $datos);
    }
    /******************************************************************/
    function perfil_alumno($rut){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Consultar Registro');

		$data_busqueda = array('rut' => $rut);
        $buscar_usuario = new GestionAlumnosModel($db);
		$datos['info_alumno'] = $buscar_usuario->buscarUsuario($data_busqueda);
		#si no se devuelve ningún usuario redigir a buscar-alumno
		if (empty($datos['info_alumno'])){
			return redirect()->to(base_url('public/gestionAlumnos/buscar'));
		}
		$buscar_carreras = new GestionAlumnosModel($db);
		$datos['listado_carreras'] = $buscar_carreras->buscarCarreras($data_busqueda, $datos['info_alumno']['usuario_id'], "ALU");
        $datos['listado_asignaturas'] = $buscar_carreras->buscarAsignaturas($datos['info_alumno']['usuario_id'], "ALU");
        foreach($datos['listado_asignaturas'] as $asignatura){
            $asignatura->promedio = 123;
            var_dump($asignatura);
            echo '<br>';
        }
        // var_dump($datos['listado_asignaturas']);
        return;
		$datos['listado_pagos'] = $buscar_carreras->buscarPagos($datos['info_alumno']['usuario_id']);
		$datos['info_beca'] = $buscar_carreras->buscarBeca($datos['info_alumno']['usuario_id']);
		
        return view('gestion_alumnos/perfil_alumno', $datos);
    }
    /******************************************************************/
    function perfil_funcionario($rut){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Consultar Registro');

		$data_busqueda = array('rut' => $rut);
        $buscar_usuario = new GestionAlumnosModel($db);
		$datos['info_alumno'] = $buscar_usuario->buscarUsuario($data_busqueda);
		#si no se devuelve ningún usuario redigir a buscar-alumno
		if (empty($datos['info_alumno'])){
			return redirect()->to(base_url('public/gestionAlumnos/buscar'));
		}
		$buscar_carreras = new GestionAlumnosModel($db);
		$datos['listado_carreras'] = $buscar_carreras->buscarCarreras($data_busqueda, $datos['info_alumno']['usuario_id'], "FUN");
		$datos['listado_asignaturas'] = $buscar_carreras->buscarAsignaturas($datos['info_alumno']['usuario_id'], "FUN");
		
        return view('gestion_alumnos/perfil_funcionario', $datos);
    }
    /******************************************************************/
    function perfil_profesor($rut){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Consultar Registro');

		$data_busqueda = array('rut' => $rut);
        $buscar_usuario = new GestionAlumnosModel($db);
		$datos['info_alumno'] = $buscar_usuario->buscarUsuario($data_busqueda);
		#si no se devuelve ningún usuario redigir a buscar-alumno
		if (empty($datos['info_alumno'])){
			return redirect()->to(base_url('public/gestionAlumnos/buscar'));
		}
		$buscar_carreras = new GestionAlumnosModel($db);
		$datos['listado_carreras'] = $buscar_carreras->buscarCarreras($data_busqueda, $datos['info_alumno']['usuario_id'], "PRO");
		$datos['listado_asignaturas'] = $buscar_carreras->buscarAsignaturas($datos['info_alumno']['usuario_id'], "PRO");
		$datos['listado_encuestas'] = $buscar_carreras->buscarEncuestas($datos['info_alumno']['usuario_id']);
		
        return view('gestion_alumnos/perfil_profesor', $datos);
    }
    /******************************************************************/
    function index_alumno(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Consultar Registro');

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();
            //~ echo "<pre>";
            //~ print_r($data_busqueda);
            //~ print_r($this->request->getFiles());
            //~ exit();
            $data_beca = array();
            if($file = $this->request->getFiles())
            {
                //print_r($imagefile);
                if($adjunto = $file['adjunto'])
                {
                    if ($adjunto->isValid() && ! $adjunto->hasMoved())
                    {
                        $name = $adjunto->getClientName(); //This is if you want to change the file name to encrypted 
                        $adjunto->move(realpath(FCPATH . '../assets/uploads/beca'), $name);
                        $data_beca['usuario_id'] = $data_busqueda['oid'];
                        $data_beca['comentario'] = $data_busqueda['comentario'];
                        $data_beca['documento'] = $name;
                        $data_beca['d_create'] = date('Y-m-d H:i:s');
                        
                        $registrar_beca = new GestionAlumnosModel($db);
						$respuesta2 = $registrar_beca->registrarBeca($data_beca);
                    }
                }
            }
            $editar_usuario = new GestionAlumnosModel($db);
            unset($data_busqueda['comentario']);
            $respuesta = $editar_usuario->editarUsuario($data_busqueda);

            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/gestionAlumnos/buscar'));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar el documento!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        return view('gestion_alumnos/buscar-alumno', $datos);
    }
    /******************************************************************/
    function revisar_registro($usuario_id, $grupo_id){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Consultar Registro');

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();

            $buscar_historial = new GestionAlumnosModel($db);
            $datos['info_alumno'] = $buscar_historial->buscarUsuario($data_busqueda);
            
            return view('gestion_alumnos/historial-carrera', $datos);
        }
        $buscar_historial = new GestionAlumnosModel($db);
        $datos['info_historial'] = $buscar_historial->buscarHistorial($usuario_id, $grupo_id);
        return view('gestion_alumnos/historial-carrera', $datos);
    }
    /******************************************************************/
    function editar_registro($usuario_id, $grupo_id){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Consultar Registro');

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();
            $data_busqueda['hial_fecha'] = date('Y-m-d');
            $data_busqueda['activo'] = '1';
            $agregar_registro = new GestionAlumnosModel($db);
            $respuesta = $agregar_registro->agregarRegistro($data_busqueda);
            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/gestionAlumnos/editar_registro/'.$data_busqueda['oid_usuario'].'/'.$data_busqueda['oid_grupo']));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar el documento!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $estados_alumno = new GestionAlumnosModel($db);
        $datos['estados_alumno'] = $estados_alumno->getEstadosAlumno();
        
        $r_semestres = new GestionAlumnosModel($db);
        $datos['r_semestres'] = $r_semestres->getSemestres();
        
        $buscar_historial = new GestionAlumnosModel($db);
        $datos['info_historial'] = $buscar_historial->buscarHistorial($usuario_id, $grupo_id);
        $datos['usuario_id'] = $usuario_id;
        $datos['grupo_id'] = $grupo_id;
        return view('gestion_alumnos/editar-registro', $datos);
    }
    /******************************************************************/
    function ver_notas($usuario_id, $grupo_id, $curso_id){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Notas del Alumno');
		
		$buscar_alumno = new UsuarioModel($db);
        $datos['data_alumno'] = $buscar_alumno->getUsuario2($usuario_id);
        
        $buscar_carrera = new ComunidadModel($db);
        $datos['data_carrera'] = $buscar_carrera->buscarComunidadId($grupo_id);
        
        $buscar_curso = new GestionAlumnosModel($db);
        $datos['data_curso'] = $buscar_curso->buscarCurso($curso_id);
        
        $buscar_notas = new GestionAlumnosModel($db);
        $datos['notas_alumno'] = $buscar_notas->buscarNotas($usuario_id, $grupo_id, $curso_id);
        $datos['curso_acta'] = $buscar_notas->buscarActaCurso($usuario_id, $grupo_id, $curso_id);
        
        return view('gestion_alumnos/ver-notas', $datos);
    }
    /******************************************************************/
    function ver_asistencias($usuario_id, $grupo_id, $curso_id){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Asistencias del Alumno');
		
		$buscar_alumno = new UsuarioModel($db);
        $datos['data_alumno'] = $buscar_alumno->getUsuario2($usuario_id);
        
        $buscar_carrera = new ComunidadModel($db);
        $datos['data_carrera'] = $buscar_carrera->buscarComunidadId($grupo_id);
        
        $buscar_curso = new GestionAlumnosModel($db);
        $datos['data_curso'] = $buscar_curso->buscarCurso($curso_id);
        
        $buscar_notas = new GestionAlumnosModel($db);
        $datos['asistencias_alumno'] = $buscar_notas->buscarAsistencias($usuario_id, $grupo_id, $curso_id);
        
        return view('gestion_alumnos/ver-asistencias', $datos);
    }
    /******************************************************************/
    function ver_comprobantes($usuario_id, $grupo_id){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Comprobantes del Alumno');
		
		$buscar_alumno = new UsuarioModel($db);
        $datos['data_alumno'] = $buscar_alumno->getUsuario2($usuario_id);
        
        $buscar_carrera = new ComunidadModel($db);
        $datos['data_carrera'] = $buscar_carrera->buscarComunidadId($grupo_id);
        
        $buscar_notas = new GestionAlumnosModel($db);
        $datos['comprobantes_alumno'] = $buscar_notas->buscarComprobantes($usuario_id, $grupo_id);
        
        return view('gestion_alumnos/ver-comprobantes', $datos);
    }
    /******************************************************************/
    function ver_detalles_encuesta($encuesta_id){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Comprobantes del Alumno');
		
		$buscar_encuesta = new GestionAlumnosModel($db);
		
        $datos['data_encuesta'] = $buscar_encuesta->buscarEncuestaData($encuesta_id);
        
        $datos['detalles_encuesta'] = $buscar_encuesta->buscarEncuestaDetalle($encuesta_id);
        
        return view('gestion_alumnos/detalles-evaluacion', $datos);
    }
    /******************************************************************/
    function actualUser(){
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find(1);
        return $findUsuario;
    }

}

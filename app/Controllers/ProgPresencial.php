<?php namespace App\Controllers;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ComunidadModel;
use App\Models\ProgPresencialModel;
use App\Models\PeriodoModel;

class ProgPresencial extends BaseController{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
    }
    /******************************************************************/
    public function agregar_profesor($id_comunidad){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar Profesor');

        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $agregarProfesor = new ProgPresencialModel($db);
            foreach ($data_post as $id_usuario){
                $respuesta = $agregarProfesor->agregar_profesor($id_usuario, $id_comunidad);
            }
        }
        $r_profesores = new ProgPresencialModel($db);
        $datos['r_profesores'] = $r_profesores->getAllProfesores($id_comunidad);
        $datos['oid_grupo'] = $id_comunidad;

		return view('prog_presencial/agregar-profesor', $datos);
    }
    /******************************************************************/
    public function agregar_asignatura($id_comunidad){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar Asignatura');
        
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            // var_dump($data_post);
            // return;
            $agregarCurso = new ProgPresencialModel($db);
            $respuesta = $agregarCurso->agregar_curso($dataForm);

            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/progPresencial/editar/'.$dataForm['oid_grupo']));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar el documento!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $r_profesores = new ProgPresencialModel($db);
        $datos['r_profesores'] = $r_profesores->getProfesores($id_comunidad);
        $r_asignaturas = new ProgPresencialModel($db);
        $datos['r_asignaturas'] = $r_asignaturas->getAsignaturas($id_comunidad);
        $r_duraciongrupo = new ProgPresencialModel($db);
        $datos['r_duraciongrupo'] = $r_duraciongrupo->getGrupo($id_comunidad);
        $r_cursos = new ProgPresencialModel($db);
        $datos['r_cursos'] = $r_cursos->getCursos($id_comunidad);
        // var_dump($datos['r_duraciongrupo']);
        // return;
        $datos['oid_grupo'] = $id_comunidad;

		return view('prog_presencial/agregar-asignatura', $datos);
	}
    /******************************************************************/
    function eliminar_profesor($id_comunidad){
        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $eliminarProfesor = new ProgPresencialModel($db);
            foreach ($data_post as $id_usuario){
                $respuesta = $eliminarProfesor->eliminar_profesor($id_usuario, $id_comunidad);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function eliminar_asignatura($id_comunidad){
        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $eliminarAsignatura = new ProgPresencialModel($db);
            foreach ($data_post as $id_curso){
                $respuesta = $eliminarAsignatura->eliminar_asignatura($id_curso, $id_comunidad);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function eliminar_examen($id_comunidad){
        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            // $eliminarExamen = new AdmisionCarreraModel($db);
            foreach ($data_post as $id_pregunta){
                // $respuesta = $eliminarExamen->eliminar_examen($id_pregunta, $id_comunidad);
                var_dump($id_pregunta);
            }
            return;
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    /* Página principal para programas presenciales */
    function buscar(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Buscar Programas Presenciales');

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();

            $buscar = new ProgPresencialModel($db);
            $datos['resultado_busqueda'] = $buscar->getProgPresencial($data_busqueda);
            return view('prog_presencial/listado-prog-presencial', $datos);
        }
        $r_periodos = new PeriodoModel($db);
        $datos['r_periodos'] = $r_periodos->getPeriodos();

        return view('prog_presencial/buscar-prog-presencial', $datos);
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
                return redirect()->to(base_url('public/progPresencial/editar/'.$id_comunidad));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar el documento!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $datos['resultado_busqueda'] = [];
        $r_periodos = new PeriodoModel($db);
        $datos['r_periodos'] = $r_periodos->getPeriodos();
        $r_cursos = new ProgPresencialModel($db);
        $datos['r_cursos'] = $r_cursos->getCursos($id_comunidad);
        $r_clasificacion = new ProgPresencialModel($db);
        $datos['r_clasificacion'] = $r_clasificacion->getGrupoClasificacion();
        $r_profesores = new ProgPresencialModel($db);
        $datos['r_profesores'] = $r_profesores->getProfesores($id_comunidad);
        $r_alumnos = new ProgPresencialModel($db);
        $datos['r_alumnos'] = $r_alumnos->getAlumnos($id_comunidad);

        return view('prog_presencial/editar-prog-presencial', $datos);
    }
    /******************************************************************/
    function editar_asignatura($id_comunidad, $id_curso){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Asignatura');

        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $editarCurso = new ProgPresencialModel($db);
            $respuesta = $editarCurso->editar_curso($dataForm, $id_comunidad, $id_curso);

            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/progPresencial/editar/'.$dataForm['oid_grupo']));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar el documento!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $r_curso = new ProgPresencialModel($db);
        $datos['r_curso'] = $r_curso->getCursoEditar($id_curso)[0];
        $r_cursos = new ProgPresencialModel($db);
        $datos['r_cursos'] = $r_cursos->getCursos($id_comunidad);
        $r_profesores = new ProgPresencialModel($db);
        $datos['r_profesores'] = $r_profesores->getProfesores($id_comunidad);
        $r_asignaturas = new ProgPresencialModel($db);
        $datos['r_asignaturas'] = $r_asignaturas->getAsignaturas($id_comunidad);
        $r_duraciongrupo = new ProgPresencialModel($db);
        $datos['r_duraciongrupo'] = $r_duraciongrupo->getGrupo($id_comunidad);
        $datos['oid_grupo'] = $id_comunidad;
        $datos['r_curso'] = json_decode(json_encode($datos['r_curso']), true);
        return view('prog_presencial/editar-asignatura', $datos);
    }

    /******************************************************************/
    function editar_alumno($id_comunidad, $id_usuario){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Datos Personales');

        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $dataForm['hial_fecha'] = date('Y-m-d');
            $dataForm['activo'] = '1';
            $agregarHistorial = new ProgPresencialModel($db);
            $respuesta = $agregarHistorial->agregar_historial($dataForm);

            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/progPresencial/editar_alumno/'.$dataForm['oid_grupo'].'/'.$dataForm['oid_usuario']));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar el documento!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $datos['oid_grupo'] = $id_comunidad;
        $datos['oid_usuario'] = $id_usuario;
        $r_estadosalumnos = new ProgPresencialModel($db);
        $datos['r_estadosalumnos'] = $r_estadosalumnos->getEstadosAlumnos();
        $r_semestres = new ProgPresencialModel($db);
        $datos['r_semestres'] = $r_semestres->getSemestres();
        $r_alumno = new ProgPresencialModel($db);
        $datos['r_alumno'] = $r_alumno->getAlumnoEditar($id_usuario, $id_comunidad);

        return view('prog_presencial/editar-alumno', $datos);
    }
    /******************************************************************/
    function cambiarVigencia($id_comunidad){
        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $cambiar = new ProgPresencialModel($db);
            $respuesta = $cambiar->cambiar_vigencia($data_post, $id_comunidad);
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function actualUser(){
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find(1);
        return $findUsuario;
    }


    function reporte_asignaturas($oid){
        $listado = new ProgPresencialModel($db);
        $result = $listado->listadoCursos($oid);
        // echo var_dump($result);
        $resultado = array();
        foreach($result as $r){
            // $temporal = {'profesores'};
            $where = "curso.oid = $r->oid";
            $profesores =  $listado->listadoProfesores($where);
            $where = "a.oid_cursos = $r->oid";
            $horas =  $listado->calculoHoras($where);
            $where = "asistencia.oid_cursos = $r->oid";
            $contenidos =  $listado->listadoContenidosCurso($where,$r->oid);
            $temporal = array('titulo'=>$r->titulo,'profesores'=>$profesores,'horas'=>$horas,'contenidos'=>$contenidos);
            // $resultado.array_push($profesores);
            array_push($resultado,$temporal);
        }
        $datos['resultado']=$resultado;
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Programa Presencial');
        return view('prog_presencial/reporte-asignaturas', $datos);
    } 
    
    
    function reporte_contenidos($oid){
        $listado = new ProgPresencialModel($db);
        $result = $listado->listadoCursos($oid);
        // echo var_dump($result);
        $resultado = array();
        foreach($result as $r){
            // $temporal = {'profesores'};
            $where = "curso.oid = $r->oid";
            $profesores =  $listado->listadoProfesores($where);
            $where = "a.oid_cursos = $r->oid";
            $horas =  $listado->calculoHoras($where);
            $temporal = array('titulo'=>$r->titulo,'curs_horas'=>$r->curs_horas,'horas'=>$horas,'profesores'=>$profesores);
            // $resultado.array_push($profesores);
            array_push($resultado,$temporal);
        }
        $datos['resultado']=$resultado;
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Programa Presencial');
        return view('prog_presencial/reporte-contenidos', $datos);
    } 
}
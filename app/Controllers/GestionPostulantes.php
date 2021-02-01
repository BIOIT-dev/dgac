<?php namespace App\Controllers;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ComunidadModel;
use App\Models\ProgPresencialModel;
use App\Models\PeriodoModel;
use App\Models\GestionPostulantesModel;
use App\Models\AdmisionCarreraModel;

class GestionPostulantes extends BaseController{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
    }
    /******************************************************************/
    function index(){
        $id_comunidad = "12";
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Postulaciones a Carreras');

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
        return view('gestion_postulantes/listado-periodos', $datos);
    }
    /******************************************************************/
    public function carreras_periodo($id_periodo){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Carreras del Periodo');

        $findEdit = new ComunidadModel($db);
        $findEdit = $findEdit->find('1');
        $datos['profile_data_edit'] = $findEdit;

        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $agregarProfesor = new ProgPresencialModel($db);
            foreach ($data_post as $id_usuario){
                $respuesta = $agregarProfesor->agregar_profesor($id_usuario, $id_comunidad);
            }
        }
        $r_carreras_periodo = new GestionPostulantesModel($db);
        $datos['r_carreras_periodo'] = $r_carreras_periodo->getCarrerasPeriodo($id_periodo);
        // $datos['oid_grupo'] = $id_comunidad;
        $datos['r_periodos'] = [];
		return view('gestion_postulantes/listado-carreras', $datos);
    }
    /******************************************************************/
    function postulantes_carrera($id_comunidad){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Postulaciones');

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

        $r_borrador = new GestionPostulantesModel($db);
        $datos['r_borrador'] = $r_borrador->getPostulantes($id_comunidad, '0');
        $r_enviadas = new GestionPostulantesModel($db);
        $datos['r_enviadas'] = $r_enviadas->getPostulantes($id_comunidad, '1');
        $r_etapa1 = new GestionPostulantesModel($db);
        $datos['r_etapa1'] = $r_etapa1->getPostulantes($id_comunidad, '2');
        $r_etapa2 = new GestionPostulantesModel($db);
        $datos['r_etapa2'] = $r_etapa2->getPostulantes($id_comunidad, '3');
        $r_etapa3 = new GestionPostulantesModel($db);
        $datos['r_etapa3'] = $r_etapa3->getPostulantes($id_comunidad, '4');
        $r_seleccionado = new GestionPostulantesModel($db);
        $datos['r_seleccionado'] = $r_seleccionado->getPostulantes($id_comunidad, '5');
        $r_matriculado = new GestionPostulantesModel($db);
        $datos['r_matriculado'] = $r_matriculado->getPostulantes($id_comunidad, '6');
        $r_anulada = new GestionPostulantesModel($db);
        $datos['r_anulada'] = $r_anulada->getPostulantes($id_comunidad, '9');

        return view('gestion_postulantes/listado-postulaciones', $datos);
    }

    /******************************************************************/
    public function editar_postulacion($id_comunidad, $id_postulacion){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Postulaciones');

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

        $gestionPostulantesModel = new GestionPostulantesModel($db);
        $datos['r_comprobantes'] = $gestionPostulantesModel->getComprobantes($id_postulacion);
        $datos['r_exam_postulaciones'] = $gestionPostulantesModel->getExamPostulacion($id_postulacion);
        $datos['r_pendientes'] = $gestionPostulantesModel->getPendPostulacion($id_postulacion, $id_comunidad);
        $datos['info_postulacion'] = (array)$gestionPostulantesModel->getInfoPostulacion($id_postulacion);
        $datos['id_grupo'] = $id_comunidad;
        $datos['id_postulacion'] = $id_postulacion;
        $datos['r_carreras'] = $gestionPostulantesModel->cargarCarreras($id_comunidad);
        $carrerasExist = $gestionPostulantesModel->cargarCarrerasExist($datos['info_postulacion']['oid_usuario'], $id_comunidad);
        
        $oid_carreras = [];
        foreach($datos['r_carreras'] as $key => $carr){
            array_push($oid_carreras, $carr->oid);
            #se sacan las carreras en las que el alumno ya está matriculado
            if(in_array($carr->oid, $carrerasExist)){
                unset($datos['r_carreras'][$key]);
            }
        }
        $datos['r_matriculado'] = $gestionPostulantesModel->obtenerCarreraMatriculado($datos['info_postulacion']['oid_usuario'], $oid_carreras);
        return view('gestion_postulantes/editar-postulacion', $datos);
    }
    /******************************************************************/
    function editar_examen_postulacion($id_preg_examen, $id_grupo){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Postulaciones');
        $gestionPostulantesModel = new GestionPostulantesModel($db);
        $datos['examen_postulacion'] = $gestionPostulantesModel->find($id_preg_examen);
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $respuesta = $gestionPostulantesModel->editar_exam_postulacion($id_preg_examen, $dataForm);

            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/gestionPostulantes/editar_postulacion/'.$id_grupo."/".$datos['examen_postulacion']['oid_postulaciones']));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar el documento!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $datos['respuestas_examen'] = $gestionPostulantesModel->getRespuestas($datos['examen_postulacion']['oid_grpr']);
        $datos['id_grupo'] = $id_grupo;
        return view('gestion_postulantes/editar-exam-postulacion', $datos);
    }
    /******************************************************************/
    function editar_pend_postulacion($id_preg_examen, $id_grupo, $id_postulacion){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Postulaciones');
        $gestionPostulantesModel = new GestionPostulantesModel($db);
        $datos['examen_postulacion'] = $gestionPostulantesModel->find($id_preg_examen);
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $dataPostulacion['oid_grpr'] = $id_preg_examen;
            $dataPostulacion['oid_postulaciones'] = $id_postulacion;
            $dataPostulacion['oid_respuestas'] = $dataForm['oid_respuestas'];
            $dataPostulacion['exam_comentario'] = $dataForm['exam_comentario'];
            $respuesta = $gestionPostulantesModel->agregarExamen($dataPostulacion);
            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/gestionPostulantes/editar_postulacion/'.$id_grupo."/".$id_postulacion));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar el documento!';
                return view('respuestas_servidor/error', $datos);
            }
        }        
        $datos['respuestas_examen'] = $gestionPostulantesModel->getRespuestas($id_preg_examen);
        $datos['id_grupo'] = $id_grupo;
        $datos['id_postulacion'] = $id_postulacion;
        return view('gestion_postulantes/editar-pend-postulacion', $datos);
    }
    /******************************************************************/
    function cambiarVigencia(){
        
        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $gestionPostulantesModel = new GestionPostulantesModel($db);
            $respuesta = $gestionPostulantesModel->cambiar_vigencia($data_post['id_postulacion']);
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function cambiarEstado(){
        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $gestionPostulantesModel = new GestionPostulantesModel($db);
            $respuesta = $gestionPostulantesModel->editarEstado($data_post['oid_postulacion'], $data_post['oid_poes']);
            if($data_post['oid_poes'] == '6'){
                $respuesta = $gestionPostulantesModel->matricular($data_post['oid_usuario'], $data_post['oid_grupo']);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function descargar($id_postulacion, $id_archivo, $nombre_documento){
        $path = getcwd().'/../writable/uploads/postulaciones/'.$id_postulacion.'/'.$id_archivo.'/'.$nombre_documento;
        return $this->response->download($path, null);
    }
    /******************************************************************/
    function editarPuntajes($oid_grupo, $oid_postulacion){
        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            
            $gestionPostulantesModel = new GestionPostulantesModel($db);
            $respuesta = $gestionPostulantesModel->updatePostulacion($oid_postulacion, $data_post);
            if($respuesta)
                return redirect()->to(base_url('public/gestionPostulantes/editar_postulacion/'.$oid_grupo."/".$oid_postulacion));
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
}
<?php namespace App\Controllers;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ComunidadModel;
use App\Models\PeriodoModel;

class Periodo extends BaseController
{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
    }
    /******************************************************************/
    function index(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Periodos de Postulación');

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
        $r_periodos = new PeriodoModel($db);
        $datos['r_periodos'] = $r_periodos->getPeriodos();
        return view('periodo/index-periodo', $datos);
    }
    /******************************************************************/
	public function agregar_periodo(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Crear Periodo');

        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();

            $crearPeriodo = new PeriodoModel($db);
            $respuesta = $crearPeriodo->crear_periodo($data_post);

            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/periodo/index/'));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el periodo!';
                return view('respuestas_servidor/error', $datos);
            }
        }
		return view('periodo/agregar-periodo', $datos);
    }
    /******************************************************************/
    public function editar_periodo($id_periodo){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Periodo');

        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $editarPeriodo = new PeriodoModel($db);
            $respuesta = $editarPeriodo->editar_periodo($data_post, $id_periodo);
            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/periodo/index/'));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el periodo!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $edit_periodo = new PeriodoModel($db);
        $datos['edit_periodo'] = $edit_periodo->find($id_periodo);
		return view('periodo/editar-periodo', $datos);
    }
    /******************************************************************/
    function sedes_periodo($id_periodo){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Sedes de Postulación');

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
        $r_periodos = new PeriodoModel($db);
        $datos['r_periodos'] = $r_periodos->getSedes($id_periodo);
        $disponibles = new PeriodoModel($db);
        $datos['disponibles'] = $disponibles->getDisponibles($id_periodo);

        $datos['id_periodo'] = $id_periodo; 
        return view('periodo/sedes-periodo', $datos);
    }
    /******************************************************************/
    function cambiarVigencia(){
        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $cambiar = new PeriodoModel($db);
            $respuesta = $cambiar->cambiar_vigencia($data_post);
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function cambiarVigenciaSede(){
        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $cambiar = new PeriodoModel($db);
            $respuesta = $cambiar->cambiar_vigencia_sede($data_post);
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function agregarRegistro(){
        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $cambiar = new PeriodoModel($db);
            $respuesta = $cambiar->agregar_registro($data_post);
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
	public function agregar_sede($id_periodo){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Crear Sede');

        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();

            $crearPeriodo = new PeriodoModel($db);
            $respuesta = $crearPeriodo->crear_sede($data_post);

            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/periodo/sedes_periodo/'.$id_periodo));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el periodo!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $datos['id_periodo'] = $id_periodo;
		return view('periodo/agregar-sede', $datos);
    }
    /******************************************************************/
    function actualUser(){
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find(1);
        return $findUsuario;
    }
}
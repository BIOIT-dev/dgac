<?php namespace App\Controllers;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\IndicadoresHistoricosModel;

class IndicadoresHistoricos extends BaseController
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
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Gestión de Indicadores Históricos');

        $indicador_grupo = new IndicadoresHistoricosModel($db);
        $datos['indicador_grupo'] = $indicador_grupo->getIndicadorGrupo();
        return view('indicadores_historicos/index-ind-historicos', $datos);
    }
    /******************************************************************/
	public function agregar_indicador_grupo(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Crear Indicador Grupo');

        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $data_post['activo'] = '0';
            $crearIndicadorGrupo = new IndicadoresHistoricosModel($db);
            $respuesta = $crearIndicadorGrupo->crear_indicador_grupo($data_post);

            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/indicadoresHistoricos/index/'));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el periodo!';
                return view('respuestas_servidor/error', $datos);
            }
        }
		return view('indicadores_historicos/agregar-ind-grupo', $datos);
    }
    /******************************************************************/
    public function editar_indicador_grupo($id_indicador_grupo){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Indicador Grupo');

        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $edit_indicador_grupo = new IndicadoresHistoricosModel($db);
            $respuesta = $edit_indicador_grupo->editar_indicador_grupo($data_post, $id_indicador_grupo);
            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/indicadoresHistoricos/index/'));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el periodo!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $edit_indicador_grupo = new IndicadoresHistoricosModel($db);
        $datos['edit_indicador_grupo'] = $edit_indicador_grupo->find($id_indicador_grupo);
		return view('indicadores_historicos/editar-ind-grupo', $datos);
    }
    /******************************************************************/
    function listado_indicadores($id_indicador_grupo){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Listado Indicadores');

        $indicadores = new IndicadoresHistoricosModel($db);
        $datos['indicadores'] = $indicadores->getIndicadores($id_indicador_grupo);
        $datos['id_indicador_grupo'] = $id_indicador_grupo;
        return view('indicadores_historicos/index-indicadores', $datos);
    }
    /******************************************************************/
	public function agregar_indicador($id_indicador_grupo){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar Indicador');

        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $data_post['oid_ind_grupo'] = $id_indicador_grupo;
            $crearIndicador = new IndicadoresHistoricosModel($db);
            $respuesta = $crearIndicador->crear_indicador($data_post);

            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/indicadoresHistoricos/index/'));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el periodo!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $datos['id_indicador_grupo'] = $id_indicador_grupo;
		return view('indicadores_historicos/agregar-indicador', $datos);
    }
    /******************************************************************/
    public function editar_indicador($id_indicador){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Indicador');

        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $edit_indicador = new IndicadoresHistoricosModel($db);
            $respuesta = $edit_indicador->editar_indicador($data_post, $id_indicador);
            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/indicadoresHistoricos/index/'));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar el indicador!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $edit_indicador = new IndicadoresHistoricosModel($db);
        $datos['edit_indicador'] = $edit_indicador->getIndicador($id_indicador);
		return view('indicadores_historicos/editar-indicador', $datos);
    }
    /******************************************************************/
    function cambiarVigencia(){
        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $cambiar = new IndicadoresHistoricosModel($db);
            $respuesta = $cambiar->cambiar_vigencia($data_post);
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
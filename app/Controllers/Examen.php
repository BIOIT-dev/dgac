<?php namespace App\Controllers;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ExamenModel;

class Examen extends BaseController
{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
    }
    /******************************************************************/
	public function index()
	{
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Exámenes');
        $buscar = new ExamenModel($db);
        $datos['resultado_busqueda'] = $buscar->getExamenes();
        return view('examen/listado-examen', $datos);
	}
    /******************************************************************/
	public function crear(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar Pregunta');

        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $crearElemento = new ExamenModel($db);
            $respuesta = $crearElemento->crear($dataForm);

            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'profile/administracion';
                $datos['mensaje_servidor'] = 'La pregunta ha sido creada correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear la pregunta!';
                return view('respuestas_servidor/error', $datos);
            }
        }
		return view('examen/agregar-examen', $datos);
    }
    /******************************************************************/
    function agregar_respuesta($id_examen){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar Respuestas');
        if ($this->request->getMethod() == 'post') {
            $respuestas_recibidas = $this->request->getPost();
            $agregar = new ExamenModel($db);

            foreach ($respuestas_recibidas as $id_respuesta){
                var_dump($id_respuesta);
                $respuesta = $agregar->agregarRespuestas($id_examen, $id_respuesta);
                // var_dump($respuesta);
            }
            return $id_respuesta;
        }
        $buscar = new ExamenModel($db);
        $datos['resultado_busqueda'] = $buscar->getRespuestas($id_examen);
        $datos['respuestas_pregunta'] = $buscar->getIdRespuestas($id_examen);
        // var_dump($datos['respuestas_pregunta']);
        // return $datos['respuestas_pregunta'];
        $datos['id_examen'] = $id_examen;
        return view('examen/agregar-respuesta', $datos);
    }
    /******************************************************************/
    function eliminar(){
        if ($this->request->getMethod() == 'post') {
            $examenes_recibidos = $this->request->getPost();
            $eliminar = new ExamenModel($db);

            foreach ($examenes_recibidos as $id_examen){
                $respuesta = $eliminar->eliminar($id_examen);
                var_dump($respuesta);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function buscar(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Buscar Documento');

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();

            $buscar = new DocumentoModel($db);
            $datos['resultado_busqueda'] = $buscar->buscar($data_busqueda);
            
            return view('documento/listado-documento', $datos);
        }

        return view('documento/buscar-examen', $datos);
    }
    /******************************************************************/
    function editar($id_examen){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Exámen');

        $find = new ExamenModel($db);
        $findEdit = $find->find($id_examen);
        $datos['profile_data_edit'] = $findEdit;
        $datos['profile_foto_edit'] = array('foto'=>base_url().'/assets/images/users/4.jpg');

        $datos['resultado_busqueda'] = $find->buscarPreguntas($id_examen);

        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            if($dataForm['preg_activo'] == 'on') $dataForm['preg_activo'] = '0';
            else $dataForm['preg_activo'] = '1';
            $editar = new ExamenModel($db);
            $respuesta = $editar->editar($dataForm);

            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'profile/administracion';
                $datos['mensaje_servidor'] = 'La pregunta se editó correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar la pregunta!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        return view('examen/editar-examen', $datos);
    }
    /******************************************************************/
    function editar_respuesta($id_examen_r){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Exámen');

        $find = new ExamenModel($db);
        $findEdit = $find->getRespuesta($id_examen_r);
        $datos['profile_data_edit'] = $findEdit[0];
        $datos['profile_foto_edit'] = array('foto'=>base_url().'/assets/images/users/4.jpg');
        // var_dump($datos['profile_data_edit']);
        // return $datos['profile_data_edit'];

        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            if($dataForm['activo'] == 'on') $dataForm['activo'] = '0';
            else $dataForm['activo'] = '1';
            $editar = new ExamenModel($db);
            $respuesta = $editar->editarActivo($dataForm);

            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'profile/administracion';
                $datos['mensaje_servidor'] = 'La respuesta se editó correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar la respuesta!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        return view('examen/editar-respuesta', $datos);
    }
    /******************************************************************/
    function actualUser(){
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find(1);
        return $findUsuario;
    }

}

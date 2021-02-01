<?php namespace App\Controllers;

use CodeIgniter\Models;
use App\Models\ComunidadModel;
use App\Models\UsuarioModel;
use App\Models\EncuestaModel;
use App\Models\TestPreguntaModel;
use App\Models\TestPreguntaOpcionModel;

class Encuesta extends BaseController
{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
    }
     /******************************************************************/
	public function crear_encuesta()
	{
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar Encuesta o Banco de Preguntas');

        if ($this->request->getMethod() == 'post') {
            $data_encuesta = $this->request->getPost();

            $crearEncuesta = new EncuestaModel($db);
            $respuesta = $crearEncuesta->crear_encuesta($data_encuesta);
            $datos['respuesta'] = $respuesta;
            
            if ($respuesta != FALSE){
				$datos['url_retorno'] = 'profile/administracion';
                $datos['mensaje_servidor'] = 'La encuesta/pregunta ha sido creada correctamente!</br>Click "OK" para ingresar datos.';
                $datos['oid_creado'] = $respuesta;
                return view('respuestas_servidor/exito_encuesta', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear la encuesta/pregunta!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $findComunidades = new ComunidadModel($db);
        $datos['query'] = $findComunidades->obtenerComunidadesActivas();

		return view('encuesta/crear-encuesta', $datos);
	}
    /******************************************************************/
     /******************************************************************/
	public function crear_pregunta()
	{
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar Encuesta o Banco de Preguntas');

        if ($this->request->getMethod() == 'post') {
            $data_encuesta = $this->request->getPost();
            $tipo = substr($data_encuesta['add_pregunta'],0,3);
            $valor = substr($data_encuesta['add_pregunta'],-1);

            $crearPregunta = new EncuestaModel($db);
            $id_pregunta = $crearPregunta->crear_pregunta($data_encuesta['oid_test'], $tipo);

            $crearOpcionPregunta = new EncuestaModel($db);
            for ($init = 0; $init < $valor; $init++){
                var_dump($id_pregunta, $init);
                $correcta = ($init==0 ? 'S' : 'N');
                $crearOpcionPregunta->crear_opcion_pregunta($data_encuesta['oid_test'], $id_pregunta, $correcta);
            }
            return redirect()->to(base_url('public/encuesta/editar_pregunta/'.$data_encuesta['oid_test'].'/'.$id_pregunta));
        }
        $findComunidades = new ComunidadModel($db);
        $datos['query'] = $findComunidades->obtenerComunidadesActivas();

		return view('encuesta/crear-pregunta', $datos);
	}
	/******************************************************************/
	/******************************************************************/
    function buscar_encuesta(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Buscar Encuesta o Banco de Preguntas');

        if ($this->request->getMethod() == 'post') {
            $data_encuesta = $this->request->getPost();
            $buscarEncuesta = new EncuestaModel($db);
            $datos['resultado_busqueda'] = $buscarEncuesta->buscar_encuesta($data_encuesta);
            
            return view('encuesta/listado-encuesta', $datos);
        }
        $findComunidades = new ComunidadModel($db);
        $query = $findComunidades->obtenerComunidades();
        $datos['query'] = $query;

        return view('encuesta/buscar-encuesta', $datos);
    }
    /******************************************************************/
    /******************************************************************/
    function administrar_encuestas(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Buscar Encuesta o Banco de Preguntas para Administración');

        if ($this->request->getMethod() == 'post') {
            $data_encuesta = $this->request->getPost();
            $buscarEncuesta = new EncuestaModel($db);
            $datos['resultado_busqueda'] = $buscarEncuesta->buscar_encuesta($data_encuesta);
            
            return view('encuesta/listado-encuesta', $datos);
        }
        $adminEncuestas = new EncuestaModel($db);
        $datos['resultado_busqueda'] = $adminEncuestas->getEncuestas();

        return view('encuesta/administrar-encuestas', $datos);
    }
    /******************************************************************/
    /******************************************************************/
    function editar($id_encuesta){
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Encuesta o Banco de Preguntas');
        $datos['profile_data'] = $this->usuarioActual;

        $findEncuesta_edit = new EncuestaModel($db);
        $datos['profile_data_edit'] = $findEncuesta_edit->find($id_encuesta);

        if ($this->request->getMethod() == 'post') {
            $data_comunidad = $this->request->getPost();
            
            $editarComunidad = new ComunidadModel($db);
            $respuesta = $editarComunidad->editar_comunidad($data_comunidad);

            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'profile/administracion';
                $datos['mensaje_servidor'] = 'La comunidad se editó correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar la comunidad!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $findComunidadEnc = new ComunidadModel($db);
        $datos['comunidad_encuesta'] = $findComunidadEnc->find($datos['profile_data_edit']['oid_grupo']);

        $findPreguntasEnc = new TestPreguntaModel($db);
        $datos['preguntas_encuesta'] = $findPreguntasEnc->buscar_test_preguntas($id_encuesta);
        // var_dump($datos['preguntas_encuesta']->length;
        $datos['resultado_preguntas'] = array();
        $buscarPreguntas = new TestPreguntaOpcionModel($db);
        foreach($datos['preguntas_encuesta'] as $dp){
            array_push($datos['resultado_preguntas'], $buscarPreguntas->buscar_test_pregunta_opcion($id_encuesta, $dp->oid));
        }

        return view('encuesta/editar-encuesta', $datos);
    }
    /******************************************************************/
    /******************************************************************/
    function editar_general($id_encuesta){
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Encuesta o Banco de Preguntas');
        $datos['profile_data'] = $this->usuarioActual;

        $findEncuesta_edit = new EncuestaModel($db);
        $datos['profile_data_edit'] = $findEncuesta_edit->find($id_encuesta);
        
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $editarGeneral = new EncuestaModel($db);
            $respuesta = $editarGeneral->editar_general($id_encuesta, $dataForm);

            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/encuesta/editar/'.$id_encuesta));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar la comunidad!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        return view('encuesta/editar-general', $datos);
    }
    /******************************************************************/
    /******************************************************************/
    function editar_pregunta($id_encuesta, $id_pregunta){
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Modificar Encuesta de Observación');
        $datos['profile_data'] = $this->usuarioActual;

        $findPregunta = new EncuestaModel($db);
        $datos['pregunta_edit'] = $findPregunta->buscar_pregunta($id_pregunta);
        $buscarPreguntas = new TestPreguntaOpcionModel($db);
        $datos['opciones_preguntas'] = $buscarPreguntas->buscar_test_pregunta_opcion($id_encuesta, $id_pregunta);

        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $editarPregunta = new EncuestaModel($db);
            $respuesta = $editarPregunta->editar_pregunta($id_pregunta, $dataForm['texto_pregunta']); # se edita el enunciado de la pregunta
            $editarOpcionPregunta = new EncuestaModel($db);
            switch($datos['pregunta_edit']->tipo){
                case "ALT":
                    foreach($datos['opciones_preguntas'] as $op){
                        $correcta = ($dataForm['correcta']==$op->oid ? 'S' : 'N');
                        $respuesta = $editarOpcionPregunta->editar_opcion_pregunta($op->oid, $correcta, $dataForm['text'.$op->oid]);
                    }
                    break;
                case "MUL":
                    foreach($datos['opciones_preguntas'] as $op){
                        $correcta = (isset($dataForm['correcta'.$op->oid]) ? 'S' : 'N');
                        $respuesta = $editarOpcionPregunta->editar_opcion_pregunta($op->oid, $correcta, $dataForm['text'.$op->oid]);
                    }
                    break;
            }
            
            return redirect()->to(base_url('public/encuesta/editar/'.$id_encuesta));
        }

        $findEncuesta_edit = new EncuestaModel($db);
        $datos['profile_data_edit'] = $findEncuesta_edit->find($id_encuesta);
        $datos['id_pregunta'] = $id_pregunta;
        return view('encuesta/editar-pregunta', $datos);
    }
    /******************************************************************/
    /******************************************************************/
    function eliminar_encuesta(){
        if ($this->request->getMethod() == 'post') {
            $encuestas_recibidas = $this->request->getPost();
            $eliminarEncuesta = new EncuestaModel($db);
            foreach ($encuestas_recibidas as $id_encuesta){
                $respuesta = $eliminarEncuesta->eliminar_encuesta($id_encuesta);
                var_dump($respuesta);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function eliminar_pregunta(){
        if ($this->request->getMethod() == 'post') {
            $pregunta_recibida = $this->request->getPost();
            $eliminarPregunta = new EncuestaModel($db);
            $respuesta = $eliminarPregunta->eliminar_pregunta($pregunta_recibida['id_pregunta']);
            if ($respuesta == TRUE){
                return "success";
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido eliminar la pregunta!';
                return view('respuestas_servidor/error', $datos);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    public function cambiar_vigencia(){
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            if($dataForm["estado"]==0) $dataForm["estado"] = '1';
            else $dataForm["estado"] = '0';
            $data = [
                'estado' => $dataForm["estado"]
            ];
            $db = \Config\Database::connect();
            $builder = $db->table('test');
            $builder->where('oid', $dataForm["oid"]);
            $response = $builder->update($data);
            return $response;
        }
    }
    /******************************************************************/
    function actualUser(){
        $findUsuario = new UsuarioModel($db);
        return $findUsuario->find(1);
    }
}

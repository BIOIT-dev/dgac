<?php namespace App\Controllers;

// Éste módulo corresponde a las encuestas públicas

use CodeIgniter\Models;
use App\Models\ComunidadModel;
use App\Models\UsuarioModel;
use App\Models\EncuestasModel; //Modelo encuestas pública
use App\Models\EncuestaModel;
use App\Models\ExamenModel;
use App\Models\TestPreguntaModel;
use App\Models\TestPreguntaOpcionModel;
use App\Models\ProgPresencialModel;


class Encuestas extends BaseController{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
    }
    /******************************************************************/
	public function index($estado_habilitar=null){
        $session = session();
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Encuestas');
        
        ($estado_habilitar == '1' ? $datos['estado_habilitar'] = 1 : $datos['estado_habilitar'] = 0);

        $encuestasModel = new EncuestasModel($db);
        $datos['resultado_busqueda'] = $encuestasModel->getEncuestas($session->grupo_id);
        foreach($datos['resultado_busqueda'] as $rb){
            $respuesta = $encuestasModel->getRespondida($rb->oid, $session->grupo_id, $session->user_id);
            $rb->respondida = $respuesta;
            // var_dump($rb);
            // echo '<br/>';
        }
        // var_dump($datos['resultado_busqueda']);
        // return;
        return view('encuestas/index', $datos);
    }
    
    public function encuestarun($id_encuesta){
        $session = session();
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Contestar Encuesta');
        $datos['profile_data'] = $this->usuarioActual;

        $encuestasModel = new EncuestasModel($db);
        $datos['profile_data_edit'] = $encuestasModel->getEncuesta($id_encuesta, $session->grupo_id);
        $oid_test = $datos['profile_data_edit']['oid_test'];
        // var_dump($datos['profile_data_edit']);
        // return;
        $findPreguntasEnc = new TestPreguntaModel($db);
        $datos['preguntas_encuesta'] = $findPreguntasEnc->buscar_test_preguntas($oid_test);
        // var_dump($datos['preguntas_encuesta']);
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $fecha_actual = date('Y-m-d H:i:s');
            foreach($datos['preguntas_encuesta'] as $preg_enc){
                if($preg_enc->tipo != "PED"){
                    $dataEncuesta['oid_encuesta'] = $id_encuesta;
                    $dataEncuesta['oid_pregunta'] = $preg_enc->oid;
                    $dataEncuesta['oid_respuesta'] = $dataForm[$preg_enc->oid];
                    $dataEncuesta['txt_respuesta'] = "";
                    $dataEncuesta['oid_usuario'] = $session->user_id;
                    $dataEncuesta['fecha'] = $fecha_actual;
                    $dataEncuesta['oid_grupo'] = $session->grupo_id;
                    // var_dump($dataEncuesta);
                    // echo "<br />";
                    $encuestasModel->insertEncuestaUsuario($dataEncuesta);
                }else{
                    $dataEncuesta['oid_encuesta'] = $id_encuesta;
                    $dataEncuesta['oid_pregunta'] = $preg_enc->oid;
                    $dataEncuesta['oid_respuesta'] = "0";
                    $dataEncuesta['txt_respuesta'] = $dataForm[$preg_enc->oid];
                    $dataEncuesta['oid_usuario'] = $session->user_id;
                    $dataEncuesta['fecha'] = $fecha_actual;
                    $dataEncuesta['oid_grupo'] = $session->grupo_id;
                    // var_dump($dataEncuesta);
                    // echo "<br />";
                    $encuestasModel->insertEncuestaUsuario($dataEncuesta);
                }
            }
            return redirect()->to(base_url('public/encuestas/index'));
        }
        $findComunidadEnc = new ComunidadModel($db);
        $datos['comunidad_encuesta'] = $findComunidadEnc->find($session->grupo_id);

        // $findPreguntasEnc = new TestPreguntaModel($db);
        // $datos['preguntas_encuesta'] = $findPreguntasEnc->buscar_test_preguntas($oid_test);
        // var_dump($datos['preguntas_encuesta']->length;
        $datos['resultado_preguntas'] = array();
        $buscarPreguntas = new TestPreguntaOpcionModel($db);
        foreach($datos['preguntas_encuesta'] as $dp){
            array_push($datos['resultado_preguntas'], $buscarPreguntas->buscar_test_pregunta_opcion($oid_test, $dp->oid));
        }
        return view('encuestas/encuesta-run', $datos);
    }
     /******************************************************************/
	public function add_encuesta(){
        $session = session();
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar Encuesta de Observación');
        $encuestasModel = new EncuestasModel($db);
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $dataForm['fecha'] = date('Y-m-d H:i:s');
            $dataForm['oid_usuario'] = $session->user_id;
            $dataForm['oid_grupo'] = $session->grupo_id;
            // var_dump($dataForm);
            // return;
            
            $respuesta = $encuestasModel->agregarEncuesta($dataForm);

            if ($respuesta == TRUE){
                $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'');
                $datos['mensaje_servidor'] = "Encuesta agregada correctamente";
                $datos['url_redirect'] = 'encuestas/index';
                return view('respuestas_servidor/exito_params', $datos);
            }else{
                $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'');
                $datos['mensaje_servidor'] = "No se pudo crear la encuesta";
                $datos['url_redirect'] = 'encuestas/index';
                return view('respuestas_servidor/error_params', $datos);
            }
        }
        $datos['r_encuestas'] = $encuestasModel->getTests($session->grupo_id);
        $datos['r_asignaturas'] = $encuestasModel->getAsignaturas($session->grupo_id);

		return view('encuestas/agregar-encuesta', $datos);
    }
    
    public function getProfesores(){  
        $session = session();      
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            // var_dump($dataForm);
            // return;
            $encuestasModel = new EncuestasModel($db);
            $r = $encuestasModel->getProfesores($dataForm['oid_curso'], $session->grupo_id)[0];
            $html = "";
            if($r->oid_profesor==0||$r->oid_profesor=='0'){
                $html.= "<option value='0'>No Existen Profesores para esta Asignatura</option> ";
            }elseif ($r->oid_profesor2==0||$r->oid_profesor2=='0'){
                $html.= "<option value='null'>Seleccionar</option>";
                $html.= "<option value='".$r->oid_profesor."'>".$r->nombres.' '.$r->apellidos."</option> ";
            }else{
                $html.= "<option value='null'>Seleccionar</option>";
                $html.= "<option value='".$r->oid_profesor."'>".$r->nombres.' '.$r->apellidos."</option> ";
                $html.= "<option value='".$r->oid_profesor2."'>".$r->nombres2.' '.$r->apellidos2."</option> ";
                if($r->oid_profesor3!=0){
                $html.= "<option value='".$r->oid_profesor3."'>".$r->nombres3.' '.$r->apellidos3."</option> ";
                }
                if($r->oid_profesor4!=0){
                $html.= "<option value='".$r->oid_profesor4."'>".$r->nombres4.' '.$r->apellidos4."</option> ";
              }
              if($r->oid_profesor5!=0){
                $html.= "<option value='".$r->oid_profesor5."'>".$r->nombres5.' '.$r->apellidos5."</option> ";
              }
              if($r->oid_profesor6!=0){
                $html.= "<option value='".$r->oid_profesor6."'>".$r->nombres6.' '.$r->apellidos6."</option> ";
              }
              if($r->oid_profesor7!=0){
                $html.= "<option value='".$r->oid_profesor7."'>".$r->nombres7.' '.$r->apellidos7."</option> ";
              }
              if($r->oid_profesor8!=0){
                $html.= "<option value='".$r->oid_profesor8."'>".$r->nombres8.' '.$r->apellidos8."</option> ";
              }
              if($r->oid_profesor9!=0){
                $html.= "<option value='".$r->oid_profesor9."'>".$r->nombres9.' '.$r->apellidos9."</option> ";
              }
              if($r->oid_profesor10!=0){
                $html.= "<option value='".$r->oid_profesor10."'>".$r->nombres10.' '.$r->apellidos10."</option> ";
              }
            }
            return $html;
        }
    }

    function editar($id_encuesta){
        $session = session();  
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Encuesta o Banco de Preguntas');
        $datos['profile_data'] = $this->usuarioActual;

        $encuestasModel = new EncuestasModel($db);
        $datos['data_edit'] = $encuestasModel->find($id_encuesta);

        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $respuesta = $encuestasModel->updateEncuesta($id_encuesta, $dataForm);
            if ($respuesta == TRUE){
				$datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'');
                $datos['mensaje_servidor'] = "Encuesta editada correctamente";
                $datos['url_redirect'] = 'encuestas/index';
                return view('respuestas_servidor/exito_params', $datos);
            }else{
                $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'');
                $datos['mensaje_servidor'] = "No se pudo editar la encuesta";
                $datos['url_redirect'] = 'encuestas/index';
                return view('respuestas_servidor/error_params', $datos);
            }
        }
        $datos['r_encuesta'] = $encuestasModel->getTest($datos['data_edit']['oid_test'])[0];
        $datos['r_asignaturas'] = $encuestasModel->getAsignaturas($session->grupo_id);

        return view('encuestas/editar-encuesta', $datos);
    }

    function eliminar(){
        if ($this->request->getMethod() == 'post') {
            $encuestas_recibidas = $this->request->getPost();
            $eliminarEncuesta = new EncuestasModel($db);
            foreach ($encuestas_recibidas as $id_encuesta){
                $respuesta = $eliminarEncuesta->deleteEncuesta($id_encuesta);
                var_dump($respuesta);
            }
        }else{
            var_dump("ERROR Controlador");
        }
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
    function editar2($id_encuesta){
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
        $session = session();
        $usuarioModel = new UsuarioModel($db);
        $findUsuario = $usuarioModel->getUsuario($session->username);
        return $findUsuario;
        // $findUsuario = new UsuarioModel($db);
        // return $findUsuario->find(1);
    }
}

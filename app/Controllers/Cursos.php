<?php namespace App\Controllers;
// namespace App\Models;
use ZipArchive;
use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\CursosModel;
use App\Models\RolesModel;
use App\Models\EncuestasModel;
use App\Models\TestPreguntaModel;
use App\Models\TestPreguntaOpcionModel;
use App\Models\ComunidadModel;

use App\Models\ProgPresencialModel;
use App\Models\PeriodoModel;

class Cursos extends BaseController
{
    /**============================================================================================
    /  Inicio Categoria de documentos
    /  ============================================================================================
    */

    public function zip(){
        echo "hola";
        $zip = new ZipArchive; 
        return;
    }

    public function index()
    {
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mis modulos de aprendizaje','ubicacion_url'=>'public/cursos/');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $obj = new CursosModel($db);
        $datos['profile_data'] = $findUsuario;
        $datos['cursos'] = $obj->ant_obtener_cursos($session->grupo_id);
        
        return view('cursos/index', $datos);
    }

    public function edit_curso($oid_curso){
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mis modulos de aprendizaje','ubicacion_url'=>'public/cursos/');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        
        $curso = new CursosModel($db);
        $usuario = new UsuarioModel($db);
        $datos['profile_data'] = $findUsuario;
        $datos['oid_grupo'] = $session->grupo_id;
        $datos['cursos'] = $curso->obtenerCursosPorOrden($session->grupo_id);
        $datos['curso_info'] = $curso->ant_obtener_info_curso($oid_curso,$session->grupo_id);

        $datos['profesores'] = $usuario->obtenerProfesoresComunidad($session->grupo_id);
        // print_r($datos['cursos']);
        // print_r($datos['profesores']);
        if ($this->request->getMethod() == 'post') {
            $data_curso = $this->request->getPost();

            $crearCurso = new CursosModel($db);
            $respuesta = $crearCurso->editar_curso($data_curso);

            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'cursos/index';
                $datos['mensaje_servidor'] = 'El curso ha sido editado correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar el curso!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        return view('cursos/edit', $datos);

    }


    public function add_objeto_aprendizaje($oid_curso){
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mis modulos de aprendizaje','ubicacion_url'=>'public/cursos/');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        
        $curso = new CursosModel($db);
        $usuario = new UsuarioModel($db);
        $datos['profile_data'] = $findUsuario;
        $oid_grupo = $session->grupo_id;
        $datos['oid_grupo'] = $session->grupo_id;
        $datos['oid_curso'] = $oid_curso;
        $datos['cursos_orden'] = $curso->generarListadoOrden($oid_curso,$oid_grupo);
        $datos['cursos_objeto_aprendizaje'] = $curso->obtenerObjetosAprendizajes($oid_curso,$oid_grupo);
        if ($this->request->getMethod() == 'post') {
            $data_curso = $this->request->getPost();
            $datos_post = ['oid_curso'=>$data_curso['oid_curso'],'titulo'=>$data_curso['titulo'],'texto'=>$data_curso['texto'],'oid_sco'=>$data_curso['oid_sco'],'orden'=>'0'];
            $crearCurso = new CursosModel($db);
            $respuesta = $crearCurso->crear_objeto_aprendizaje($datos_post);

            if (!$respuesta == FALSE){
                $is_scor = $crearCurso->is_scorm($data_curso['oid_sco']);
                $crTipo = 'NOAPLICA';
                try{
                    if($is_scor->is_scorm==1){
                        $crTipo = 'SCORM';
                    }else{
                        $crTipo = 'MICROSITIO';
                    }
                }catch (\Exception $e)
                {
                }
                $id = $respuesta;
                $datos_insert = ['oid_curso'=>$data_curso['oid_curso'],'oid_objeto'=>$id,'tipo_objeto'=>$crTipo,'orden'=>$data_curso['orden'],'oid_grupo'=>$oid_grupo];
                $respuesta = $crearCurso->crear_curso_ruta($datos_insert);

                $datos['mensaje_servidor'] = 'El objeto de aprendizaje ha sido creado correctamente!';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el objeto de aprendizaje!';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/error', $datos);
            }
        }
        
        return view('cursos/add_objeto_aprendizaje', $datos);
    }

    public function edit_objeto_aprendizaje($oid_curso,$oid){
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mis modulos de aprendizaje','ubicacion_url'=>'public/cursos/');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        
        $curso = new CursosModel($db);
        $usuario = new UsuarioModel($db);
        $datos['profile_data'] = $findUsuario;
        $oid_grupo = $session->grupo_id;
        $datos['oid_grupo'] = $session->grupo_id;
        $datos['oid_curso'] = $oid_curso;

        $datos['cursos_orden'] = $curso->generarListadoOrden($oid_curso,$oid_grupo);
        $datos['cursos_objeto_aprendizaje'] = $curso->obtenerObjetosAprendizajes($oid_curso,$oid_grupo);
        $datos['cursos_scorm'] = $curso->obtenerSCORM($oid,$oid_curso);
        if ($this->request->getMethod() == 'post') {
            $data_curso = $this->request->getPost();
            $datos_post = ['oid_curso'=>$data_curso['oid_curso'],'titulo'=>$data_curso['titulo'],'texto'=>$data_curso['texto'],'oid'=>$data_curso['oid'],'orden'=>'0'];
            $crearCurso = new CursosModel($db);
            $respuesta = $crearCurso->editar_scorm_curso($datos_post);

            if (!$respuesta == FALSE){
                $is_scor = $crearCurso->is_scorm($data_curso['oid_sco']);
                $crTipo = 'NOAPLICA';
                try{
                    if($is_scor->is_scorm==1){
                        $crTipo = 'SCORM';
                    }else{
                        $crTipo = 'MICROSITIO';
                    }
                }catch (\Exception $e)
                {
                    //die($e->getMessage());
                }
                $id = $respuesta;
                $datos_insert = ['oid_curso'=>$data_curso['oid_curso'],'oid_objeto'=>$id,'tipo_objeto'=>$crTipo,'orden'=>$data_curso['orden'],'oid_grupo'=>$oid_grupo];
                $respuesta = $crearCurso->editar_ruta($datos_insert);

                $datos['mensaje_servidor'] = 'El objeto de aprendizaje ha sido editado correctamente!';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar el objeto de aprendizaje!';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/error', $datos);
            }
        }
        
        return view('cursos/edit_objeto_aprendizaje', $datos);
    }



    public function add_etiqueta($oid_curso){
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mis modulos de aprendizaje','ubicacion_url'=>'public/cursos/');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        
        $curso = new CursosModel($db);
        $usuario = new UsuarioModel($db);
        $datos['profile_data'] = $findUsuario;
        $oid_grupo = $session->grupo_id;
        $datos['oid_grupo'] = $session->grupo_id;
        $datos['oid_curso'] = $oid_curso;
        $datos['cursos_orden'] = $curso->generarListadoOrden($oid_curso,$oid_grupo);

        if ($this->request->getMethod() == 'post') {
            $data_curso = $this->request->getPost();
            $datos_post = ['oid_curso'=>$data_curso['oid_curso'],'titulo'=>$data_curso['titulo'],'oid_usuario'=>$data_curso['oid_usuario'],'fecha'=>date('Y-m-d H:M:S')];
            $crearCurso = new CursosModel($db);
            $respuesta = $crearCurso->crear_etiqueta($datos_post);

            if (!$respuesta == FALSE){
                $id = $respuesta;
                $datos_insert = ['oid_curso'=>$data_curso['oid_curso'],'oid_objeto'=>$id,'tipo_objeto'=>'ETIQUETA','orden'=>$data_curso['orden'],'oid_grupo'=>$oid_grupo];
                $respuesta = $crearCurso->crear_curso_ruta($datos_insert);

                $datos['mensaje_servidor'] = 'La etiqueta ha sido creada correctamente!';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear la etiqueta!';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/error', $datos);
            }
        }
        return view('cursos/add_etiqueta', $datos);
    }

    
    public function edit_etiqueta($oid_curso,$oid){
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mis modulos de aprendizaje','ubicacion_url'=>'public/cursos/');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        
        $curso = new CursosModel($db);
        $usuario = new UsuarioModel($db);
        $datos['profile_data'] = $findUsuario;
        $oid_grupo = $session->grupo_id;
        $datos['oid_grupo'] = $session->grupo_id;
        $datos['oid_curso'] = $oid_curso;
        $datos['cursos_orden'] = $curso->generarListadoOrden($oid_curso,$oid_grupo);
        $datos['etiqueta_detalle'] = $curso->obtenerEtiqueta($oid,$oid_curso);
        $datos['orden_'] = $curso->generarOrdenEditar($oid_curso,$session->grupo_id);
        // echo var_dump($datos['orden_']);
        // return;
        
        if ($this->request->getMethod() == 'post') {
            $data_curso = $this->request->getPost();
            $data_curso_temporal = $data_curso;
            // print_r($data_curso);
            unset($data_curso_temporal['orden']);
            // $datos_post = ['oid_curso'=>$data_curso['oid_curso'],'titulo'=>$data_curso['titulo'],'oid_usuario'=>$data_curso['oid_usuario'],'fecha'=>date('Y-m-d H:M:S')];
            $crearCurso = new CursosModel($db);
            $respuesta = $crearCurso->editar_etiqueta($data_curso_temporal);

            if (!$respuesta == FALSE){
                $id = $oid;
                $datos_insert = ['oid_curso'=>$data_curso['oid_curso'],'oid_objeto'=>$id,'tipo_objeto'=>'ETIQUETA','orden'=>$data_curso['orden'],'oid_grupo'=>$oid_grupo];
                $respuesta2 = $crearCurso->editar_ruta($datos_insert);

                $datos['mensaje_servidor'] = 'La etiqueta ha sido editada correctamente!';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar la etiqueta!';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/error', $datos);
            }
        }
        return view('cursos/edit_etiqueta', $datos);
    }


    public function edit_evaluaciones($oid_curso,$oid){
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mis modulos de aprendizaje','ubicacion_url'=>'public/cursos/');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        
        $curso = new CursosModel($db);
        $usuario = new UsuarioModel($db);
        $datos['profile_data'] = $findUsuario;
        $oid_grupo = $session->grupo_id;
        $datos['oid_grupo'] = $session->grupo_id;
        $datos['oid_curso'] = $oid_curso;
        $datos['oid_evaluacion'] = $oid;


        $datos['cursos_orden'] = $curso->generarListadoOrden($oid_curso,$oid_grupo);
        $datos['cursos_objeto_aprendizaje'] = $curso->obtenerObjetosAprendizajes($oid_curso,$oid_grupo);
        $datos['cursos_banco_preguntas'] = $curso->obtenerBancoPreguntas($oid_curso,$oid_grupo);
        $datos['cursos_maxima_ponderacion'] = $curso->obtenerMaximaPonderacion($oid_curso);
        $datos['datos_evaluaciones'] =  $curso->getEvaluaciones($oid,$oid_curso,$session->grupo_id);
        $datos['orden_'] = $curso->generarOrdenEditar($oid_curso,$session->grupo_id);
        $reg = $datos['datos_evaluaciones'];
        $datos['pregunta_seleccionada'] = $curso->obtenerPreguntaSeleccionada($session->grupo_id, $reg->oid_test, $reg->tipo);
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            unset($dataForm['orden']);
            if( $reg->tipo=="REG" ){
                $respuestaEdit = $curso->editarEvaluacion($dataForm, $oid);
            }elseif( $reg->tipo=="TLI" && !$reg->es_formativa ){
                $respuestaEdit = $curso->editarEvaluacion($dataForm, $oid);
            }elseif( $reg->tipo=="TLI" && $reg->es_formativa ){
                $respuestaEdit = $curso->editarEvaluacion($dataForm, $oid);
            }

            if($respuestaEdit == TRUE){
                $datos['mensaje_servidor'] = 'La evaluación ha sido editada correctamente!';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar la evaluación';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/error', $datos);
            }
        }
        if( $reg->tipo=="REG" ){
            $template = 'cursos/edit_evaluacion_reg';
        }elseif( $reg->tipo=="TLI" && !$reg->es_formativa ){
            $template = 'cursos/edit_evaluacion_tli';
        }elseif( $reg->tipo=="TLI" && $reg->es_formativa ){
            $template = 'cursos/edit_evaluacion_formativa';
        }

        return view($template, $datos);
    }


    public function add_evaluacion($oid_curso){
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mis modulos de aprendizaje', 'ubicacion_url'=>'public/cursos/');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        
        $curso = new CursosModel($db);
        $usuario = new UsuarioModel($db);
        $datos['profile_data'] = $findUsuario;
        $oid_grupo = $session->grupo_id;
        $datos['oid_grupo'] = $session->grupo_id;
        $datos['oid_curso'] = $oid_curso;
        $datos['cursos_orden'] = $curso->generarListadoOrden($oid_curso,$oid_grupo);
        $datos['cursos_objeto_aprendizaje'] = $curso->obtenerObjetosAprendizajes($oid_curso,$oid_grupo);
        $datos['cursos_banco_preguntas'] = $curso->obtenerBancoPreguntas($oid_curso,$oid_grupo);
        $datos['cursos_maxima_ponderacion'] = $curso->obtenerMaximaPonderacion($oid_curso);
        // echo var_dump($datos['cursos_maxima_ponderacion']);
        // return;

        if ($this->request->getMethod() == 'post') {
            $data_curso = $this->request->getPost();
            $data_curso_temporal = $data_curso;
            // print_r($data_curso);
            unset($data_curso_temporal['orden']);

            $archivos = $this->request->getFiles();
            if($archivos = $this->request->getFiles()){
                if($archivo = $archivos['instrucciones'])
                {
                    if ($archivo->isValid() && ! $archivo->hasMoved())
                    {
                        $archivo_temp = $archivo->getClientName(); //This is if you want to change the file name to encrypted
                        $archivo->move(realpath(FCPATH . '../assets/uploads/miscursos/evaluaciones/'), $archivo_temp);
                        $data_curso_temporal['instrucciones'] = $archivo_temp;
                        // You can continue here to write a code to save the name to database
                        // db_connect() or model format

                    }
                }
            }
            if(isset($data_curso_temporal['es_tarea'])){
                if($data_curso_temporal['es_tarea'] == 'on')
                    $data_curso_temporal['es_tarea'] = 1;
                else $data_curso_temporal['es_tarea'] = 0;
            }
            $crearCurso = new CursosModel($db);
            $respuesta = $crearCurso->crear_curso_evaluacion($data_curso_temporal);

            if (!$respuesta == FALSE){
                $id = $respuesta;
                $crTipo="EVAL".$data_curso['tipo'];
                $datos_insert = ['oid_curso'=>$data_curso['oid_curso'],'oid_objeto'=>$id,'tipo_objeto'=>$crTipo,'orden'=>$data_curso['orden'],'oid_grupo'=>$oid_grupo];
                $respuesta = $crearCurso->crear_curso_ruta($datos_insert);
                // echo var_dump($respuesta);
                // return;
                $datos['mensaje_servidor'] = '¡La evaluación ha sido creada correctamente!';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear la evaluación';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/error', $datos);
            }
        }
        return view('cursos/add_evaluacion', $datos);
    }


    public function add_apuntes($oid_curso){
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mis modulos de aprendizaje', 'ubicacion_url'=>'public/cursos/');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        
        $curso = new CursosModel($db);
        $usuario = new UsuarioModel($db);
        $datos['profile_data'] = $findUsuario;
        $oid_grupo = $session->grupo_id;
        $datos['oid_grupo'] = $session->grupo_id;
        $datos['oid_curso'] = $oid_curso;
        $datos['cursos_orden'] = $curso->generarListadoOrden($oid_curso,$oid_grupo);
        $datos['cursos_objeto_aprendizaje'] = $curso->obtenerObjetosAprendizajes($oid_curso,$oid_grupo);
        if ($this->request->getMethod() == 'post') {
            $data_curso = $this->request->getPost();
            $data_curso_temporal = $data_curso;
            // print_r($data_curso);
            unset($data_curso_temporal['orden']);

            if($archivos = $this->request->getFiles()){
                if($archivo = $archivos['archivo'])
                {
                    if ($archivo->isValid() && ! $archivo->hasMoved())
                    {
                        $archivo_temp = $archivo->getClientName(); //This is if you want to change the file name to encrypted
                        $archivo_temp = str_replace(" ", "_", $archivo_temp);
                        $archivo_temp = md5(uniqid(rand(),1)) . "_" . $archivo_temp; 
                        $archivo->move(realpath(FCPATH . '../assets/uploads/apuntes'), $archivo_temp);
                        $data_curso_temporal['archivo'] = $archivo_temp;
                        // You can continue here to write a code to save the name to database
                        // db_connect() or model format

                    }
                }
            }
            
            $crearCurso = new CursosModel($db);
            $respuesta = $crearCurso->crear_curso_apuntes($data_curso_temporal);

            if (!$respuesta == FALSE){
                $id = $respuesta;
                // $crTipo="EVAL".$data_curso['tipo'];
                $datos_insert = ['oid_curso'=>$data_curso['oid_curso'],'oid_objeto'=>$id,'tipo_objeto'=>'APUNTES','orden'=>$data_curso['orden'],'oid_grupo'=>$oid_grupo];
                $respuesta = $crearCurso->crear_curso_ruta($datos_insert);
                // echo var_dump($respuesta);
                // return;
                $datos['mensaje_servidor'] = 'El documento ha sido creado correctamente!';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el documento!';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/error', $datos);
            }
        }
        
        return view('cursos/add_apuntes', $datos);
    }

    public function edit_apuntes($oid_curso, $oid_apunte){
        $session = session();
        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mis modulos de aprendizaje', 'ubicacion_url'=>'public/cursos/');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        
        $curso = new CursosModel($db);
        $datos['profile_data'] = $findUsuario;
        $oid_grupo = $session->grupo_id;
        $datos['oid_grupo'] = $session->grupo_id;
        $datos['oid_curso'] = $oid_curso;
        $datos['oid_apunte'] = $oid_apunte;
        $datos['cursos_orden'] = $curso->generarListadoOrden($oid_curso,$oid_grupo);
        // $datos['cursos_objeto_aprendizaje'] = $curso->obtenerObjetosAprendizajes($oid_curso,$oid_grupo);
        if ($this->request->getMethod() == 'post') {
            $data_curso = $this->request->getPost();
            $data_curso_temporal = $data_curso;
            // print_r($data_curso);
            unset($data_curso_temporal['orden']);
            if($archivos = $this->request->getFiles()){
                if($archivo = $archivos['archivo']){
                    if ($archivo->isValid() && ! $archivo->hasMoved()){
                        $archivo_temp = $archivo->getClientName(); //This is if you want to change the file name to encrypted
                        $archivo_temp = str_replace(" ", "_", $archivo_temp);
                        $archivo_temp = md5(uniqid(rand(),1)) . "_" . $archivo_temp; 
                        $archivo->move(realpath(FCPATH . '../assets/uploads/apuntes'), $archivo_temp);
                        $data_curso_temporal['archivo'] = $archivo_temp;
                    }
                }
            }
            
            $crearCurso = new CursosModel($db);
            // var_dump($oid_apunte, $data_curso_temporal);
            // return;
            $respuesta = $crearCurso->editar_curso_apuntes($oid_apunte, $data_curso_temporal);

            if (!$respuesta == FALSE){
                $datos['mensaje_servidor'] = 'El documento ha sido editado correctamente!';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar el documento!';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/error', $datos);
            }
        }
        $datos['apunte_edit'] = $curso->getApunte($oid_apunte);
        return view('cursos/edit_apuntes', $datos);
    }


    public function add_pizarra($oid_curso){
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mis modulos de aprendizaje', 'ubicacion_url'=>'public/cursos/');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        
        $curso = new CursosModel($db);
        $usuario = new UsuarioModel($db);
        $datos['profile_data'] = $findUsuario;
        $oid_grupo = $session->grupo_id;
        $datos['oid_grupo'] = $session->grupo_id;
        $datos['oid_curso'] = $oid_curso;
        $datos['cursos_orden'] = $curso->generarListadoOrden($oid_curso,$oid_grupo);
        $datos['cursos_objeto_aprendizaje'] = $curso->obtenerObjetosAprendizajes($oid_curso,$oid_grupo);
        if ($this->request->getMethod() == 'post') {
            $data_curso = $this->request->getPost();
            $data_curso_temporal = $data_curso;
            // print_r($data_curso);
            unset($data_curso_temporal['orden']);
            
            $crearCurso = new CursosModel($db);
            $respuesta = $crearCurso->crear_curso_pizarra($data_curso_temporal);

            if (!$respuesta == FALSE){
                $id = $respuesta;
                // $crTipo="EVAL".$data_curso['tipo'];
                $datos_insert = ['oid_curso'=>$data_curso['oid_curso'],'oid_objeto'=>$id,'tipo_objeto'=>'PIZARRA','orden'=>$data_curso['orden'],'oid_grupo'=>$oid_grupo];
                $respuesta = $crearCurso->crear_curso_ruta($datos_insert);
                // echo var_dump($respuesta);
                // return;
                $datos['mensaje_servidor'] = 'La pizarra ha sido creado correctamente!';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear la pizarra!';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/error', $datos);
            }
        }
        
        return view('cursos/add_pizarra', $datos);
    }

    public function edit_pizarra($oid_curso, $oid_pizarra){
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mis modulos de aprendizaje', 'ubicacion_url'=>'public/cursos/');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        
        $curso = new CursosModel($db);
        $usuario = new UsuarioModel($db);
        $datos['profile_data'] = $findUsuario;
        $oid_grupo = $session->grupo_id;
        $datos['oid_grupo'] = $session->grupo_id;
        $datos['oid_curso'] = $oid_curso;
        $datos['cursos_orden'] = $curso->generarListadoOrden($oid_curso,$oid_grupo);
        $datos['cursos_objeto_aprendizaje'] = $curso->obtenerObjetosAprendizajes($oid_curso,$oid_grupo);
        if ($this->request->getMethod() == 'post') {
            $data_curso = $this->request->getPost();
            // var_dump($data_curso);
            // return;
            $data_curso_temporal = $data_curso;
            // print_r($data_curso);
            unset($data_curso_temporal['orden']);
            
            $crearCurso = new CursosModel($db);
            $respuesta = $crearCurso->edit_curso_pizarra($data_curso_temporal, $oid_pizarra);

            if (!$respuesta == FALSE){
                $id = $respuesta;
                // $crTipo="EVAL".$data_curso['tipo'];
                // $datos_insert = ['oid_curso'=>$data_curso['oid_curso'],'oid_objeto'=>$id,'tipo_objeto'=>'PIZARRA','orden'=>$data_curso['orden'],'oid_grupo'=>$oid_grupo];
                // $respuesta = $crearCurso->crear_curso_ruta($datos_insert);
                // echo var_dump($respuesta);
                // return;
                $datos['mensaje_servidor'] = 'La pizarra ha sido editada correctamente!';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar la pizarra!';
                $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
                return view('respuestas_servidor/error', $datos);
            }
        }
        $datos['edit_pizarra'] = $curso->obtenerPizarra($oid_pizarra, $oid_curso);
        return view('cursos/edit_pizarra', $datos);
    }


    public function curso_detalle($oid_curso){
        $session = session();
        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mis modulos de aprendizaje', 'ubicacion_url'=>'public/cursos/');
        $curso = new CursosModel($db);
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $uid_oid = $session->user_id;
        $oid_grupo = $session->grupo_id;
        $datos['profile_data'] = $findUsuario;
        $datos['oid_grupo'] = $session->grupo_id;
        $datos['oid_curso'] = $oid_curso;
        $datos['cursos'] = $curso->ant_ruta_curso($uid_oid,$oid_curso,$oid_grupo);
        $datos['cursos_info'] = $curso->ant_obtener_info_curso($oid_curso,$oid_grupo);
        $curso_info = $datos['cursos_info'];
        $curso_detalle = array();
        $i = 0;
        foreach ($datos['cursos'] as $key => $value){

            // echo $value->tipo_objeto
            // $i = $i + 1;
            if (! $value->hits) {
                $value->hits = 0;
                $value->fecha = "---";
            }
            if ($value->tipo_objeto == "PIZARRA") {
                $pizarra = $curso->ant_obtener_pizarras($value->oid_objeto,$oid_curso);
                if($pizarra){
                    $a = array('oid'=>$pizarra->oid,'tipo'=>$value->tipo_objeto,'hits'=>$value->hits,'titulo'=>$pizarra->titulo,'texto'=>$pizarra->texto);
                    array_push($curso_detalle,$a);
                }
            }elseif($value->tipo_objeto == "APUNTES") {
                $apunte = $curso->ant_obtener_apuntes($value->oid_objeto,$oid_curso);
                if($apunte){
                    $a = array('oid'=>$apunte->oid,'tipo'=>$value->tipo_objeto,
                    'hits'=>$value->hits,
                    'titulo'=>$apunte->titulo,
                    'texto'=>$apunte->texto,
                    'archivo'=>$apunte->archivo,
                    'archivo_disco'=>$apunte->archivo_disco);
                    array_push($curso_detalle,$a);
                }
            }elseif($value->tipo_objeto == "EVALREG" || $value->tipo_objeto == "EVALTLI") {
                $evaluacione = $curso->ant_obtener_evaluaciones($uid_oid,$value->oid_objeto,$oid_curso);
                if($evaluacione){
                    if (trim($evaluacione->nota) != "") {
                        if ($curso_info->escala == 0)
                            $evaluacione->la_nota = trim(sprintf("%3.1f", $evaluacione->nota));
                        else
                            $evaluacione->la_nota = trim(sprintf("%3.0f", $evaluacione->nota));
                    } else
                        $evaluacione->la_nota = "---";
                    
                    $a = array('oid'=>$evaluacione->oid, 'tipo'=>$value->tipo_objeto,
                    'hits'=>$value->hits,
                    'titulo'=>$evaluacione->titulo,
                    'texto'=>$evaluacione->texto,
                    'fecha'=>$value->fecha,
                    // 'tipo'=>$evaluacione->tipo,
                    'ponderacion'=>$evaluacione->ponderacion,
                    'disponible_test'=>$evaluacione->disponible_test,
                    'es_tarea'=>$evaluacione->es_tarea,
                    'es_formativa'=>$evaluacione->es_formativa,
                    'instrucciones'=>$evaluacione->instrucciones,
                    'cta_oid'=>$evaluacione->cta_oid,
                    'cta_fecha'=>$evaluacione->cta_fecha,
                    'cta_archivo'=>$evaluacione->cta_archivo,
                    'nota'=>$evaluacione->nota,
                    'archivo'=>$evaluacione->archivo,
                    'finicio'=>$evaluacione->finicio,
                    'ftermino'=>$evaluacione->ftermino,
                    'oid_test'=>$evaluacione->oid_test);
                    array_push($curso_detalle,$a);
                }
            }elseif ($value->tipo_objeto == "SCORM" || $value->tipo_objeto == "MICROSITIO") {
                $SCORM = $curso->obtenerSCORM($value->oid_objeto,$oid_curso);
                if($SCORM){
                    $a = array('oid'=>$SCORM->oid,'tipo'=>$value->tipo_objeto,
                    'hits'=>$value->hits,
                    'titulo'=>$SCORM->titulo,
                    'texto'=>$SCORM->texto,
                    'oid_sco'=>$SCORM->oid_sco,
                    'is_scorm'=>$SCORM->is_scorm,
                    'ss_objeto'=>$SCORM->ss_objeto,
                    'dirname'=>$SCORM->dirname,
                    'home'=>$SCORM->home,
                    'attr_scrollbar'=>$SCORM->attr_scrollbar,
                    'attr_toolbar'=>$SCORM->attr_toolbar,
                    'attr_statusbar'=>$SCORM->attr_statusbar,
                    'attr_menubar'=>$SCORM->attr_menubar,
                    'attr_linkbar'=>$SCORM->attr_linkbar,
                    'attr_resizable'=>$SCORM->attr_resizable,
                    'win_ancho'=>$SCORM->win_ancho,
                    'win_alto'=>$SCORM->win_alto);
                    array_push($curso_detalle,$a);
                }
            }elseif ($value->tipo_objeto == "ETIQUETA") {
                $etiqueta = $curso->obtenerEtiqueta($value->oid_objeto,$oid_curso);
                if($etiqueta){
                    $a = array('oid'=>$etiqueta->oid,'tipo'=>$value->tipo_objeto,
                    'hits'=>$value->hits,
                    'titulo'=>$etiqueta->titulo);
                    array_push($curso_detalle,$a);
                }
            }
            
            // $curso_detalle += [ "element$i" =>['tipo'=>$value->tipo_objeto,'hits'->$value->hits]]; 
        }
        
        // print_r($curso_detalle); 
        $datos['cursos_ordenado'] = $curso_detalle;
        // return;
        return view('cursos/detalle', $datos);

    }

    public function add()
    {
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mis modulos de aprendizaje','ubicacion_url'=>'public/cursos/');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        
        $curso = new CursosModel($db);
        $usuario = new UsuarioModel($db);
        $datos['profile_data'] = $findUsuario;
        $datos['oid_grupo'] = $session->grupo_id;
        $datos['cursos'] = $curso->obtenerCursosPorOrden($session->grupo_id);

        $datos['profesores'] = $usuario->obtenerProfesoresComunidad($session->grupo_id);
        // print_r($datos['cursos']);
        // print_r($datos['profesores']);
        if ($this->request->getMethod() == 'post') {
            $data_curso = $this->request->getPost();

            $crearCurso = new CursosModel($db);
            $respuesta = $crearCurso->crear_curso($data_curso);

            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'cursos/index';
                $datos['mensaje_servidor'] = 'El curso ha sido creado correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el curso!';
                return view('respuestas_servidor/error', $datos);
            }
        }


        // return;
        // exit;
        return view('cursos/add', $datos);
    }


    public function promedio_notas(){
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mis modulos de aprendizaje','ubicacion_url'=>'public/cursos/');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        
        $curso = new CursosModel($db);
        $usuario = new UsuarioModel($db);
        $datos['profile_data'] = $findUsuario;
        $datos['oid_grupo'] = $session->grupo_id;

        $promedio_notas = new CursosModel($db);
        $respuesta = $promedio_notas->promedio_notas_sql1($session->grupo_id);
        // print_r($respuesta);
        $curso_detalle = array();
        $i = 0;
        foreach ($respuesta as $key => $value){
            $respuesta2 = $promedio_notas->promedio_notas_sql2($value->id_curso, $session->grupo_id);
            unset($evaluaciones);
            foreach ($respuesta2 as $key2 => $value2){
                $evaluaciones[]=$value2;
            }
            $nEvaluaciones=sizeof($evaluaciones);
            $respuesta3 = $promedio_notas->promedio_notas_sql3($session->grupo_id);
            
            unset($aprobados);
            unset($alumnos);
            unset($SumNotaFinal);
            unset($NotasFin);
            $NotasFin=0;
            $alumnos = 0;
            $aprobados=0;
            foreach ($respuesta3 as $key3 => $value3){
                $alumnos++;
                unset($nota);
                unset($final);
                $nota = "";
                $final=0;
                for($i=0; $i<$nEvaluaciones; $i++ ){   
                    $respuesta4 = $promedio_notas->promedio_notas_sql4($evaluaciones[ $i ]->oid,$value3->oid);
                    // print_r($respuesta4 );
                    if( isset($respuesta4->nota)){
                        if( $value->escala==0 )
                            $nota=trim( sprintf("%3.1f", $respuesta4->nota ) );
                        else
                            $nota=trim( sprintf("%3.0f", $respuesta4->nota ) );
                    }
                    if( $nota!=""){ 
                    $final+=($nota)*($evaluaciones[$i]->ponderacion);
                    } 
                }
                if(round(($final)/100,2) >= $value->not_min)
                {
                    $NotasFin+=$final;
                    $aprobados++;
                }
            }
            $a = array('semestre'=>$value->semestre,
            'id_curso'=>$value->id_curso,
            'titulo_curso'=>$value->titulo_curso,
            'promedio'=> $aprobados!=0 ? round(($NotasFin/$aprobados)/100,2) : 0,
            'aprobados'=>$aprobados,
            'alumnos'=>$alumnos
            );
            array_push($curso_detalle,$a);
        }
        $datos['curso_detalle'] = $curso_detalle;
        return view('cursos/promedio_notas', $datos);
    }

    /** */
    public function add_notas_evaluacion($oid_curso, $oid_evaluacion){
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mis modulos de aprendizaje', 'ubicacion_url'=>'public/cursos/');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        
        $curso = new CursosModel($db);
        $usuario = new UsuarioModel($db);
        $datos['profile_data'] = $findUsuario;
        $datos['profile_data_edit'] = $findUsuario;
        $datos['resultado_busqueda'] = [];
        $oid_grupo = $session->grupo_id;
        $datos['oid_grupo'] = $session->grupo_id;
        $datos['oid_curso'] = $oid_curso;
        $datos['oid_evaluacion'] = $oid_evaluacion;
        $datos['cursos_orden'] = $curso->generarListadoOrden($oid_curso,$oid_grupo);
        $datos['cursos_objeto_aprendizaje'] = $curso->obtenerObjetosAprendizajes($oid_curso,$oid_grupo);
        $datos['alumnos'] = $curso->obtenerAlumnos($oid_grupo, $oid_evaluacion);
        $datos['evaluacion'] = $curso->obtenerEvaluacion($oid_evaluacion);
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            foreach($dataForm as $df){
                $respuestaEval = $curso->buscarEvaluacionAlumno($oid_evaluacion, $df['oid_usuario']);# si existe una nota para ese alumno en aquila evaluación
                if($respuestaEval){
                    $curso->updateNotas($oid_evaluacion, $df['oid_usuario'], $df['nota'], $session->user_id); #actualizar nota
                }else{
                    if($df['nota'] != ""){
                        $curso->insertarNotas($oid_evaluacion, $df['oid_usuario'], $df['nota'], $session->user_id);
                    }
                }
            }
            // var_dump($dataForm);
            return;
            // print_r($data_curso);
            // unset($data_curso_temporal['orden']);
            
            // $crearCurso = new CursosModel($db);
            // $respuesta = $crearCurso->crear_curso_pizarra($data_curso_temporal);

            // if (!$respuesta == FALSE){
            //     $id = $respuesta;
            //     // $crTipo="EVAL".$data_curso['tipo'];
            //     $datos_insert = ['oid_curso'=>$data_curso['oid_curso'],'oid_objeto'=>$id,'tipo_objeto'=>'PIZARRA','orden'=>$data_curso['orden'],'oid_grupo'=>$oid_grupo];
            //     $respuesta = $crearCurso->crear_curso_ruta($datos_insert);
            //     // echo var_dump($respuesta);
            //     // return;
            //     $datos['mensaje_servidor'] = 'La evaluacion ha sido creado correctamente!';
            //     $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
            //     return view('respuestas_servidor/exito', $datos);
            // }else{
            //     $datos['mensaje_servidor'] = 'No se ha podido crear la evaluacion!';
            //     $datos['url_retorno']='cursos/curso_detalle/'.$oid_curso;
            //     return view('respuestas_servidor/error', $datos);
            // }
        }
        
        return view('cursos/add-notas-evaluacion', $datos);
    }

    public function agregarFeedback(){
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $cursosModel = new CursosModel($db);
            $archivo = $this->request->getFiles()['archivo'];
            try {
                // $tipoArchivo = explode("archivo", $da)[1];
                $path = '../uploads/feedback/';
                $zipName = $archivo->getName(); //nombre archivo zip
                $zipName = str_replace(" ", "_", $zipName);
                $zipName = md5(uniqid(rand(),1)) . "_" . $zipName;
                if($zipName != ""){
                    /* se guardan los datos de los archivos en la BD */
                    $respuestaArchivos = $cursosModel->insertFeedback($zipName, $dataForm['curso_evaluacion_alumno']);
                    if($respuestaArchivos){
                        $file = $archivo->store($path, $zipName);//se sube el archivo en writable/uploads/feedback
                        return redirect()->to(base_url('public/cursos/add_notas_evaluacion/'.$dataForm['oid_grupo_hidden']."/".$dataForm['oid_evaluacion_hidden']));
                    }else{
                        $datos['url_retorno'] = 'cursos/add_notas_evaluacion/'.$dataForm['oid_grupo_hidden']."/".$dataForm['oid_evaluacion_hidden'];
                        $datos['mensaje_servidor'] = 'No se ha podido agregar la retroalimentación';
                        return view('respuestas_servidor/exito', $datos);
                    }
                    
                }
            }catch (\Exception $e){
                /** */
            }
            return redirect()->to(base_url('public/gestionPostulantes/editar_postulacion/'.$dataForm['oid_grupo_hidden']."/".$dataForm['oid_evaluacion_hidden']));
        }
    }

    public function eliminarFeedback(){
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $cursosModel = new CursosModel($db);
            $respuesta = $cursosModel->deleteFeedback($dataForm['oid']);
            return $respuesta;
        }
    }

    public function eliminarEvaluacion(){
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $cursosModel = new CursosModel($db);
            $respuesta = $cursosModel->deleteEvaluacion($dataForm['oid_evaluacion']);
            var_dump($respuesta);
        }
    }

    public function eliminarPizarra(){
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $cursosModel = new CursosModel($db);
            $respuesta = $cursosModel->deletePizarra($dataForm['oid_evaluacion']);
            var_dump($respuesta);
        }
    }

    function descargar($nombre_documento){
        $path = getcwd().'/../writable/uploads/feedback/'.$nombre_documento;
        return $this->response->download($path, null);
    }

    function descargarRespuesta($nombre_documento){
        $path = getcwd().'/../writable/uploads/respuestas_alumnos/'.$nombre_documento;
        return $this->response->download($path, null);
    }

	public function subirRespuestaAlumno(){
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            // var_dump($dataForm);
            // return;
            $cursosModel = new CursosModel($db);
            $archivo = $this->request->getFiles()['archivo'];
            try {
                // $tipoArchivo = explode("archivo", $da)[1];
                $path = '../uploads/respuestas_alumnos/';
                $zipName = $archivo->getName(); //nombre archivo zip
                $zipName = str_replace(" ", "_", $zipName);
                $zipName = md5(uniqid(rand(),1)) . "_" . $zipName;
                if($zipName != ""){
                    /* se guardan los datos de los archivos en la BD */
                    $respuestaArchivos = $cursosModel->insertRespuesta($zipName, $dataForm['evaluacion'], $session->user_id);
                    // var_dump($respuestaArchivos, $dataForm);
                    // return;
                    // $file = $archivo->store($path, $zipName);//se sube el archivo en writable/uploads/feedback
                    // return redirect()->to(base_url('public/cursos/curso_detalle/'.$dataForm['curso_info']));
                    if($respuestaArchivos){
                        $file = $archivo->store($path, $zipName);//se sube el archivo en writable/uploads/feedback
                        return redirect()->to(base_url('public/cursos/curso_detalle/'.$dataForm['cursos_info']));
                    }else{
                        $datos['url_retorno'] = 'cursos/curso_detalle/'.$dataForm['cursos_info'];
                        $datos['mensaje_servidor'] = 'No se ha podido agregar la respuesta';
                        return view('respuestas_servidor/exito', $datos);
                    }
                    
                }
            }catch (\Exception $e){
                /** */
                var_dump($e);
                return;
            }
            return redirect()->to(base_url('public/cursos/curso_detalle/'.$dataForm['cursos_info']));
            // return redirect()->to(base_url('public/gestionPostulantes/editar_postulacion/'.$dataForm['oid_grupo_hidden']."/".$dataForm['oid_evaluacion_hidden']));
        }
    }
    /******************************************************************/
    public function testTLIiniciar($id_encuesta, $oid, $oid_curso){
        $session = session();
        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Contestar Encuesta');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $datos['oid'] = $oid;
        $datos['oid_curso'] = $oid_curso;

        $cursosModel = new CursosModel($db);

        #verificar si el alumno ya ha contestado
        $validacionAlumno = $cursosModel->getAlumnoRespuesta($oid, $session->user_id);
        if($validacionAlumno != array()){
            $datos['url_redirect'] = 'cursos/curso_detalle/'.$oid_curso;
            $datos['mensaje_servidor'] = 'No se puede ingresar, ya se ha respondido esta evaluación';
            return view('respuestas_servidor/error_params', $datos);
        }

        # agregar visita a encuesta
        $cursoRuta = $cursosModel->getCursoRuta($oid_curso, $oid, $session->user_id);
        if($cursoRuta) $cursosModel->updCursoRuta($oid_curso, $oid, $session->user_id, $cursoRuta[0]['hits'] + 1);
        else $cursosModel->addCursoRuta($oid_curso, $oid, $session->user_id);
        
        $datos['profile_data_edit'] = $cursosModel->getEncuesta($id_encuesta);
        // var_dump($datos['profile_data_edit']);
        // return;
        // $oid_test = $datos['profile_data_edit']['oid_test'];
        $oid_test = $id_encuesta;
        // var_dump($datos['profile_data_edit']);
        // return;
        $reg = $cursosModel->getReg($oid, $oid_curso, $session->user_id, $session->grupo_id);
        $findPreguntasEnc = new TestPreguntaModel($db);
        // $datos['preguntas_encuesta'] = $findPreguntasEnc->buscar_test_preguntas($oid_test);
        $preguntas_encuesta = $findPreguntasEnc->buscar_test_preguntas($oid_test);
        #--------------------------------------------------#
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $ids_preguntas = array();
            foreach($dataForm as $idf => $df){
                array_push($ids_preguntas, $idf);
            }
            $datos['preguntas_encuesta'] = array();
            foreach($preguntas_encuesta as $pre_enc){
                if(in_array($pre_enc->oid, $ids_preguntas)){
                    array_push($datos['preguntas_encuesta'], $pre_enc);
                }
            }
            $test = $cursosModel->getEncuesta2($id_encuesta);
            $test->preguntas=array();

            foreach($datos['preguntas_encuesta'] as $pregunta){
                $test->preguntas[ $pregunta->oid ]=$pregunta;
                $test->preguntas[ $pregunta->oid ]->opciones=array();

                $result2 = $cursosModel->getPreguntaOpcion($oid_test, $pregunta->oid);
                foreach($result2 as $opcion){
                    $opcion->respuesta="N";
                    $test->preguntas[ $pregunta->oid ]->opciones[ $opcion->oid ]=$opcion;
                }
            }

            $maxPuntos=0;
            $totPuntos=0;
            $respuestas="";

            $oid_rand="";
            $npreg=1;
            foreach( $datos['preguntas_encuesta'] as $kpreg=>$rpreg ){
                if( $npreg>21) break;
                $oid_rand=$oid_rand . "[" . $rpreg->oid . "]";
            }

            $lasResp=array();
            foreach($dataForm as $poid => $opc ){
                $lasResp[$poid][$opc]="S";
            }

            foreach( $test->preguntas as $poid=>$rpreg ){
                $poid+=0;
                if( mb_strpos( $oid_rand, "[$poid]" )===false ) continue;
                $corr="YY";
                $resp="XX";
                $maxPuntos++;
                $respuestas=$respuestas . "[$poid";
                foreach( $rpreg->opciones as $roid=>$ropc ){
                  if( $ropc->correcta=="S" ) $corr=$roid;
                  if( @$lasResp[$poid][$roid]=="S" ){
                    $resp=$roid+0;
                    $test->preguntas[$poid]->opciones[$roid]->respuesta="S";
                    if($test->preguntas[$poid]->opciones[$roid]->correcta=="S"){
                      if($test->preguntas[$poid]->tipo=="ALT" ){
                        $totPuntos++;
                      }
                      else{
                      }
                    }
                  }
                }
                $respuestas=$respuestas . ":$corr:$resp]";
            }
            // escala 1-7: se asume 60% de exigencia
            // $reg = $cursosModel->getReg($oid, $oid_curso, $session->user_id, $session->grupo_id);
            if( $reg->escala==0 ){
                $pCorte=$maxPuntos*0.60;
                if( $totPuntos<$pCorte )
                    $nota=3/$pCorte*$totPuntos+1.0;
                else
                    $nota=3/($maxPuntos-$pCorte)*($totPuntos-$pCorte)+4;
                $nota=round( $nota, 1 );
                if( $nota<1.0 ) $nota=1.0;
                elseif( $nota>7.0 ) $nota=7.0;
            }else{// escala 0-100, se asume 50% de exigencia
                $nota=$totPuntos*100/$maxPuntos;
                $nota=round( $nota, 0 );
            }

            $detalle = "OidTLI=$oid_test Ptos=$totPuntos MaxPuntos=$maxPuntos Nota=$nota Respuestas=$respuestas";
            $cursosModel->insertRespuestasEncuesta($oid, $session->user_id, $nota, $session->user_id, $detalle);
            return redirect()->to(base_url('public/cursos/curso_detalle/'.$oid_curso));
        }
        $preguntas_aleatorias = array_rand($preguntas_encuesta, $reg->numpregs_test);
        $datos['preguntas_encuesta'] = array();
        foreach($preguntas_aleatorias as $preg_enc=>$preg_enc2){
            array_push($datos['preguntas_encuesta'], $preguntas_encuesta[$preg_enc2]);
        }

        $datos['resultado_preguntas'] = array();
        $buscarPreguntas = new TestPreguntaOpcionModel($db);
        foreach($datos['preguntas_encuesta'] as $dp){
            array_push($datos['resultado_preguntas'], $buscarPreguntas->buscar_test_pregunta_opcion($oid_test, $dp->oid));
        }        
        return view('cursos/test_tli_iniciar', $datos);
    }
    /******************************************************************/
    /**============================================================================================
    /  Inicio Módulo Asistencia
    /  ==========================================================================================*/
    function asistencia($id_curso){
        $cursosModel = new CursosModel($db);
        $usuarioModel = new UsuarioModel($db);
        $comunidadModel = new ComunidadModel($db);

        $session = session();
        $id_comunidad = $session->grupo_id;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Asistencia');
        $datos['profile_data'] = $usuarioModel->find($session->user_id);
        $datos['profile_data_edit'] = $comunidadModel->find($id_comunidad);

        $datos['datos_horas']['horas_asignadas'] = $cursosModel->getHorasAsistenciaAsign($id_curso);
        $datos['datos_horas']['horas_actuales'] = $cursosModel->getHorasAsistenciaActual($id_curso);
        $datos['id_curso'] = $id_curso;

        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            if($dataForm['tipo'] == 'asistencia'){
                unset($dataForm['tipo']);
                $dataForm['oid_cursos'] = $id_curso;
                $respuesta = $cursosModel->insertarAsistencia($dataForm);
                if($respuesta != FALSE){
                    $datos['url_retorno'] = 'Cursos/asistencia/'.$id_curso;
                    $datos['mensaje_servidor'] = 'Se agregó la asistencia correctamente';
                    return view('respuestas_servidor/exito', $datos);
                }else{
                    $datos['url_redirect'] = 'Cursos/asistencia/'.$id_curso;
                    $datos['mensaje_servidor'] = 'No se pudo asignar la asistencia al curso';
                    return view('respuestas_servidor/error_params', $datos);
                }
            }elseif($dataForm['tipo'] == 'justificaciones'){
                unset($dataForm['tipo']);
                $respuesta = $cursosModel->insertarJustificacion($dataForm['fecha_justificacion'], $dataForm['alumno_justificacion'], $dataForm['horas_justificadas']);
                if($respuesta != FALSE){
                    $datos['url_retorno'] = 'Cursos/asistencia/'.$id_curso;
                    $datos['mensaje_servidor'] = 'Se agregó la justificación correctamente';
                    return view('respuestas_servidor/exito', $datos);
                }else{
                    $datos['url_redirect'] = 'Cursos/asistencia/'.$id_curso;
                    $datos['mensaje_servidor'] = 'No se pudo asignar la justificación';
                    return view('respuestas_servidor/error_params', $datos);
                }
            }elseif($dataForm['tipo'] == 'atrasos'){
                unset($dataForm['tipo']);
                $respuesta = $cursosModel->insertarAtraso($dataForm['fecha_atraso'], $dataForm['alumno_atraso']);
                if($respuesta != FALSE){
                    $datos['url_retorno'] = 'Cursos/asistencia/'.$id_curso;
                    $datos['mensaje_servidor'] = 'Se agregó el atraso correctamente';
                    return view('respuestas_servidor/exito', $datos);
                }else{
                    $datos['url_redirect'] = 'Cursos/asistencia/'.$id_curso;
                    $datos['mensaje_servidor'] = 'No se pudo asignar el atraso';
                    return view('respuestas_servidor/error_params', $datos);
                }
            }
        }
        $datos['alumnos'] = $cursosModel->getAlumnos($session->grupo_id);
        $datos['asistencias'] = $cursosModel->getAsistencias($id_curso);
        return view('asistencia/index', $datos);
    }

    function getfecha(){
        $cursosModel = new CursosModel($db);
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $fechas = $cursosModel->getFecha($dataForm['id_curso'], $dataForm['id_usuario']);
            $fechas2 = array();
            foreach($fechas as $fe){
                $m = $fe->asis_fecha;
                $m .= " (" . $fe->asus_horajust . "Hrs)";
                $m .= " (Just: " . $fe->asus_justificado . " Hrs)";
                $varia = ['oid' => $fe->oid, 'texto'=>$m, 'horas_j'=>$fe->asis_horas];
                array_push($fechas2, $varia);
            }
            echo json_encode($fechas2);
        }
    }

    function getFechaAtraso(){
        $cursosModel = new CursosModel($db);
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $fechas = $cursosModel->getFechaAtraso($dataForm['id_curso'], $dataForm['id_usuario']);
            $fechas2 = array();
            foreach($fechas as $fe){
                $presente = 'PRESENTE';
                $m = "";
                $m = $fe->asis_fecha;
                $m .= " (" . $fe->asis_horas . "Hrs)";
                if ($fe->asus_presente == 2) {
                    $presente = 'AUSENTE';
                }
                $m .= " " . $presente;
                $varia = ['oid' => $fe->oid, 'texto'=>$m];
                array_push($fechas2, $varia);
            }
            echo json_encode($fechas2);
        }
    }

    function get_asistencia(){
        $cursosModel = new CursosModel($db);
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $asistencia = $cursosModel->getAsistencia($dataForm['id_asistencia']);
            echo json_encode($asistencia[0]);
        }
    }

    function editar_asistencia($id_curso){
        $session = session();
        $usuarioModel = new UsuarioModel($db);
        $comunidadModel = new ComunidadModel($db);
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Asistencia');
        $datos['profile_data'] = $usuarioModel->find($session->user_id);
        $datos['profile_data_edit'] = $comunidadModel->find($session->grupo_id);
        $cursosModel = new CursosModel($db);
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $respuesta = $cursosModel->editarAsistencia($dataForm);
            if($respuesta != FALSE){
                $datos['url_retorno'] = 'Cursos/asistencia/'.$id_curso;
                $datos['mensaje_servidor'] = 'Se editó la asistencia correctamente';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['url_redirect'] = 'Cursos/asistencia/'.$id_curso;
                $datos['mensaje_servidor'] = 'No se pudo editar la asistencia';
                return view('respuestas_servidor/error_params', $datos);
            }
        }
    }

    public function eliminar_asistencia(){
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $cursosModel = new CursosModel($db);
            $respuesta = $cursosModel->deleteAsistencia($dataForm['id_asistencia']);
            return $respuesta;
        }
    }

    function asistencia_diaria($id_curso, $tipo = null, $id_asistencia = null){
        $cursosModel = new CursosModel($db);
        $usuarioModel = new UsuarioModel($db);
        $comunidadModel = new ComunidadModel($db);
        $session = session();

        $id_comunidad = $session->grupo_id;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Asistencia Diaria');
        $datos['profile_data'] = $usuarioModel->find($session->user_id);
        $datos['profile_data_edit'] = $comunidadModel->find($id_comunidad);
        $datos['id_curso'] = $id_curso;
        $datos['id_asistencia'] = $id_asistencia;

        // if (is_numeric($tipo)) {
        //     switch ($tipo) {
        //         case 1:
        //             $tipo = 'ADM';
        //             break;
        //         case 2:
        //             $tipo = 'PRO';
        //             break;
        //         case 3:
        //             $tipo = 'ALU';
        //             break;
        //     }
        // }

        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            if($dataForm['tipo'] == 'asistencia'){
                unset($dataForm['tipo']);
                $dataForm['oid_cursos'] = $id_curso;
                $respuesta = $cursosModel->insertarAsistencia($dataForm);
                if($respuesta != FALSE){
                    $datos['url_retorno'] = 'Cursos/asistencia/'.$id_curso;
                    $datos['mensaje_servidor'] = 'Se agregó la asistencia correctamente';
                    return view('respuestas_servidor/exito', $datos);
                }else{
                    $datos['url_redirect'] = 'Cursos/asistencia/'.$id_curso;
                    $datos['mensaje_servidor'] = 'No se pudo asignar la asistencia al curso';
                    return view('respuestas_servidor/error_params', $datos);
                }
            }elseif($dataForm['tipo'] == 'justificaciones'){
                unset($dataForm['tipo']);
                $respuesta = $cursosModel->insertarJustificacion($dataForm['fecha_justificacion'], $dataForm['alumno_justificacion'], $dataForm['horas_justificadas']);
                if($respuesta != FALSE){
                    $datos['url_retorno'] = 'Cursos/asistencia/'.$id_curso;
                    $datos['mensaje_servidor'] = 'Se agregó la justificación correctamente';
                    return view('respuestas_servidor/exito', $datos);
                }else{
                    $datos['url_redirect'] = 'Cursos/asistencia/'.$id_curso;
                    $datos['mensaje_servidor'] = 'No se pudo asignar la justificación';
                    return view('respuestas_servidor/error_params', $datos);
                }
            }elseif($dataForm['tipo'] == 'atrasos'){
                // unset($dataForm['tipo']);
                // $dataForm['oid_asistencia'] = $id_asistencia;
                // var_dump($dataForm);
                // return;
                $respuesta = $cursosModel->insertarAtrasoDiario($dataForm['id_asistencia'], $dataForm['oid_usuario'], $dataForm['asus_llegada'], $dataForm['asus_horajust']);
                if($respuesta != FALSE){
                    $datos['url_retorno'] = 'Cursos/asistencia/'.$id_curso;
                    $datos['mensaje_servidor'] = 'Se agregó el atraso correctamente';
                    return view('respuestas_servidor/exito', $datos);
                }else{
                    $datos['url_redirect'] = 'Cursos/asistencia/'.$id_curso;
                    $datos['mensaje_servidor'] = 'No se pudo asignar el atraso';
                    return view('respuestas_servidor/error_params', $datos);
                }
            }
        }
        $datos['alumnos'] = $cursosModel->getAlumnos($session->grupo_id, $id_asistencia);
        foreach($datos['alumnos'] as $index => $alumno){
            $asistencia = $cursosModel->getAsistenciaAlumno($id_asistencia, $datos['alumnos'][$index]->oid);  
            if($asistencia == array()){
                $datos['alumnos'][$index]->asistencia = '0';
            }else{
                $datos['alumnos'][$index]->asistencia = $asistencia[0]->asus_presente;
            }         
        }
        // var_dump($datos['alumnos']);
        // return;
        // $datos['asistencias'] = $cursosModel->getAsistencias($id_curso);
        $datos['asistencia'] = $cursosModel->getAsistencia($id_asistencia);
        return view('asistencia/asistencia_diaria', $datos);
    }

    public function add_asistencia_alumno(){
        if ($this->request->getMethod() == 'post') {
            $cursosModel = new CursosModel($db);
            $dataForm = $this->request->getPost();
            $estado = ($dataForm['estado']=='presente'?'1':'2');
            $respuesta = $cursosModel->editAsistenciaAlumno($dataForm['id_asistencia'], $dataForm['id_alumno'], $estado);
            if(!$respuesta){
                $horajust = $cursosModel->getHoraJustAsistencia($dataForm['id_asistencia']);
                $respuestaAdd = $cursosModel->addAsistenciaAlumno($dataForm['id_asistencia'], $dataForm['id_alumno'], $estado, $horajust[0]->asis_horas);
                var_dump($respuestaAdd);
                return;
            }
            var_dump($respuesta);
            // $cursosModel = new CursosModel($db);
            // $respuesta = $cursosModel->deleteAsistencia($dataForm['id_asistencia']);
            // return $respuesta;
        }
    }

    function getAlumnosAtrasos(){
        $cursosModel = new CursosModel($db);
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $datos['alumnos'] = $cursosModel->getAlumnos($session->grupo_id, $dataForm['id_asistencia']);
            foreach($datos['alumnos'] as $index => $alumno){
                $asistencia = $cursosModel->getAsistenciaAlumno($dataForm['id_asistencia'], $datos['alumnos'][$index]->oid);  
                if($asistencia == array()){
                    $datos['alumnos'][$index]->asistencia = '0';
                }else{
                    $datos['alumnos'][$index]->asistencia = $asistencia[0]->asus_presente;
                }         
            }
            echo json_encode($datos['alumnos']);
        }
    }

}

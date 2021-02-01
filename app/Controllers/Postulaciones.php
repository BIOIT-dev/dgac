<?php namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\PostulacionesModel;
use App\Models\SedeModel;

class Postulaciones extends BaseController
{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
    }
    /******************************************************************/
    /******************************************************************/
    function index(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Postulaciones');
        $datos['profile_foto_edit'] = array('foto'=>base_url().'/assets/images/users/4.jpg');

        $r_periodos = new PostulacionesModel($db);
        $datos['r_periodos'] = $r_periodos->getPeriodos();
        $datos['r_grupos'] = array();
        foreach($datos['r_periodos'] as $datosPeriodo){
            array_push($datos['r_grupos'], $r_periodos->getGrupos($datosPeriodo->oid));             
        }
        return view('postulaciones/index', $datos);
    }
    /******************************************************************/
    function usuario_nuevo(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Postulaciones a Programas Presenciales');

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();
            
            $buscar = new PostulacionesModel($db);
            $datos['resultado_busqueda'] = $buscar->getUsuario(explode("-", $data_busqueda['rut'])[0]);
            if($datos['resultado_busqueda'] != array() ){
                $datos['sedeRendicion'] = [];
                $postulacionesModel = new PostulacionesModel($db);
                $validacionCarrera = $postulacionesModel->validarCarrera($data_busqueda['grupo_id'], $datos['resultado_busqueda']['oid']);
                /* Se comprueba que no se haya postulado a la carrera elegida */
                // var_dump($validacionCarrera);
                // return;
                if($validacionCarrera->oid >= 1){
                    // $datos['mensaje_servidor'] = "Error, ya tienes una postulación en esta carrera.";
                    // $datos['url_redirect'] = 'postulaciones';
                    // return view('respuestas_servidor/error_params', $datos);
                    $datos['usuarioPostulante'] = $postulacionesModel->getUsuario(explode("-", $data_busqueda['rut'])[0]); //datos postulante
                    $datos['grupoPostulacion'] = $postulacionesModel->getGrupo($data_busqueda['grupo_id']);
                    $datos['tiposArchivo'] = $postulacionesModel->getTiposArchivo();

                    // var_dump($datos['usuarioPostulante']['oid'], $data_busqueda['grupo_id']);
                    // echo '<br><br>';
                    // $oid_postulacion = $postulacionesModel->getPostulacion($data_busqueda['grupo_id'], $datos['usuarioPostulante']['oid']);
                    $datos['data_postulacion'] = $postulacionesModel->getPostulacion($data_busqueda['grupo_id'], $datos['usuarioPostulante']['oid']);
                    // var_dump($oid_postulacion->oid);
                    // echo '<br><br>';
                    // $datos['notas_psu']['mat'] = $oid_postulacion->post_mat;
                    // $datos['notas_psu']['len'] = $oid_postulacion->post_len;
                    // $datos['notas_psu']['nem'] = $oid_postulacion->post_nem;
                    foreach($datos['tiposArchivo'] as $tipoArchivo){
                        // var_dump($oid_postulacion->oid, $tipoArchivo->oid);
                        // var_dump($postulacionesModel->getPostulacionArchivos($oid_postulacion->oid, $tipoArchivo->oid));
                        $archivo_subido = $postulacionesModel->getPostulacionArchivos($datos['data_postulacion']->oid, $tipoArchivo->oid);
                        if($archivo_subido != array())
                            $tipoArchivo->archivo_data = $archivo_subido[0]->name;
                        else
                            $tipoArchivo->archivo_data = 'NULL';
                        // echo '<br><br>';
                        // var_dump($tipoArchivo);
                        // echo '<br><br>';
                    }
                    // var_dump($datos['tiposArchivo']);
                    // return;
                    $buscarSedes = new PostulacionesModel($db);
                    $datos['sedes_rendicion'] = $buscarSedes->getSedes($datos['grupoPostulacion']['oid_periodos']);
                    // var_dump($datos['resultado_busqueda']);
                    // return;
                    return view('postulaciones/actualizar', $datos);
                }
                $cantCarreras = $postulacionesModel->getCantCarreras($data_busqueda['grupo_id']); //cantidad de carreras a postular por usuario en el periodo
                $datos['usuarioPostulante'] = $postulacionesModel->getUsuario(explode("-", $data_busqueda['rut'])[0]); //datos postulante
                $periodo = $postulacionesModel->getPeriodoGrupo($data_busqueda['grupo_id']); // oid del periodo de la postulación
                $cantPostulaciones = $postulacionesModel->getCantPostulaciones($datos['usuarioPostulante']['oid'], $periodo->oid);//cantidad de postulaciones del usuario en el periodo
                /* Se comprueba que no se haya postulado más veces de las permitidas en un periodo */
                if($cantPostulaciones->oid >= $cantCarreras->peri_carreras_postular){
                    $datos['mensaje_servidor'] = "Error, has postulado a suficiente carreras por éste periodo";
                    $datos['url_redirect'] = 'postulaciones';
                    return view('respuestas_servidor/error_params', $datos);
                }
                
                $datos['grupoPostulacion'] = $postulacionesModel->getGrupo($data_busqueda['grupo_id']);
                $datos['tiposArchivo'] = $postulacionesModel->getTiposArchivo();
                $buscarSedes = new PostulacionesModel($db);
                $datos['sedes_rendicion'] = $buscarSedes->getSedes($datos['grupoPostulacion']['oid_periodos']);
                return view('postulaciones/usuario', $datos);
            }else{
                $datos['rut_usuario'] = $data_busqueda['rut'];
                $datos['grupo_id'] = $data_busqueda['grupo_id'];
                $buscarSedes = new PostulacionesModel($db);
                $datos['grupoPostulacion'] = $buscarSedes->getGrupo($data_busqueda['grupo_id']);
                $datos['sedes_rendicion'] = $buscarSedes->getSedes($datos['grupoPostulacion']['oid_periodos']);
                return view('postulaciones/usuario_nuevo', $datos);
            }
        }
    }
    /******************************************************************/
    function crear_usuario(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Postulaciones a Programas Presenciales');

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();
            $datos['sedeRendicion'] = $data_busqueda['oid_sedes'];
            unset($data_busqueda['oid_sedes']);
            $oidGrupo = $data_busqueda['grupo_id'];
            unset($data_busqueda['grupo_id']);
            $data_busqueda["userid"] = explode("-", $data_busqueda['rut'])[0];
            $data_busqueda["clave"] = md5(strtolower(explode(" ", $data_busqueda['nombres'])[0]));
            $data_busqueda["apellidos"] = $data_busqueda['apellido_paterno']." ".$data_busqueda['apellido_materno'];
            $data_busqueda['quien_soy'] = 'Un postulante';
            /* Creación del Usuario */
            $postulacionesModel = new PostulacionesModel($db);
            /*************************************************************************/
            $res_crearUsuario = $postulacionesModel->crearUsuario($data_busqueda);
            if(!$res_crearUsuario) { 
                $datos['mensaje_servidor'] = "Error, reintentar la solicitud";
                return view('respuestas_servidor/error_postulacion', $datos);
                return "ERROR, NO SE PUDO CREAR USUARIO";  
            }
            
            /* Envio correo de confirmación de creación de usuario */
            $mensaje = '<h1>El usuario fue registrado correctamente</h1>';
            $mensaje .= '<p>Sus credenciales para ingresar a la plataforma son:</p>';
            $mensaje .= '<p>Usuario: '.$data_busqueda["userid"].'</p>';
            $mensaje .= '<p>Contraseña: '.strtolower(explode(" ", $data_busqueda['nombres'])[0]).'</p>';
            $this->enviarEmail($data_busqueda["email"], 'Registro plataforma postulación DGAC', $mensaje);
            /*************************************************************************/
            $datos['usuarioPostulante'] = $postulacionesModel->getUsuario(explode("-", $data_busqueda['rut'])[0]);
            // $db = \Config\Database::connect();
            // $new_data = array(
            //     'oid_usuario' => $datos['usuarioPostulante']['oid'],
            //     'oid_grupo' => 1,
            //     'rol' => 'ALU',
            //     'oid_tutor' => 0,
            //     'conexiones' => 0,
            //     'hits_click' => 0,
            //     'hits_download' => 0,
            //     'hits_post' => 0,
            //     'hits_scorm' => 0
            // );
            // $db->table('usuario_grupo')->insert($new_data);
            $datos['grupoPostulacion'] = $postulacionesModel->getGrupo($oidGrupo);
            $datos['tiposArchivo'] = $postulacionesModel->getTiposArchivo();
            $buscarSedes = new SedeModel($db);
            $datos['sedes_rendicion'] = $buscarSedes->getSedes();
            return view('postulaciones/usuario', $datos);
        }
    }
    /******************************************************************/
    function finalizar(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Postulaciones a Programas Presenciales');

        $postulacionesModel = new PostulacionesModel($db);
        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();
            $datos_archivos = $this->request->getFiles();
            /* EXTRAE LA INFORMACIÓN DEL USUARIO PARA ACTUALIZAR */
            $datosPostulante = [
                'rut'=>$data_busqueda['rut'],
                'nombres'=>$data_busqueda['nombres'],
                'apellido_paterno'=>$data_busqueda['apellido_paterno'],
                'apellido_materno'=>$data_busqueda['apellido_materno'],
                'apellidos'=>$data_busqueda['apellido_paterno'].' '.$data_busqueda['apellido_materno'],
                'sexo'=>$data_busqueda['sexo'],
                'fecnac'=>$data_busqueda['fecnac'],
                'ciudad'=>$data_busqueda['ciudad'],
                'comuna'=>$data_busqueda['comuna'],
                'direccion'=>$data_busqueda['direccion'],
                'fono'=>$data_busqueda['fono'],
                'email'=>$data_busqueda['email']
            ];
            /* ACTUALIZAR INFORMACIÓN DEL USUARIO */
            $respuestaIDUsuario = $postulacionesModel->getIdUsuario(explode("-", $data_busqueda['rut'])[0])[0];
            $respuestaUpdateUsuario = $postulacionesModel->updateUsuario($respuestaIDUsuario->oid, $datosPostulante);
            /* ELIMINA DATOS INECESARIOS PARA LA POSTULACIÓN */
            unset(  $data_busqueda['rut'],$data_busqueda['nombres'],$data_busqueda['apellido_paterno'],$data_busqueda['apellido_materno'],$data_busqueda['sexo'],
                    $data_busqueda['fecnac'],$data_busqueda['ciudad'],$data_busqueda['comuna'],$data_busqueda['direccion'],$data_busqueda['fono'],$data_busqueda['email']);
            /* AGREGAR DATOS QUE FALTAN */
            $data_busqueda["oid_usuario"] = $respuestaIDUsuario->oid;
            $data_busqueda["post_fecha"] = date("Y-m-d");
            /* INGRESA LA POSTULACIÓN A LA BASE DE DATOS */
            $respuestaPostulacion = $postulacionesModel->insertPostulacion($data_busqueda);
            /* se suben los archivos a uploads y a la BD */
            foreach($datos_archivos as $da => $objetoArchivo){
                try {
                    $tipoArchivo = explode("archivo", $da)[1];
                    $path = '../uploads/postulaciones/'.$respuestaPostulacion.'/'.$tipoArchivo.'/';
                    $zipName = $objetoArchivo->getName(); //nombre archivo zip
                    $zipName = str_replace(" ", "_", $zipName);
                    if($zipName != ""){
                        /* se guardan los datos de los archivos en la BD */
                        $respuestaArchivos = $postulacionesModel->insertPostulacionArchivo($respuestaPostulacion, $tipoArchivo, $objetoArchivo);
                        $file = $objetoArchivo->store($path, $zipName);//se sube el archivo .zip en writable/uploads/postulaciones
                        
                    }
                }catch (\Exception $e){
                    /** */
                }
            }
            /* Envio correo de confirmación de postulación */
            $mensaje = '<h1>Su postulación fue ingresada correctamente</h1>';
            $mensaje .= '<p>Felicitaciones '.$datosPostulante['nombres'].', se ha ingresado de forma exitosa su postulación a la carrera *NombreCarrera*</p>';
            $this->enviarEmail($datosPostulante["email"], 'Postulación carrera *Ingresar Carrera* DGAC', $mensaje);
            return $respuestaPostulacion;
        }
    }
    /******************************************************************/
    function actualizar($id_postulacion){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Postulaciones a Programas Presenciales');

        $postulacionesModel = new PostulacionesModel($db);
        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();
            $datos_archivos = $this->request->getFiles();
            /* EXTRAE LA INFORMACIÓN DEL USUARIO PARA ACTUALIZAR */
            $datosPostulante = [
                'rut'=>$data_busqueda['rut'],
                'nombres'=>$data_busqueda['nombres'],
                'apellido_paterno'=>$data_busqueda['apellido_paterno'],
                'apellido_materno'=>$data_busqueda['apellido_materno'],
                'apellidos'=>$data_busqueda['apellido_paterno'].' '.$data_busqueda['apellido_materno'],
                'sexo'=>$data_busqueda['sexo'],
                'fecnac'=>$data_busqueda['fecnac'],
                'ciudad'=>$data_busqueda['ciudad'],
                'comuna'=>$data_busqueda['comuna'],
                'direccion'=>$data_busqueda['direccion'],
                'fono'=>$data_busqueda['fono'],
                'email'=>$data_busqueda['email']
            ];
            /* ACTUALIZAR INFORMACIÓN DEL USUARIO */
            $respuestaIDUsuario = $postulacionesModel->getIdUsuario(explode("-", $data_busqueda['rut'])[0])[0];
            $respuestaUpdateUsuario = $postulacionesModel->updateUsuario($respuestaIDUsuario->oid, $datosPostulante);
            /* ELIMINA DATOS INECESARIOS PARA LA POSTULACIÓN */
            unset(  $data_busqueda['rut'],$data_busqueda['nombres'],$data_busqueda['apellido_paterno'],$data_busqueda['apellido_materno'],$data_busqueda['sexo'],
                    $data_busqueda['fecnac'],$data_busqueda['ciudad'],$data_busqueda['comuna'],$data_busqueda['direccion'],$data_busqueda['fono'],$data_busqueda['email']);
            /* AGREGAR DATOS QUE FALTAN */
            $data_busqueda["oid_usuario"] = $respuestaIDUsuario->oid;
            $data_busqueda["post_fecha"] = date("Y-m-d");
            /* INGRESA LA POSTULACIÓN A LA BASE DE DATOS */
            $respuestaPostulacion = $postulacionesModel->updatePostulacion($id_postulacion, $data_busqueda);
            /* se suben los archivos a uploads y a la BD */
            $kekeke = array();
            foreach($datos_archivos as $da => $objetoArchivo){
                try {
                    $tipoArchivo = explode("archivo", $da)[1];
                    $path = '../uploads/postulaciones/'.$respuestaPostulacion.'/'.$tipoArchivo.'/';
                    $zipName = $objetoArchivo->getName(); //nombre archivo zip
                    $zipName = str_replace(" ", "_", $zipName);
                    if($zipName != ""){
                        $archivo_subido = $postulacionesModel->getPostulacionArchivos($id_postulacion, $tipoArchivo);
                        if($archivo_subido != array()){
                            $postulacionesModel->deletePostulacionArchivo($archivo_subido[0]->oid);
                        }
                        /* se guardan los datos de los archivos en la BD */
                        $respuestaArchivos = $postulacionesModel->insertPostulacionArchivo($id_postulacion, $tipoArchivo, $objetoArchivo);
                        $file = $objetoArchivo->store($path, $zipName);//se sube el archivo .zip en writable/uploads/postulaciones
                        
                    }
                }catch (\Exception $e){
                    /** */
                }
            }
            /* Envio correo de confirmación de postulación */
            $mensaje = '<h1>Su postulación fue actualizada correctamente</h1>';
            $mensaje .= '<p>Felicitaciones '.$datosPostulante['nombres'].', se ha ingresado de forma exitosa su postulación a la carrera *NombreCarrera*</p>';
            $this->enviarEmail($datosPostulante["email"], 'Postulación carrera *Ingresar Carrera* DGAC', $mensaje);
            return $respuestaPostulacion;
        }
    }
    /******************************************************************/
    function usuario(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Postulaciones a Programas Presenciales');

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();
            $buscar = new PostulacionesModel($db);
            $datos['resultado_busqueda'] = $buscar->getUsuario(explode("-", $data_busqueda['rut'])[0]);
            if($datos['resultado_busqueda'] != array() ){
                var_dump($datos['resultado_busqueda']);
            }else{
                $datos['rut_usuario'] = $data_busqueda['rut'];
                $buscarSedes = new SedeModel($db);
                $datos['sedes_rendicion'] = $buscarSedes->getSedes();
                return view('postulaciones/usuario_nuevo', $datos);
            }
        }
    }
    /******************************************************************/
    function actualUser(){
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find(1);
        return $findUsuario;
    }

    public function enviarEmail($destinatario, $asunto, $mensaje){
        $email = \Config\Services::email();

        $email->setFrom('lucia.martinez.7420@outlook.com', 'Dirección General de Aeronáutica Civil');
        $email->setTo($destinatario);
        $email->attach(base_url().'/assets/images/users/5.jpg');
        // $email->setCC('consultora.bioit@gmail.com');

        $email->setSubject($asunto);
        $email->setMessage($mensaje);

        $email->send();
     }

     public function enviarEmailTest(){
        $email = \Config\Services::email();

        $email->setFrom('contacto@araucaniaverde.cl', 'Dirección General de Aeronáutica Civil');
        $email->setTo('ing.omar.orozco@gmail.com');
        // $email->setCC('consultora.bioit@gmail.com');

        $email->setSubject("mensaje prueba dgac");
        $email->setMessage("mensaje de prueba dgac 1");

        $email->send();
     }

}

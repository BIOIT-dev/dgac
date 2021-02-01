<?php namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\ScormModel;
use ZipArchive;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class Scorm extends BaseController{
    public $usuarioActual;
    public $profile_foto;
    public $path_scorm;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
        helper('bread');

        $this->path_scorm = 'scorm/';
    }
    /******************************************************************/
    function buscar(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Buscar Scorm');
        $scormModel = new ScormModel($db);
        $datos['r_grupos'] = $scormModel->obtenerComunidadesActivas();

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();
            $datos['resultado_busqueda'] = $scormModel->obtenerScorms($data_busqueda);
            return view('scorm/listado-scorm', $datos);
        }
        return view('scorm/buscar-scorm', $datos);
    }
    /******************************************************************/
	/******************************************************************/
    function agregar(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar Scorm');
        $scormModel = new ScormModel($db);
        $datos['r_grupos'] = $scormModel->obtenerComunidadesActivas();

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();
            $archivo = $this->request->getFiles()['archivo'];
            $path = $this->path_scorm;
            $dirname = md5(uniqid(rand(),1));
            $zipName = $archivo->getName(); //nombre archivo zip
            $file = $archivo->store($path.$dirname, $zipName);//se sube el archivo .zip en writable/uploads/scorm
            /* si se recibe is_scorm desde el formulario */
            if(isset($data_busqueda['is_scorm'])){
                if($data_busqueda['is_scorm'] == 'on')
                    $data_busqueda['is_scorm'] = '1';
                $esScorm = $data_busqueda['is_scorm'];
            }else{
                $data_busqueda['is_scorm'] = '0';
                $esScorm = FALSE;
            }
            /* se extrae el contenido del .zip en ../assets/uploads/scorm */
            $message = $this->unzipSco( $zipName, $path, $dirname, $esScorm );
            if($message == "OK"){/* si todo sale bien en la descompresión, se inserta en la base de datos */
                $data_busqueda['dirname'] = $dirname;
                $data_busqueda["fecha"] = date("Y-m-d H:i:s");
                $respuesta = $scormModel->insertScorm($data_busqueda);
                return redirect()->to(base_url('public/scorm/buscar'));
            }else{/* sino se eliminan los directorios y envía ventana de error */
                $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Error Scorm');
                $datos['mensaje_servidor'] = $message;
                $datos['url_redirect'] = 'scorm/agregar';
                $this->deleteDirScorm(getcwd().'/../assets/uploads/'.$path.$dirname);
                $this->deleteDirScorm(getcwd().'/../writable/uploads/'.$path.$dirname);
                return view('respuestas_servidor/error_params', $datos);
            }
        }
        return view('scorm/agregar-scorm', $datos);
    }
    /* función que extrae el contenido del scorm en la carpeta ../assets */
    function unzipSco( $zipName, $path, $dirname, $is_scorm ){
        $tmp = getcwd().'/../assets/uploads/'.$path.$dirname;
        $zip = new ZipArchive;
        if($zip->open(getcwd().'/../writable/uploads/'.$path.$dirname."/".$zipName) === TRUE){
            $zip->extractTo($tmp);
            $zip->close(); 
        }else{
            return "Error al leer ZIP";
        }      
        // es SCORM, debemos encontrar y validar el imsmanifest.xml
        if( $is_scorm && !@is_file( $tmp."/imsmanifest.xml" ))
            return "Error, no se encuentra manifest.xml";
        //eso es todo
        return "OK";
      }
      /* elimina el directorio de forma recursiva */
      function deleteDirScorm($dir){
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) {
            if ($file->isDir()){
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        rmdir($dir);
      }
      /* vacía el directorio de forma recursiva */
      function cleanDirScorm($dir){
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) {
            if ($file->isDir()){
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
      }
    /******************************************************************/
    /******************************************************************/
    function editar($id_scorm){
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Objeto de Aprendizaje');
        $datos['profile_data'] = $this->usuarioActual;
        $scormModel = new ScormModel($db);
        $datos['r_scorm'] = $scormModel->getScorm($id_scorm);

        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $archivo = $this->request->getFiles();

            if($archivo == array() or $archivo['archivo'] == "" ){
                $respuesta = $scormModel->editScorm($dataForm);/* se actualizan los datos en la bd */
                $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Error Scorm');
                $datos['mensaje_servidor'] = "Elemento editado correctamente";
                $datos['url_redirect'] = 'scorm/buscar';
                return view('respuestas_servidor/exito_params', $datos);
            }else{
                $archivo = $this->request->getFiles()['archivo'];
                $dirname = $datos['r_scorm']->dirname;
                $path = $this->path_scorm;
                $zipName = $archivo->getName(); //nombre archivo zip
                /* se renombran carpetas temporales _copy como backup */
                rename(getcwd().'/../assets/uploads/'.$path.$dirname, getcwd().'/../assets/uploads/'.$path.$dirname.'_copy');
                rename(getcwd().'/../writable/uploads/'.$path.$dirname, getcwd().'/../writable/uploads/'.$path.$dirname.'_copy');
                $file = $archivo->store($path.$dirname, $zipName);//se sube el archivo .zip en writable/uploads/scorm
                $message = $this->unzipSco( $zipName, $path, $dirname, $datos['r_scorm']->is_scorm );

                if($message == "OK"){/* si todo sale bien en la descompresión, se inserta en la base de datos */
                    $respuesta = $scormModel->editScorm($dataForm);/* se actualizan los datos en la bd */
                    /* se eliminan las carpetas backup */
                    $this->deleteDirScorm(getcwd().'/../assets/uploads/'.$path.$dirname.'_copy');
                    $this->deleteDirScorm(getcwd().'/../writable/uploads/'.$path.$dirname.'_copy');
                    $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Error Scorm');
                    $datos['mensaje_servidor'] = "Elemento editado correctamente";
                    $datos['url_redirect'] = 'scorm/buscar';
                    return view('respuestas_servidor/exito_params', $datos);
                }else{/* sino se dejan como antes los directorios y envía ventana de error */
                    $this->deleteDirScorm(getcwd().'/../assets/uploads/'.$path.$dirname);
                    $this->deleteDirScorm(getcwd().'/../writable/uploads/'.$path.$dirname);
                    rename(getcwd().'/../assets/uploads/'.$path.$dirname.'_copy', getcwd().'/../assets/uploads/'.$path.$dirname);
                    rename(getcwd().'/../writable/uploads/'.$path.$dirname.'_copy', getcwd().'/../writable/uploads/'.$path.$dirname);
                    $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Error Scorm');
                    $datos['mensaje_servidor'] = $message;
                    $datos['url_redirect'] = 'scorm/editar/'.$datos['r_scorm']->oid;
                    return view('respuestas_servidor/error_params', $datos);
                }
            }
        }
        return view('scorm/editar-scorm', $datos);
    }
    /******************************************************************/
    /******************************************************************/
    function eliminar(){
        if ($this->request->getMethod() == 'post') {
            $scorm_recibidos = $this->request->getPost();
            $scormModel = new ScormModel($db);
            foreach ($scorm_recibidos as $id_scorm){
                $actual_scorm = $scormModel->getScorm($id_scorm);
                $dirname = $actual_scorm->dirname;
                $path = $this->path_scorm;
                $respuesta = $scormModel->deleteScorm($id_scorm);

                if($respuesta){
                    $this->deleteDirScorm(getcwd().'/../assets/uploads/'.$path.$dirname);
                    $this->deleteDirScorm(getcwd().'/../writable/uploads/'.$path.$dirname);
                }
            }
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

<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ComunidadModel;
use App\Models\CarreraModel;
use App\Models\DocumentoModel;

class Documento extends BaseController
{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
    }
    /******************************************************************/
    /******************************************************************/
	public function index()
	{
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Gestionar Documentos');
		return view('documento/index-documento', $datos);
	}
    /******************************************************************/
	public function crear()
	{
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar Documento');

        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            if($dataForm['tiar_obligatorio'] == 'on') $dataForm['tiar_obligatorio'] = '1';
            else $dataForm['tiar_obligatorio'] = '0';
            $crearElemento = new DocumentoModel($db);
            $respuesta = $crearElemento->crear($dataForm);

            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'profile/administracion';
                $datos['mensaje_servidor'] = 'El documento ha sido creado correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el documento!';
                return view('respuestas_servidor/error', $datos);
            }
        }
		return view('documento/agregar-documento', $datos);
	}
    /******************************************************************/
    /******************************************************************/
    function eliminar(){
        if ($this->request->getMethod() == 'post') {
            $documentos_recibidos = $this->request->getPost();
            $eliminar = new DocumentoModel($db);

            foreach ($documentos_recibidos as $id_documento){
                $respuesta = $eliminar->eliminar($id_documento);
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

        return view('documento/buscar-documento', $datos);
    }
    /******************************************************************/
    function editar($id_documento){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Documento');

        $findEdit = new DocumentoModel($db);
        $findEdit = $findEdit->find($id_documento);
        $datos['profile_data_edit'] = $findEdit;
        $datos['profile_foto_edit'] = array('foto'=>base_url().'/assets/images/users/4.jpg');

        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            if($dataForm['tiar_obligatorio'] == 'on') $dataForm['tiar_obligatorio'] = '1';
            else $dataForm['tiar_obligatorio'] = '0';
            if($dataForm['vige_cod'] == 'on') $dataForm['vige_cod'] = '0';
            else $dataForm['vige_cod'] = '1';
            $editar = new DocumentoModel($db);
            $respuesta = $editar->editar($dataForm);

            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'profile/administracion';
                $datos['mensaje_servidor'] = 'El documento se editó correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar el documento!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        return view('documento/editar-documento', $datos);
    }
    /******************************************************************/
    /******************************************************************/
    /******************************************************************/
    function actualUser(){
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find(1);
        return $findUsuario;
    }

}

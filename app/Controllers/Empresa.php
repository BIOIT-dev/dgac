<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\EmpresaModel;

class Empresa extends BaseController
{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
    }
    /******************************************************************/
	public function crear_empresa()
	{
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Crear Empresa');

        if ($this->request->getMethod() == 'post') {
            $data_empresa = $this->request->getPost();

            $crearEmpresa = new EmpresaModel($db);
            $respuesta = $crearEmpresa->crear_empresa($data_empresa);

            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'profile/administracion';
                $datos['mensaje_servidor'] = 'La empresa ha sido creado correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear la empresa!';
                return view('respuestas_servidor/error', $datos);
            }
        }
		return view('empresa/crear-empresa', $datos);
	}
    /******************************************************************/
    /******************************************************************/
    function eliminar_empresa(){
        if ($this->request->getMethod() == 'post') {
            $empresas_recibidas = $this->request->getPost();
            $eliminarEmpresa = new EmpresaModel($db);

            foreach ($empresas_recibidas as $id_empresa){
                $respuesta = $eliminarEmpresa->eliminar_empresa($id_empresa);
                var_dump($respuesta);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function buscar_empresa(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Buscar Empresa');

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();
            $buscarEmpresa = new EmpresaModel($db);
            $datos['resultado_busqueda'] = $buscarEmpresa->buscar_empresa($data_busqueda);
            
            return view('empresa/listado-empresa', $datos);
        }

        // $findComunidades = new ComunidadModel($db);
        // $query = $findComunidades->obtenerComunidades();
        // $datos['query'] = $query;

        return view('empresa/buscar-empresa', $datos);
    }
    /******************************************************************/
    function editar($id_usuario){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Empresa');

        $findEmpresa_edit = new EmpresaModel($db);
        $findEmpresa_edit = $findEmpresa_edit->find($id_usuario);
        $datos['profile_data_edit'] = $findEmpresa_edit;
        $datos['profile_foto_edit'] = array('foto'=>base_url().'/assets/images/users/4.jpg');

        if ($this->request->getMethod() == 'post') {
            $data_empresa = $this->request->getPost();
            
            $editarEmpresa = new EmpresaModel($db);
            $respuesta = $editarEmpresa->editar_empresa($data_empresa);

            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'profile/administracion';
                $datos['mensaje_servidor'] = 'La empresa se editó correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar la empresa!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        return view('empresa/editar-empresa', $datos);
    }
    /******************************************************************/
    /******************************************************************/
    function actualUser(){
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find(1);
        return $findUsuario;
    }
}

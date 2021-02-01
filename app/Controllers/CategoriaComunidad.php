<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ComunidadModel;
use App\Models\CarreraModel;
use App\Models\CategoriaComunidadModel;

class CategoriaComunidad extends BaseController
{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
    }
    /******************************************************************/
    /******************************************************************/
	public function index_categoria_comunidad()
	{
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Gestionar CategoriaComunidads');
		return view('categoria_comunidad/index-categoria_comunidad', $datos);
	}
    /******************************************************************/
	public function crear()
	{
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar Categoria de Comunidad');

        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();

            $crearCategoriaComunidad = new CategoriaComunidadModel($db);
            $respuesta = $crearCategoriaComunidad->crear_categoria_comunidad($data_post);

            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'profile/administracion';
                $datos['mensaje_servidor'] = 'La categoria de comunidad ha sido creada correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear la categoria de comunidad!';
                return view('respuestas_servidor/error', $datos);
            }
        }
		return view('categoria_comunidad/agregar-categoria_comunidad', $datos);
	}
    /******************************************************************/
    /******************************************************************/
    function eliminar(){
        if ($this->request->getMethod() == 'post') {
            $categoria_comunidads_recibidas = $this->request->getPost();
            $eliminarCategoriaComunidad = new CategoriaComunidadModel($db);

            foreach ($categoria_comunidads_recibidas as $id_categoria_comunidad){
                $respuesta = $eliminarCategoriaComunidad->eliminar_categoria_comunidad($id_categoria_comunidad);
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
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Buscar Categoria de Comunidad');

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();

            $buscarCategoriaComunidad = new CategoriaComunidadModel($db);
            $datos['resultado_busqueda'] = $buscarCategoriaComunidad->buscar_categoria_comunidad($data_busqueda);
            // var_dump($datos['resultado_busqueda']);
            // return $datos['resultado_busqueda'];
            return view('categoria_comunidad/listado-categoria_comunidad', $datos);
        }

        return view('categoria_comunidad/buscar-categoria_comunidad', $datos);
    }
    /******************************************************************/
    function editar($id_categoria_comunidad){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Categoria de Comunidad');

        $findCategoriaComunidad_edit = new CategoriaComunidadModel($db);
        $findCategoriaComunidad_edit = $findCategoriaComunidad_edit->find($id_categoria_comunidad);
        $datos['profile_data_edit'] = $findCategoriaComunidad_edit;
        $datos['profile_foto_edit'] = array('foto'=>base_url().'/assets/images/users/4.jpg');

        if ($this->request->getMethod() == 'post') {
            $data_categoria_comunidad = $this->request->getPost();
            
            $editarCategoriaComunidad = new CategoriaComunidadModel($db);
            $respuesta = $editarCategoriaComunidad->editar_categoria_comunidad($data_categoria_comunidad);

            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'profile/administracion';
                $datos['mensaje_servidor'] = 'La categoria de comunidad se editó correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar la categoria de comunidad!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        return view('categoria_comunidad/editar-categoria_comunidad', $datos);
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

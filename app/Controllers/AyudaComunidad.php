<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ComunidadModel;
use App\Models\CarreraModel;
use App\Models\AyudaComunidadModel;

class AyudaComunidad extends BaseController
{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
    }
    /******************************************************************/
    /******************************************************************/
    function buscar(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Buscar Ayuda de Comunidad');

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();

            $buscarDatos = new AyudaComunidadModel($db);
            $datos['resultado_busqueda'] = $buscarDatos->buscar($data_busqueda);
            
            return view('ayuda_comunidad/listado-ayuda_comunidad', $datos);
        }

        return view('ayuda_comunidad/buscar-ayuda_comunidad', $datos);
    }
    /******************************************************************/
    function editar($id_comunidad){
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Ayuda de Comunidad');
        $datos['profile_data'] = $this->usuarioActual;

        $findComunidad_edit = new ComunidadModel($db);
        $findComunidad_edit = $findComunidad_edit->find($id_comunidad);
        $datos['profile_data_edit'] = $findComunidad_edit;

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
        return view('ayuda_comunidad/editar-ayuda_comunidad', $datos);
    }
    /******************************************************************/
    /******************************************************************/
    function actualUser(){
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find(1);
        return $findUsuario;
    }

}

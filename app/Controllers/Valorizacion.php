<?php namespace App\Controllers;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ValorizacionModel;

class Valorizacion extends BaseController{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
    }
    /******************************************************************/
	public function index(){
        $datos['profile_foto'] = $this->profile_foto;
        $datos['profile_data'] = $this->usuarioActual;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Valorización Horas Docente');
        $sueldoBase = new ValorizacionModel($db);
        $datos['sueldobase'] = $sueldoBase->getSueldobase()->sueldobase;
        $datos['asignacion'] = $sueldoBase->getAsignacion()->sueldobase;
		return view('valorizacion_horas/agregar-valorizacion', $datos);
    }
    /******************************************************************/
    public function editar(){
        $datos['profile_foto'] = $this->profile_foto;
        $datos['profile_data'] = $this->usuarioActual;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Valorización Horas Docente');
        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $editarsueldoBase = new ValorizacionModel($db);
            $respuesta = $editarsueldoBase->editarSueldobase($data_post);
            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/valorizacion/index/'));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el periodo!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $sueldoBase = new ValorizacionModel($db);
        $datos['sueldobase'] = $sueldoBase->getSueldobase()->sueldobase;
		return view('valorizacion_horas/actualizar-sueldobase', $datos);
    }

    public function editar_asignacion(){
        $datos['profile_foto'] = $this->profile_foto;
        $datos['profile_data'] = $this->usuarioActual;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Valorización Horas Docente');
        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $editarsueldoBase = new ValorizacionModel($db);
            $respuesta = $editarsueldoBase->editarAsignacion($data_post);
            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/valorizacion/index/'));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el periodo!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $sueldoBase = new ValorizacionModel($db);
        $datos['asignacion'] = $sueldoBase->getAsignacion()->sueldobase;
		return view('valorizacion_horas/actualizar-asignacion', $datos);
    }
    /******************************************************************/
    function actualUser(){
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find(1);
        return $findUsuario;
    }
}

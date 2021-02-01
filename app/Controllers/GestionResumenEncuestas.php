<?php namespace App\Controllers;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ComunidadModel;
use App\Models\GestionResumenEncuestasModel;
use App\Models\PeriodoModel;

class GestionResumenEncuestas extends BaseController
{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
    }
    /******************************************************************/
	public function index($estado_habilitar){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar nuevo Resumen de Encuestas');
        
        ($estado_habilitar == '1' ? $datos['estado_habilitar'] = 1 : $datos['estado_habilitar'] = 0);

        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            // var_dump($data_post);
            // return;
            $crear = new GestionResumenEncuestasModel($db);
            $respuesta = $crear->crear_resumen_enc($data_post);

            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/gestionResumenEncuestas/index/0'));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el periodo!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        // $datos['estado_habilitar'] = ($estado_habilitar == '1' ? $estado_habilitar = TRUE : $estado_habilitar = FALSE);

        $gestionEncuestas = new GestionResumenEncuestasModel($db);
        $datos['r_comunidad'] = $gestionEncuestas->getComunidades($estado_habilitar);
        $datos['r_carrera'] = $gestionEncuestas->getCarrerasAll();
        $datos['resultado_busqueda'] = $gestionEncuestas->getResumenEncuestas();
        // var_dump($datos['r_comunidad']);
        // return;

		return view('gestion_resumen_encuestas/index-gest-res-encuestas', $datos);
    }
    /******************************************************************/
    public function obtenercarreras(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Periodo');
        if ($this->request->isAJAX()){
            $dataGet = $this->request->getGet();
            $gestionEncuestas = new GestionResumenEncuestasModel($db);
            $r_carreras = $gestionEncuestas->getCarreras($dataGet['idcomunidad']);
            return json_encode($r_carreras);
        }
    }
    /******************************************************************/
    public function obtenersemestres(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Periodo');
        if ($this->request->isAJAX()){
            $dataGet = $this->request->getGet();
            $gestionEncuestas = new GestionResumenEncuestasModel($db);
            $r_semestres = $gestionEncuestas->getSemestres($dataGet['idcarrera']);
            return json_encode($r_semestres);
        }
    }
    /******************************************************************/
    public function obtenerasignaturas(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Periodo');
        if ($this->request->isAJAX()){
            $dataGet = $this->request->getGet();
            $gestionEncuestas = new GestionResumenEncuestasModel($db);
            $r_asignaturas = $gestionEncuestas->getAsignaturas($dataGet['semestres'], $dataGet['idcarrera'], $dataGet['estado_habilitar']);
            return json_encode($r_asignaturas);
        }
    }
    /******************************************************************/
    public function obtenerprofesores(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Periodo');
        if ($this->request->isAJAX()){
            $dataGet = $this->request->getGet();
            $gestionEncuestas = new GestionResumenEncuestasModel($db);
            $r_profesores = $gestionEncuestas->getProfesores($dataGet['idcomunidad']);
            return json_encode($r_profesores);
        }
    }
    /******************************************************************/
    /******************************************************************/
     function eliminar(){
        if ($this->request->getMethod() == 'post') {
            $data_post = $this->request->getPost();
            $eliminar = new GestionResumenEncuestasModel($db);
            foreach ($data_post as $id_resumen_enc){
                $eliminar->eliminar_resumen($id_resumen_enc);
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
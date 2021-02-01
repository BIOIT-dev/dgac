<?php namespace App\Controllers;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\CarreraModel;
use App\Models\IndicadoresCarrerasModel;

class IndicadoresCarreras extends BaseController
{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
    }
    /******************************************************************/
	public function index(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Listado de Carreras');
        $buscar = new IndicadoresCarrerasModel($db);
        $datos['resultado_busqueda'] = $buscar->getIndicadoresCarreras();
        return view('indicadores_carrera/listado-ind-carrera', $datos);
	}
    /******************************************************************/
	public function crear(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Crear Nuevo Registro de Carrera');

        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $crearElemento = new IndicadoresCarrerasModel($db);
            $respuesta = $crearElemento->crear($dataForm);

            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/indicadoresCarreras/index/'));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el registro!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $r_carreras = new CarreraModel($db);
        $datos['r_carreras'] = $r_carreras->getCarreras();
		return view('indicadores_carrera/agregar-ind-carrera', $datos);
    }
    /******************************************************************/
    function eliminar(){
        if ($this->request->getMethod() == 'post') {
            $recibidos = $this->request->getPost();
            $eliminar = new IndicadoresCarrerasModel($db);

            foreach ($recibidos as $id_recibido){
                $respuesta = $eliminar->eliminar($id_recibido);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function editar($id_registro){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Asignatura');

        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $editarRegistro = new IndicadoresCarrerasModel($db);
            $respuesta = $editarRegistro->editar($dataForm);

            if ($respuesta == TRUE){
                return redirect()->to(base_url('public/indicadoresCarreras/index/'));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar el registro!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $r_indicador = new IndicadoresCarrerasModel($db);
        $datos['r_indicador'] = $r_indicador->getIndicador($id_registro);
        return view('indicadores_carrera/editar-ind-carrera', $datos);
    }
    /******************************************************************/
    /******************************************************************/
    /* Página principal para programas presenciales */
    function buscar_ind_carreras(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Estadísticas de Programas Presenciales');

        $indicadores_carrera = new IndicadoresCarrerasModel($db);
        $datos['matricula_carrera'] = $indicadores_carrera->getMatriculaCarrera(1,2,0); // se le pasan los valores de ($tipo, $anio, $vigencia)
        $datos['ratios_ocupacion'] = $indicadores_carrera->getRatiosOcupacion(2,2,0); // se le pasan los valores de ($tipo, $seccion, $vigencia)
        /* Tasa de Titulación Carreras Técnicas  */
        $datos['tasa_tec_1_sem_cohorte'] = $indicadores_carrera->getRatiosOcupacion(3,3,0); // se le pasan los valores de ($tipo, $seccion, $vigencia)
        $datos['tasa_tec_2_sem_cohorte'] = $indicadores_carrera->getRatiosOcupacion(3,4,0); // se le pasan los valores de ($tipo, $seccion, $vigencia)
        /* Tasa de Titulación Carreras Profesionales  */
        $datos['tasa_prof_1_sem_cohorte'] = $indicadores_carrera->getRatiosOcupacion(4,3,0); // se le pasan los valores de ($tipo, $seccion, $vigencia)
        $datos['tasa_prof_2_sem_cohorte'] = $indicadores_carrera->getRatiosOcupacion(4,4,0); // se le pasan los valores de ($tipo, $seccion, $vigencia)
        /* Tasa de Titulación Carreras Técnicas  */
        $datos['tit_tecnica_3_sem_cohorte'] = $indicadores_carrera->getRatiosOcupacion(5,5,0); // se le pasan los valores de ($tipo, $seccion, $vigencia)
        $datos['oportuna_tecnica_cohorte'] = $indicadores_carrera->getRatiosOcupacion(5,6,0); // se le pasan los valores de ($tipo, $seccion, $vigencia)
        $datos['tiempo_tecnica_cohorte'] = $indicadores_carrera->getRatiosOcupacion(5,7,0); // se le pasan los valores de ($tipo, $seccion, $vigencia)
        /* Tasa de Titulación Carreras Profesionales  */
        $datos['tit_prof_3_sem_cohorte'] = $indicadores_carrera->getRatiosOcupacion(6,5,0); // se le pasan los valores de ($tipo, $seccion, $vigencia)
        $datos['oportuna_prof_cohorte'] = $indicadores_carrera->getRatiosOcupacion(6,6,0); // se le pasan los valores de ($tipo, $seccion, $vigencia)
        $datos['tiempo_prof_cohorte'] = $indicadores_carrera->getRatiosOcupacion(6,7,0); // se le pasan los valores de ($tipo, $seccion, $vigencia)

        return view('indicadores_carrera/indicadores_carrera', $datos);
    }
    /******************************************************************/
    /******************************************************************/
    function actualUser(){
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find(1);
        return $findUsuario;
    }

}
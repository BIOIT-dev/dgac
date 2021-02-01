<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ComunidadModel;
use App\Models\CarreraModel;
use App\Models\DocumentoModel;
use App\Models\ResumenEncuestasModel;

class ResumenEncuestas extends BaseController
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

        $resumen_encuestas = new ResumenEncuestasModel($db);
        $datos['carreras'] = $resumen_encuestas->getCarreras();

        $fecha_actual = date('Y');
        $fecha_atras = 6;
        // $select, $anio, $semestre, $nivel_formacion, $oid_elemento
        $datos['r_nivelFormacion'] = array();
        for($index = 0; $index < 10; $index++){
            if($index < 5)
                array_push($datos['r_nivelFormacion'], ['Carrera Técnica','Dimensión '.($index+1)]);
            else
                array_push($datos['r_nivelFormacion'], ['Carrera Profesional','Dimensión '.($index-4)]);
            for($i = $fecha_actual; $i >= $fecha_actual-$fecha_atras; $i--){
                if($index < 5){
                    array_push($datos['r_nivelFormacion'][$index], $resumen_encuestas->getResumenEncuestas('blk'.($index+1), $i, '1', 'TECNICO', FALSE, FALSE, FALSE));
                    array_push($datos['r_nivelFormacion'][$index], $resumen_encuestas->getResumenEncuestas('blk'.($index+1), $i, '2', 'TECNICO', FALSE, FALSE, FALSE));
                }else{
                    array_push($datos['r_nivelFormacion'][$index], $resumen_encuestas->getResumenEncuestas('blk'.($index-4), $i, '1', 'PROFESIONAL', FALSE, FALSE, FALSE));
                    array_push($datos['r_nivelFormacion'][$index], $resumen_encuestas->getResumenEncuestas('blk'.($index-4), $i, '2', 'PROFESIONAL', FALSE, FALSE, FALSE));
                }                
            }
        }
        /******************************************************************/
        $datos['r_capacitacion'] = array();
        for($index = 0; $index < 5; $index++){
                array_push($datos['r_capacitacion'], ['Capacitación','Dimensión '.($index+1)]);
            for($i = $fecha_actual; $i >= $fecha_actual-$fecha_atras; $i--){
                    array_push($datos['r_capacitacion'][$index], $resumen_encuestas->getResumenEncuestas('blk'.($index+1), $i, '1', 'CAPACITACION', FALSE, FALSE, FALSE));
                    array_push($datos['r_capacitacion'][$index], $resumen_encuestas->getResumenEncuestas('blk'.($index+1), $i, '2', 'CAPACITACION', FALSE, FALSE, FALSE));             
            }
        }
        $datos['r_carreras'] = [];

		return view('resumen_encuestas/index-res-encuestas', $datos);
    }
    /******************************************************************/
    public function obtenertabla(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Periodo');
        if ($this->request->isAJAX()){
            $dataGet = $this->request->getGet();
            $resumen_encuestas = new ResumenEncuestasModel($db);
            switch($dataGet['tipo_tabla']){
                case "1":
                    return view('resumen_encuestas/tablas/nivel_formacion');
                    break;
                case "2":
                    return view('resumen_encuestas/tablas/capacitacion');
                    break;
                case "3":
                    $datos['carreras'] = $resumen_encuestas->getCarreras();
                    return view('resumen_encuestas/tablas/carrera', $datos);
                    break;
                case "4":
                    $datos['carreras'] = $resumen_encuestas->getCarreras();
                    return view('resumen_encuestas/tablas/asignatura', $datos);
                    break;
                case "5":
                    $datos['carreras'] = $resumen_encuestas->getCarreras();
                    return view('resumen_encuestas/tablas/docente', $datos);
                    break;
            }
        }
    }
    // $select, $anio, $semestre, $nivel_formacion, $oid_elemento
    public function loadCarrera(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Periodo');
        if ($this->request->isAJAX()){
            $dataGet = $this->request->getGet();
            
            $resumen_encuestas = new ResumenEncuestasModel($db);
            $nombre_carrera = $resumen_encuestas->getCarreraTabla($dataGet['oid_elemento']);
            $fecha_actual = date('Y');
            $fecha_atras = 6;
            $carrera_datos = array();
            for($index = 0; $index < 5; $index++){
                    array_push($carrera_datos, [$nombre_carrera->nombre, 'Dimensión '.($index+1)]);
                for($i = $fecha_actual; $i >= $fecha_actual-$fecha_atras; $i--){
                        array_push($carrera_datos[$index], $resumen_encuestas->getResumenEncuestas('blk'.($index+1), $i, '1', FALSE, $dataGet['oid_elemento'], FALSE, FALSE));
                        array_push($carrera_datos[$index], $resumen_encuestas->getResumenEncuestas('blk'.($index+1), $i, '2', FALSE, $dataGet['oid_elemento'], FALSE, FALSE));             
                }
            }
            return json_encode($carrera_datos);
        }
            
    }

    public function getAsignaturas(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Periodo');
        if ($this->request->isAJAX()){
            $dataGet = $this->request->getGet();
            $resumen_encuestas = new ResumenEncuestasModel($db);
                $datos = $resumen_encuestas->getAsignaturas($dataGet['oid_elemento']);
                return json_encode($datos);
        }
            
    }

    public function loadAsignatura(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Periodo');
        if ($this->request->isAJAX()){
            $dataGet = $this->request->getGet();
            
            $resumen_encuestas = new ResumenEncuestasModel($db);
            $nombre_carrera = $resumen_encuestas->getAsignaturaTabla($dataGet['oid_elemento']);
            $fecha_actual = date('Y');
            $fecha_atras = 6;
            $carrera_datos = array();
            for($index = 0; $index < 5; $index++){
                array_push($carrera_datos, [$nombre_carrera->asignatura, 'Dimensión '.($index+1)]);
                for($i = $fecha_actual; $i >= $fecha_actual-$fecha_atras; $i--){
                        array_push($carrera_datos[$index], $resumen_encuestas->getResumenEncuestas('blk'.($index+1), $i, '1', FALSE, FALSE, $dataGet['oid_elemento'], FALSE));
                        array_push($carrera_datos[$index], $resumen_encuestas->getResumenEncuestas('blk'.($index+1), $i, '2', FALSE, FALSE, $dataGet['oid_elemento'], FALSE));             
                }
            }
            return json_encode($carrera_datos);
        }
            
    }

    public function getDocentes(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Periodo');
        if ($this->request->isAJAX()){
            $dataGet = $this->request->getGet();
            $resumen_encuestas = new ResumenEncuestasModel($db);
                $datos = $resumen_encuestas->getDocentes($dataGet['oid_elemento']);
                return json_encode($datos);
        }  
    }

    public function loadDocente(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Periodo');
        if ($this->request->isAJAX()){
            $dataGet = $this->request->getGet();
            
            $resumen_encuestas = new ResumenEncuestasModel($db);
            $nombre_carrera = $resumen_encuestas->getDocenteTabla($dataGet['oid_elemento']);
            $fecha_actual = date('Y');
            $fecha_atras = 6;
            $carrera_datos = array();
            for($index = 0; $index < 5; $index++){
                array_push($carrera_datos, [$nombre_carrera->nombres, 'Dimensión '.($index+1)]);
                for($i = $fecha_actual; $i >= $fecha_actual-$fecha_atras; $i--){
                        array_push($carrera_datos[$index], $resumen_encuestas->getResumenEncuestas('blk'.($index+1), $i, '1', FALSE, FALSE, FALSE, $dataGet['oid_elemento']));
                        array_push($carrera_datos[$index], $resumen_encuestas->getResumenEncuestas('blk'.($index+1), $i, '2', FALSE, FALSE, FALSE, $dataGet['oid_elemento']));             
                }
            }
            return json_encode($carrera_datos);
        }
            
    }
    /******************************************************************/
    /******************************************************************/
    function actualUser(){
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find(1);
        return $findUsuario;
    }

}
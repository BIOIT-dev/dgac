<?php namespace App\Controllers;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\SedeModel;
use App\Models\ReportePresupuestarioModel;

class ReportePresupuestario extends BaseController{
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
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Reporte Presupuestario');
        $presupuestos = new ReportePresupuestarioModel($db);
        $datos['presupuestos'] = $presupuestos->getAllRP();
		return view('reporte_presupuestario/index', $datos);
    }
    /******************************************************************/
    public function reportePresupuestarioApi(){
        $ReportePresupuestarioModel = new ReportePresupuestarioModel($db);
        if ($this->request->isAJAX()){
            $data_post = $this->request->getGet();
            $presupuesto = $ReportePresupuestarioModel->getPresupuesto($data_post['cohorte']);

            $datosTotales['total1'] = $ReportePresupuestarioModel->getTotal($presupuesto[0]->cohorte, 'total1')->num;
            $datosTotales['total2'] = $presupuesto[0]->monto;
            $datosTotales['total3'] = strval($presupuesto[0]->monto - $ReportePresupuestarioModel->getTotal($presupuesto[0]->cohorte, 'total3')->num);
            $datosTotales['total4'] = $ReportePresupuestarioModel->getTotal($presupuesto[0]->cohorte, 'total4')->num;
            $datosTotales['total5'] = $ReportePresupuestarioModel->getTotal($presupuesto[0]->cohorte, 'total5')->num;
            $datosTotales['total6'] = $ReportePresupuestarioModel->getTotal($presupuesto[0]->cohorte, 'total6')->num;
            $datosTotales['total7'] = $ReportePresupuestarioModel->getTotal($presupuesto[0]->cohorte, 'total7')->num;
            $datosTotales['total8'] = $ReportePresupuestarioModel->getTotal($presupuesto[0]->cohorte, 'total8')->num;
            $datosTotales['total9'] = $ReportePresupuestarioModel->getTotal($presupuesto[0]->cohorte, 'total9')->num;
            $datosTotales['total10'] = $ReportePresupuestarioModel->getTotal($presupuesto[0]->cohorte, 'total10')->num;
            $datosTotales['total11'] = $ReportePresupuestarioModel->getTotal($presupuesto[0]->cohorte, 'total11')->num;
            $datosTotales['total12'] = $ReportePresupuestarioModel->getTotal($presupuesto[0]->cohorte, 'total12')->num;
            $datosTotales['total13'] = $ReportePresupuestarioModel->getTotal($presupuesto[0]->cohorte, 'total13')->num;
            $datosTotales['total14'] = $ReportePresupuestarioModel->getTotal($presupuesto[0]->cohorte, 'total14')->num;
            $datosTotales['total15'] = $ReportePresupuestarioModel->getTotal($presupuesto[0]->cohorte, 'total15')->num;
            $datosTotales['correccion_totales'] = $presupuesto[0]->monto - ($datosTotales['total7'] + $datosTotales['total13']);
            return json_encode($datosTotales);
        }
    }
    /******************************************************************/
    function agregar_presupuesto(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Agregar Presupuesto');
        $ReportePresupuestarioModel = new ReportePresupuestarioModel($db);
        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();

            $respuesta = $ReportePresupuestarioModel->agregar_presupuesto($data_busqueda);
            if ($respuesta == TRUE){
				$datos['resultado_busqueda'] = $ReportePresupuestarioModel->getAllRP();
                return view('reporte_presupuestario/agregar', $datos);
            }else{
                $datos['url_redirect'] = 'reportePresupuestario/agregar_presupuesto';
                $datos['mensaje_servidor'] = 'Ya existe un prespuesto para el cohorte!';
                return view('respuestas_servidor/error_params', $datos);
            }
        }
        $datos['resultado_busqueda'] = $ReportePresupuestarioModel->getAllRP();
        return view('reporte_presupuestario/agregar', $datos);
    }
    /******************************************************************/
    function editar($id_presupuesto){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Presupuesto');

        $ReportePresupuestarioModel = new ReportePresupuestarioModel($db);
        $datos['data_edit'] = $ReportePresupuestarioModel->find($id_presupuesto);

        $datos['profile_foto_edit'] = array('foto'=>base_url().'/assets/images/users/4.jpg');

        if ($this->request->getMethod() == 'post') {
            $dataForm = $this->request->getPost();
            $ReportePresupuestarioModel = new ReportePresupuestarioModel($db);
            $respuesta = $ReportePresupuestarioModel->editar_presupuesto($id_presupuesto, $dataForm);
            if ($respuesta == TRUE){
				$datos['url_retorno'] = 'reportePresupuestario/agregar_presupuesto';
                $datos['mensaje_servidor'] = 'El presupuesto se editó correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar la sede!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        return view('reporte_presupuestario/editar', $datos);
    }
    /******************************************************************/
    
    function eliminar_presupuesto(){
        if ($this->request->getMethod() == 'post') {
            $datos_recibidos = $this->request->getPost();
            $ReportePresupuestarioModel = new ReportePresupuestarioModel($db);
            foreach ($datos_recibidos as $id_presupuesto){
                $respuesta = $ReportePresupuestarioModel->eliminar_presupuesto($id_presupuesto);
                var_dump($respuesta);
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

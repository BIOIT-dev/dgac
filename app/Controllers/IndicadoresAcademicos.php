<?php namespace App\Controllers;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\CarreraModel;
use App\Models\IndicadoresCarrerasModel;
use App\Models\IndicadoresAcademicosModel;

class IndicadoresAcademicos extends BaseController
{
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
    }
    /******************************************************************/
    function grafico($tipo_grafico){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Asignatura');
        /******************************/
        $indicadores_academicos = new IndicadoresAcademicosModel($db);
        $fecha_actual = date('Y');
        $fecha_atras = 6;
        $datos['fecha_atras'] = $fecha_atras;
        switch($tipo_grafico){
            case 'matriculados_institucion':
                $datos['tituloGrafico'] = 'Número de Matriculados en la Institución';
                $datos['datosGrafico'] = array(['Matricula Nueva'],['Matricula Total']);
                for($i = $fecha_actual-$fecha_atras; $i <= $fecha_actual; $i++){
                    array_push($datos['datosGrafico'][0], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(insc_alumn_nuev) as num', FALSE, FALSE, FALSE, FALSE));
                    array_push($datos['datosGrafico'][1], $indicadores_academicos->getMatriculadosInstitucion($i, '(sum(insc_alumn_nuev) + sum(insc_alumn_antg)) as num', FALSE, FALSE, FALSE, FALSE));
                }
                break;
            case 'matricula_formacion':
                $datos['tituloGrafico'] = 'Matrícula Nueva por Nivel de Formación';
                $datos['datosGrafico'] = array(['Carreras Técnicas'],['Carreras Profesionales']);
                for($i = $fecha_actual-$fecha_atras; $i <= $fecha_actual; $i++){
                    array_push($datos['datosGrafico'][0], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(insc_alumn_nuev) as num', 'TECNICO', FALSE, FALSE, FALSE));
                    array_push($datos['datosGrafico'][1], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(insc_alumn_nuev) as num', 'PROFESIONAL', FALSE, FALSE, FALSE));
                }
                break;
            case 'ratios_ocupacion_institucion':
                $datos['tituloGrafico'] = 'Ratios de Ocupación Total Institución';
                $datos['datosGrafico'] = array(['Tasa de Ocupación']);
                for($i = $fecha_actual-$fecha_atras; $i <= $fecha_actual; $i++){
                    array_push($datos['datosGrafico'][0], $indicadores_academicos->getMatriculadosInstitucion($i, '((sum(insc_alumn_nuev)/sum(vaca_alumn_nuev))*100) as num', FALSE, FALSE, FALSE, FALSE));
                }
                break;
            case 'ratios_ocupacion_formacion':
                $datos['tituloGrafico'] = 'Ratios de Ocupación Total Institución';
                $datos['datosGrafico'] = array(['Carreras Técnicas'],['Carreras Profesionales']);
                for($i = $fecha_actual-$fecha_atras; $i <= $fecha_actual; $i++){
                    array_push($datos['datosGrafico'][0], $indicadores_academicos->getMatriculadosInstitucion($i, '((sum(insc_alumn_nuev)/sum(vaca_alumn_nuev))*100) as num', 'TECNICO', FALSE, FALSE, FALSE));
                    array_push($datos['datosGrafico'][1], $indicadores_academicos->getMatriculadosInstitucion($i, '((sum(insc_alumn_nuev)/sum(vaca_alumn_nuev))*100) as num', 'PROFESIONAL', FALSE, FALSE, FALSE));
                }
                break;
            case 'cohorte_carrera_8sem':
                $datos['tituloGrafico'] = 'Carreras de 8 Semestres';
                $datos['datosGrafico'] = array(['Año 1'],['Año 2'],['Año 3'],['Año 4']);
                for($i = $fecha_actual-$fecha_atras; $i <= $fecha_actual; $i++){
                    array_push($datos['datosGrafico'][0], $indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(insc_alumn_nuev) as num', FALSE, FALSE, FALSE, '8'));
                    array_push($datos['datosGrafico'][1], $indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(rematricula2) as num', FALSE, FALSE, FALSE, '8'));
                    array_push($datos['datosGrafico'][2], $indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(rematricula3) as num', FALSE, FALSE, FALSE, '8'));
                    array_push($datos['datosGrafico'][3], $indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(rematricula4) as num', FALSE, FALSE, FALSE, '8'));
                }
                break;
            case 'cohorte_carrera_6sem':
                $datos['tituloGrafico'] = 'Carreras de 6 Semestres';
                $datos['datosGrafico'] = array(['Año 1'],['Año 2'],['Año 3']);
                for($i = $fecha_actual-$fecha_atras; $i <= $fecha_actual; $i++){
                    array_push($datos['datosGrafico'][0], $indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(insc_alumn_nuev) as num', FALSE, FALSE, FALSE, '6'));
                    array_push($datos['datosGrafico'][1], $indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(rematricula2) as num', FALSE, FALSE, FALSE, '6'));
                    array_push($datos['datosGrafico'][2], $indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(rematricula3) as num', FALSE, FALSE, FALSE, '6'));
                }
                break;
            case 'cohorte_carrera_3sem':
                $datos['tituloGrafico'] = 'Carreras de 3 Semestres';
                $datos['datosGrafico'] = array(['Año 1'],['Año 2']);
                for($i = $fecha_actual-$fecha_atras; $i <= $fecha_actual; $i++){
                    array_push($datos['datosGrafico'][0], $indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(insc_alumn_nuev) as num', FALSE, FALSE, FALSE, '3'));
                    array_push($datos['datosGrafico'][1], $indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(rematricula2) as num', FALSE, FALSE, FALSE, '3'));
                }
                break;
            case 'cohorte_carrera_2sem':
                $datos['tituloGrafico'] = 'Carreras de 2 Semestres';
                $datos['datosGrafico'] = array(['Año 1']);
                for($i = $fecha_actual-$fecha_atras; $i <= $fecha_actual; $i++){
                    array_push($datos['datosGrafico'][0], $indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(insc_alumn_nuev) as num', FALSE, FALSE, FALSE, '2'));
                }
                break;
            case 'titulacion_formacion_8sem':
                $datos['tituloGrafico'] = 'Indicadores de Titulación por Nivel de Formación - Carreras de 8 Semestres';
                $datos['datosGrafico'] = array(['Carreras Técnicas'],['Carreras Profesionales']);
                for($i = $fecha_actual-$fecha_atras; $i <= $fecha_actual; $i++){
                    array_push($datos['datosGrafico'][0], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(num_titulados) as num', 'TECNICO', FALSE, FALSE, '8'));
                    array_push($datos['datosGrafico'][1], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(num_titulados) as num', 'PROFESIONAL', FALSE, FALSE, '8'));
                }
                break;
            case 'titulacion_formacion_6sem':
                $datos['tituloGrafico'] = 'Indicadores de Titulación por Nivel de Formación - Carreras de 6 Semestres';
                $datos['datosGrafico'] = array(['Carreras Técnicas'],['Carreras Profesionales']);
                for($i = $fecha_actual-$fecha_atras; $i <= $fecha_actual; $i++){
                    array_push($datos['datosGrafico'][0], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(num_titulados) as num', 'TECNICO', FALSE, FALSE, '6'));
                    array_push($datos['datosGrafico'][1], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(num_titulados) as num', 'PROFESIONAL', FALSE, FALSE, '6'));
                }
                break;
            case 'titulacion_formacion_3sem':
                $datos['tituloGrafico'] = 'Indicadores de Titulación por Nivel de Formación - Carreras de 3 Semestres';
                $datos['datosGrafico'] = array(['Carreras Técnicas'],['Carreras Profesionales']);
                for($i = $fecha_actual-$fecha_atras; $i <= $fecha_actual; $i++){
                    array_push($datos['datosGrafico'][0], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(num_titulados) as num', 'TECNICO', FALSE, FALSE, '3'));
                    array_push($datos['datosGrafico'][1], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(num_titulados) as num', 'PROFESIONAL', FALSE, FALSE, '3'));
                }
                break;
            case 'titulacion_formacion_2sem':
                $datos['tituloGrafico'] = 'Indicadores de Titulación por Nivel de Formación - Carreras de 2 Semestres';
                $datos['datosGrafico'] = array(['Carreras Técnicas'],['Carreras Profesionales']);
                for($i = $fecha_actual-$fecha_atras; $i <= $fecha_actual; $i++){
                    array_push($datos['datosGrafico'][0], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(num_titulados) as num', 'TECNICO', FALSE, FALSE, '2'));
                    array_push($datos['datosGrafico'][1], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(num_titulados) as num', 'PROFESIONAL', FALSE, FALSE, '2'));
                }
                break;
        }
        return view('indicadores_academicos/graficos', $datos);
    }
    /******************************************************************/
    /******************************************************************/
    /* Página principal para programas presenciales */
    function index(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Indicadores Académicos');
        /******************************/
        $indicadores_academicos = new IndicadoresAcademicosModel($db);
        $datos['matriculados_institucion_nueva'] = array();
        $datos['matriculados_institucion_total'] = array();
        $fecha_actual = date('Y');
        for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
            $suma_total = $indicadores_academicos->getAntiguos($i)->numero;
            $suma_total = $suma_total + ($indicadores_academicos->getMatriculadosInstitucion($i, '(sum(insc_alumn_nuev) + sum(insc_alumn_antg)) as num', FALSE, FALSE, FALSE, FALSE)['num']);
            array_push($datos['matriculados_institucion_nueva'], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(insc_alumn_nuev) as num', FALSE, FALSE, FALSE, FALSE));
            array_push($datos['matriculados_institucion_total'], ['num' => $suma_total]);
        }
        /******************************/
        $datos['matricula_formacion_tecnica'] = array();
        $datos['matricula_formacion_profesional'] = array();
        $fecha_actual = date('Y');
        for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
            array_push($datos['matricula_formacion_tecnica'], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(insc_alumn_nuev) as num', 'TECNICO', FALSE, FALSE, FALSE));
            array_push($datos['matricula_formacion_profesional'], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(insc_alumn_nuev) as num', 'PROFESIONAL', FALSE, FALSE, FALSE));
        }
        /******************************/
        $datos['matricula_nueva_carrera'] = array();
        $carreras = $indicadores_academicos->getCarreras();
        foreach($carreras as $carr){
            $valores = [$carr->nombre, "DIURNO"];
            for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
                array_push($valores, ($indicadores_academicos->getMatriculadosInstitucion($i, 'sum(insc_alumn_nuev) as num', FALSE, $carr->oid, "DIURNO", FALSE))['num']);
            }
            $valores2 = [$carr->nombre, "VESPERTINO"];
            for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
                array_push($valores2, ($indicadores_academicos->getMatriculadosInstitucion($i, 'sum(insc_alumn_nuev) as num', FALSE, $carr->oid, "VESPERTINO", FALSE))['num']);
            }
            array_push($datos['matricula_nueva_carrera'], [$valores]);
            array_push($datos['matricula_nueva_carrera'], [$valores2]);
        }
        /******************************************************************/
        //$cohorte, $select, $nivel_formacion, $id_carrera, $jornada, $duracion_semestre
        $datos['ratios_ocupacion_institucion'] = array();
        for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
            array_push($datos['ratios_ocupacion_institucion'], $indicadores_academicos->getMatriculadosInstitucion($i, '((sum(insc_alumn_nuev)/sum(vaca_alumn_nuev))*100) as num', FALSE, FALSE, FALSE, FALSE));
        }
        /******************************************************************/
        $datos['ratios_ocupacion_tecnica'] = array();
        $datos['ratios_ocupacion_profesional'] = array();
        $fecha_actual = date('Y');
        for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
            array_push($datos['ratios_ocupacion_tecnica'], $indicadores_academicos->getMatriculadosInstitucion($i, '((sum(insc_alumn_nuev)/sum(vaca_alumn_nuev))*100) as num', 'TECNICO', FALSE, FALSE, FALSE));
            array_push($datos['ratios_ocupacion_profesional'], $indicadores_academicos->getMatriculadosInstitucion($i, '((sum(insc_alumn_nuev)/sum(vaca_alumn_nuev))*100) as num', 'PROFESIONAL', FALSE, FALSE, FALSE));
        }
        /******************************************************************/
        /******************************/
        $datos['cohorte_carrera_8sem'] = array();
        $valores = [];
        for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
            array_push($datos['cohorte_carrera_8sem'], [
                $i,
                ($indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(insc_alumn_nuev) as num', FALSE, FALSE, FALSE, '8'))['num'],
                ($indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(rematricula2) as num', FALSE, FALSE, FALSE, '8'))['num'],
                ($indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(rematricula3) as num', FALSE, FALSE, FALSE, '8'))['num'],
                ($indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(rematricula4) as num', FALSE, FALSE, FALSE, '8'))['num'],
                ($indicadores_academicos->getMatriculadosInstitucion($i, '(SUM(rematricula4)/SUM(insc_alumn_nuev))*100 as num', FALSE, FALSE, FALSE, '8'))['num']
            ]);
        }
        /******************************************************************/
        /******************************/
        $datos['cohorte_carrera_6sem'] = array();
        $valores = [];
        for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
            array_push($datos['cohorte_carrera_6sem'], [
                $i,
                ($indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(insc_alumn_nuev) as num', FALSE, FALSE, FALSE, '6'))['num'],
                ($indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(rematricula2) as num', FALSE, FALSE, FALSE, '6'))['num'],
                ($indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(rematricula3) as num', FALSE, FALSE, FALSE, '6'))['num'],
                ($indicadores_academicos->getMatriculadosInstitucion($i, '(SUM(rematricula3)/SUM(insc_alumn_nuev))*100 as num', FALSE, FALSE, FALSE, '6'))['num']
            ]);
        }
        /******************************************************************/
        /******************************/
        $datos['cohorte_carrera_3sem'] = array();
        $valores = [];
        for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
            array_push($datos['cohorte_carrera_3sem'], [
                $i,
                ($indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(insc_alumn_nuev) as num', FALSE, FALSE, FALSE, '3'))['num'],
                ($indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(rematricula2) as num', FALSE, FALSE, FALSE, '3'))['num'],
                ($indicadores_academicos->getMatriculadosInstitucion($i, '(SUM(rematricula2)/SUM(insc_alumn_nuev))*100 as num', FALSE, FALSE, FALSE, '3'))['num']
            ]);
        }
        /******************************************************************/
        /******************************/
        $datos['cohorte_carrera_2sem'] = array();
        $valores = [];
        for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
            array_push($datos['cohorte_carrera_2sem'], [
                $i,
                ($indicadores_academicos->getMatriculadosInstitucion($i, 'SUM(insc_alumn_nuev) as num', FALSE, FALSE, FALSE, '2'))['num'],
                ($indicadores_academicos->getMatriculadosInstitucion($i, '(SUM(insc_alumn_nuev)/SUM(insc_alumn_nuev))*100 as num', FALSE, FALSE, FALSE, '2'))['num']
            ]);
        }
         /******************************************************************/
        /******************************/
        $datos['titulacion_formacion_tec_8sem'] = array();
        $datos['titulacion_formacion_prof_8sem'] = array();
        $fecha_actual = date('Y');
        for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
            array_push($datos['titulacion_formacion_tec_8sem'], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(num_titulados) as num', 'TECNICO', FALSE, FALSE, '8'));
            array_push($datos['titulacion_formacion_prof_8sem'], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(num_titulados) as num', 'PROFESIONAL', FALSE, FALSE, '8'));
        }
         /******************************************************************/
        /******************************/
        $datos['titulacion_formacion_tec_6sem'] = array();
        $datos['titulacion_formacion_prof_6sem'] = array();
        $fecha_actual = date('Y');
        for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
            array_push($datos['titulacion_formacion_tec_6sem'], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(num_titulados) as num', 'TECNICO', FALSE, FALSE, '6'));
            array_push($datos['titulacion_formacion_prof_6sem'], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(num_titulados) as num', 'PROFESIONAL', FALSE, FALSE, '6'));
        }
         /******************************************************************/
        /******************************/
        $datos['titulacion_formacion_tec_3sem'] = array();
        $datos['titulacion_formacion_prof_3sem'] = array();
        $fecha_actual = date('Y');
        for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
            array_push($datos['titulacion_formacion_tec_3sem'], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(num_titulados) as num', 'TECNICO', FALSE, FALSE, '3'));
            array_push($datos['titulacion_formacion_prof_3sem'], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(num_titulados) as num', 'PROFESIONAL', FALSE, FALSE, '3'));
        }
         /******************************************************************/
        /******************************/
        $datos['titulacion_formacion_tec_2sem'] = array();
        $datos['titulacion_formacion_prof_2sem'] = array();
        $fecha_actual = date('Y');
        for($i = $fecha_actual-6; $i <= $fecha_actual; $i++){
            array_push($datos['titulacion_formacion_tec_2sem'], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(num_titulados) as num', 'TECNICO', FALSE, FALSE, '2'));
            array_push($datos['titulacion_formacion_prof_2sem'], $indicadores_academicos->getMatriculadosInstitucion($i, 'sum(num_titulados) as num', 'PROFESIONAL', FALSE, FALSE, '2'));
        }
        // var_dump($datos['cohorte_carrera_8sem']);
        // return;

        return view('indicadores_academicos/index-ind-academicos', $datos);
    }
    /******************************************************************/
    /******************************************************************/
    function actualUser(){
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find(1);
        return $findUsuario;
    }

}
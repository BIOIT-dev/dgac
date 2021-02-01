<?php namespace App\Models; 

use CodeIgniter\Model;

class IndicadoresAcademicosModel extends Model{
    protected $table      = 'indicadores_carreras';
    protected $primaryKey = 'oid';

    protected $returnType     = 'array';

    protected $allowedFields = ['oid'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    /******************************************************************/
    public function getIndicadoresCarreras(){
        $db = \Config\Database::connect();
        $builder = $db->table('indicadores_carreras');
        $builder->select('*, indicadores_carreras.oid as oid_ic');
        $builder->join('carreras', 'carreras.oid=indicadores_carreras.carrera', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function crear($datos){
        $db = \Config\Database::connect();
        $db->table('indicadores_carreras')->insert($datos);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
    /******************************************************************/
    public function eliminar($id){
        $db = \Config\Database::connect();
        $builder = $db->table('indicadores_carreras');

        $builder->delete(['oid' => $id]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
    /******************************************************************/
    public function getIndicador($id){
        $db = \Config\Database::connect();
        $builder = $db->table('indicadores_carreras');
        $builder->select('*, indicadores_carreras.oid as oid_ic');
        $builder->where('indicadores_carreras.oid', $id);
        $builder->join('carreras', 'carreras.oid=indicadores_carreras.carrera', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        $indicador = json_decode(json_encode($query),true);
        return $indicador[0];
    }

    public function editar($dataForm){
        $db = \Config\Database::connect();
        $builder = $db->table('indicadores_carreras');
        $builder->where('oid', $dataForm['oid']);
        $response = $builder->update($dataForm);
        return $response;
    }
    /******************************************************************/
    public function getMatriculadosInstitucion($cohorte, $select, $nivel_formacion, $id_carrera, $jornada, $duracion_semestre){
        $db = \Config\Database::connect();
        $builder = $db->table('indicadores_carreras');
        $builder->select($select);
        $builder->where('cohorte', $cohorte);
        if($nivel_formacion != FALSE)
            $builder->where('nivel_formacion', $nivel_formacion);
        if($id_carrera != FALSE){
            $builder->where('carrera', $id_carrera);
        }
        if($jornada != FALSE){
            $builder->where('jornada', $jornada);
        }
        if($duracion_semestre != FALSE){
            $builder->where('duracion_semestre', $duracion_semestre);
        }
        $query   = $builder->get();
        $query = $query->getResult();
        $ratios = json_decode(json_encode($query),true);
        return $ratios[0];
        // return $query;
    }

    public function getAntiguos($cohorte){
        $db = \Config\Database::connect();
        $sql = "SELECT COUNT( DISTINCT oid_usuario ) as numero
                FROM historial_alumnos
                WHERE oid_esal =1
                AND nuevo =0 AND hial_anio=".$cohorte;
        $query = $db->query($sql);
        return $query->getRow();
    }

    public function getCarreras(){
        $db = \Config\Database::connect();
        $builder = $db->table('carreras');
        $builder->select('carreras.oid, carreras.nombre');
        $builder->where('estatus', 0);
        $builder->orderBy('carreras.nombre');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function profesores_agregados($id_comunidad){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario_grupo');
        $builder->select('usuario_grupo.oid_usuario');
        $builder->where('usuario_grupo.oid_grupo', $id_comunidad);
        $builder->where('usuario_grupo.rol', "PRO");
        $builder->join('usuario', 'usuario.oid=usuario_grupo.oid_usuario', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        $profesores_agregados = array();
        foreach($query as $q){
            array_push($profesores_agregados, $q->oid_usuario);
        }
        return $profesores_agregados; // retorna array con los id's de profesores agregados a la carrera
    }

    public function getAllProfesores($id_comunidad){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario_grupo');
        $builder->select('*');
        $builder->where('usuario_grupo.oid_grupo', "19");// 19 es el id de Comunidad de Profesores de la Escuela Técnica Aeronáutica
        $builder->where('usuario_grupo.rol', "PRO");
        $prof_agregados = $this->profesores_agregados($id_comunidad);//trae los profesores agregados
        if($prof_agregados!=array()){
            $builder->whereNotIn('usuario_grupo.oid_usuario', $this->profesores_agregados($id_comunidad));
        };
        $builder->join('usuario', 'usuario.oid=usuario_grupo.oid_usuario', 'left');
        $builder->where('usuario.inactivo', 0);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getRatiosOcupacion($tipo, $seccion, $vigencia){
        $db = \Config\Database::connect();
        $builder = $db->table('indicadores_historicos');
        $builder->select('*, indicadores_historicos.oid as oid_ind_his');
        $builder->join('indicadores_grupos', 'indicadores_grupos.oid=indicadores_historicos.oid_ind_grupo', 'left');
        $builder->where('indicadores_historicos.seccion', $seccion);
        $builder->where('indicadores_grupos.activo', $vigencia);
        $builder->where('indicadores_grupos.tipo', $tipo);
        $query   = $builder->get();
        $query = $query->getResult();
        $ratios = json_decode(json_encode($query),true);
        return $ratios;
    }
}
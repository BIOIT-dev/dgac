<?php namespace App\Models; 

use CodeIgniter\Model;

class IndicadoresCarrerasModel extends Model{
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
    public function getMatriculaCarrera($tipo, $anio, $vigencia){
        $db = \Config\Database::connect();
        $builder = $db->table('indicadores_grupos');
        $builder->select('*, indicadores_grupos.oid as oid_ig');
        $builder->join('indicadores_matricula', 'indicadores_matricula.oid_ind_grupo=indicadores_grupos.oid', 'left');
        $builder->where('indicadores_grupos.tipo', $tipo);
        $builder->where('indicadores_grupos.activo', $vigencia);
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
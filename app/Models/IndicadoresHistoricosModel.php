<?php namespace App\Models;

use CodeIgniter\Model;

class IndicadoresHistoricosModel extends Model{
    protected $table      = 'indicadores_grupos';
    protected $primaryKey = 'oid';

    protected $returnType     = 'array';

    protected $allowedFields = ['oid', 'grupo'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getIndicadorGrupo(){
        $db = \Config\Database::connect();
        $builder = $db->table('indicadores_grupos');
        $builder->select('*');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function cambiar_vigencia($dataForm){
        $data = [
            'activo' => $dataForm["estado"]
        ];
        $db = \Config\Database::connect();
        $builder = $db->table('indicadores_grupos');
        $builder->where('oid', $dataForm["id_indicador"]);
        $response = $builder->update($data);
        return $response;
    }
    /******************************************************************/
    public function crear_indicador_grupo($dataForm){
        $db = \Config\Database::connect();
        $db->table('indicadores_grupos')->insert($dataForm);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
    /******************************************************************/
    public function editar_indicador_grupo($datos_indicador_grupo, $id_indicador_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('indicadores_grupos');
        $builder->where('oid', $id_indicador_grupo);
        $response = $builder->update($datos_indicador_grupo);
        return $response;
    }
    /******************************************************************/
    public function getIndicadores($id_indicador_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('indicadores_matricula');
        $builder->select('*');
        $builder->where('oid_ind_grupo', $id_indicador_grupo);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function crear_indicador($dataForm){
        $db = \Config\Database::connect();
        $db->table('indicadores_matricula')->insert($dataForm);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
    /******************************************************************/
    public function getIndicador($id_indicador){
        $db = \Config\Database::connect();
        $builder = $db->table('indicadores_matricula');
        $builder->select('*');
        $builder->where('oid', $id_indicador);
        $query   = $builder->get();
        $query = $query->getResult();
        $indicador = json_decode(json_encode($query),true);
        return $indicador[0];
    }
    /******************************************************************/
    public function editar_indicador($datos_indicador, $id_indicador){
        $db = \Config\Database::connect();
        $builder = $db->table('indicadores_matricula');
        $builder->where('oid', $id_indicador);
        $response = $builder->update($datos_indicador);
        return $response;
    }
}
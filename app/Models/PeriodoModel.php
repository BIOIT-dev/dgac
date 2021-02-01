<?php namespace App\Models;

use CodeIgniter\Model;

class PeriodoModel extends Model{
    protected $table      = 'periodos';
    protected $primaryKey = 'oid';

    protected $returnType     = 'array';

    protected $allowedFields = ['oid', 'nombre'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getPeriodos(){
        $db = \Config\Database::connect();
        $builder = $db->table('periodos');
        $builder->select('*');
        $builder->orderBy('peri_nombre');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function crear_periodo($datos_periodo){
        $db = \Config\Database::connect();
        $db->table('periodos')->insert($datos_periodo);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
    /******************************************************************/
    public function crear_sede($datos_periodo){
        $db = \Config\Database::connect();
        $db->table('sedes')->insert($datos_periodo);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
    /******************************************************************/
    public function editar_periodo($datos_periodo, $id_periodo){
        $db = \Config\Database::connect();
        $builder = $db->table('periodos');
        $builder->where('oid', $id_periodo);
        $response = $builder->update($datos_periodo);
        return $response;
    }
    /******************************************************************/
    public function cambiar_vigencia($dataForm){
        $data = [
            'peri_activo' => $dataForm["estado"]
        ];
        $db = \Config\Database::connect();
        $builder = $db->table('periodos');
        $builder->where('oid', $dataForm["id_periodo"]);
        $response = $builder->update($data);
        return $response;
    }
    /******************************************************************/
    public function cambiar_vigencia_sede($dataForm){
        $data = [
            'sepe_activo' => $dataForm["estado"]
        ];
        $db = \Config\Database::connect();
        $builder = $db->table('sedes_periodos');
        $builder->where('oid', $dataForm["id_sede"]);
        $response = $builder->update($data);
        return $response;
    }
    /******************************************************************/
    public function agregar_registro($dataForm){
        $data = [
            'oid_sedes' => $dataForm["id_sede"],
            'oid_periodos' => $dataForm["id_periodo"],
            'sepe_activo' => '1'
        ];
        $db = \Config\Database::connect();
        $db->table('sedes_periodos')->insert($data);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
    /******************************************************************/
    public function getSedes($id_periodo){
        $db = \Config\Database::connect();
        $builder = $db->table('sedes');
        $builder->select('*, sedes.oid as id_sede');
        $builder->where('sedes.inactivo', '0');
        $builder->join('sedes_periodos', 'sedes_periodos.oid_sedes=sedes.oid', 'left');
        $builder->where('sedes_periodos.oid_periodos', $id_periodo);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function sedes_agregadas($id_periodo){
        $db = \Config\Database::connect();
        $builder = $db->table('sedes');
        $builder->select('*, sedes.oid as id_sede');
        $builder->where('sedes.inactivo', '0');
        $builder->join('sedes_periodos', 'sedes_periodos.oid_sedes=sedes.oid', 'left');
        $builder->where('sedes_periodos.oid_periodos', $id_periodo);
        $query   = $builder->get();
        $query = $query->getResult();
        $sedes_agregadas = array();
        foreach($query as $q){
            array_push($sedes_agregadas, $q->id_sede);
        }
        return $sedes_agregadas; // retorna array con los id's de sedes agregadas al periodo
    }
    
    public function getDisponibles($id_periodo){
        $db = \Config\Database::connect();
        $builder = $db->table('sedes');
        $builder->select('*');
        $prof_agregados = $this->sedes_agregadas($id_periodo);//trae las sedes agregadas
        if($prof_agregados!=array()){
            $builder->whereNotIn('sedes.oid', $this->sedes_agregadas($id_periodo));
        };
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
}
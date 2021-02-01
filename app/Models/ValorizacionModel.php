<?php namespace App\Models;

use CodeIgniter\Model;

class ValorizacionModel extends Model{
    protected $table      = 'config';
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
    /******************************************************************/
    public function getSueldobase(){
        $db = \Config\Database::connect();
        $builder = $db->table('config');
        $builder->select('*');
        $builder->where('oid', '1');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query[0];
    }
    public function getAsignacion(){
        $db = \Config\Database::connect();
        $builder = $db->table('config');
        $builder->select('*');
        $builder->where('oid', '2');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query[0];
    }
    /******************************************************************/
    public function editarSueldobase($sueldobase){
        $db = \Config\Database::connect();
        $builder = $db->table('config');
        $builder->where('oid', '1');
        $response = $builder->update($sueldobase);
        return $response;
    }
    /******************************************************************/
    public function editarAsignacion($asignacion){
        $db = \Config\Database::connect();
        $builder = $db->table('config');
        $builder->where('oid', '2');
        $response = $builder->update($asignacion);
        return $response;
    }
}
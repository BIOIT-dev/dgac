<?php namespace App\Models;

use CodeIgniter\Model;

class TemaModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'tema';
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

    public function getTemas(){
        $db = \Config\Database::connect();
        $builder = $db->table('tema');
        $builder->select('*');
        $builder->orderBy('descripcion');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
}
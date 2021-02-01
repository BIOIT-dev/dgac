<?php namespace App\Models;

use CodeIgniter\Model;

class GrupoCategoriaModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'grupo';
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

    public function getGrupoCategoria(){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo_categoria');
        $builder->select('*');
        $builder->orderBy('nombre');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
}
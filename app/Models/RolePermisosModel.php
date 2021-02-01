<?php namespace App\Models;

use CodeIgniter\Model;

class RolePermisosModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'role_permisos';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = ['role_id', 'modulo_id','acceso'];

    protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    

}

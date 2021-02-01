<?php namespace App\Models;

use CodeIgniter\Model;

class GrupoTipoModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'grupo';
    protected $primaryKey = 'grti_cod';

    protected $returnType     = 'array';

    protected $allowedFields = ['oid', 'nombre'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getGrupoTipo(){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo_tipo');
        $builder->select('*');
        $builder->orderBy('grti_cod');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    
    public function getGrupoTipoNombre($nombre){
        $db = \Config\Database::connect();

        $builder = $db->table('grupo_tipo');
        $builder->select('*');
        $builder->where('grti_nombre', $nombre);
        
        $query   = $builder->get();
        return $query->getRow();

    }
}

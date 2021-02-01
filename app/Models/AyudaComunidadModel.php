<?php namespace App\Models;

use CodeIgniter\Model;

class AyudaComunidadModel extends Model
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

    public function buscar($datos_busqueda){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select("grupo.oid, replace(grupo.nombre, '".'"'."', '') as nombre, grupo.autoincorporacion, grupo.inactivo, grupo_categoria.nombre as gcnombre, (  
            select count(1) 
            from usuario_grupo ug 
            where ug.oid_grupo=grupo.oid ) as numUsers");
        $builder->join('grupo_categoria', 'grupo_categoria.oid=grupo.oid_categoria', 'left');
        $builder->like('grupo.nombre', $datos_busqueda['nombre']);
        $builder->orderBy('grupo_categoria.nombre, grupo.nombre');

        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
}
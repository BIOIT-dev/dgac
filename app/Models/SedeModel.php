<?php namespace App\Models;

use CodeIgniter\Model;

class SedeModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'sedes';
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

    public function crear_sede($datos_sede){
        $db = \Config\Database::connect();
        $db->table('sedes')->insert($datos_sede);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function getSedes(){
        $db = \Config\Database::connect();
        $builder = $db->table('sedes');
        $builder->select('*');
        $builder->orderBy('sede_nombre');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function buscar_sede($datos_busqueda){
        $db = \Config\Database::connect();
        $builder = $db->table('sedes');
        // var_dump($datos_busqueda);
        $builder->select('*');
        if ($datos_busqueda['sede_nombre'] != '') $builder->like('sedes.sede_nombre', $datos_busqueda['sede_nombre']);
        $builder->orderBy('sedes.oid', 'DESC');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function eliminar_sede($id_sede){
        $db = \Config\Database::connect();
        $builder = $db->table('sedes');

        $builder->delete(['oid' => $id_sede]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function editar_sede($datos_sede){
        $db = \Config\Database::connect();
        $builder = $db->table('sedes');
        
        $builder->where('oid', $datos_sede['oid']);
        $response = $builder->update($datos_sede);
        
        return $response;
    }
}
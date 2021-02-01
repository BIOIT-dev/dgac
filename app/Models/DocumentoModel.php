<?php namespace App\Models; 

use CodeIgniter\Model;

class DocumentoModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'tipos_archivos';
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

    public function crear($datos){
        $db = \Config\Database::connect();
        $db->table('tipos_archivos')->insert($datos);
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
        $builder->orderBy('nombre');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function buscar($datos_busqueda){
        $db = \Config\Database::connect();
        $builder = $db->table('tipos_archivos');
        $builder->select('*');
        if ($datos_busqueda['tiar_nombre'] != '') $builder->like('tipos_archivos.tiar_nombre', $datos_busqueda['tiar_nombre']);
        $builder->orderBy('tipos_archivos.oid');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function eliminar($id_documento){
        $db = \Config\Database::connect();
        $builder = $db->table('tipos_archivos');

        $builder->delete(['oid' => $id_documento]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function editar($dataForm){
        $db = \Config\Database::connect();
        $builder = $db->table('tipos_archivos');
        $builder->where('oid', $dataForm['oid']);
        $response = $builder->update($dataForm);
        return $response;
    }
}
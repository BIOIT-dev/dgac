<?php namespace App\Models;

use CodeIgniter\Model;

class EmpresaModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'empresa';
    protected $primaryKey = 'oid';

    protected $returnType     = 'array';

    protected $allowedFields = ['nombres', 'apellidos'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function crear_empresa($datos_empresa){
        $db = \Config\Database::connect();
        $db->table('empresa')->insert($datos_empresa);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
        // var_dump($rows);
        // return $builder->affected_rows();
        // var_dump($builder);
        // foreach ($builder as $buil)
        //     var_dump($build);
    }

    public function buscar_empresa($datos_busqueda){
        $db = \Config\Database::connect();
        $builder = $db->table('empresa');
        $builder->select('*');
        $builder->where('1', '1');
        if ($datos_busqueda['rut'] != '') $builder->like('empresa.rut', $datos_busqueda['rut']);
        if ($datos_busqueda['nombre'] != '') $builder->like('empresa.nombre', $datos_busqueda['nombre']);
        if ($datos_busqueda['contacto'] != '') $builder->like('empresa.contacto', $datos_busqueda['contacto']);
        $builder->orderBy('empresa.nombre');

        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function eliminar_empresa($id_empresa){
        $db = \Config\Database::connect();
        $builder = $db->table('empresa');

        $builder->delete(['oid' => $id_empresa]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function editar_empresa($datos_empresa){
        $db = \Config\Database::connect();
        $builder = $db->table('empresa');
        
        $builder->where('oid', $datos_empresa['oid']);
        $response = $builder->update($datos_empresa);
        
        return $response;
    }
}
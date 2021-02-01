<?php namespace App\Models;

use CodeIgniter\Model;

class CarreraModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'carreras';
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

    public function crear_carrera($datos_carrera){
        $db = \Config\Database::connect();
        $db->table('carreras')->insert($datos_carrera);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function getCarreras(){
        $db = \Config\Database::connect();
        $builder = $db->table('carreras');
        $builder->select('*');
        $builder->orderBy('nombre');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function buscar_carrera($datos_busqueda){
        $db = \Config\Database::connect();
        $builder = $db->table('carreras');
        // var_dump($datos_busqueda);
        $builder->select('*');
        if ($datos_busqueda['nombre'] != '') $builder->like('carreras.nombre', $datos_busqueda['nombre']);
        // $builder->orderBy('usuario.apellido_paterno', 'ASC');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function eliminar_carrera($id_carrera){
        $db = \Config\Database::connect();
        $builder = $db->table('carreras');

        $builder->delete(['oid' => $id_carrera]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function editar_carrera($datos_carrera){
        $db = \Config\Database::connect();
        $builder = $db->table('carreras');
        
        $builder->where('oid', $datos_carrera['oid']);
        $response = $builder->update($datos_carrera);
        
        return $response;
    }
}
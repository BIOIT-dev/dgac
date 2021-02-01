<?php namespace App\Models;

use CodeIgniter\Model;

class TestPreguntaOpcionModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'test_pregunta_opcion';
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

    public function crear_encuesta($datos_encuesta){
        $db = \Config\Database::connect();
        $datos_encuesta['fecha'] = date('Y-m-d H:i:s');
        $db->table('test')->insert($datos_encuesta);
        // var_dump($db);
        if ($db->affectedRows() > 0){
            return $db->insertID();
        }else {
            return FALSE;
        }
    }
    // Retorna las preguntas asociadas a una encuesta
    public function buscar_test_pregunta_opcion($oid_test, $oid_pregunta){
        $db = \Config\Database::connect();
        $builder = $db->table('test_pregunta_opcion');
        $builder->select('*');
        $builder->where('test_pregunta_opcion.oid_test', $oid_test);
        $builder->where('test_pregunta_opcion.oid_pregunta', $oid_pregunta);
        $builder->orderBy('test_pregunta_opcion.oid');

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
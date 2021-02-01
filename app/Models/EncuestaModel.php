<?php namespace App\Models;

use CodeIgniter\Model;

class EncuestaModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'test';
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

    public function getEncuestas(){
        $db = \Config\Database::connect();
        $builder = $db->table('test');
        $builder->select('test.*, grupo.nombre');
        $builder->join('grupo', 'test.oid_grupo=grupo.oid', 'left');
        // $builder->orderBy('grupo.nombre, test.titulo');
        // $builder->orderBy('test.tipo');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

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

    public function crear_pregunta($id_test, $tipo){
        $db = \Config\Database::connect();
        $data = [
            'oid_test' => $id_test,
            'tipo'  => $tipo
        ];
        $db->table('test_pregunta')->insert($data);
        // var_dump($db);
        if ($db->affectedRows() > 0){
            return $db->insertID();
        }else {
            return FALSE;
        }
    }

    public function crear_opcion_pregunta($id_test, $id_pregunta, $correcta){
        $db = \Config\Database::connect();
        $data = [
            'oid_test' => $id_test,
            'oid_pregunta'  => $id_pregunta,
            'correcta' => $correcta
        ];
        $db->table('test_pregunta_opcion')->insert($data);
        // var_dump($db);
        if ($db->affectedRows() > 0){
            return $db->insertID();
        }else {
            return FALSE;
        }
    }

    public function buscar_encuesta($datos_busqueda){
        $db = \Config\Database::connect();
        $builder = $db->table('test');
        $builder->select('test.*, grupo.nombre');
        $builder->join('grupo', 'test.oid_grupo=grupo.oid', 'left');
        if ($datos_busqueda['titulo'] != '') $builder->like('test.titulo', $datos_busqueda['titulo']);
        if ($datos_busqueda['oid_grupo'] != '0') $builder->where('test.oid_grupo', $datos_busqueda['oid_grupo']);
        $builder->orderBy('grupo.nombre, test.titulo');

        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function buscar_pregunta($id_pregunta){
        $db = \Config\Database::connect();
        $builder = $db->table('test_pregunta');
        $builder->select('*');
        $builder->where('test_pregunta.oid', $id_pregunta);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query[0];
    }

    public function buscar_encuesta_update($datos_busqueda){
        $db = \Config\Database::connect();
        $builder = $db->table('test');
        $builder->select('test.*');
        $builder->where('test.oid', $datos_busqueda['oid']);
        if ($datos_busqueda['oid_grupo'] != '0') $builder->where('test.oid_grupo', $datos_busqueda['oid_grupo']);

        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function editar_general($id_encuesta, $data){
        $db = \Config\Database::connect();
        $data = [
            'titulo' => $data['titulo'],
            'instrucciones' => $data['instrucciones']
        ];
        $builder = $db->table('test');
        $builder->where('oid', $id_encuesta);
        $response = $builder->update($data);
        return $response;
    }

    public function editar_pregunta($id_pregunta, $texto_pregunta){
        $db = \Config\Database::connect();
        $data = [
            'texto' => $texto_pregunta,
        ];
        $builder = $db->table('test_pregunta');
        $builder->where('oid', $id_pregunta);
        $response = $builder->update($data);
        
        return $response;
    }

    public function editar_opcion_pregunta($id_opcion, $correcta, $texto){
        $db = \Config\Database::connect();
        $data = [
            'texto' => $texto,
            'correcta' => $correcta
        ];
        $builder = $db->table('test_pregunta_opcion');
        $builder->where('oid', $id_opcion);
        $response = $builder->update($data);
        
        return $response;
    }

    public function eliminar_encuesta($id_encuesta){
        $db = \Config\Database::connect();
        $builder = $db->table('test');

        $builder->delete(['oid' => $id_encuesta]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function eliminar_pregunta($id_pregunta){
        $db = \Config\Database::connect();
        $builder = $db->table('test_pregunta');
        $builder->delete(['oid' => $id_pregunta]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
}
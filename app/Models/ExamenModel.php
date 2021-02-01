<?php namespace App\Models; 

use CodeIgniter\Model;

class ExamenModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'preguntas';
    protected $primaryKey = 'oid';

    protected $returnType     = 'array';

    protected $allowedFields = ['oid', 'preg_nombre', 'preg_activo'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function crear($datos){
        $db = \Config\Database::connect();
        $db->table('preguntas')->insert($datos);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function agregarRespuestas($id_examen, $id_respuesta){
        $db = \Config\Database::connect();
        $datos = [
            'oid_preguntas' => $id_examen,
            'oid_respuestas' => $id_respuesta
        ];
        $db->table('preguntas_respuestas')->insert($datos);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function getExamenes(){
        $db = \Config\Database::connect();
        $builder = $db->table('preguntas');
        $builder->select('*');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getRespuestas($id_examen){
        $db = \Config\Database::connect();
        $builder = $db->table('respuestas');
        $builder->select('*');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getIdRespuestas($id_examen){
        $db = \Config\Database::connect();
        $builder = $db->table('preguntas_respuestas');
        $builder->select('oid_respuestas');
        $builder->where('oid_preguntas', $id_examen);
        $builder->join('respuestas', 'respuestas.oid=preguntas_respuestas.oid_respuestas', 'left');
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

    public function buscarPreguntas($id_examen){
        $db = \Config\Database::connect();
        $builder = $db->table('preguntas_respuestas');
        $builder->select('*');
        $builder->where('oid_preguntas', $id_examen);
        $builder->join('respuestas', 'respuestas.oid=preguntas_respuestas.oid_respuestas', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getRespuesta($id_examen_r){
        $db = \Config\Database::connect();
        $builder = $db->table('preguntas_respuestas');
        $builder->select('*');
        $builder->where('preguntas_respuestas.oid', $id_examen_r);
        $builder->join('respuestas', 'respuestas.oid=preguntas_respuestas.oid_respuestas', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function eliminar($id_examen){
        $db = \Config\Database::connect();
        $builder = $db->table('preguntas');

        $builder->delete(['oid' => $id_examen]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function editar($dataForm){
        $db = \Config\Database::connect();
        $builder = $db->table('preguntas');
        $builder->where('oid', $dataForm['oid']);
        $response = $builder->update($dataForm);
        return $response;
    }

    public function editarActivo($dataForm){
        $db = \Config\Database::connect();
        $builder = $db->table('preguntas_respuestas');
        $builder->where('oid', $dataForm['oid']);
        $response = $builder->update($dataForm);
        return $response;
    }
}
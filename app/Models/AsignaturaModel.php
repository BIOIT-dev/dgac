<?php namespace App\Models;

use CodeIgniter\Model;

class AsignaturaModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'asignaturas';
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

    public function crear_asignatura($datos_asignatura){
        $db = \Config\Database::connect();
        $db->table('asignaturas')->insert($datos_asignatura);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function getasignaturas(){
        $db = \Config\Database::connect();
        $builder = $db->table('asignaturas');
        $builder->select('*');
        $builder->orderBy('nombre');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function listado_asignatura(){
        $db = \Config\Database::connect();
        $builder = $db->table('asignaturas');
        // var_dump($datos_busqueda);
        $builder->select('asignaturas.oid as oid,  carreras.nombre as carrera, asignaturas.asignatura as asignatura, asignaturas.sigla as sigla, asignaturas.semestre as semestre');
        // if ($datos_busqueda['nombre'] != '') $builder->like('asignaturas.nombre', $datos_busqueda['nombre']);
        // $builder->orderBy('usuario.apellido_paterno', 'ASC');
        // $builder->where('carreras.oid', 'asignaturas.carrera_oid');
        $builder->join('carreras', 'carreras.oid=asignaturas.carrera_oid', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function eliminar_asignatura($id_asignatura){
        $db = \Config\Database::connect();
        $builder = $db->table('asignaturas');

        $builder->delete(['oid' => $id_asignatura]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function editar_asignatura($datos_asignatura){
        $db = \Config\Database::connect();
        $builder = $db->table('asignaturas');
        
        $builder->where('oid', $datos_asignatura['oid']);
        $response = $builder->update($datos_asignatura);
        
        return $response;
    }
}
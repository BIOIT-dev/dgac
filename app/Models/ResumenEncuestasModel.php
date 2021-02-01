<?php namespace App\Models; 

use CodeIgniter\Model;

class ResumenEncuestasModel extends Model{
    protected $table      = 'indicadores_carreras';
    protected $primaryKey = 'oid';

    protected $returnType     = 'array';

    protected $allowedFields = ['oid'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    /******************************************************************/
    /******************************************************************/
    public function getResumenEncuestas($select, $anio, $semestre, $nivel_formacion, $carrera_oid, $asignatura, $docente){
        $db = \Config\Database::connect();
        $builder = $db->table('resumen_encuestas');
        $builder->select('ROUND(AVG('.$select.'), 2) as blk');
        $builder->where('anio_aplicacion', $anio);
        $builder->like('semestre', $semestre);
        if($nivel_formacion != FALSE)
            $builder->like('nivel_formacion', $nivel_formacion);
        if($carrera_oid != FALSE)
            $builder->like('carrera_oid', $carrera_oid);
        if($asignatura != FALSE)
            $builder->like('curso_oid', $asignatura);
        if($docente != FALSE)
            $builder->like('profesor_oid', $docente);
        $query   = $builder->get();
        $query = $query->getResult();
        $ratios = json_decode(json_encode($query),true);
        return $ratios[0];
    }

    public function getCarreras(){
        $db = \Config\Database::connect();
        $builder = $db->table('resumen_encuestas');
        $builder->select('carreras.oid, carreras.nombre');
        $builder->distinct();
        $builder->join('carreras', 'carreras.oid=resumen_encuestas.carrera_oid', 'left');
        $builder->orderBy('carreras.nombre');
        $query = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getCarreraTabla($carrera_oid){
        $db = \Config\Database::connect();
        $builder = $db->table('carreras');
        $builder->select('*');
        $builder->where('oid', $carrera_oid);
        $query = $builder->get();
        $query = $query->getResult();
        return $query[0];
    }

    public function getAsignaturas($carrera_oid){
        $db = \Config\Database::connect();
        $builder = $db->table('asignaturas');
        $builder->select('*, asignaturas.oid as as_oid');
        $builder->distinct();
        $builder->join('resumen_encuestas', 'resumen_encuestas.curso_oid= asignaturas.oid', 'left');
        $builder->where('resumen_encuestas.carrera_oid', $carrera_oid);
        $query = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getAsignaturaTabla($oid){
        $db = \Config\Database::connect();
        $builder = $db->table('asignaturas');
        $builder->select('*');
        $builder->where('oid', $oid);
        $query = $builder->get();
        $query = $query->getResult();
        return $query[0];
    }

    public function getDocentes($carrera_oid){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('*, usuario.oid');
        $builder->distinct();
        $builder->join('resumen_encuestas', 'resumen_encuestas.profesor_oid= usuario.oid', 'left');
        $builder->where('resumen_encuestas.carrera_oid', $carrera_oid);
        $query = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getDocenteTabla($oid){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('*');
        $builder->where('oid', $oid);
        $query = $builder->get();
        $query = $query->getResult();
        return $query[0];
    }
}
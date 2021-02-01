<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class GestionResumenEncuestasModel extends Model{
    protected $table      = 'periodos';
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

    public function getResumenEncuestas(){
        $db = \Config\Database::connect();
        $builder = $db->table('resumen_encuestas as re');
        $builder->select('re.oid as oid_re, g.nombre as nombre_grupo, c.nombre as nombre_carrera, u.nombres as nombre_profesor, u.apellido_paterno as apellido_profesor, a.asignatura as nombre_asignatura');
        $builder->join('grupo as g', 'g.oid = re.grupo_oid', 'left');
        $builder->join('carreras as c', 'c.oid = re.carrera_oid', 'left');
        $builder->join('usuario as u', 'u.oid = re.profesor_oid', 'left');
        $builder->join('asignaturas as a', 'a.oid = re.curso_oid', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getComunidades($estado_habilitar){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select('*');
        $builder->whereIn('grti_cod', ['1', '2']);
        if($estado_habilitar != 1)
            $builder->where('carrera >', 0);
        $builder->orderBy('nombre');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getCarrerasAll(){
        $db = \Config\Database::connect();
        $builder = $db->table('carreras');
        $builder->select('*');
        $builder->orderBy('nombre');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getCarreras($id_comunidad){
        $db = \Config\Database::connect();
        $builder = $db->table('carreras');
        $builder->select('carreras.oid as carrera_id, carreras.nombre as carrera_nombre');
        $builder->join('grupo', 'grupo.carrera=carreras.oid', 'left');
        $builder->where('grupo.oid', $id_comunidad);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getSemestres($id_carrera){
        $db = \Config\Database::connect();
        $builder = $db->table('asignaturas');
        $builder->select('semestre');
        $builder->distinct();
        $builder->where('carrera_oid', $id_carrera);
        $builder->orderBy('semestre_order');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getAsignaturas($semestre, $id_carrera, $estado_habilitar){
        $db = \Config\Database::connect();
        $builder = $db->table('asignaturas');
        $builder->select('*');
        if($estado_habilitar != 1)
            $builder->join('curso', 'curso.asignatura_oid = asignaturas.oid', 'left');
        $builder->where('semestre', $semestre);
        $builder->where('carrera_oid', $id_carrera);
        $builder->distinct();
        $builder->orderBy('asignatura');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function profesores_grupo($id_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('curso c');
        $builder->select('c.oid');
        $builder->join('grupo', 'grupo.oid=c.oid_grupo', 'left');
        $builder->where('grupo.oid', $id_grupo);
        $query   = $builder->get();
        $query = $query->getResult();
        $respuestas = array();
        foreach($query as $q){
            array_push($respuestas, $q->oid);
        }
        return $respuestas; // retorna array con los id's de sedes agregadas al periodo
    }

    public function getProfesoresQuery($id_comunidad){
        $db = \Config\Database::connect();
        $builder = $db->table('curso c');
        $builder->select('
            c.oid, c.titulo, c.inactivo,
            c.oid_profesor, u.nombres, u.apellidos, u.sexo, u.email,
            c.oid_profesor2, u2.nombres as nombres2, u2.apellidos as apellidos2, u2.sexo as sexo2, u2.email as email2,
            c.oid_profesor3, u3.nombres as nombres3, u3.apellidos as apellidos3, u3.sexo as sexo3, u3.email as email3,
            c.oid_profesor4, u4.nombres as nombres4, u4.apellidos as apellidos4, u4.sexo as sexo4, u4.email as email4,
            c.oid_profesor5, u5.nombres as nombres5, u5.apellidos as apellidos5, u5.sexo as sexo5, u5.email as email5,
            c.oid_profesor6, u6.nombres as nombres6, u6.apellidos as apellidos6, u6.sexo as sexo6, u6.email as email6,
            c.oid_profesor7, u7.nombres as nombres7, u7.apellidos as apellidos7, u7.sexo as sexo7, u7.email as email7,
            c.oid_profesor8, u8.nombres as nombres8, u8.apellidos as apellidos8, u8.sexo as sexo8, u8.email as email8,
            c.oid_profesor9, u9.nombres as nombres9, u9.apellidos as apellidos9, u9.sexo as sexo9, u9.email as email9,
            c.oid_profesor10, u10.nombres as nombres10, u10.apellidos as apellidos10, u10.sexo as sexo10, u10.email as email10
        ');
        $builder->join('usuario u', 'u.oid=c.oid_profesor', 'left');
        $builder->join('usuario u2', 'u2.oid=c.oid_profesor2', 'left');
        $builder->join('usuario u3', 'u3.oid=c.oid_profesor3', 'left');
        $builder->join('usuario u4', 'u4.oid=c.oid_profesor4', 'left');
        $builder->join('usuario u5', 'u5.oid=c.oid_profesor5', 'left');
        $builder->join('usuario u6', 'u6.oid=c.oid_profesor6', 'left');
        $builder->join('usuario u7', 'u7.oid=c.oid_profesor7', 'left');
        $builder->join('usuario u8', 'u8.oid=c.oid_profesor8', 'left');
        $builder->join('usuario u9', 'u9.oid=c.oid_profesor9', 'left');
        $builder->join('usuario u10', 'u10.oid=c.oid_profesor10', 'left');
        $respuestas = $this->profesores_grupo($id_comunidad);//
        if($respuestas!=array()){
            $builder->whereIn('c.oid', $respuestas);
        };
        $query   = $builder->get();
        $query = $query->getResult();

        $arrayId= array();
        foreach($query as $r){
            if($r->oid_profesor!=0)
                array_push($arrayId,(int)$r->oid_profesor);
            if($r->oid_profesor2!=0)
                array_push($arrayId,(int)$r->oid_profesor2);
            if($r->oid_profesor3!=0)
                array_push($arrayId,(int)$r->oid_profesor3);
            if($r->oid_profesor4!=0)
                array_push($arrayId,(int)$r->oid_profesor4);
            if($r->oid_profesor5!=0)
                array_push($arrayId,(int)$r->oid_profesor5);
            if($r->oid_profesor6!=0)
                array_push($arrayId,(int)$r->oid_profesor6);
            if($r->oid_profesor7!=0)
                array_push($arrayId,(int)$r->oid_profesor7);
            if($r->oid_profesor8!=0)
                array_push($arrayId,(int)$r->oid_profesor8);
            if($r->oid_profesor9!=0)
                array_push($arrayId,(int)$r->oid_profesor9);
            if($r->oid_profesor10!=0)
                array_push($arrayId,(int)$r->oid_profesor10);
        }
        return $arrayId;
    }

    public function getProfesores($id_comunidad){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('*');
        // $respuestas = $this->getProfesoresQuery($id_comunidad);//
        // if($respuestas!=array()){
        $builder->whereIn('usuario.oid', $this->getProfesoresQuery($id_comunidad));
        // };
        $builder->orderBy('nombres');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function crear_resumen_enc($datos){
        $db = \Config\Database::connect();
        $db->table('resumen_encuestas')->insert($datos);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
    /******************************************************************/
    public function eliminar_resumen($id){
        $db = \Config\Database::connect();
        $builder = $db->table('resumen_encuestas');
        $builder->delete(['oid' => $id]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
}
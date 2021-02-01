<?php namespace App\Models;

use CodeIgniter\Model;

class AdmisionCarreraModel extends Model
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

    public function agregar_examen($id_pregunta, $id_comunidad){
        $db = \Config\Database::connect();
        $data = [
            'oid_preguntas' => $id_pregunta,
            'oid_grupos'  => $id_comunidad
        ];
        $db->table('grupos_preguntas')->insert($data);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
    /******************************************************************/
    public function obtenerCarrera($grupo_id){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select('*');
        $builder->where('grupo.oid', $grupo_id);
        $query   = $builder->get();
        $query = $query->getResult();
        $carrera = json_decode(json_encode($query),true);
        // foreach($query as $q){
        //     array_push($carrera, $q->oid);
        // }
        return $carrera[0]; // retorna array con los id's de profesores agregados a la carrera
    }

    public function agregar_carrera($datos_carrera){
        $datos_padre = $this->obtenerCarrera($datos_carrera['oid_grupo']);
        $datos_padre['oid'] = NULL;
        $datos_padre['nombre'] = $datos_carrera['nombre'];
        $datos_padre['grti_cod'] = "1";
        $datos_padre['oid_padre'] = $datos_carrera['oid_grupo'];
        // var_dump($datos_padre);
        // return;
        $db = \Config\Database::connect();

        $db->table('grupo')->insert($datos_padre);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
    /******************************************************************/
    public function getAdmisionCarrera($data_busqueda){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select('*');
        $builder->where('grupo.oid_periodos', $data_busqueda['oid_periodo']);
        $builder->where('grupo.grti_cod', '3');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function getExamenes($id_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('grupos_preguntas');
        $builder->select('*, grupos_preguntas.oid as grupos_preguntas_id');
        $builder->where('grupos_preguntas.oid_grupos', $id_grupo);
        $builder->join('preguntas', 'preguntas.oid=grupos_preguntas.oid_preguntas', 'left');
        $builder->orderBy('grupos_preguntas_id');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function examenes_agregados($id_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('grupos_preguntas');
        $builder->select('*');
        $builder->where('grupos_preguntas.oid_grupos', $id_grupo);
        $query   = $builder->get();
        $query = $query->getResult();
        $examenes_agregados = array();
        foreach($query as $q){
            array_push($examenes_agregados, $q->oid_preguntas);
        }
        return $examenes_agregados; // retorna array con los id's de exámanes agregados
    }

    public function getAllExamenes($id_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('preguntas');
        $builder->select('*');
        $exam_agregados = $this->examenes_agregados($id_grupo);//trae los exámenes agregados
        if($exam_agregados!=array()){
            $builder->whereNotIn('preguntas.oid', $this->examenes_agregados($id_grupo));
        };
        $builder->where('preguntas.preg_activo', 0);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function buscar_carrera($datos_busqueda){
        $db = \Config\Database::connect();
        $builder = $db->table('carreras');
        $builder->select('*');
        if ($datos_busqueda['nombre'] != '') $builder->like('carreras.nombre', $datos_busqueda['nombre']);
        // $builder->orderBy('usuario.apellido_paterno', 'ASC');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getCarreras($id_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select('oid, nombre, horas, duracion, inactivo');
        $builder->where('grupo.oid_padre', $id_grupo);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getPostulantes($id_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('postulaciones');
        $builder->select('*, postulaciones.oid as postulacion_oid');
        $builder->where('postulaciones.oid_grupo', $id_grupo);
        $builder->where('postulaciones.oid_poes !=', '9');
        $builder->join('usuario', 'usuario.oid=postulaciones.oid_usuario', 'left');
        $builder->join('postulacion_estados', 'postulacion_estados.oid=postulaciones.oid_poes', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getMatriculados($id_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('postulaciones');
        $builder->select('*, postulaciones.oid as postulacion_oid');
        $builder->where('postulaciones.oid_grupo', $id_grupo);
        $builder->where('postulaciones.oid_poes', '6');
        $builder->join('usuario', 'usuario.oid=postulaciones.oid_usuario', 'left');
        $builder->join('postulacion_estados', 'postulacion_estados.oid=postulaciones.oid_poes', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function eliminar_examen($id_grupos_preguntas){
        $db = \Config\Database::connect();
        $builder = $db->table('grupos_preguntas');
        $builder->where('oid', $id_grupos_preguntas);
        $builder->delete();
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function eliminar_carrera($id_carrera){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->where('oid', $id_carrera);
        $builder->delete();
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
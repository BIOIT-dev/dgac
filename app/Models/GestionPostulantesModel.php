<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class GestionPostulantesModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'postulaciones_examenes';
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

    /******************************************************************/
    public function getExamPostulacion($id_postulacion){//Exámenes evaluados
        $db = \Config\Database::connect();
        $builder = $db->table('postulaciones_examenes');
        $builder->select('*, postulaciones_examenes.oid as oid_pe, grupos_preguntas.oid as oid_gp, respuestas.oid as oid_resp, preguntas.oid as oid_preg');
        $builder->where('postulaciones_examenes.oid_postulaciones', $id_postulacion);
        $builder->join('grupos_preguntas', 'grupos_preguntas.oid=postulaciones_examenes.oid_grpr', 'left');
        $builder->join('respuestas', 'respuestas.oid=postulaciones_examenes.oid_respuestas', 'left');
        $builder->join('preguntas', 'preguntas.oid=grupos_preguntas.oid_preguntas', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function examPostulacionAgregados($id_postulacion){
        $db = \Config\Database::connect();
        $builder = $db->table('postulaciones_examenes');
        $builder->select('*');
        $builder->where('postulaciones_examenes.oid_postulaciones', $id_postulacion);
        
        $query   = $builder->get();
        $query = $query->getResult();
        $post_agregadas = array();
        foreach($query as $q){
            array_push($post_agregadas, $q->oid_grpr);
        }
        return $post_agregadas; // retorna array con los id's de postulaciones evaluados
    }
    public function getPendPostulacion($id_postulacion, $id_grupo){ //postulaciones pendientes
        $db = \Config\Database::connect();
        $builder = $db->table('grupos_preguntas');
        $builder->select('*, grupos_preguntas.oid as oid_gp');
        
        $builder->where('grupos_preguntas.oid_grupos', $id_grupo);
        $post_agregadas = $this->examPostulacionAgregados($id_postulacion);//trae los profesores agregados
        if($post_agregadas!=array()){
            $builder->whereNotIn('grupos_preguntas.oid', $this->examPostulacionAgregados($id_postulacion));
        };
        $builder->join('preguntas', 'preguntas.oid=grupos_preguntas.oid_preguntas', 'left');
        // $builder->join('postulaciones_examenes', 'postulaciones_examenes.oid_grpr=grupos_preguntas.oid', 'left');
        // $builder->join('respuestas', 'respuestas.oid=postulaciones_examenes.oid_respuestas', 'left');
        
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function getInfoPostulacion($id_postulacion){
        $db = \Config\Database::connect();
        $builder = $db->table('postulaciones');
        $builder->select('*');
        $builder->where('postulaciones.oid', $id_postulacion);
        $builder->join('usuario', 'usuario.oid=postulaciones.oid_usuario', 'left');
        $builder->join('sedes', 'sedes.oid=postulaciones.oid_sedes', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return json_decode(json_encode($query[0]), true);
    }
    /******************************************************************/
    public function getComprobantes($id_postulacion){
        $db = \Config\Database::connect();
        $builder = $db->table('postulaciones_archivos');
        $builder->select('*, postulaciones_archivos.oid as oid_pa');
        $builder->where('postulaciones_archivos.oid_postulaciones', $id_postulacion);
        $builder->join('tipos_archivos', 'tipos_archivos.oid=postulaciones_archivos.poar_tipo', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function agregar_profesor($id_usuario, $id_comunidad){
        $db = \Config\Database::connect();
        $data = [
            'oid_usuario' => $id_usuario,
            'oid_grupo'  => $id_comunidad,
            'rol'  => 'PRO'
        ];
        $db->table('usuario_grupo')->insert($data);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
    /******************************************************************/
    public function agregar_curso($dataForm){
        $db = \Config\Database::connect();
        $db->table('curso')->insert($dataForm);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
    /******************************************************************/
    public function agregar_historial($dataForm){
        $db = \Config\Database::connect();
        $db->table('historial_alumnos')->insert($dataForm);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
    /******************************************************************/
    public function getCarrerasPeriodo($id_periodo){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select('*');
        $builder->where('grupo.oid_periodos', $id_periodo);
        $builder->where('grupo.grti_cod', '3');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function getCursos($id_comunidad){
        $db = \Config\Database::connect();
        $builder = $db->table('curso');
        $builder->select('curso.oid, curso.titulo, curso.curs_coeficiente, curso.curs_horas, curso.semestre, curso.ponderacion,
        (  
            select concat(usuario.nombres, " " ,usuario.apellido_paterno)
            from usuario
            where usuario.oid=curso.oid_profesor ) as nombreProfesor'
        );
        $builder->where('curso.oid_grupo', $id_comunidad);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function getCursoEditar($id_curso){
        $db = \Config\Database::connect();
        $builder = $db->table('curso');
        $builder->select('*');
        $builder->where('curso.oid', $id_curso);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function getGrupoClasificacion(){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo_clasificacion');
        $builder->select('*');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function getPostulantes($id_grupo, $id_poes){
        $db = \Config\Database::connect();
        $builder = $db->table('postulaciones');
        $builder->select('*, postulaciones.oid as postulacion_oid');
        $builder->where('postulaciones.oid_grupo', $id_grupo);
        $builder->where('postulaciones.oid_poes', $id_poes);
        $builder->join('usuario', 'usuario.oid=postulaciones.oid_usuario', 'left');
        $builder->join('postulacion_estados', 'postulacion_estados.oid=postulaciones.oid_poes', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function getProfesores($id_comunidad){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario_grupo');
        $builder->select('*');
        $builder->where('usuario_grupo.oid_grupo', $id_comunidad);
        $builder->where('usuario_grupo.rol', "PRO");
        $builder->join('usuario', 'usuario.oid=usuario_grupo.oid_usuario', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function profesores_agregados($id_comunidad){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario_grupo');
        $builder->select('usuario_grupo.oid_usuario');
        $builder->where('usuario_grupo.oid_grupo', $id_comunidad);
        $builder->where('usuario_grupo.rol', "PRO");
        $builder->join('usuario', 'usuario.oid=usuario_grupo.oid_usuario', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        $profesores_agregados = array();
        foreach($query as $q){
            array_push($profesores_agregados, $q->oid_usuario);
        }
        return $profesores_agregados; // retorna array con los id's de profesores agregados a la carrera
    }

    public function getAllProfesores($id_comunidad){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario_grupo');
        $builder->select('*');
        $builder->where('usuario_grupo.oid_grupo', "19");// 19 es el id de Comunidad de Profesores de la Escuela Técnica Aeronáutica
        $builder->where('usuario_grupo.rol', "PRO");
        $prof_agregados = $this->profesores_agregados($id_comunidad);//trae los profesores agregados
        if($prof_agregados!=array()){
            $builder->whereNotIn('usuario_grupo.oid_usuario', $this->profesores_agregados($id_comunidad));
        };
        $builder->join('usuario', 'usuario.oid=usuario_grupo.oid_usuario', 'left');
        $builder->where('usuario.inactivo', 0);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getGrupo($id_comunidad){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select('carrera, duracion, horas');
        $builder->where('grupo.oid', $id_comunidad);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getAsignaturas($id_comunidad){
        $db = \Config\Database::connect();
        $builder = $db->table('asignaturas');
        $builder->select('*');
        $builder->where('asignaturas.carrera_oid', $this->getGrupo($id_comunidad)[0]->carrera);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getRespuestas($id_pregunta){
        $db = \Config\Database::connect();
        $builder = $db->table('grupos_preguntas');
        $builder->select('*, respuestas.oid as id_respuestas');
        
        $builder->where('grupos_preguntas.oid', $id_pregunta);
        $builder->join('preguntas_respuestas', 'preguntas_respuestas.oid_preguntas=grupos_preguntas.oid_preguntas', 'left');
        $builder->join('preguntas', 'preguntas.oid=grupos_preguntas.oid_preguntas', 'left');
        $builder->join('respuestas', 'respuestas.oid=preguntas_respuestas.oid_respuestas', 'left');

        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function editar_exam_postulacion($id_exam_postulacion, $dataForm){
        $db = \Config\Database::connect();
        $builder = $db->table('postulaciones_examenes');
        $builder->where('oid', $id_exam_postulacion);
        $response = $builder->update($dataForm);
        return $response;
    }
    /******************************************************************/
    public function agregarExamen($data){
        $db = \Config\Database::connect();
        $db->table('postulaciones_examenes')->insert($data);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
    /******************************************************************/
    public function editarEstado($id_postulacion, $id_estado){
        $db = \Config\Database::connect();
        $data = [
            'oid_poes' => $id_estado
        ];
        $builder = $db->table('postulaciones');
        $builder->where('oid', $id_postulacion);
        $response = $builder->update($data);
        return $response;
    }

    public function cambiar_vigencia($id_exam_postulacion){
        $db = \Config\Database::connect();
        $builder = $db->table('postulaciones_examenes');
        $builder->delete(['oid' => $id_exam_postulacion]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function cargarCarreras($oid_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select('*');
        $builder->where('oid_padre', $oid_grupo);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function cargarCarrerasExist($oid_usuario, $oid_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario_grupo');
        $builder->select('grupo.oid');
        $builder->where('oid_usuario', $oid_usuario);
        $builder->join('grupo', 'grupo.oid=usuario_grupo.oid_grupo', "left");
        $builder->where('oid_padre', $oid_grupo);
        $query   = $builder->get();
        $query = $query->getResult();
        $carreras_exist = array();
        foreach($query as $q){
            array_push($carreras_exist, $q->oid);
        }
        return $carreras_exist;
    }

    public function matricular($id_usuario, $id_comunidad){
        $db = \Config\Database::connect();
        $data = [
            'oid_usuario' => $id_usuario,
            'oid_grupo'  => $id_comunidad,
            'rol'  => 'ALU'
        ];
        $db->table('usuario_grupo')->insert($data);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function obtenerCarreraMatriculado($oid_usuario, $oid_grupo_padre){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario_grupo');
        $builder->select('nombre');
        $builder->where('oid_usuario', $oid_usuario);
        $builder->whereIN('oid_grupo', $oid_grupo_padre);
        $builder->join('grupo', 'grupo.oid=usuario_grupo.oid_grupo', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function updatePostulacion($id_postulacion, $datos){
        $db = \Config\Database::connect();
        $builder = $db->table('postulaciones');
        $builder->where('oid', $id_postulacion);
        $response = $builder->update($datos);
        return $response;
    }
    
}
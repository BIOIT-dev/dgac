<?php namespace App\Models;

use CodeIgniter\Model;

class PostulacionesModel extends Model
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

    public function getGrupos($periodo_id){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select('*');
        $builder->where('grti_cod', "3");
        $builder->where('oid_periodos', $periodo_id);
        $builder->where('inactivo', "0");
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getPeriodos(){
        $db = \Config\Database::connect();
        $builder = $db->table('periodos');
        $builder->select('*');
        $builder->where('peri_activo', "1");
        $builder->orderBy('peri_nombre');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getUsuario($userid){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('*');
        $builder->where('userid', $userid);
        $query   = $builder->get();
        $query = $query->getResult();
        $usuario = json_decode(json_encode($query),true);
        try {
            return $usuario[0];
        }catch (\Exception $e){
            return [];
        }
    }

    public function getGrupo($grupo_oid){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select('*');
        $builder->where('oid', $grupo_oid);
        $query   = $builder->get();
        $query = $query->getResult();
        $grupo = json_decode(json_encode($query),true);
        try {
            return $grupo[0];
        }catch (\Exception $e){
            return [];
        }
    }
    public function getTiposArchivo(){
        $db = \Config\Database::connect();
        $builder = $db->table('tipos_archivos');
        $builder->select('*');
        $builder->where('vige_cod', '0');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getSedes($periodo_id){
        $db = \Config\Database::connect();
        $builder = $db->table('sedes_periodos');
        $builder->select('*');
        $builder->join('sedes', 'sedes.oid=sedes_periodos.oid_sedes', 'left');
        $builder->join('periodos', 'periodos.oid=sedes_periodos.oid_periodos', 'left');
        $builder->where('oid_periodos', $periodo_id);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    
    public function crearUsuario($datos_usuario){
        try {
            $db = \Config\Database::connect();
            $db->table('usuario')->insert($datos_usuario);
            if ($db->affectedRows() > 0){
                return TRUE;
            }else {
                return FALSE;
            }
        }catch (\Exception $e){
            return FALSE;
        }
    }

    public function getIdUsuario($userid){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('*');
        $builder->where('userid', $userid);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function updateUsuario($usuario_id, $datos_usuario){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->where('oid', $usuario_id);
        $response = $builder->update($datos_usuario);
        return $response;
    }

    public function insertPostulacion($datos_postulacion){
        try {
            $db = \Config\Database::connect();
            $db->table('postulaciones')->insert($datos_postulacion);
            if ($db->affectedRows() > 0){
                return $db->insertID();
            }else {
                return FALSE;
            }
        }catch (\Exception $e){
            return FALSE;
        }
    }

    public function insertPostulacionInit($id_grupo, $id_usuario){
        try {
            $db = \Config\Database::connect();
            $datos_postulacion = [
                'oid_grupo' => $id_grupo,
                'oid_usuario'  => $id_usuario
            ];
            $db->table('postulaciones')->insert($datos_postulacion);
            if ($db->affectedRows() > 0){
                return $db->insertID();
            }else {
                return FALSE;
            }
        }catch (\Exception $e){
            return FALSE;
        }
    }

    public function insertPostulacionArchivo($id_postulacion, $tipoArchivo, $objetoArchivo){
        try {
            $db = \Config\Database::connect();
            $nombreArchivo = str_replace(" ", "_", $objetoArchivo->getName());
            $datos_postulacion = [
                'oid_postulaciones' => $id_postulacion,
                'poar_tipo'  => $tipoArchivo,
                'name' => $nombreArchivo,
                'type' => $objetoArchivo->getMimeType(),
                'size' => $objetoArchivo->getSize('kb'),
                'created' => date("Y-m-d H:i:s")
            ];
            var_dump($datos_postulacion);
            $db->table('postulaciones_archivos')->insert($datos_postulacion);
            if ($db->affectedRows() > 0){
                return $db->insertID();
            }else {
                return FALSE;
            }
        }catch (\Exception $e){
            return FALSE;
        }
    }

    public function getCantCarreras($oid_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select('periodos.peri_carreras_postular');
        $builder->where('grupo.oid', $oid_grupo);
        $builder->join('periodos', 'periodos.oid=grupo.oid_periodos', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query[0];
    }

    public function getCantPostulaciones($oid_usuario, $oid_periodo){
        $db = \Config\Database::connect();
        $builder = $db->table('postulaciones');
        $builder->selectCount('postulaciones.oid');
        // $builder->countAllResults();
        $builder->where('oid_usuario', $oid_usuario);
        // $builder->where('oid_grupo', $oid_grupo);
        $builder->join('grupo', 'grupo.oid=postulaciones.oid_grupo', 'left');
        $builder->where('grupo.oid_periodos', $oid_periodo);
        // $builder->join('periodos', 'periodos.oid='.$oid_periodo, 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query[0];
    }

    public function getPeriodoGrupo($oid_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select('periodos.oid');
        $builder->where('grupo.oid', $oid_grupo);
        $builder->join('periodos', 'periodos.oid=grupo.oid_periodos', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query[0];
    }

    public function validarCarrera($oid_grupo, $oid_usuario){
        $db = \Config\Database::connect();
        $builder = $db->table('postulaciones');
        $builder->selectCount('oid');
        $builder->where('postulaciones.oid_grupo', $oid_grupo);
        $builder->where('postulaciones.oid_usuario', $oid_usuario);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query[0];
    }

    public function getPostulacion($oid_grupo, $oid_usuario){
        $db = \Config\Database::connect();
        $builder = $db->table('postulaciones');
        $builder->select('*');
        $builder->where('postulaciones.oid_grupo', $oid_grupo);
        $builder->where('postulaciones.oid_usuario', $oid_usuario);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query[0];
    }

    public function getPostulacionArchivos($oid_postulacion, $tipo){
        $db = \Config\Database::connect();
        $builder = $db->table('postulaciones_archivos');
        $builder->select('name, oid');
        $builder->where('postulaciones_archivos.oid_postulaciones', $oid_postulacion);
        $builder->where('postulaciones_archivos.poar_tipo', $tipo);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function updatePostulacion($oid_postulacion, $datos_postulacion){
        $db = \Config\Database::connect();
        $builder = $db->table('postulaciones');
        $builder->where('oid', $oid_postulacion);
        $response = $builder->update($datos_postulacion);
        // if ($db->affectedRows() > 0){
        //     return $db->insertID();
        // }else {
        //     return FALSE;
        // }
        return $response;
    }

    public function deletePostulacionArchivo($id_postulacion){
        $db = \Config\Database::connect();
        $builder = $db->table('postulaciones_archivos');
        $builder->where('oid', $id_postulacion);
        $builder->delete();
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
















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
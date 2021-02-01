<?php namespace App\Models; 

use CodeIgniter\Model;

class GestionAlumnosModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'usuario';
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

    public function buscarUsuario($datos_busqueda){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('*, usuario.oid as usuario_id');
        if($datos_busqueda['rut'] != ""){
            $builder->where('rut', $datos_busqueda['rut']);
        }
        if(isset($datos_busqueda['apellido_paterno']) && $datos_busqueda['apellido_paterno'] != ""){
            $builder->like('apellido_paterno', $datos_busqueda['apellido_paterno']);
        }
        if(isset($datos_busqueda['apellido_materno']) && $datos_busqueda['apellido_materno'] != ""){
            $builder->like('apellido_materno', $datos_busqueda['apellido_materno']);
        }
        
        $builder->join('usuario_grupo', 'usuario_grupo.oid_usuario=usuario.oid', 'left');
        $builder->where('usuario_grupo.rol', 'ALU');
        $builder->join('grupo', 'grupo.oid=usuario_grupo.oid_grupo', 'left');
        $builder->where('grupo.grti_cod', '1');
        $builder->where('grupo.inactivo', '0');
        $query   = $builder->get();
        $query = $query->getResult();
        $usuario = json_decode(json_encode($query),true);
        if(empty($usuario)){
            return array();
        }
        return $usuario[0];
    }

    public function buscarCarreras($datos_busqueda, $id_usuario, $rol){
        $db = \Config\Database::connect();
        
        // Sub consulta del último estado de la carrera
        $estado = 'SELECT esal_nombre as estado FROM `historial_alumnos`
LEFT JOIN estados_alumnos ON estados_alumnos.oid=historial_alumnos.oid_esal
LEFT JOIN semestres ON semestres.oid=historial_alumnos.oid_semestre
WHERE historial_alumnos.oid_usuario = '.$id_usuario.' AND historial_alumnos.oid_grupo = grupo.oid
ORDER BY historial_alumnos.oid DESC
LIMIT 1';
        
        // Sub consulta del último semestre de la carrera
        $semestre = 'SELECT semestres.nombre as semestre FROM `historial_alumnos`
LEFT JOIN estados_alumnos ON estados_alumnos.oid=historial_alumnos.oid_esal
LEFT JOIN semestres ON semestres.oid=historial_alumnos.oid_semestre
WHERE historial_alumnos.oid_usuario = '.$id_usuario.' AND historial_alumnos.oid_grupo = grupo.oid
ORDER BY historial_alumnos.oid DESC
LIMIT 1';
        
        $builder = $db->table('grupo');
        $builder->select('*, ('.$estado.') as estado_carrera, ('.$semestre.') as semestre_carrera');
        if($rol != "FUN"){
			$builder->where('grupo.grti_cod', '1');
		}else{
			$builder->whereIn('grupo.grti_cod', array(1, 2));
		}
        $builder->where('grupo.inactivo', '0');
        $builder->join('usuario_grupo', 'usuario_grupo.oid_grupo=grupo.oid', 'left');
        $builder->where('usuario_grupo.oid_usuario', $id_usuario);
        if($rol != "FUN"){
			$builder->where('usuario_grupo.rol', $rol);
		}else{
			$builder->whereNotIn('usuario_grupo.rol', array("ALU", "PRO"));
		}
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function buscarAsignaturas($id_usuario, $rol){
        $db = \Config\Database::connect();
        $builder = $db->table('curso');
        $builder->select('curso.oid_grupo, usuario_grupo.oid_usuario, grupo.nombre as nombre_grupo, curso.oid, curso.titulo, curso.curs_horas, periodos.peri_nombre, curso.finicio, curso.ftermino');
        $builder->join('grupo', 'grupo.oid=curso.oid_grupo', 'left');
        $builder->join('usuario_grupo', 'usuario_grupo.oid_grupo=grupo.oid', 'left');
        $builder->join('periodos', 'periodos.oid=grupo.oid_periodos', 'left');
        if($rol != "FUN"){
			$builder->where('grupo.grti_cod', '1');
		}else{
			$builder->whereIn('grupo.grti_cod', array(1, 2));
		}
        $builder->where('grupo.inactivo', '0');
        if($rol != "FUN"){
			$builder->where('usuario_grupo.rol', $rol);
		}else{
			$builder->whereNotIn('usuario_grupo.rol', array("ALU", "PRO"));
		}
        $builder->where('usuario_grupo.oid_usuario', $id_usuario);
        //~ $builder->groupBy('asignaturas.asignatura');
        $builder->orderBy('nombre_grupo, curso.oid', 'DESC');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function buscarHistorial($usuario_id, $grupo_id){
        $db = \Config\Database::connect();
        $builder = $db->table('historial_alumnos');
        $builder->select('*, historial_alumnos.oid as oid_ha');
        $builder->where('historial_alumnos.oid_usuario', $usuario_id);
        $builder->where('historial_alumnos.oid_grupo', $grupo_id);
        $builder->join('estados_alumnos', 'estados_alumnos.oid=historial_alumnos.oid_esal', 'left');
        $builder->join('semestres', 'semestres.oid=historial_alumnos.oid_semestre', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function buscarNotas($usuario_id, $grupo_id, $curso_id){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_evaluacion_alumno');
        $builder->select('curso.titulo as titulo_curso, curso.descripcion as descripcion_curso, curso_evaluacion.titulo as titulo_evaluacion, curso_evaluacion_alumno.nota, curso_evaluacion_alumno.fecha');
        $builder->join('curso_evaluacion', 'curso_evaluacion.oid=curso_evaluacion_alumno.oid_evaluacion', 'left');
        $builder->join('curso', 'curso.oid=curso_evaluacion.oid_curso', 'left');
        $builder->where('curso_evaluacion_alumno.oid_usuario', $usuario_id);
        $builder->where('curso.oid_grupo', $grupo_id);
        $builder->where('curso.oid', $curso_id);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function buscarAsistencias($usuario_id, $grupo_id, $curso_id){
        $db = \Config\Database::connect();
        $builder = $db->table('asistencia_usuarios');
        $builder->select('asistencia.oid, asistencia.asis_fecha, asistencia.asis_horas, asistencia_usuarios.asus_presente, asistencia_usuarios.asus_atrasado');
        $builder->join('asistencia', 'asistencia.oid=asistencia_usuarios.oid_asistencia', 'left');
        $builder->join('curso', 'curso.oid=asistencia.oid_cursos', 'left');
        $builder->where('asistencia_usuarios.oid_usuario', $usuario_id);
        $builder->where('curso.oid_grupo', $grupo_id);
        $builder->where('asistencia.oid_cursos', $curso_id);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function buscarComprobantes($usuario_id, $grupo_id){
        $db = \Config\Database::connect();
        $builder = $db->table('postulaciones_archivos');
        $builder->select('*, postulaciones_archivos.oid as oid_pa');
        $builder->join('postulaciones', 'postulaciones.oid=postulaciones_archivos.oid_postulaciones', 'left');
        $builder->join('tipos_archivos', 'tipos_archivos.oid=postulaciones_archivos.poar_tipo', 'left');
        $builder->where('postulaciones.oid_usuario', $usuario_id);
        $builder->where('postulaciones.oid_grupo', $grupo_id);
        $builder->orderBy('oid_pa', 'ASC');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function buscarActaCurso($usuario_id, $grupo_id, $curso_id){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_acta');
        $builder->select('grupo.nombre as nombre_grupo, curso.titulo as titulo_curso, usuario.nombres, curso_acta.promedio');
        $builder->join('usuario', 'usuario.oid=curso_acta.oid_usuario', 'left');
        $builder->join('curso', 'curso.oid=curso_acta.oid_curso', 'left');
        $builder->join('grupo', 'curso.oid_grupo=grupo.oid', 'left');
        $builder->where('curso_acta.oid_usuario', $usuario_id);
        $builder->where('curso.oid_grupo', $grupo_id);
        $builder->where('curso_acta.oid_curso', $curso_id);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    
    public function buscarEncuestaData($encuesta_id){
        $db = \Config\Database::connect();
        $builder = $db->table('encuesta e');
        $select = 'e.oid as oid_encuesta, e.titulo as titulo_encuesta, t.titulo as titulo_test, ';
        $select .= 'e.agno, s.nombre as nombre_semestre, g.nombre as nombre_grupo, c.titulo as titulo_curso, ';
        $select .= 'e.f_desde, e.f_hasta, e.porcentaje ';
        $builder->select($select);
        $builder->join('test t', 't.oid=e.oid_test', 'left');
        $builder->join('semestres s', 's.oid=e.semestre', 'left');
        $builder->join('grupo g', 'g.oid=e.oid_grupo', 'left');
        $builder->join('curso c', 'c.oid=e.oid_curso', 'left');
        $builder->where('e.oid', $encuesta_id);
        $query   = $builder->get();
        $query = $query->getRow();
        return $query;
    }
    
    public function buscarEncuestas($usuario_id){
        $db = \Config\Database::connect();
        $builder = $db->table('encuesta e');
        $select = 'e.oid as oid_encuesta, e.titulo as titulo_encuesta, t.titulo as titulo_test, ';
        $select .= 'e.agno, s.nombre as nombre_semestre, g.nombre as nombre_grupo, c.titulo as titulo_curso, ';
        $select .= 'e.f_desde, e.f_hasta, e.porcentaje ';
        $builder->select($select);
        $builder->join('test t', 't.oid=e.oid_test', 'left');
        $builder->join('semestres s', 's.oid=e.semestre', 'left');
        $builder->join('grupo g', 'g.oid=e.oid_grupo', 'left');
        $builder->join('curso c', 'c.oid=e.oid_curso', 'left');
        $builder->where('e.oid_profesor', $usuario_id);
        $builder->where('e.disponible', 1);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    
    public function buscarEncuestaDetalle($encuesta_id){
        $db = \Config\Database::connect();
        $builder = $db->table('encuesta_usuario e_u');
        $select = 'e_u.oid, p.preg_nombre, r.resp_nombre, e_u.txt_respuesta';
        $builder->select($select);
        $builder->join('encuesta e', 'e.oid=e_u.oid_encuesta', 'left');
        $builder->join('preguntas p', 'p.oid=e_u.oid_pregunta', 'left');
        $builder->join('respuestas r', 'r.oid=e_u.oid_respuesta', 'left');
        $builder->where('e_u.oid_encuesta', $encuesta_id);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function buscarPagos($usuario_id){
        $db = \Config\Database::connect();
        $builder = $db->table('pagos');
        $builder->select('*');
        $builder->join('grupo', 'pagos.grupo_oid=grupo.oid', 'left');
        $builder->where('pagos.usuario_oid', $usuario_id);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function buscarBeca($usuario_id){
        $db = \Config\Database::connect();
        $builder = $db->table('becas');
        $builder->select('*');
        $builder->where('becas.usuario_id', $usuario_id);
        $query   = $builder->get();
        $query = $query->getRow();
        return $query;
    }

    public function buscarCurso($curso_id){
        $db = \Config\Database::connect();
        $builder = $db->table('curso');
        $builder->select('*');
        $builder->where('curso.oid', $curso_id);
        $query   = $builder->get();
        $query = $query->getRow();
        return $query;
    }

    public function editarUsuario($datos){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->where('oid', $datos['oid']);
        $response = $builder->update($datos);
        return $response;
    }

    public function registrarBeca($datos){
		$db = \Config\Database::connect();
        $builder = $db->table('becas');
        $builder->where( 'usuario_id', $datos['usuario_id'] );
        $query = $builder->get();
        
        if(count($query->getResult()) > 0){
			$builder = $db->table('becas');
        
			$builder->where('usuario_id', $datos['usuario_id']);
			$response = $builder->update( $datos );
			
			return $response;
		}else{
			$db->table('becas')->insert($datos);
			if ($db->affectedRows() > 0){
				return 'ok';
			}else {
				return 'error';
			}			
		}
    }

    public function getEstadosAlumno(){
        $db = \Config\Database::connect();
        $builder = $db->table('estados_alumnos');
        $builder->select('*');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getSemestres(){
        $db = \Config\Database::connect();
        $builder = $db->table('semestres');
        $builder->select('*');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function agregarRegistro($dataForm){
        $db = \Config\Database::connect();
        $db->table('historial_alumnos')->insert($dataForm);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

}

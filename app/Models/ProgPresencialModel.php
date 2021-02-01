<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class ProgPresencialModel extends Model
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

    public function agregar_curso($dataForm){
        $db = \Config\Database::connect();
        $db->table('curso')->insert($dataForm);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function agregar_historial($dataForm){
        $db = \Config\Database::connect();
        $db->table('historial_alumnos')->insert($dataForm);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function getProgPresencial($data_busqueda){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select('*');
        $builder->where('grupo.oid_periodos', $data_busqueda['oid_periodo']);
        $builder->where('grupo.grti_cod', '1');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

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

    public function getCursoEditar($id_curso){
        $db = \Config\Database::connect();
        $builder = $db->table('curso');
        $builder->select('*');
        $builder->where('curso.oid', $id_curso);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    
    public function getGrupoClasificacion(){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo_clasificacion');
        $builder->select('*');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

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

    public function getAlumnos($id_comunidad){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario_grupo');
        $builder->select('*');
        $builder->where('usuario_grupo.oid_grupo', $id_comunidad);
        $builder->where('usuario_grupo.rol', "ALU");
        $builder->join('usuario', 'usuario.oid=usuario_grupo.oid_usuario', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getAlumnoEditar($id_usuario, $id_comunidad){
        $db = \Config\Database::connect();
        $builder = $db->table('historial_alumnos');
        $builder->select('*, historial_alumnos.activo as hi_activo');
        $builder->where('historial_alumnos.oid_usuario', $id_usuario);
        $builder->where('historial_alumnos.oid_grupo', $id_comunidad);
        $builder->join('estados_alumnos', 'estados_alumnos.oid=historial_alumnos.oid_esal', 'left');
        $builder->join('semestres', 'semestres.oid=historial_alumnos.oid_semestre', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getEstadosAlumnos(){
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

    public function eliminar_profesor($id_usuario, $id_comunidad){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario_grupo');
        $builder->where('oid_usuario', $id_usuario);
        $builder->where('oid_grupo', $id_comunidad);
        $builder->where('rol', 'PRO');
        $builder->delete();
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function eliminar_asignatura($id_curso, $id_comunidad){
        $db = \Config\Database::connect();
        $builder = $db->table('curso');
        $builder->where('oid', $id_curso);
        $builder->where('oid_grupo', $id_comunidad);
        $builder->delete();
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function editar_carrera_general($datos_carrera){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->where('oid', $datos_carrera['oid']);
        $response = $builder->update($datos_carrera);
        
        return $response;
    }

    public function editar_curso($dataForm, $id_comunidad, $id_curso){
        $db = \Config\Database::connect();
        $builder = $db->table('curso');
        $builder->where('oid', $id_curso);
        $builder->where('oid_grupo', $id_comunidad);
        $response = $builder->update($dataForm);
        return $response;
    }

    public function cambiar_vigencia($dataForm, $id_comunidad){
        if($dataForm["inactivo"]==0) $dataForm["inactivo"] = '1';
        else $dataForm["inactivo"] = '0';
        $data = [
            'inactivo' => $dataForm["inactivo"]
        ];
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->where('oid', $dataForm["oid"]);
        $response = $builder->update($data);

        $data = [
            'motivo' => $dataForm["motivo"],
            'motivo_obs'=>$dataForm["motivo_obs"]
        ];
        $builder = $db->table('usuario_grupo');
        $builder->where('oid_usuario', $dataForm["oid"]);
        $builder->where('oid_grupo', $dataForm["oid_grupo"]);
        $response = $builder->update($data);


        return $response;
    }

    public function listadoCursos($oid){
        $sql="SELECT curso.titulo, curso.oid,grupo.nombre, curso.curs_horas, curso.oid FROM curso, grupo where curso.oid_grupo=$oid and grupo.oid=curso.oid_grupo GROUP BY curso.titulo, curso.oid,grupo.nombre, curso.curs_horas ORDER BY curso.titulo";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }


    function listadoProfesores($where)
    {
        $sql="SELECT usuario.nombres, usuario.apellidos FROM curso,usuario where usuario.oid=curso.oid_profesor and $where";
        $sql = $sql . " UNION ";
        $sql = $sql . " SELECT usuario.nombres, usuario.apellidos FROM curso,usuario where usuario.oid=curso.oid_profesor2 and $where";
        $sql = $sql . " UNION ";
        $sql = $sql . " SELECT usuario.nombres, usuario.apellidos FROM curso,usuario where usuario.oid=curso.oid_profesor3 and $where";
        $sql = $sql . " UNION ";
        $sql = $sql . " SELECT usuario.nombres, usuario.apellidos FROM curso,usuario where usuario.oid=curso.oid_profesor4 and $where";
        $sql = $sql . " UNION ";
        $sql = $sql . " SELECT usuario.nombres, usuario.apellidos FROM curso,usuario where usuario.oid=curso.oid_profesor5 and $where";
        $sql = $sql . " UNION ";
        $sql = $sql . " SELECT usuario.nombres, usuario.apellidos FROM curso,usuario where usuario.oid=curso.oid_profesor6 and $where";
        $sql = $sql . " UNION ";
        $sql = $sql . " SELECT usuario.nombres, usuario.apellidos FROM curso,usuario where usuario.oid=curso.oid_profesor7 and $where";
        $sql = $sql . " UNION ";
        $sql = $sql . " SELECT usuario.nombres, usuario.apellidos FROM curso,usuario where usuario.oid=curso.oid_profesor8 and $where";
        $sql = $sql . " UNION ";
        $sql = $sql . " SELECT usuario.nombres, usuario.apellidos FROM curso,usuario where usuario.oid=curso.oid_profesor9 and $where";
        $sql = $sql . " UNION ";
        $sql = $sql . " SELECT usuario.nombres, usuario.apellidos FROM curso,usuario where usuario.oid=curso.oid_profesor10 and $where";

        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        $result1=$query->getResult();
        if($result1){
            $lista = "<ul style='text-align: left;font-size: 11px;'>";
            foreach($result1 as $r){
                $lista = $lista . "<li>".$r->nombres." ".$r->apellidos."</li>";
            }
            $lista = $lista."</ul>";
        }else{
            $lista = "<ul style='list-style: none;text-align: justify;font-size: 12px;'><li>No hay profesores</li></ul>";
        }
        return $lista;
    }


    function calculoHoras($where)
{
    $sql="select sum(a.asis_horas) as asis_horas  FROM asistencia a WHERE $where ";

    $db = \Config\Database::connect();
    $query = $this->db->query($sql);
    $result1=$query->getRow();
    if($result1){
      // if($r->num < )
      return (int)$result1->asis_horas;
    }else{
      return '0';
    }

}

function listadoContenidosCurso($where,$id)
{
    $sql="SELECT asis_content,asis_fecha,asis_horas FROM asistencia where $where ORDER BY asis_fecha";

    $db = \Config\Database::connect();
    $query = $this->db->query($sql);
    $result1=$query->getResult();
    if($result1){
      $lista = '<ul style="text-align: left;font-size: 12px;">';
      foreach($result1 as $r){
        if($r->asis_content==""){
          $lista = $lista . "<li><b>Fecha: </b> ".$r->asis_fecha."<br><b> Horas: </b> ".$r->asis_horas." <br><b>Contenidos: </b> No hay contenidos <hr></li>";
        }else{
          $lista = $lista . "<li><b>Fecha: </b> ".$r->asis_fecha."<br><b> Horas: </b> ".$r->asis_horas." <br><b>Contenidos: </b>".$r->asis_content." <hr></li>";
        }
      }
      $lista = $lista.'</ul>';
    }else{
      $lista = "<ul style='list-style: none;text-align: justify;font-size: 12px;'></ul>";
    }
    $result = '<a onclick="mensaje(\'Informe\',\''.$lista.'\')"> Ver contenidos</a>';
    $resultado2 = '<button type="button" class="btn btn-success" data-toggle="modal"
    data-target="#success-header-modal-'.$id.'">Ver contenidos</button>
    <div id="success-header-modal-'.$id.'" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="success-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-success">
                <h4 class="modal-title text-white" id="success-header-modalLabel">Contenidos
                </h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                
                <p>'.$lista.'</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light"
                    data-dismiss="modal">Cerrar</button>
                
            </div>
        </div>
    </div>
</div>';

    return $resultado2;
}
}
<?php namespace App\Models;

use CodeIgniter\Model;

class EncuestasModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'encuesta';
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

    public function getEncuestas($id_grupo){
        $db = \Config\Database::connect();
        $sql =  "select e.oid, e.titulo, e.oid_grupo, e.disponible, t.tipo ,e.f_hasta, e.f_desde  " .
                "from encuesta e, test t " .
                "where e.oid_grupo = ".$id_grupo." ".
                "and e.oid_test = t.oid " .
                "and e.disponible = 1 ".
                "order by e.titulo desc";
        
        // $fecha_actual = date('Y-m-d H:i:s');
        // $sql="select e.oid, e.titulo, e.oid_grupo, e.disponible, t.tipo ,e.f_hasta, e.f_desde " .
        // "from encuesta e, test t " .
        // "where e.oid_grupo=".$id_grupo." and " .
        // "e.oid_test=t.oid " .
        // "and e.disponible =1 and e.f_hasta >='".$fecha_actual."' and e.f_desde <='".$fecha_actual."' order by e.titulo desc";
        $query = $db->query($sql);
        return $query->getResultObject();
    }

    public function getEncuesta($oid_encuesta, $id_grupo){
        $db = \Config\Database::connect();
        $sql="select e.*, t.titulo as ttitulo, t.instrucciones, t.tipo " .
       "from encuesta e, test t " .
       "where e.oid=".$oid_encuesta." and e.oid_grupo=".$id_grupo." " .
       "and e.oid_test=t.oid and (t.tipo='EDO' or t.tipo='EPO' or t.tipo='EVD')";
        $query = $db->query($sql);
        return $query->getResultArray()[0];
    }
    
    public function insertEncuestaUsuario($datos_encuesta){
        $db = \Config\Database::connect();
        $db->table('encuesta_usuario')->insert($datos_encuesta);
        if ($db->affectedRows() > 0){
            return $db->insertID();
        }else {
            return FALSE;
        }
    }

    public function getRespondida($oid_encuesta, $id_grupo, $id_usuario){
        $db = \Config\Database::connect();
        $sql="select count(1) as resp " .
        "from encuesta_usuario " .
        "where oid_encuesta=".$oid_encuesta.
        " and oid_grupo=".$id_grupo.
        " and oid_usuario=".$id_usuario;
        $query = $db->query($sql);
        return $query->getResultArray()[0]['resp'];
    }

    public function getTests($id_grupo){
        $db = \Config\Database::connect();
        $sql =  "select t.oid, t.titulo, t.tipo, " .
                "( select count(1) from test_pregunta p where p.oid_test=t.oid ) as cnt " .
                "from test t " .
                "where t.oid_grupo in(0, ".$id_grupo.") and (t.tipo='EDO' or t.tipo='EPO' or t.tipo='EVD') and t.estado=0 " .
                "order by t.titulo asc";
        $query = $db->query($sql);
        return $query->getResultObject();
    }

    public function getAsignaturas($id_grupo){
        $db = \Config\Database::connect();
        $sql = "select oid ,titulo from curso where oid_grupo=".$id_grupo;
        $query = $db->query($sql);
        return $query->getResultObject();
    }

    public function getProfesores($oid_curso, $id_grupo){
        $db = \Config\Database::connect();
        $sql = "select
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
                from curso c
                left join usuario u on u.oid=c.oid_profesor
                left join usuario u2 on u2.oid=c.oid_profesor2
                left join usuario u3 on u3.oid=c.oid_profesor3
                left join usuario u4 on u4.oid=c.oid_profesor4
                left join usuario u5 on u5.oid=c.oid_profesor5
                left join usuario u6 on u6.oid=c.oid_profesor6
                left join usuario u7 on u7.oid=c.oid_profesor7
                left join usuario u8 on u8.oid=c.oid_profesor8
                left join usuario u9 on u9.oid=c.oid_profesor9
                left join usuario u10 on u10.oid=c.oid_profesor10
                where c.oid_grupo=".$id_grupo." and c.oid=".$oid_curso;
        $query = $db->query($sql);
        return $query->getResultObject();
    }

    public function agregarEncuesta($datos_encuesta){
        $db = \Config\Database::connect();
        $db->table('encuesta')->insert($datos_encuesta);
        if ($db->affectedRows() > 0){
            return $db->insertID();
        }else {
            return FALSE;
        }
    }

    public function getTest($id_test){
        $db = \Config\Database::connect();
        $builder = $db->table('test');
        $builder->select('titulo');
        $builder->where('oid', $id_test);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    
    public function updateEncuesta($id_encuesta, $data){
        $db = \Config\Database::connect();
        $builder = $db->table('encuesta');
        $builder->where('oid', $id_encuesta);
        $response = $builder->update($data);
        return $response;
    }

    public function deleteEncuesta($id_encuesta){
        $db = \Config\Database::connect();
        $builder = $db->table('encuesta');
        $builder->delete(['oid' => $id_encuesta]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }


    /******************************************************************/
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
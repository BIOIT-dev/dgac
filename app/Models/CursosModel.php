<?php namespace App\Models;

use CodeIgniter\Model;

class CursosModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'curso';
    protected $primaryKey = 'oid';

    protected $returnType     = 'array';

    protected $allowedFields = ['*'];

    protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    /**============================================================================================
    /  Inicio Categoria de documentos
    /  ============================================================================================
    */
    public function obtenerCursosPorOrden($oid_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('curso AS a');
        $builder->select('a.oid, a.titulo, a.orden');
        $builder->where('a.oid_grupo', $oid_grupo);
        $builder->orderBy('a.orden');
        $query = $builder->get();
        return $query->getResult();
    }


    // $sql = "select cs.titulo, cs.texto, cs.oid_sco, " 
    // . "ss.is_scorm, ss.titulo as ss_objeto, ss.dirname, ss.home, " .
    // "ss.attr_scrollbar, ss.attr_toolbar, ss.attr_statusbar, ss.attr_menubar, 
    // ss.attr_linkbar, ss.attr_resizable, ss.win_ancho, ss.win_alto " . 
    // "from curso_sco cs " . "left join scorm_sco ss on ss.oid=cs.oid_sco " 
    // . "where cs.oid=$r->oid_objeto and " . "cs.oid_curso=$coid";
    // $sql = "select titulo " . "from curso_etiqueta " . "where oid=$r->oid_objeto and " . "oid_curso=$coid";
    public function obtenerEtiqueta($oid_objeto,$coid){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_etiqueta');
        $builder->select('oid, titulo');
        $builder->where('oid', $oid_objeto);
        $builder->where('oid_curso', $coid);
        $query = $builder->get();
        return $query->getRow();
    }


    public function obtenerSCORM($oid_objeto,$coid){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_sco cs');
        $builder->select('cs.oid as oid, cs.titulo, cs.texto, cs.oid_sco,ss.is_scorm, ss.titulo as ss_objeto, ss.dirname, ss.home,ss.attr_scrollbar, ss.attr_toolbar, ss.attr_statusbar, ss.attr_menubar,ss.attr_linkbar, ss.attr_resizable, ss.win_ancho, ss.win_alto ');
        $builder->join('scorm_sco ss', 'ss.oid=cs.oid_sco');
        $builder->where('cs.oid', $oid_objeto);
        $builder->where('cs.oid_curso', $coid);
        $query = $builder->get();
        return $query->getRow();
    }

    public function getEvaluaciones($oid,$coid,$uid_grupo){
        $sql="select c.titulo as ctitulo, c.descripcion, c.inactivo as inactivo, c.orden, " .
        "ce.oid, ce.oid_curso, ce.titulo, ce.texto, ce.ponderacion, ce.oid_usuario, ce.instrucciones, " .
        "ce.tipo, ce.oid_test, ce.duracion_test, ce.disponible_test, ce.numpregs_test, ce.es_tarea, ce.responder_todo, ce.muestra_feedback, ce.es_formativa, " .
        "cr.orden, ce.finicio, ce.ftermino," .
        "c.oid_profesor, u.nombres, u.apellidos, u.foto, u.sexo, " .
        "c.oid_profesor2, u2.nombres as nombres2, u2.apellidos as apellidos2, u2.foto as foto2, u2.sexo as sexo2, " .
        "date_format( ce.fecha , '%d/%m/%Y' )" . " as laFecha, " .
        "date_format( ce.fecha , '%H:%i' )" . " as laHora " .
        "from curso c " .
        "inner join curso_evaluacion ce on ce.oid=$oid and ce.oid_curso=c.oid " .
        "inner join curso_ruta cr on cr.oid_curso=c.oid and cr.oid_objeto=ce.oid and cr.oid_grupo=c.oid_grupo and cr.tipo_objeto=concat( 'EVAL', ce.tipo )" .
        "left join usuario u on c.oid_profesor=u.oid " .
        "left join usuario u2 on c.oid_profesor2=u2.oid " .
        "where c.oid=$coid and c.oid_grupo=$uid_grupo";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);  
        return $query->getRow();
    }


    public function obtenerEvaluaciones($oid_objeto,$coid,$uid_oid){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_evaluacion ce');
        $builder->select('ce.titulo, ce.texto, ce.tipo, ce.ponderacion, ce.disponible_test, ce.es_tarea,ce.es_formativa, ce.instrucciones,cta.oid as cta_oid,cta.fecha as cta_fecha, cta.archivo as cta_archivo,cea.nota, cea.archivo, ce.finicio, ce.ftermino ');
        $builder->join('curso_evaluacion_alumno cea', 'cea.oid_alumno='.$uid_oid.'
        and cea.oid_evaluacion=ce.oid', 'left');
        $builder->join('curso_tarea_alumno cta', 'cta.oid_usuario='.$uid_oid.'
        and cta.oid_evaluacion=ce.oid', 'left');
        $builder->where('ce.oid', $oid_objeto);
        $builder->where('ce.oid_curso', $coid);
        $query = $builder->get();
        return $query->getResult();
    }


    public function generarListadoOrden($oid_curso,$oid_grupo){
        $db = \Config\Database::connect();

        $sql_test  = "select cr.orden, " .
        "CASE cr.tipo_objeto " .
        "WHEN 'APUNTES' THEN (select titulo from curso_apuntes o where o.oid=cr.oid_objeto ) " .
        "WHEN 'PIZARRA' THEN (select titulo from curso_pizarra o where o.oid=cr.oid_objeto ) " .
        "WHEN 'EVALTLI' THEN (select titulo from curso_evaluacion o where o.oid=cr.oid_objeto ) " .
        "WHEN 'EVALREG' THEN (select titulo from curso_evaluacion o where o.oid=cr.oid_objeto ) " .
        "WHEN 'SCORM' THEN (select titulo from curso_sco o where o.oid=cr.oid_objeto ) " .
        "WHEN 'MICROSITIO' THEN (select titulo from curso_sco o where o.oid=cr.oid_objeto ) " .
        "WHEN 'ETIQUETA' THEN (select titulo from curso_etiqueta o where o.oid=cr.oid_objeto ) " .
        "ELSE 'Do Nothing' END as titulo from curso_ruta cr".
        " where cr.oid_curso=$oid_curso and " .
        " cr.oid_grupo=$oid_grupo " .
        " order by cr.orden";
        $query = $this->db->query($sql_test);
        
        return $query->getResult();
    }
    
    public function obtenerApunte($oid_objeto,$coid){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_apuntes');
        $builder->select('oid, titulo, texto, archivo, archivo_disco');
        $builder->where('oid', $oid_objeto);
        $builder->where('oid_curso', $coid);
        $query = $builder->get();
        return $query->getResult();
    }

    public function obtenerPizarra($oid_objeto,$coid){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_pizarra');
        $builder->select('oid, titulo, texto');
        #oid=$r->oid_objeto and " . "oid_curso=$coid
        $builder->where('oid', $oid_objeto);
        $builder->where('oid_curso', $coid);
        // $builder->orderBy('a.oid');
        $query = $builder->get();
        
        return $query->getResult();
    }

    public function obtenerCursos($oid_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('curso AS a');
        $builder->select('a.*, a.fecha AS datetime');
        $builder->where('a.oid_grupo', $oid_grupo);
        $builder->orderBy('a.oid');
        $query = $builder->get();
        return $query->getResult();
    }

    public function obtenerCursosGeneral(){
        $db = \Config\Database::connect();
        $builder = $db->table('curso AS a');
        $builder->select('a.*, a.fecha AS datetime');
        $builder->orderBy('a.oid');
        $query = $builder->get();
        return $query->getResult();
    }

    public function ant_obtener_cursos($oid_grupo){
        $sql = "select c.oid, c.titulo, c.descripcion, c.inactivo, " .
        "c.oid_profesor, u.nombres, u.apellidos, u.foto, u.sexo, u.email, " .
        "c.oid_profesor2, u2.nombres as nombres2, u2.apellidos as apellidos2, u2.foto as foto2, u2.sexo as sexo2, u2.email as email2, " .
        "c.oid_profesor3, u3.nombres as nombres3, u3.apellidos as apellidos3, u3.foto as foto3, u3.sexo as sexo3, u3.email as email3, " .
        "c.oid_profesor4, u4.nombres as nombres4, u4.apellidos as apellidos4, u4.foto as foto4, u4.sexo as sexo4, u4.email as email4, " .
        "c.oid_profesor5, u5.nombres as nombres5, u5.apellidos as apellidos5, u5.foto as foto5, u5.sexo as sexo5, u5.email as email5, " .
        "c.oid_profesor6, u6.nombres as nombres6, u6.apellidos as apellidos6, u6.foto as foto6, u6.sexo as sexo6, u6.email as email6, " .
        "c.oid_profesor7, u7.nombres as nombres7, u7.apellidos as apellidos7, u7.foto as foto7, u7.sexo as sexo7, u7.email as email7, " .
        "c.oid_profesor8, u8.nombres as nombres8, u8.apellidos as apellidos8, u8.foto as foto8, u8.sexo as sexo8, u8.email as email8, " .
        "c.oid_profesor9, u9.nombres as nombres9, u9.apellidos as apellidos9, u9.foto as foto9, u9.sexo as sexo9, u9.email as email9, " .
        "c.oid_profesor10, u10.nombres as nombres10, u10.apellidos as apellidos10, u10.foto as foto10, u10.sexo as sexo10, u10.email as email10, " .
        "(select count(1) from curso_apuntes    capu where c.oid=capu.oid_curso) as ncapu, " .
        "(select count(1) from curso_etiqueta   ceti where c.oid=ceti.oid_curso) as nceti, " .
        "(select count(1) from curso_pizarra    cpiz where c.oid=cpiz.oid_curso) as ncpiz, " .
        "(select count(1) from curso_evaluacion ceva where c.oid=ceva.oid_curso) as nceva, " .
        "(select count(1) from curso_sco        ccso where c.oid=ccso.oid_curso) as nccso  " .
        "from curso c " .
        "left join usuario u on u.oid=c.oid_profesor " .
        "left join usuario u2 on u2.oid=c.oid_profesor2 " .
        "left join usuario u3 on u3.oid=c.oid_profesor3 " .
        "left join usuario u4 on u4.oid=c.oid_profesor4 " .
        "left join usuario u5 on u5.oid=c.oid_profesor5 " .
        "left join usuario u6 on u6.oid=c.oid_profesor6 " .
        "left join usuario u7 on u7.oid=c.oid_profesor7 " .
        "left join usuario u8 on u8.oid=c.oid_profesor8 " .
        "left join usuario u9 on u9.oid=c.oid_profesor9 " .
        "left join usuario u10 on u10.oid=c.oid_profesor10 " .
        "where c.oid_grupo=$oid_grupo " .
        "order by c.orden ";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);  
        return $query->getResult();
    }

    public function ant_obtener_info_curso($coid,$uid_grupo){
        $sql = "select c.orden, c.zona_home, c.oid ,c.evaluada, c.not_min,  c.titulo as titulo, c.descripcion as descripcion, c.instrucciones, c.inactivo, c.escala, c.ponderacion, " .
        "c.oid_profesor, u.nombres, u.apellidos, u.foto, u.sexo, u.email, " .
        "c.oid_profesor2, u2.nombres as nombres2, u2.apellidos as apellidos2, u2.foto as foto2, u2.sexo as sexo2, u2.email as email2, " .
        "c.oid_profesor3, u3.nombres as nombres3, u3.apellidos as apellidos3, u3.foto as foto3, u3.sexo as sexo3, u3.email as email3, " .
        "c.oid_profesor4, u4.nombres as nombres4, u4.apellidos as apellidos4, u4.foto as foto4, u4.sexo as sexo4, u4.email as email4, " .
        "c.oid_profesor5, u5.nombres as nombres5, u5.apellidos as apellidos5, u5.foto as foto5, u5.sexo as sexo5, u5.email as email5, " .
        "c.oid_profesor6, u6.nombres as nombres6, u6.apellidos as apellidos6, u6.foto as foto6, u6.sexo as sexo6, u6.email as email6, " .
        "c.oid_profesor7, u7.nombres as nombres7, u7.apellidos as apellidos7, u7.foto as foto7, u7.sexo as sexo7, u7.email as email7, " .
        "c.oid_profesor8, u8.nombres as nombres8, u8.apellidos as apellidos8, u8.foto as foto8, u8.sexo as sexo8, u8.email as email8, " .
        "c.oid_profesor9, u9.nombres as nombres9, u9.apellidos as apellidos9, u9.foto as foto9, u9.sexo as sexo9, u9.email as email9, " .
        "c.oid_profesor10, u10.nombres as nombres10, u10.apellidos as apellidos10, u10.foto as foto10, u10.sexo as sexo10, u10.email as email10 " .
        "from curso c " .
        "left join usuario u on c.oid_profesor=u.oid " .
        "left join usuario u2 on c.oid_profesor2=u2.oid " .
        "left join usuario u3 on u3.oid=c.oid_profesor3 " .
        "left join usuario u4 on u4.oid=c.oid_profesor4 " .
        "left join usuario u5 on u5.oid=c.oid_profesor5 " .
        "left join usuario u6 on u6.oid=c.oid_profesor6 " .
        "left join usuario u7 on u7.oid=c.oid_profesor7 " .
        "left join usuario u8 on u8.oid=c.oid_profesor8 " .
        "left join usuario u9 on u9.oid=c.oid_profesor9 " .
        "left join usuario u10 on u10.oid=c.oid_profesor10 " .
        "where c.oid=$coid and c.oid_grupo=$uid_grupo";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);  
        return $query->getRow();
    }

    public function editar_curso($dataForm){
        $db = \Config\Database::connect();
        $builder = $db->table('curso');
        $builder->where('oid', $dataForm['oid']);
        $response = $builder->update($dataForm);
        return $response;
    }

    public function editar_etiqueta($dataForm){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_etiqueta');
        $builder->where('oid', $dataForm['oid']);
        $response = $builder->update($dataForm);
        return $response;
    }

    public function editar_scorm_curso($dataForm){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_sco');
        $builder->where('oid', $dataForm['oid']);
        $response = $builder->update($dataForm);
        return $response;
    }

    public function editar_ruta($dataForm){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_ruta');
        // echo var_dump($dataForm);
        $builder->where('oid_curso', $dataForm['oid_curso']);
        $builder->where('oid_grupo', $dataForm['oid_grupo']);
        $builder->where('oid_objeto', $dataForm['oid_objeto']);
        $builder->where('tipo_objeto', $dataForm['tipo_objeto']);
        $response = $builder->update($dataForm);
        return $response;
    }

    public function ant_ruta_curso($uid_oid,$coid,$uid_grupo){
        $sql = "select cr.oid_objeto, cr.tipo_objeto, cra.hits, " 
        . "date_format(cra.fecha, '%d/%m/%Y %H:%i:%s') "
        . " as fecha " 
        . "from curso_ruta cr " 
        . "left join curso_ruta_alumno cra on cra.oid_alumno=$uid_oid 
        and cr.oid_curso=cra.oid_curso 
        and cr.oid_objeto=cra.oid_objeto 
        and cr.tipo_objeto=cra.tipo_objeto " 
        . "where cr.oid_curso='$coid' and " 
        . "cr.oid_grupo=$uid_grupo " . "order by cr.orden";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);  
        return $query->getResult();
    }

    public function ant_obtener_pizarras($oid_objeto,$coid){
        $sql = "select oid, titulo, texto " . "from curso_pizarra " . "where oid=$oid_objeto and " . "oid_curso=$coid";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);  
        return $query->getRow();
    }

    public function ant_obtener_apuntes($oid_objeto,$coid){
        $sql = "select oid, titulo, texto, archivo, archivo_disco " 
        . "from curso_apuntes " 
        . "where oid=$oid_objeto and " 
        . "oid_curso=$coid";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);  
        return $query->getRow();
    }

    public function ant_obtener_evaluaciones($uid_oid,$oid_objeto,$coid){
        $sql = "select ce.oid as oid, ce.titulo, ce.texto, ce.tipo, ce.ponderacion, ce.disponible_test, 
        ce.es_tarea, ce.es_formativa, ce.instrucciones, ce.oid_test, " 
        . "cta.oid as cta_oid, " 
        . "date_format(cta.fecha, '%d/%m/%Y %H:%i:%s') as cta_fecha, cta.archivo as cta_archivo, " 
        . "cea.nota, cea.archivo, ce.finicio, ce.ftermino " 
        . "from curso_evaluacion ce " 
        . "left join curso_evaluacion_alumno cea on cea.oid_alumno=$uid_oid and cea.oid_evaluacion=ce.oid " 
        . "left join curso_tarea_alumno cta on  cta.oid_usuario=$uid_oid and cta.oid_evaluacion=ce.oid " 
        . "where ce.oid=$oid_objeto and " . "ce.oid_curso=$coid";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);  
        return $query->getRow();

    }


    public function is_scorm($oid){
        $db = \Config\Database::connect();
        $builder = $db->table('scorm_sco AS a');
        $builder->select('a.is_scorm');
        $builder->where('a.oid', $oid);
        $query = $builder->get();
        return $query->getRow();
    }
    public function obtenerBancoPreguntas($coid,$uid_grupo){
        $sql="select t.oid, t.titulo, t.tipo, " .
           "(select count(1) from test_pregunta tp where tp.oid_test=t.oid ) as npregs " .
           "from test t left join curso_evaluacion ce on t.oid=ce.oid_test and ce.oid_curso=$coid " .
           "where (t.oid_grupo=0 or t.oid_grupo=$uid_grupo) " .
           "and ce.oid_curso is null and t.tipo='TLI'" .
           "order by t.titulo";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function obtenerMaximaPonderacion($coid){
        $sql="select sum(ponderacion) as maxp " .
        "from curso_evaluacion " .
        "where oid_curso=$coid and tipo in ('REG', 'TLI')";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        $resultado = $query->getResult();
        $maxp = 100 - $resultado[0]->maxp;
        return $maxp;
    }
    
//   $r=$_Db->query( $sql );
//   $maxp=100 - $r->maxp;
    
    public function obtenerObjetosAprendizajes($coid,$uid_grupo){
        $sql ="select ss.oid as oid, ss.titulo, ss.is_scorm " .
        "from scorm_sco ss " .
        "left join curso_sco cs on ss.oid=cs.oid_sco and cs.oid_curso=$coid " .
        "where (ss.oid_grupo=0 or ss.oid_grupo=$uid_grupo) " .
        "and cs.oid_curso is null " .
        "order by ss.titulo";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    

    public function obtener_detalle_curso($uid_oid,$oid_curso,$oid_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_ruta AS cr');
        $builder->select('cr.oid_objeto, cr.tipo_objeto, cra.hits, cra.fecha as fecha');
        $builder->join('curso_ruta_alumno  as cra', 'cra.oid_alumno='.$uid_oid.'
        and cr.oid_curso=cra.oid_curso 
        and cr.oid_objeto=cra.oid_objeto 
        and cr.tipo_objeto=cra.tipo_objeto', 'left');
        $builder->where('cr.oid_curso', $oid_curso);
        $builder->where('cr.oid_grupo', $oid_grupo);
        $builder->orderBy('cr.orden');
        $query = $builder->get();
        return $query->getResult();

    }

    public function crear_curso($datos){
        $db = \Config\Database::connect();
        $db->table('curso')->insert($datos);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function crear_etiqueta($datos){
        $db = \Config\Database::connect();
        $db->table('curso_etiqueta')->insert($datos);
        if ($db->affectedRows() > 0){
            // $db->insertID();
            return $db->insertID();
        }else {
            return FALSE;
        }
    }

    public function crear_objeto_aprendizaje($datos){
        $db = \Config\Database::connect();
        $db->table('curso_sco')->insert($datos);
        if ($db->affectedRows() > 0){
            // $db->insertID();
            return $db->insertID();
        }else {
            return FALSE;
        }
    }

    public function crear_curso_ruta($datos){
        $db = \Config\Database::connect();
        $db->table('curso_ruta')->insert($datos);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }


    public function crear_curso_evaluacion($datos){
        $db = \Config\Database::connect();
        $db->table('curso_evaluacion')->insert($datos);
        if ($db->affectedRows() > 0){
            return $db->insertID();
        }else {
            return FALSE;
        }
    }


    public function crear_curso_apuntes($datos){
        $db = \Config\Database::connect();
        $db->table('curso_apuntes')->insert($datos);
        if ($db->affectedRows() > 0){
            return $db->insertID();
        }else {
            return FALSE;
        }
    }

    public function crear_curso_pizarra($datos){
        $db = \Config\Database::connect();
        $db->table('curso_pizarra')->insert($datos);
        if ($db->affectedRows() > 0){
            return $db->insertID();
        }else {
            return FALSE;
        }
    }

    public function edit_curso_pizarra($datos, $oid_pizarra){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_pizarra');
        $builder->where('oid', $oid_pizarra);
        $response = $builder->update($datos);
        return $response;
    }


    public function promedio_notas_sql1($uid_grupo){
        $sql = "SELECT c.oid id_curso, c.titulo titulo_curso, c.escala, c.semestre,c.not_min
        FROM curso c 
        Inner join curso_evaluacion  ce on c.oid = ce.oid_curso
        Inner Join curso_evaluacion_alumno  cea on cea.oid_evaluacion = ce.oid
        Inner Join usuario u on u.oid = cea.oid_alumno
        WHERE c.oid_grupo =$uid_grupo 
        and c.inactivo=0 and u.inactivo=0
        group by c.oid
        ORDER BY c.semestre";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }


    public function promedio_notas_sql2($id_curso,$uid_grupo){
        $sql="select ce.* " .
        "from curso c " .
        "inner join curso_evaluacion ce on ce.oid_curso=c.oid " .
        "inner join curso_ruta cr on cr.oid_curso=c.oid and cr.oid_objeto=ce.oid and cr.oid_grupo=c.oid_grupo and cr.tipo_objeto=concat('EVAL', ce.tipo)" .
        "where c.oid=$id_curso and c.oid_grupo=$uid_grupo " .
        "order by cr.orden";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }


    public function promedio_notas_sql3($uid_grupo){
        $sql="select u.oid, u.nombres, u.apellido_paterno, u.apellido_materno " .
        "from usuario u inner join usuario_grupo ug on u.oid=ug.oid_usuario and ug.oid_grupo=$uid_grupo and ug.rol='ALU' " .
        "where u.inactivo=0 " .
        "order by u.apellido_paterno, u.apellido_materno, u.nombres";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }


    public function promedio_notas_sql4($oid_evaluacion,$oid_alumno){
        $sql="select nota " .
         "from curso_evaluacion_alumno " .
         "where oid_evaluacion=" . $oid_evaluacion . " " .
         "and oid_alumno=" . $oid_alumno;  
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getRow();
    }


    function generarOrdenEditar($coid, $goid, $curr=0){      
        // $r = new stdclass;
        // $r->orden=0;
        // $r->titulo="Al inicio";
      
        $ruta=array();
        $n=0;
        // $ruta[ $n=0 ]=$r;
      
        $sql="select cr.orden, " .
             "case " .
             "when cr.tipo_objeto='APUNTES' then (select titulo from curso_apuntes o where o.oid=cr.oid_objeto ) " .
             "when cr.tipo_objeto='PIZARRA' then (select titulo from curso_pizarra o where o.oid=cr.oid_objeto ) " .
             "when cr.tipo_objeto='EVALTLI' then (select titulo from curso_evaluacion o where o.oid=cr.oid_objeto ) " .
             "when cr.tipo_objeto='EVALREG' then (select titulo from curso_evaluacion o where o.oid=cr.oid_objeto ) " .
             "when cr.tipo_objeto='SCORM' then (select titulo from curso_sco o where o.oid=cr.oid_objeto ) " .
             "when cr.tipo_objeto='MICROSITIO' then (select titulo from curso_sco o where o.oid=cr.oid_objeto ) " .
             "when cr.tipo_objeto='ETIQUETA' then (select titulo from curso_etiqueta o where o.oid=cr.oid_objeto ) " .
             "end as titulo " .
             "from curso_ruta cr " .
             "where cr.oid_curso=$coid and " .
             "cr.oid_grupo=$goid " .
             "order by cr.orden";
        // echo $sql;
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        $resultado = $query->getResult();
        // print_r($resultado);
        foreach ($resultado as $key => $r){
          if( $r->orden==$curr ) continue;
          $r->titulo=" Despues de : " . $r->titulo;
          $ruta[ ++$n ]=$r;
        }
        if( $curr==0 ) $curr=$n+1;
        $listado = array();
        $a = array('valor'=>0,
        'selected'=>"",
        'titulo'=>'Al inicio'
        );
        array_push($listado,$a);
        foreach( $ruta as $k=>$r ){
            $a = array('valor'=>$r->orden+0.5,
            'selected'=>$curr-1==$r->orden?"selected='selected'":"",
            'titulo'=>$r->titulo
            );
            array_push($listado,$a);
        }
        return $listado;
      }

	
	// NUEVOS MÉTODOS----------------------------------------------------------------------------
	
	// Obtener cursos con estado = 0
	public function obtenerCursos0(){
        $sql="SELECT DISTINCT nombre_grupo from compromiso_docente where estado = 0";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }
	
	// Obtener unidades
	public function obtenerUnidades($curso){
        $sql="SELECT DISTINCT unidad from compromiso_docente where nombre_grupo='$curso' and estado= 0";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }
	
	// Obtener oficio portador
	public function obtenerOficioPortador($curso, $unidad){
        $sql="SELECT  * from compromiso_docente where nombre_grupo='$curso' and unidad='$unidad' and estado= 0";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }
    
	// Obtener profesores
	public function obtenerProfesores($oid_comunidad, $oid_curso){
        $sql="select c.oid, c.titulo, c.inactivo, c.oid_profesor, u.nombres, u.apellidos, u.sexo, u.email,
		c.oid_profesor2, u2.nombres as nombres2, u2.apellidos as apellidos2, u2.sexo as sexo2, u2.email as email2
		 from curso c 
		left join usuario u on u.oid=c.oid_profesor 
		left join usuario u2 on u2.oid=c.oid_profesor2 where c.oid_grupo=$oid_comunidad and c.oid=$oid_curso";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    //obtener alumnos a evaluar
    public function obtenerAlumnos($uid_grupo, $oid){
        $sql =  "select u.oid as uoid, u.apellidos, u.nombres, cea.nota, cta.oid as cta_oid, cea.archivo, cea.oid as cea_oid, cta.archivo as cta_archivo " . 
                "from usuario u " . "inner join usuario_grupo ug on u.oid=ug.oid_usuario and ug.oid_grupo=$uid_grupo and ug.rol='ALU'" . 
                "left join curso_evaluacion_alumno cea on cea.oid_evaluacion=$oid and cea.oid_alumno=u.oid " . 
                "left join curso_tarea_alumno cta on cta.oid_evaluacion=$oid and cta.oid_usuario=u.oid " . 
                "where u.inactivo=0 " . "order by apellidos, nombres";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function buscarEvaluacionAlumno($oid_evaluacion, $oid_alumno){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_evaluacion_alumno');
        $builder->select('oid');
        $builder->where('oid_evaluacion', $oid_evaluacion);
        $builder->where('oid_alumno', $oid_alumno);
        $query = $builder->get();
        return $query->getResult();
    }

    public function insertarNotas($oid_evaluacion, $oid_alumno, $nota, $oid_usuario){
        $db = \Config\Database::connect();
        $data = [
            'oid_evaluacion' => $oid_evaluacion,
            'oid_alumno'  => $oid_alumno,
            'nota' => $nota,
            'fecha' => date('Y-m-d H:i:s'),
            'oid_usuario' => $oid_usuario
        ];
        $db->table('curso_evaluacion_alumno')->insert($data);
        if ($db->affectedRows() > 0){
            return $db->insertID();
        }else {
            return FALSE;
        }
    }

    public function updateNotas($oid_evaluacion, $oid_alumno, $nota, $oid_usuario){
        $db = \Config\Database::connect();
        $data = [
            'nota' => $nota,
            // 'fecha' => date('Y-m-d H:i:s')
        ];
        $builder = $db->table('curso_evaluacion_alumno');
        $builder->where('oid_evaluacion', $oid_evaluacion);
        $builder->where('oid_alumno', $oid_alumno);
        $response = $builder->update($data);
        return $response;
    }

    public function obtenerEvaluacion($oid_evaluacion){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_evaluacion');
        $builder->select('*, curso_evaluacion.titulo as ce_titulo, curso_evaluacion.ponderacion as ce_ponderacion');
        $builder->where('curso_evaluacion.oid', $oid_evaluacion);
        $builder->join('curso', 'curso.oid=curso_evaluacion.oid_curso', 'left');
        $query = $builder->get();
        return $query->getResult();
    }

    public function insertFeedback($archivo, $oid_cea){
        $db = \Config\Database::connect();
        $data = [
            'archivo' => $archivo
        ];
        $builder = $db->table('curso_evaluacion_alumno');
        $builder->where('oid', $oid_cea);
        $response = $builder->update($data);
        return $response;
    }

    public function deleteFeedback($oid_cea){
        $db = \Config\Database::connect();
        $data = [
            'archivo' => ""
        ];
        $builder = $db->table('curso_evaluacion_alumno');
        $builder->where('oid', $oid_cea);
        $response = $builder->update($data);
        return $response;
    }

    public function deleteEvaluacion($oid_evaluacion){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_evaluacion');
        $builder->delete(['oid' => $oid_evaluacion]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function deletePizarra($oid_pizarra){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_pizarra');
        $builder->delete(['oid' => $oid_pizarra]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function insertRespuesta($archivo, $oid_evaluacion, $oid_usuario){
        $db = \Config\Database::connect();
        $data = [
            'archivo' => $archivo,
            'archivo_disco' => $archivo,
            'oid_evaluacion' => $oid_evaluacion,
            'oid_usuario' => $oid_usuario,
            'fecha' => date('Y-m-d H:i:s')
        ];
        $db->table('curso_tarea_alumno')->insert($data);
        if ($db->affectedRows() > 0){
            return $db->insertID();
        }else {
            return FALSE;
        }
    }
    
    public function getEncuesta($oid_test){
        $sql =  "select * " .
                "from test " .
                "where oid = $oid_test " .
                "order by oid";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        // return $query->getResult()[0];
        return $query->getResultArray()[0];
    }

    public function getEncuesta2($oid_test){
        $sql =  "select * " .
                "from test " .
                "where oid = $oid_test " .
                "order by oid";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult()[0];
        // return $query->getResultArray()[0];
    }

    public function getPreguntaOpcion($test_oid, $pregunta_oid){
        $sql =  "select * " .
                "from test_pregunta_opcion " .
                "where oid_test=$test_oid and oid_pregunta='$pregunta_oid' " .
                "order by oid";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getReg($oid, $coid, $uid_oid, $uid_grupo){
        $sql =  "select c.titulo as ctitulo, c.descripcion, c.inactivo as inactivo, c.escala, " .
                "ce.oid, ce.oid_curso, ce.titulo, ce.texto, ce.ponderacion, ce.oid_usuario, " .
                "ce.tipo, ce.oid_test, ce.duracion_test, ce.disponible_test, ce.numpregs_test, ce.muestra_feedback, ce.es_formativa, " .
                "cea.oid as cea_oid, " .
                "c.oid_profesor, u.nombres, u.apellidos, u.foto, u.sexo, " .
                "c.oid_profesor2, u2.nombres as nombres2, u2.apellidos as apellidos2, u2.foto as foto2, u2.sexo as sexo2 " .
                // date_format( "ce.fecha" , "'%d/%m/%Y'" ) . " as laFecha " .
                "from curso c " .
                "inner join curso_evaluacion ce on ce.oid=$oid and ce.oid_curso=c.oid and ce.disponible_test=1 " .
                "inner join curso_ruta cr on cr.oid_curso=c.oid and cr.oid_objeto=ce.oid and cr.oid_grupo=c.oid_grupo " .
                "left join curso_evaluacion_alumno cea on cea.oid_evaluacion=ce.oid and cea.oid_alumno=$uid_oid " .
                "left join usuario u on c.oid_profesor=u.oid " .
                "left join usuario u2 on c.oid_profesor2=u2.oid " .
                "where c.oid=$coid and c.oid_grupo=$uid_grupo";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult()[0];
    }

    public function insertRespuestasEncuesta($oid_evaluacion, $oid_alumno, $nota, $oid_usuario, $detalle){
        $db = \Config\Database::connect();
        $data = [
            'oid_evaluacion' => $oid_evaluacion,
            'oid_alumno'  => $oid_alumno,
            'nota' => $nota,
            'fecha' => date('Y-m-d H:i:s'),
            'oid_usuario' => $oid_usuario,
            'detalle' => $detalle
        ];
        $db->table('curso_evaluacion_alumno')->insert($data);
        if ($db->affectedRows() > 0){
            return $db->insertID();
        }else {
            return FALSE;
        }
    }

    public function getCursoRuta($oid_curso, $oid_objeto, $oid_alumno){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_ruta_alumno');
        $builder->select('*');
        $builder->where('oid_curso', $oid_curso);
        $builder->where('oid_objeto', $oid_objeto);
        $builder->where('oid_alumno', $oid_alumno);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function updCursoRuta($oid_curso, $oid_objeto, $oid_alumno, $hits){
        date_default_timezone_set('America/Santiago');
        $db = \Config\Database::connect();
        $data = [
            'hits' => $hits,
            'fecha' => date('Y-m-d H:i:s'), 
        ];
        $builder = $db->table('curso_ruta_alumno');
        $builder->where('oid_curso', $oid_curso);
        $builder->where('oid_objeto', $oid_objeto);
        $builder->where('oid_alumno', $oid_alumno);
        $response = $builder->update($data);
        return $response;
    }

    public function addCursoRuta($oid_curso, $oid_objeto, $oid_alumno){
        $db = \Config\Database::connect();
        $data = [
            'oid_curso' => $oid_curso,
            'oid_objeto' => $oid_objeto,
            'tipo_objeto' => 'EVALTLI',
            'oid_alumno'  => $oid_alumno,
            'fecha' => date('Y-m-d H:i:s'),
            'hits' => 1
        ];
        $db->table('curso_ruta_alumno')->insert($data);
        if ($db->affectedRows() > 0){
            return $db->insertID();
        }else {
            return FALSE;
        }
    }

    public function obtenerPreguntaSeleccionada($oid_grupo, $oid_test, $tipo){
        $sql =  "select t.titulo, (select count(1) from test_pregunta tp where tp.oid_test=t.oid) as numpregs " .
                "from test t " .
                "where t.oid=$oid_test and t.tipo='$tipo' and " .
                "(t.oid_grupo=0 or t.oid_grupo=$oid_grupo) ";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function editarEvaluacion($dataForm, $oid_evaluacion){
        $db = \Config\Database::connect();
        // $data = [
        //     'archivo' => $archivo
        // ];
        $builder = $db->table('curso_evaluacion');
        $builder->where('oid', $oid_evaluacion);
        $response = $builder->update($dataForm);
        return $response;
    }

    public function getApunte($oid_apunte){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_apuntes');
        $builder->select('*');
        $builder->where('oid', $oid_apunte);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function editar_curso_apuntes($oid_apunte, $dataForm){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_apuntes');
        $builder->where('oid', $oid_apunte);
        $response = $builder->update($dataForm);
        return $response;
    }

    public function getAlumnoRespuesta($oid_evaluacion, $oid_alumno){
        $db = \Config\Database::connect();
        $builder = $db->table('curso_evaluacion_alumno');
        $builder->select('*');
        $builder->where('oid_evaluacion', $oid_evaluacion);
        $builder->where('oid_alumno', $oid_alumno);
        $query = $builder->get();
        return $query->getResultArray();
    }

    /**============================================================================================
    /  Inicio Módulo Asistencia
    /  =========================================================================================**/
    public function getHorasAsistenciaActual($id_curso){
        $db = \Config\Database::connect();
        $builder = $db->table('asistencia');
        $builder->select('SUM(asis_horas) AS horas');
        $builder->where('oid_cursos', $id_curso);
        $query = $builder->get();
        return $query->getResultArray()[0]['horas'];
    }
    
    public function getHorasAsistenciaAsign($id_curso){
        $db = \Config\Database::connect();
        $builder = $db->table('curso');
        $builder->select('curs_horas');
        $builder->where('oid', $id_curso);
        $query = $builder->get();
        return $query->getResultArray()[0]['curs_horas'];
    }

    public function getAsistencias($id_curso){
        $db = \Config\Database::connect();
        $builder = $db->table('asistencia');
        $builder->select('*');
        $builder->where('oid_cursos', $id_curso);
        $query = $builder->get();
        return $query->getResult();
    }

    public function insertarAsistencia($datos){
        $db = \Config\Database::connect();
        $db->table('asistencia')->insert($datos);
        if ($db->affectedRows() > 0){
            return $db->insertID();
        }else {
            return FALSE;
        }
    }

    public function getAlumnos($oid_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario_grupo');
        $builder->select('*');
        $builder->where('usuario_grupo.oid_grupo', $oid_grupo);
        $builder->where('usuario_grupo.rol', 'ALU');
        $builder->join('usuario', 'usuario.oid=usuario_grupo.oid_usuario', 'left');
        $builder->where('usuario.inactivo', '0');
        $builder->orderBy('usuario.apellidos');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getFecha($oid_curso, $oid_usuario){
        $db = \Config\Database::connect();
        $builder = $db->table('asistencia');
        $builder->select('*');
        $builder->where('asistencia.oid_cursos', $oid_curso);
        $builder->join('asistencia_usuarios', 'asistencia_usuarios.oid_asistencia=asistencia.oid', 'left');
        $builder->where('asistencia_usuarios.oid_usuario', $oid_usuario);
        $builder->where('asistencia_usuarios.asus_presente', '2');
        $query = $builder->get();
        return $query->getResult();
    }
    
    public function insertarJustificacion($oid, $oid_usuario, $horas_justificacion){
        $db = \Config\Database::connect();
        $data = [
            'asus_justificado' => $horas_justificacion
        ];
        $builder = $db->table('asistencia_usuarios');
        $builder->where('oid_usuario', $oid_usuario);
        $builder->where('oid', $oid);
        $response = $builder->update($data);
        return $response;
    }

    public function getFechaAtraso($oid_curso, $oid_usuario){
        $db = \Config\Database::connect();
        $builder = $db->table('asistencia');
        $builder->select('*');
        $builder->where('asistencia.oid_cursos', $oid_curso);
        $builder->join('asistencia_usuarios', 'asistencia_usuarios.oid_asistencia=asistencia.oid', 'left');
        $builder->where('asistencia_usuarios.oid_usuario', $oid_usuario);
        $builder->where('asistencia_usuarios.asus_presente', '2');
        $query = $builder->get();
        return $query->getResult();
    }

    public function insertarAtraso($oid, $oid_usuario){
        $db = \Config\Database::connect();
        $data = [
            'asus_atrasado' => '1'
        ];
        $builder = $db->table('asistencia_usuarios');
        $builder->where('oid_usuario', $oid_usuario);
        $builder->where('oid', $oid);
        $response = $builder->update($data);
        return $response;
    }

    public function getAsistencia($oid){
        $db = \Config\Database::connect();
        $builder = $db->table('asistencia');
        $builder->select('*');
        $builder->where('oid', $oid);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function editarAsistencia($dataForm){
        $db = \Config\Database::connect();
        $builder = $db->table('asistencia');
        $builder->where('oid', $dataForm['oid']);
        unset($dataForm['oid']);
        $response = $builder->update($dataForm);
        return $response;
    }

    public function deleteAsistencia($oid_asistencia){
        $db = \Config\Database::connect();
        $builder = $db->table('asistencia');
        $builder->delete(['oid' => $oid_asistencia]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function getAsistenciaAlumno($id_asistencia, $id_usuario){
        $db = \Config\Database::connect();
        $builder = $db->table('asistencia_usuarios');
        $builder->select('asus_presente, oid');
        $builder->where('oid_asistencia', $id_asistencia);
        $builder->where('oid_usuario', $id_usuario);
        $query = $builder->get();
        return $query->getResult();
    }

    public function addAsistenciaAlumno($id_asistencia, $id_usuario, $estado, $asus_horajust){
        $data = [
            'oid_asistencia' => $id_asistencia,
            'oid_usuario' => $id_usuario,
            'asus_presente' => $estado,
            'asus_horajust' => $asus_horajust
        ];
        $db = \Config\Database::connect();
        $db->table('asistencia_usuarios')->insert($data);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function editAsistenciaAlumno($id_asistencia, $id_usuario, $estado){
        $data = [
            'asus_presente' => $estado,
            'asus_horajust' => '0'
        ];
        $db = \Config\Database::connect();
        $builder = $db->table('asistencia_usuarios');
        $builder->where('oid_asistencia', $id_asistencia);
        $builder->where('oid_usuario', $id_usuario);
        $builder->update($data);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
    
    public function getHoraJustAsistencia($id_asistencia){
        $db = \Config\Database::connect();
        $builder = $db->table('asistencia');
        $builder->select('asis_horas');
        $builder->where('oid', $id_asistencia);
        $query = $builder->get();
        return $query->getResult();
    }

    public function insertarAtrasoDiario($oid_asistencia, $oid_usuario, $asus_llegada, $asus_horajust){
        $db = \Config\Database::connect();
        $data = [
            'asus_llegada' => $asus_llegada,
            'asus_horajust' => $asus_horajust
        ];
        $builder = $db->table('asistencia_usuarios');
        $builder->where('oid_usuario', $oid_usuario);
        $builder->where('oid_asistencia', $oid_asistencia);
        $response = $builder->update($data);
        return $response;
    }

}

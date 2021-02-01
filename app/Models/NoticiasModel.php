<?php namespace App\Models;

use CodeIgniter\Model;

class NoticiasModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'noticia';
    protected $primaryKey = 'oid';

    protected $returnType     = 'array';

    protected $allowedFields = ['*'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function crear_noticia_model($data,$listado_comunidades){

        

        $db = \Config\Database::connect();
        $db->table('noticia')->insert($data);
        $id = $db->insertID();
        if ($db->affectedRows() > 0){
            foreach($listado_comunidades as $r){
                $data = [
                    'noticia_oid'=>$id,
                    'grupo_oid'=>$r
                ];
                $db->table('noticias_comunidad')->insert($data);
            }
            return TRUE;
        }else {
            return FALSE;
        }
        /*echo "<pre>";
        print_r($data);*/
    }

    public function editar_noticia_model($data){
        $db = \Config\Database::connect();
        $builder = $db->table('noticia');
        
        $builder->where('oid', $data['oid']);
        $response = $builder->update($data);
        
        return $response;
    }
    
    public function eliminar_noticia_model($id){
        $db = \Config\Database::connect();
        $builder = $db->table('noticia');

        $builder->delete(['oid' => $id]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    /**
    / Consultar datos
    */

    public function obtenerNoticias($oid_grupo){
        $sql="select oid, titulo, resumen, foto_chica,foto_grande, attach, datetime " .
        "from noticia " .
        "where " .
        "(oid_grupo=$oid_grupo or global=1) " .
        " UNION ".
        " SELECT n.oid, n.titulo, n.resumen, n.foto_chica, n.foto_grande, n.attach, n.datetime ".
        " FROM noticia n, noticias_comunidad where n.oid=noticias_comunidad.noticia_oid and ".
        " noticias_comunidad.grupo_oid=$oid_grupo " .
        "order by oid desc limit 0,4";

        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function obtenerNoticiasTodas($oid_grupo){
        $sql="select oid, titulo, resumen, foto_chica,foto_grande, attach " .
        "from noticia " .
        "where " .
        "(oid_grupo=$oid_grupo or global=1) " .
        " UNION ".
        " SELECT n.oid, n.titulo, n.resumen, n.foto_chica, n.foto_grande, n.attach ".
        " FROM noticia n, noticias_comunidad where n.oid=noticias_comunidad.noticia_oid and ".
        " noticias_comunidad.grupo_oid=$oid_grupo " .
        "order by oid desc";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }


    public function linksDirectos($uid_grupo){
        $sql="select 'FOROS' as origen, p.asunto as titulo, f.oid as p1, p.oid as p2, p.fecha, 'n/a' " .
           "from foro_categoria c, foro_foro f, foro_post p " .
           "where c.oid_grupo=$uid_grupo and " .
           "c.oid=f.oid_categoria and " .
           "f.oid=p.oid_foro and " .
           "p.zona_home='LNK' and " .
           "1=1 " .
           "union " .
           "select 'CHAT' as origen, cr.titulo as titulo, cr.oid as p1, 0 as p2, cr.fecha, 'n/a' " .
           "from chat_room cr " .
           "where cr.oid_grupo=$uid_grupo and " .
           "cr.zona_home='LNK' and " .
           "1=1 " .
           "union " .
           "select 'ENCUESTA' as origen, e.titulo as titulo, e.oid as p1, 0 as p2, e.fecha, 'n/a' " .
           "from encuesta e " .
           "where e.oid_grupo=$uid_grupo and " .
           "e.zona_home='LNK' and " .
           "1=1 " .
           "union " .
           "select 'CURSO' as origen, c.titulo as titulo, c.oid as p1, 0 as p2, c.fecha, 'n/a' " .
           "from curso c " .
           "where c.oid_grupo=$uid_grupo and " .
           "c.zona_home='LNK' and " .
           "1=1 " .
           "union " .
           "select 'BIBLIO' as origen, a.titulo as titulo, a.oid as p1, c.oid as p2, a.fecha, esurl " .
           "from biblio_categoria c, biblio_archivo a " .
           "where c.oid_grupo=$uid_grupo and " .
           "c.oid=a.oid_categoria and " .
           "a.zona_home='LNK' and " .
           "1=1 " .
           "order by fecha desc limit 0,3";
        // echo $sql;
        // return;
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }


    public function UltimosDocumentos($oid_grupo){
        $sql="select ba.oid, ba.titulo,ba.archivo " .
           "from biblio_categoria bc, biblio_archivo ba " .
           "where bc.oid_grupo=$oid_grupo and " .
           "bc.oid_team=0 and " .
           "bc.oid=ba.oid_categoria " .
           "order by ba.fecha desc limit 0,3";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }


    public function ultimasHistorias($uid_grupo,$uid_oid){
            $sql="select h.oid_usuario, u.apellidos, u.nombres, u.foto, u.sexo, " .
            "h.accion, date_format( h.fecha ,'%d/%m/%Y %H:%i:%s') as laFecha, h.oid_objeto, h.oid_extra, " .
            "case " .
            " when h.accion='AVISOS:ADD' then ( " .
            "                              select a.texto " .
            "                              from aviso a " .
            "                              where a.oid=h.oid_objeto and " .
            "                                   ( a.oid_grupo=$uid_grupo or a.global=1 ) " .
            "                            ) " .
            " when h.accion='BIBLIOTECA:ADD' then ( " .
            "                              select ba.titulo " .
            "                              from biblio_archivo ba, biblio_categoria bc " .
            "                              where ba.oid=h.oid_objeto and " .
            "                                    ba.oid_categoria=bc.oid and " .
            "                                   ( bc.oid_grupo=$uid_grupo or bc.global=1 ) " .
            "                            ) " .
            " when h.accion='BIBLIOTECA:COMMENT' then ( " .
            "                              select c.texto " .
            "                              from comentario c, biblio_archivo ba, biblio_categoria bc " .
            "                              where c.oid=h.oid_extra and " .
            "                                    c.seccion='BIBLIOTECA' and " .
            "                                    c.oid_objeto=ba.oid and " .
            "                                    ba.oid=h.oid_objeto and " .
            "                                    ba.oid_categoria=bc.oid and " .
            "                                   ( bc.oid_grupo=$uid_grupo or bc.global=1 ) " .
            "                            ) " .
            " when h.accion='FOROS:TEMAADD' then ( " .
            "                              select concat(fp.oid_foro,':', fp.texto )" .
            "                              from foro_post fp, foro_foro ff, foro_categoria fc " .
            "                              where fp.oid=h.oid_objeto and " .
            "                                    fp.oid_padre=0 and " .
            "                                    fp.oid_foro=ff.oid and " .
            "                                    ff.oid_categoria=fc.oid and " .
            "                                   ( fc.oid_grupo=$uid_grupo or fc.global=1 ) " .
            "                            ) " .
            " when h.accion='FOROS:POSTADD' then ( " .
            "                              select concat( fp.oid_foro, ':', fp.texto ) " .
            "                              from foro_post fp, foro_foro ff, foro_categoria fc " .
            "                              where fp.oid=h.oid_extra and " .
            "                                    fp.oid_padre=h.oid_objeto and " .
            "                                    fp.oid_foro=ff.oid and " .
            "                                    ff.oid_categoria=fc.oid and " .
            "                                   ( fc.oid_grupo=$uid_grupo or fc.global=1 ) " .
            "                            ) " .
            " when h.accion='QSOY:COMMENT' then ( " .
            "                              select c.texto " .
            "                              from comentario c " .
            "                              where c.oid=h.oid_extra and " .
            "                                    c.seccion='MICOMUNIDAD' and " .
            "                                    c.oid_objeto=h.oid_objeto " .
            "                            ) " .
            " when h.accion='QSOY:VIEW' then 'dummy' " .
            " when h.accion='QSOY:ADDFOTO' then 'dummy' " .
            " when h.accion='MICOMUNIDAD:MISFOTOS:COMMENT' then ( " .
            "                              select concat( p.oid_usuario, ':', c.texto ) " .
            "                              from comentario c, photo p " .
            "                              where c.oid=h.oid_extra and " .
            "                                    c.seccion='MICOMUNIDAD:MISFOTOS' and " .
            "                                    c.oid_objeto=h.oid_objeto and " .
            "                                    h.oid_objeto=p.oid and " .
            "                                    p.oid_grupo=$uid_grupo " .
            "                            ) " .
            " when h.accion='MICURSO:PIZARRA:ADD' then (" .
            "                              select o.titulo " .
            "                              from curso_pizarra o " .
            "                              where o.oid=h.oid_objeto and " .
            "                              o.oid_curso=h.oid_extra " .
            "                            ) " .
            " when h.accion='MICURSO:SCO:ADD' then (" .
            "                              select o.titulo " .
            "                              from curso_sco o " .
            "                              where o.oid=h.oid_objeto and " .
            "                              o.oid_curso=h.oid_extra " .
            "                            ) " .
            " when h.accion='MICURSO:EVALUACIONES:ADD' then (" .
            "                              select o.titulo " .
            "                              from curso_evaluacion o " .
            "                              where o.oid=h.oid_objeto and " .
            "                              o.oid_curso=h.oid_extra " .
            "                            ) " .
            " when h.accion='MICURSO:APUNTES:ADD' then (" .
            "                              select o.titulo " .
            "                              from curso_apuntes o " .
            "                              where o.oid=h.oid_objeto and " .
            "                              o.oid_curso=h.oid_extra " .
            "                            ) " .
            "end as texto " .
            "from history h " .
            "inner join usuario u on u.oid=h.oid_usuario " .
            "where h.oid_grupo=$uid_grupo and " .
            "( " .
            " (h.accion='AVISOS:ADD') or " .
            " (h.accion='BIBLIOTECA:ADD' and 1=1 and exists(select 1 from biblio_archivo ba, biblio_categoria bc where ba.oid=h.oid_objeto and ba.oid_categoria=bc.oid and bc.oid_team=0) ) or " .
            " (h.accion='BIBLIOTECA:COMMENT' and 1=1) or " .
            " (h.accion='FOROS:TEMAADD' and 1=1) or " .
            " (h.accion='FOROS:POSTADD' and 1=1) or " .
            " (h.accion='QSOY:COMMENT' and h.oid_objeto=$uid_oid and h.oid_usuario<>$uid_oid and 1=1) or " .
            " (h.accion='QSOY:VIEW' and h.oid_objeto=$uid_oid and h.oid_usuario<>$uid_oid and (h.oid_extra%3)=0 and 1=1) or " .
            " (h.accion='QSOY:ADDFOTO' and h.oid_usuario<>$uid_oid and 1=1) or " .
            " (h.accion='MICOMUNIDAD:MISFOTOS:COMMENT' and h.oid_usuario<>$uid_oid and 1=1) or " .
            " (h.accion='MICURSO:PIZARRA:ADD' and 1=1) or " .
            " (h.accion='MICURSO:SCO:ADD' and 1=1) or " .
            " (h.accion='MICURSO:EVALUACIONES:ADD' and 1=1) or " .
            " (h.accion='MICURSO:APUNTES:ADD' and 1=1) " .
            ") " .
            "order by fecha desc";
            $db = \Config\Database::connect();
            $query = $this->db->query($sql);
            return $query->getResult();
    }

    public function obtenerNoticiasPublic(){
        $db = \Config\Database::connect();
        $builder = $db->table('noticia AS a');
        $builder->select('a.*, b.nombres, b.apellidos, a.fecha AS datetime');
        $builder->join("usuario AS b", "a.oid_usuario = b.oid");
        $builder->whereIN('a.global', array(1));
        $builder->orderBy('a.oid');

        $query = $builder->get();
        return $query->getResult();
    }

    public function obtenerNoticiasPreview($oid){
        $db = \Config\Database::connect();
        $builder = $db->table('noticia AS a');
        $builder->select('a.*, b.nombres, b.apellidos, a.fecha AS datetime');
        $builder->join("usuario AS b", "a.oid_usuario = b.oid");
        $builder->where('a.oid', $oid);
        $builder->orderBy('a.oid');
        $query = $builder->get();
        return $query->getRow();
    }

    public function obtenerNoticiasPreviewPublic( $id ){
        $db = \Config\Database::connect();
        $builder = $db->table('noticia AS a');
        $builder->select('a.*, b.nombres, b.apellidos, a.fecha AS datetime');
        $builder->join("usuario AS b", "a.oid_usuario = b.oid");
        $builder->where('a.oid', $id);
        $builder->orderBy('a.oid');
        $query = $builder->get();
        return $query->getRow();
    }

    public function noticiaVisitas( $data ){
        $db = \Config\Database::connect();
        $builder = $db->table('noticia');
        
        $builder->where('oid', $data['oid']);
        $builder->update( array( 'hits' => $data['hits'] ) );
    }

    /**
    / Comentarios
    */

    public function obtenerComentarios($oid_objeto){
        $db = \Config\Database::connect();
        $builder = $db->table('comentario AS a');
        $builder->select('a.oid, a.texto AS comentario, b.oid as user_oid, b.nombres, b.apellidos, b.foto, a.fecha AS datetime');
        $builder->join("usuario AS b", "a.oid_usuario = b.oid");
        $builder->where('a.oid_objeto', $oid_objeto );
        $builder->orderBy('a.oid');
        $query = $builder->get();
        return $query->getResult();
    }

    public function crear_noticia_comentario_model($data){

        

        $db = \Config\Database::connect();
        $db->table('comentario')->insert($data);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
        /*echo "<pre>";
        print_r($data);*/
    }

    public function eliminar_comentario_model($oid_objeto){
        $db = \Config\Database::connect();
        $builder = $db->table('comentario');

        $builder->delete(['oid' => $oid_objeto]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function buscar_usuario_model( $grupo_ids, $comunidad_ids ){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('usuario.email');
        $builder->join('usuario_grupo', 'usuario_grupo.oid_usuario=usuario.oid');
        $builder->join('grupo', 'grupo.oid=usuario_grupo.oid_grupo');
        $builder->whereIn('usuario_grupo.rol', $grupo_ids );
        $builder->whereIn('usuario_grupo.oid_grupo', $comunidad_ids );
        $builder->orderBy('usuario.apellido_paterno', 'ASC');
        $query   = $builder->get();
        return $query->getResult();

    }
    public function all_buscar_usuario_model( $grupo_ids ){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('usuario.email');
        $builder->join('usuario_grupo', 'usuario_grupo.oid_usuario=usuario.oid');
        $builder->join('grupo', 'grupo.oid=usuario_grupo.oid_grupo');
        $builder->whereIn('usuario_grupo.rol', $grupo_ids );
        $builder->orderBy('usuario.apellido_paterno', 'ASC');
        $query   = $builder->get();
        return $query->getResult();

    }

}
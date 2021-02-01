<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\UsuarioModel;
class ComunidadModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'grupo';
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

    public function get_misComunidades(){

        $session = session();

        $db = \Config\Database::connect();
        //******************************************* */
        $builder = $db->table('usuario_permisos AS a');
        $builder->select('a.id,b.nombre AS nombre_grupo, b.descripcion,a.grupo_id');
        $builder->join('grupo AS b', 'a.grupo_id = b.oid');
        $builder->where( 'a.usuario_ids', $session->user_id );
        $builder->orderBy('a.id');

        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    //public function get_misComunidades(){
    //    $db = \Config\Database::connect();
    //    //******************************************* */
    //    $builder = $db->table('grupo');
    //    $builder->select('*, grupo.nombre as nombre_grupo');
    //    $builder->join('grupo_categoria', 'grupo_categoria.oid=grupo.oid_categoria', 'left');
    //    $builder->join('usuario_grupo', 'usuario_grupo.oid_grupo=grupo.oid', 'left');
    //    $builder->where('usuario_grupo.usgr_inactivo', '0');
    //    $builder->where('usuario_grupo.oid_usuario', '1');
    //    $builder->orderBy('grupo_categoria.nombre, grupo.nombre');

    //    $query   = $builder->get();
    //    $query = $query->getResult();
    //    return $query;
    //}
    /********************************************/
    /********************************************/
    public function crear_comunidad($datos_comunidad, $oid_usuario){
        $db = \Config\Database::connect();
        $db->table('grupo')->insert($datos_comunidad);

        if ($db->affectedRows() > 0){
            $id = $db->insertID();
            $datos_modulos = ["grupo_id"=>$id,"modulo_id"=>"2"];
            $db->table('grupo_modulos')->insert($datos_modulos);
            $datos_modulos = ["grupo_id"=>$id,"modulo_id"=>"3"];
            $db->table('grupo_modulos')->insert($datos_modulos);
            $datos_modulos = ["grupo_id"=>$id,"modulo_id"=>"4"];
            $db->table('grupo_modulos')->insert($datos_modulos);
            $datos_modulos = ["grupo_id"=>$id,"modulo_id"=>"7"];
            $db->table('grupo_modulos')->insert($datos_modulos);
            $datos_modulos = ["grupo_id"=>$id,"modulo_id"=>"8"];
            $db->table('grupo_modulos')->insert($datos_modulos);
            $datos_modulos = ["grupo_id"=>$id,"modulo_id"=>"62"];
            $db->table('grupo_modulos')->insert($datos_modulos);
            $new_data = array(
                'oid_usuario' => 1,
                'oid_grupo' => $id,
                'rol' => 'ADM',
                'oid_tutor' => 0,
                'conexiones' => 0,
                'hits_click' => 0,
                'hits_download' => 0,
                'hits_post' => 0,
                'hits_scorm' => 0
            );
            $cusuario = new UsuarioModel($db);
            $respuesta = $cusuario->crear_usuario_permisos_model($new_data);
            if ($respuesta == 'ok'){
                return TRUE;
            }else{
                return TRUE;
            }
            // $sql = "INSERT INTO grupo_modulos SELECT NULL, ".$id.", 2 FROM grupo;".
            // "INSERT INTO grupo_modulos SELECT NULL, ".$id.", 3 FROM grupo;".
            // "INSERT INTO grupo_modulos SELECT NULL, ".$id.", 4 FROM grupo;".
            // "INSERT INTO grupo_modulos SELECT NULL, ".$id.", 7 FROM grupo;".
            // "INSERT INTO grupo_modulos SELECT NULL, ".$id.", 8 FROM grupo;".
            // "INSERT INTO grupo_modulos SELECT NULL, ".$id.", 62 FROM grupo;";
            // $query = $this->db->query($sql);
            return TRUE;
        }else {
            return FALSE;
        }
    }


    /********************************************/
    /********************************************/
    public function obtenerComunidades(){
        $db = \Config\Database::connect();

        $builder = $db->table('grupo');
        $builder->select('*');
        $builder->orderBy('grupo.nombre', 'ASC');
        
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;

    }
    /********************************************/
    /********************************************/
    public function obtenerComunidadesActivas(){
        $db = \Config\Database::connect();

        $builder = $db->table('grupo');
        $builder->select('*');
        $builder->where('grupo.inactivo', '0');
        $builder->orderBy('grupo.nombre');
        
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;

    }
    /********************************************/
    /********************************************/
    public function buscarComunidad($datos_busqueda){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select("grupo.oid, replace(grupo.nombre, '".'"'."', '') as nombre, grupo.autoincorporacion, grupo.inactivo, grupo_categoria.nombre as gcnombre, (  
            select count(1) 
            from usuario_grupo ug 
            where ug.oid_grupo=grupo.oid ) as numUsers");
        $builder->join('grupo_categoria', 'grupo_categoria.oid=grupo.oid_categoria', 'left');
        $builder->like('grupo.nombre', $datos_busqueda['nombre']);
        if(isset($datos_busqueda['oid_categoria']) && !empty($datos_busqueda['oid_categoria'])){
            $builder->where('grupo.oid_categoria', $datos_busqueda['oid_categoria']);
        }
        $builder->orderBy('grupo_categoria.nombre, grupo.nombre');

        $query   = $builder->get();
        $query = $query->getResult();
        return $query;

        // "select g.oid, g.nombre, g.autoincorporacion, g.inactivo, gc.nombre as gcnombre, " .
        // "(  select count(1) 
        //     from usuario_grupo ug 
        //     where ug.oid_grupo=g.oid ) as numUsers " .
        // "from grupo g 
        // left join grupo_categoria gc on g.oid_categoria=gc.oid " .
        // "where g.nombre like ('$nombre') " .
        // "order by gc.nombre, g.nombre ";
    }

    public function buscarComunidadId($id){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select("grupo.oid, grupo.aulavirtual as aulavirtual, replace(grupo.nombre, '".'"'."', '') as nombre, grupo.autoincorporacion, grupo.inactivo, grupo_categoria.nombre as gcnombre, (  
            select count(1) 
            from usuario_grupo ug 
            where ug.oid_grupo=grupo.oid ) as numUsers");
        $builder->join('grupo_categoria', 'grupo_categoria.oid=grupo.oid_categoria', 'left');
        $builder->where('grupo.oid', $id);
        $builder->orderBy('grupo_categoria.nombre, grupo.nombre');

        $query   = $builder->get();
        $query = $query->getResult();
        return $query;

        // "select g.oid, g.nombre, g.autoincorporacion, g.inactivo, gc.nombre as gcnombre, " .
        // "(  select count(1) 
        //     from usuario_grupo ug 
        //     where ug.oid_grupo=g.oid ) as numUsers " .
        // "from grupo g 
        // left join grupo_categoria gc on g.oid_categoria=gc.oid " .
        // "where g.nombre like ('$nombre') " .
        // "order by gc.nombre, g.nombre ";
    }

    public function buscarComunidadHistorico($id){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select('*');
        $builder->where('oid_historico', $id);
        
        $query = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getLastInsertID(){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select('oid');
        $builder->orderBy('oid', 'DESC');
        $builder->limit(1);
        
        $query = $builder->get();
        return $query->getRow();
    }
    
    /********************************************/
    /********************************************/
    public function buscarComunidadNombre($nombre){
        $db = \Config\Database::connect();

        $builder = $db->table('grupo');
        $builder->select('*');
        $builder->where('nombre', $nombre);
        
        $query = $builder->get();
        $query = $query->getResult();
        return $query;

    }


    /********************************************/
    /********************************************/
    public function eliminar_comunidad($id_comunidad){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');

        $builder->delete(['oid' => $id_comunidad]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
    /********************************************/
    public function editar_comunidad($datos_comunidad){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        
        $builder->where('oid', $datos_comunidad['oid']);
        $response = $builder->update($datos_comunidad);
        
        return $response;
    }
    /********************************************/
    /********************************************/


    public function modulos($oid_grupo){
        $sql="SELECT modulo.id as id, modulo.nombre as nombre, dd.id as estatus FROM `modulo`".
        "LEFT JOIN grupo_modulos as dd ON modulo.id = dd.modulo_id AND dd.grupo_id='".$oid_grupo."' ".
        "WHERE modulo.tipo=1";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }


    public function crear_modulo_comunidad($datos){
        $db = \Config\Database::connect();
        try {
            $db->table('grupo_modulos')->insert($datos);

            if ($db->affectedRows() > 0){
                return TRUE;
            }else {
                return FALSE;
            }
        }catch (\Exception $e)
        {
            return FALSE;
        }
        
    }

    public function eliminar_modulo_comunidad($datos){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo_modulos');

        $builder->delete($datos);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    // public function UltimosDocumentos($oid_grupo){
    //     $sql="select ba.oid, ba.titulo " .
    //        "from biblio_categoria bc, biblio_archivo ba " .
    //        "where bc.oid_grupo=$oid_grupo and " .
    //        "bc.oid_team=0 and " .
    //        "bc.oid=ba.oid_categoria " .
    //        "order by ba.fecha desc";
    //     $db = \Config\Database::connect();
    //     $query = $this->db->query($sql);
    //     return $query->getResult();
    // }

    public function getLastGrupoId($user_id){
        $db = \Config\Database::connect();

        $builder = $db->table('evento');
        $builder->select('oid_grupo');
        $builder->where('oid_usuario', $user_id);
        $builder->orderBy('fecha', 'DESC');
        
        $query = $builder->get();
        // $query = $query->getResult();
        // return $query;
        $row = $query->getRow();
        return $row;
    }

    public function insertEventoCambioComunidad($dataEvento){
        $db = \Config\Database::connect();
        $db->table('evento')->insert($dataEvento);
        // $id = $db->insertID();
        if ($db->affectedRows() > 0){
            // return $id;
            return TRUE;
        }else {
            return FALSE;
        }
    }
}

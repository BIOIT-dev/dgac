<?php namespace App\Models;

use CodeIgniter\Model;

class MensajesModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'mensaje';
    protected $primaryKey = 'oid';

    protected $returnType     = 'array';

    protected $allowedFields = ['oid', 'oid_origen','oid_destino','texto','leido'.'fecha'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function agregar($datos){
        $db = \Config\Database::connect();
        $db->table('mensaje')->insert($datos);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function lists(){
        $db = \Config\Database::connect();
        $builder = $db->table('mensaje');
        $builder->select('*');
        $builder->orderBy('fecha');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }


    public function get_mensaje($oid){
        $db = \Config\Database::connect();
        $builder = $db->table('mensaje men');
        $builder->select('men.oid, men.texto, men.fecha, men.leido, us.nombres, us.email');
        $builder->join('usuario us', 'us.oid=men.oid_origen');
        $builder->where('men.oid', $oid);
        // $builder->orderBy('fecha DESC');
        $query = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function get_my_mensajes($oid){
        $db = \Config\Database::connect();
        $builder = $db->table('mensaje men');
        $builder->select('men.oid, men.texto, men.fecha, men.leido, us.nombres');
        $builder->join('usuario us', 'us.oid=men.oid_origen');
        $builder->where('men.oid_destino', $oid);
        $builder->orderBy('fecha DESC');
        $query = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function get_usuarios(){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario men');
        $builder->select('men.*');
        // $builder->join('usuario us', 'us.oid=men.oid_origen');
        // $builder->where('men.oid', $oid);
        // $builder->orderBy('fecha DESC');
        $query = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function get_send_mensajes($oid){
        $db = \Config\Database::connect();
        $builder = $db->table('mensaje men');
        $builder->select('men.oid, men.texto, men.fecha, men.leido, us.nombres');
        $builder->join('usuario us', 'us.oid=men.oid_origen');
        $builder->where('men.oid_origen', $oid);
        $builder->orderBy('fecha DESC');
        $query = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function lists_user_rol($rol,$grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario_grupo ug');
        $builder->select('ug.oid_usuario as oid,us.email as email');
        $builder->join('usuario us', 'us.oid=ug.oid_usuario');
        $builder->where('ug.oid_grupo', $grupo);
        $builder->where('ug.rol', $rol);
        $query = $builder->get();
        
        return $query->getResult();
    }

    

    // public function delete($id_mensaje){
    //     $db = \Config\Database::connect();
    //     $builder = $db->table('mensaje');

    //     $builder->delete(['oid' => $id_mensaje]);
    //     if ($db->affectedRows() > 0){
    //         return TRUE;
    //     }else {
    //         return FALSE;
    //     }
    // }

    public function edit($mensaje){
        $db = \Config\Database::connect();
        $builder = $db->table('mensaje');
        
        $builder->where('oid', $mensaje['oid']);
        $response = $builder->update($mensaje);
        
        return $response;
    }

    public function obtenerComunidad($oid_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario u');
        $builder->select('u.oid, u.nombres, u.apellidos');
        $builder->join("usuario_grupo ug", "ug.oid_usuario = u.oid");
        $builder->where('ug.oid_grupo', $oid_grupo);
        $builder->where('u.inactivo', 0);
        $builder->orderBy('u.nombres, u.apellidos');
        $query = $builder->get();
        return $query->getResult();
    }

    public function delete_messages($ids){
        $db = \Config\Database::connect();
        $builder = $db->table('mensaje');

        $builder->delete(['oid' => $ids]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

}
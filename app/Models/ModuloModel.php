<?php namespace App\Models;

use CodeIgniter\Model;

class ModuloModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'modulo';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = ['activo', 'tipo','panel_admin','nombre','url','orden'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function crear_modulo_model($fields){
        $db = \Config\Database::connect();
        $db->table('modulo')->insert($fields);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function buscar_modulo_model($datos_busqueda){
        $db = \Config\Database::connect();
        $builder = $db->table('modulo');
        $builder->select('*');
        // $builder->where('modulo.nombre', $datos_busqueda['nombre']);
        $builder->orderBy('modulo.nombre', 'ASC');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function buscar_modulo_model_all(){
        $db = \Config\Database::connect();
        $builder = $db->table('modulo');
        $builder->select('*');
        // $builder->where('modulo.nombre', $datos_busqueda['nombre']);
        $builder->orderBy('modulo.nombre', 'ASC');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function eliminar_modulo_model($id){
        $db = \Config\Database::connect();
        $builder = $db->table('modulo');

        $builder->delete(['id' => $id]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function editar_modulo_model($data_modulo){
        $db = \Config\Database::connect();
        $builder = $db->table('modulo');
        
        $builder->where('id', $data_modulo['id']);
        $response = $builder->update($data_modulo);
        
        return $response;
    }

    /**
    / Consultar datos
    */

    public function obtenerModulos(){
        $db = \Config\Database::connect();
        $builder = $db->table('modulo AS a');
        $builder->select('a.id,a.nombre,b.name');
        $builder->join("panel_admin AS b", "a.panel_admin = b.id",'left');
        $builder->orderBy('a.id');
        $query = $builder->get();
        return $query->getResult();
    }

    public function obtenerRolePermisos( $id ){
        $db = \Config\Database::connect();
        $builder = $db->table('modulo AS a');
        $builder->select('a.id, a.nombre , IF( a.id = b.modulo_id, b.id , 0 ) AS role_permisos_id, IF( a.id = b.modulo_id, "checked", "" ) AS modulo, b.acceso');
        $builder->join("role_permisos AS b", "a.id = b.modulo_id AND b.role_id = $id","left");
        $query = $builder->get();
        return $query->getResult();
        //$query = $db->getLastQuery();
        //return (string)$query;
    }

    public function obtenerPanelAdmin(){
        $db = \Config\Database::connect();
        $builder = $db->table('panel_admin');
        $builder->select('*');
        $builder->orderBy('id');
        $query = $builder->get();
        return $query->getResult();
    }

    public function setPanelAdmin($data){
        $db = \Config\Database::connect();
        $builder = $db->table('panel_admin');
        $builder->where('id', $data['id']);
        $response = $builder->update($data);
        return $response;
    }


    public function getPanelAdmin($id){
        $db = \Config\Database::connect();
        $builder = $db->table('panel_admin cs');
        $builder->select('*');
        $builder->where('cs.id', $id);
        $query = $builder->get();
        return $query->getRow();
    }

    public function addPanelAdmin($data){
        $db = \Config\Database::connect();
        $db->table('panel_admin')->insert($data);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function deletePanelAdmin($id){
        $db = \Config\Database::connect();
        $builder = $db->table('panel_admin');
        $builder->delete(['id' => $id]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

}
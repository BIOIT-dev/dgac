<?php namespace App\Models;

use CodeIgniter\Model;

class RolesModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'roles';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = ['name', 'is_active','user_id'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function crear_role_model($fields){
        $db1 = \Config\Database::connect();
        $data1['name'] = $fields['name'];
        $data1['is_active'] = $fields['is_active'];
        $data1['user_id'] = $fields['user_id'];
        $db1->table('roles')->insert($data1);
        $insertID = $db1->insertID();
        if ($db1->affectedRows() > 0){

            $db2 = \Config\Database::connect();
            foreach ($fields['modulo_id'] as $key => $value) {
                
                $data2['role_id']   = $insertID;
                $data2['modulo_id'] = $fields['modulo_id'][$key];
                $data2['acceso']    = $fields['acceso'][$key];

                $db2->table('role_permisos')->insert($data2);

            }

            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function modulos($role_id){
        $sql="SELECT modulo.id as id,modulo.controller, modulo.method,modulo.url, modulo.nombre as nombre, dd.id as estatus FROM `modulo`".
        "LEFT JOIN role_permisos as dd ON modulo.id = dd.modulo_id AND dd.role_id='".$role_id."' ";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function buscar_role_model(){
        $db = \Config\Database::connect();
        $builder = $db->table('roles');
        $builder->select('*');
        // $builder->where('roles.name', $datos_busqueda['name']);
        $builder->orderBy('roles.name', 'ASC');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function buscar_role_clave($clave){
        $db = \Config\Database::connect();
        $builder = $db->table('roles');
        $builder->select('*');
        $builder->where('roles.clave', $clave);
        $query = $builder->get();
        return $query->getResult();
    }

    public function eliminar_role_model($id){
        $db = \Config\Database::connect();
        $builder = $db->table('roles');

        $builder->delete(['id' => $id]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function editar_role_model( $roles_send, $role_permisos, $role_modulos ){
        $db = \Config\Database::connect();
        $builder = $db->table('roles');
        
        $builder->where('id', $roles_send['id']);
        $response = $builder->update($roles_send);

        // Generacion de guardado de los datos
        $db2 = \Config\Database::connect();
        foreach ($role_permisos['modulo_id'] as $key => $value) {
            
            $data2['modulo_id'] = $role_permisos['modulo_id'][$key];
            $data2['acceso']    = $role_permisos['acceso'][$key];

            if( $role_permisos['role_permisos_id'][$key] == 0 ){
                unset($role_permisos['role_permisos_id'][$key]);
                $data2['role_id'] = $roles_send['id'];
                $db2->table('role_permisos')->insert($data2);
            }

            //echo $role_permisos['role_permisos_id'][$key]." ( Modulo: ".$data2['modulo_id']." | ".$data2['lectura']." | ".$data2['escritura']." | ".$data2['eliminar']." )<br>";
            
            if( isset($role_permisos['role_permisos_id'][$key]) ){

                $builder2 = $db2->table('role_permisos');
                $builder2->where('id', $role_permisos['role_permisos_id'][$key] );
                unset($data2['modulo_id']);
                $builder2->update($data2);

            }

            //$query = $db2->getLastQuery();
            //echo (string)$query."<br>";
            
        }
        
        // Eliminar los módulos asociados al rol que sean desmarcados en la vista de edición
        $ids_modulos_nuevos = $role_permisos['modulo_id'];
        $ids_modulos_actuales = array();
        foreach($role_modulos as $modulo){
			if($modulo->role_permisos_id != 0){
				$ids_modulos_actuales[] = $modulo->id;
			}
		}
		// Comparamos los módulos actuales con los nuevos y eliminamos si procede
		foreach($ids_modulos_actuales as $id_modulo){
			if(!in_array($id_modulo, $ids_modulos_nuevos)){
				$eliminar_modulo_asociado = $this->eliminar_role_permisos($roles_send['id'], $id_modulo);
			}
		}
        
        return $response;
    }
	
	// Eliminar role_permisos
    public function eliminar_role_permisos($role_id, $modulo_id){
        $db = \Config\Database::connect();
        $builder = $db->table('role_permisos');

        $builder->delete(['role_id' => $role_id, 'modulo_id' => $modulo_id]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    /**
    / Consultar datos
    */

    public function obtenerRules(){
        $db = \Config\Database::connect();
        $builder = $db->table('roles');
        $builder->select('*');
        $builder->orderBy('id');
        $query = $builder->get();
        return $query->getResult();
    }

}

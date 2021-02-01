<?php namespace App\Models;

use CodeIgniter\Model;

class AccesoModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'usuario_permisos';
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

    public function crear_acceso_model($fields){
        $db = \Config\Database::connect();
        $count_errors = 0;
        $count_exists = 0;
        foreach($fields['usuario_ids'] as $usuario_id){
			
			// Buscamos si el usuario ya está en el grupo
			$builder = $db->table('usuario_grupo');
			$builder->where( 'oid_grupo', $fields['grupo_id'] );
			$builder->where( 'oid_usuario', $usuario_id );
			$query = $builder->get();
			
			if(count($query->getResult()) == 0){
				
				$new_data = array(
					'oid_usuario' => $usuario_id,
					'oid_grupo' => $fields['grupo_id'],
					'rol' => $fields['role_clave'],
					'oid_tutor' => 0,
					'conexiones' => 0,
					'hits_click' => 0,
					'hits_download' => 0,
					'hits_post' => 0,
					'hits_scorm' => 0
				);
				
				$db->table('usuario_grupo')->insert($new_data);
				
				if ($db->affectedRows() == 0){
					$count_errors++;
				}
							
			}else{
				$count_exists++;
			}
		}
        
        //~ unset($fields['tabla_usuarios_length']);
        //~ $db->table('usuario_permisos')->insert($fields);
        //~ if ($db->affectedRows() > 0){
            //~ return TRUE;
        //~ }else {
            //~ return FALSE;
        //~ }
        
        return array($count_errors, $count_exists);
    }
	
	// Buscar una combinación específica de grupo/rol de la tabla 'usuario_grupo'
    public function buscar_acceso_model($datos_busqueda){
        $db = \Config\Database::connect();
        $busqueda = explode(";", $datos_busqueda['ids']);
        $rol = $busqueda[0];
        $oid_grupo = $busqueda[1];
        $builder = $db->table('usuario_grupo');
        $builder->select('usuario_grupo.rol, usuario_grupo.oid_grupo, roles.name, grupo.nombre');
        $builder->join('roles', 'usuario_grupo.rol = roles.clave');
        $builder->join('grupo', 'usuario_grupo.oid_grupo = grupo.oid');
        $builder->where('usuario_grupo.rol', $rol);
        $builder->where('usuario_grupo.oid_grupo', $oid_grupo);
        $builder->groupBy('usuario_grupo.rol, usuario_grupo.oid_grupo');
        //~ $builder = $db->table('usuario_permisos');
        //~ $builder->select('usuario_permisos.id, roles.name, grupo.nombre');
        //~ $builder->join('roles', 'usuario_permisos.role_id = roles.id');
        //~ $builder->join('grupo', 'usuario_permisos.grupo_id = grupo.oid');
        //~ $builder->where('usuario_permisos.id', $datos_busqueda['id']);
        //~ $builder->orderBy('usuario_permisos.id', 'ASC');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
	
	// Buscar los usuarios de una combinación específica de grupo/rol de la tabla 'usuario_grupo'
    public function buscar_acceso_model_usuarios($datos_busqueda){
        $db = \Config\Database::connect();
        $busqueda = explode(";", $datos_busqueda['ids']);
        $rol = $busqueda[0];
        $oid_grupo = $busqueda[1];
        $builder = $db->table('usuario_grupo');
        $builder->select('oid_usuario');
        $builder->where('usuario_grupo.rol', $rol);
        $builder->where('usuario_grupo.oid_grupo', $oid_grupo);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function eliminar_role_model($id){
        $db = \Config\Database::connect();
        $builder = $db->table('acceso');

        $builder->delete(['id' => $id]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function editar_acceso_model($data_role){
        $db = \Config\Database::connect();
        $count_errors = 0;
        foreach($data_role['usuario_ids'] as $usuario_id){
			
			// Buscamos si el usuario ya está en el grupo
			$builder = $db->table('usuario_grupo');
			$builder->where( 'oid_grupo', $data_role['grupo_id'] );
			$builder->where( 'oid_usuario', $usuario_id );
			$query = $builder->get();
			
			if(count($query->getResult()) == 0){
				
				$new_data = array(
					'oid_usuario' => $usuario_id,
					'oid_grupo' => $data_role['grupo_id'],
					'rol' => $data_role['role_clave'],
					'oid_tutor' => 0,
					'conexiones' => 0,
					'hits_click' => 0,
					'hits_download' => 0,
					'hits_post' => 0,
					'hits_scorm' => 0
				);
				
				$db->table('usuario_grupo')->insert($new_data);
				
				if ($db->affectedRows() == 0){
					$count_errors++;
				}
							
			}else{
				$new_role = array(
					'rol' => $data_role['role_clave'],
				);
				$builder = $db->table('usuario_grupo');
				$builder->where('oid_usuario', $usuario_id);
				$builder->where('oid_grupo', $data_role['grupo_id']);
				$response = $builder->update($new_role);
			}
		}
		
		// Eliminar los usuario asociados al grupo/rol que sean desmarcados en la vista de edición
        $ids_usuarios_nuevos = $data_role['usuario_ids'];
        $ids_usuarios_actuales = $data_role['usuario_ids_actuales'];
		// Comparamos los usuarios actuales con los nuevos y eliminamos si procede
		foreach($ids_usuarios_actuales as $id_usuario){
			if(!in_array($id_usuario, $ids_usuarios_nuevos)){
				$eliminar_usuario_asociado = $this->eliminar_usuarios_grupo_role($id_usuario, $data_role['grupo_id'], $data_role['role_clave']);
			}
		}
		
        //~ $builder = $db->table('usuario_permisos');
        //~ unset($data_role['tabla_usuarios_length']);
        //~ $builder->where('id', $data_role['id']);
        //~ $response = $builder->update($data_role);
        
        //~ return $response;
        
        return $count_errors;
    }
    
    // Eliminar usuario/grupo/rol
    public function eliminar_usuarios_grupo_role($usuario_id, $grupo_id, $role_clave){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario_grupo');

        $builder->delete(['oid_usuario' => $usuario_id, 'oid_grupo' => $grupo_id, 'rol' => $role_clave]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    /**
    / Consulta de datos
    */
	// Buscar las diferentes combinaciones de grupo/rol de la tabla 'usuario_grupo'
    public function obtenerAcceso(){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario_grupo');
        $builder->select('usuario_grupo.rol, usuario_grupo.oid_grupo, roles.name, grupo.nombre');
        $builder->join('roles', 'usuario_grupo.rol = roles.clave');
        $builder->join('grupo', 'usuario_grupo.oid_grupo = grupo.oid');
        $builder->groupBy('usuario_grupo.rol, usuario_grupo.oid_grupo');
        //$builder = $db->table('usuario_permisos');
        //$builder->select('usuario_permisos.id, roles.name, grupo.nombre');
        //$builder->join('roles', 'usuario_permisos.role_id = roles.id');
        //$builder->join('grupo', 'usuario_permisos.grupo_id = grupo.oid');
        //$builder->orderBy('id');
        $query = $builder->get();
        return $query->getResult();
    }

    public function obtenerComunidades(){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select('*');
        $builder->orderBy('oid');
        $query = $builder->get();
        return $query->getResult();
    }

    /**
    / Consulta de datos
    */

    public function UsuarioPermisos( $user_id ){
        
        $db = \Config\Database::connect();
        $sql = "SELECT a.oid_usuario, a.rol, b.name AS role, b.id AS role_id, c.nombre AS grupo, c.oid AS grupo_id 
                FROM usuario_grupo AS a 
                JOIN roles AS b ON a.rol = b.clave 
                JOIN grupo AS c ON a.oid_grupo = c.oid 
                WHERE a.oid_usuario = $user_id
                ORDER BY a.oid_grupo ASC 
                LIMIT 1";
        
        $query = $db->query( $sql );
        return $query->getRow();
        //~ $sql = "SELECT a.id, a.role_id, b.name AS role, c.nombre AS grupo, c.oid AS grupo_id, a.usuario_ids 
                //~ FROM usuario_permisos AS a 
                //~ JOIN roles AS b ON a.role_id = b.id 
                //~ JOIN grupo AS c ON a.grupo_id = c.oid 
                //~ WHERE FIND_IN_SET($user_id,a.usuario_ids) AND a.grupo_id = c.oid
                //~ ORDER BY a.id";
        
        //~ $query = $db->query( $sql );
        //~ return $query->getRow();

        //$query = $db->getLastQuery();
        //echo (string)$query."<br>";
    }

    public function UsuarioPermisosGrupo( $user_id, $grupo_id ){
        
        $db = \Config\Database::connect();
        $sql = "SELECT a.oid_usuario, a.rol, b.name AS role, b.id AS role_id, c.nombre AS grupo, c.oid AS grupo_id 
                FROM usuario_grupo AS a 
                JOIN roles AS b ON a.rol = b.clave 
                JOIN grupo AS c ON a.oid_grupo = c.oid 
                WHERE a.oid_grupo = $grupo_id and a.oid_usuario = $user_id
                ORDER BY a.oid_grupo";
        
        $query = $db->query( $sql );
        return $query->getRow();

        //$query = $db->getLastQuery();
        //echo (string)$query."<br>";
    }

    public function RolePermisos( $role_id,$grupo_id ){
        $db = \Config\Database::connect();
        $builder = $db->table('role_permisos AS a');
        $builder->select(' b.* ,c.name, a.acceso,gm.id as id_gm ');
        $builder->join('modulo AS b', 'a.modulo_id = b.id');
        $builder->join('panel_admin AS c', 'b.panel_admin = c.id','left');
        $builder->join('grupo_modulos AS gm', 'gm.modulo_id = b.id and gm.grupo_id = '.$grupo_id,'left');

        $builder->where('role_id', $role_id );
        //$builder->orderBy('a.id');
        $builder->orderBy('b.orden','ASC');
        $query = $builder->get();
        return $query->getResult();
        //$query = $db->getLastQuery();
        //echo (string)$query."<br>";
    }

    public function PanelAdmin( $role_id ){
        $db = \Config\Database::connect();
        $builder = $db->table('role_permisos AS a');
        $builder->select(' c.id, c.name ');
        $builder->join('modulo AS b', 'a.modulo_id = b.id');
        $builder->join('panel_admin AS c', 'b.panel_admin = c.id','left');
        $builder->where('a.role_id', $role_id );
        $builder->where('b.tipo', 2 );
        $builder->groupBy('c.name');
        $builder->orderBy('a.id');
        $query = $builder->get();
        return $query->getResult();
        //$query = $db->getLastQuery();
        //echo (string)$query."<br>";
    }
    
    // Consulta de permisos por rol y grupo
    public function PermisosRoleGrupo( $role_grupo ){
		$db = \Config\Database::connect();
        $builder = $db->table('usuario_permisos');
        $builder->select('*');
        $builder->where('role_id', $role_grupo['role_id']);
        $builder->where('grupo_id', $role_grupo['grupo_id']);
        $builder->orderBy('id', 'ASC');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    

    public function RegistroLog( $user_id ){
        
        $db = \Config\Database::connect();
        $sql = "insert into evento( session, oid_usuario, fecha, seccion, oid_grupo, evento, p1, p2 ) " . "values( 'cvirtual_session', '1', '2020-12-12 12:12:12', 'testing', '1', 'ingreso', '', '' )";

        $query = $db->query( $sql );
        return $query->getRow();
        
    }

}

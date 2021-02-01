<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'usuario';
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

    public function crear_usuario_model($datos_usuario){
        $db = \Config\Database::connect();
        $db->table('usuario')->insert($datos_usuario);
        $id = $db->insertID();
        if ($db->affectedRows() > 0){
            return $id;
        }else {
            return FALSE;
        }
        // var_dump($rows);
        // return $builder->affected_rows();
        // var_dump($builder);
        // foreach ($builder as $buil)
        //     var_dump($build);
    }

    public function buscar_usuario_model($datos_busqueda){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        // var_dump($datos_busqueda);
        $builder->distinct();
        $builder->select(' usuario.inactivo, usuario.userid , usuario_grupo.oid_usuario, usuario.apellido_paterno, usuario.apellido_materno, usuario.nombres, ');
        $builder->join('usuario_grupo', 'usuario_grupo.oid_usuario=usuario.oid');
        $builder->join('grupo', 'grupo.oid=usuario_grupo.oid_grupo');
        if ($datos_busqueda['userid'] != '') $builder->like('usuario.userid', $datos_busqueda['userid']);
        if ($datos_busqueda['nombres'] != '') $builder->like('usuario.nombres', $datos_busqueda['nombres']);
        if ($datos_busqueda['apellido_paterno'] != '') $builder->like('usuario.apellido_paterno', $datos_busqueda['apellido_paterno']);
        if ($datos_busqueda['apellido_materno'] != '') $builder->like('usuario.apellido_materno', $datos_busqueda['apellido_materno']);
        if ($datos_busqueda['rol'] != '') $builder->where('usuario_grupo.rol', $datos_busqueda['rol']);
        if ($datos_busqueda['comunidad'] != '') $builder->where('grupo.oid', $datos_busqueda['comunidad']);
        $builder->orderBy('usuario.apellido_paterno', 'ASC');
        // $builder->join('grupo', 'usuario_grupo.oid_grupo=grupo.oid');
        // $builder->where('usuario_grupo.oid_usuario', '1');
        // $builder->orderBy('grupo.nombre', 'ASC');

        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }


    public function usuarios_json(){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        // var_dump($datos_busqueda);
        $builder->select('*');
        $builder->join('usuario_grupo', 'usuario_grupo.oid_usuario=usuario.oid');
        $builder->join('grupo', 'grupo.oid=usuario_grupo.oid_grupo');
        $builder->orderBy('usuario.apellido_paterno', 'ASC');
        // $builder->join('grupo', 'usuario_grupo.oid_grupo=grupo.oid');
        // $builder->where('usuario_grupo.oid_usuario', '1');
        // $builder->orderBy('grupo.nombre', 'ASC');

        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }


    public function obtenerProfesoresComunidad($oid_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario u');
        $builder->select('u.oid, u.nombres, u.apellidos');
        $builder->join("usuario_grupo ug", "ug.oid_usuario = u.oid");
        $builder->where('ug.oid_grupo', $oid_grupo);
        $builder->where('ug.rol', 'PRO');
        $builder->where('u.inactivo', 0);
        $builder->orderBy('u.nombres, u.apellidos');
        $query = $builder->get();
        return $query->getResult();
    }


    public function buscar_usuario_mi_comunidad($datos_busqueda){
        // $db = \Config\Database::connect();
        $uid_grupo = $datos_busqueda['comunidad'];
        $rol = $datos_busqueda['rol'];
        $sql = "select u.*, ug.rol, ug.oid_tutor, ug.conexiones as xconexiones, " . 
        'date_format("ug.ultima_conexion", "%d/%m/%Y %H:%i:%s")' . "as xultima_conexion, " . 
        'date_format("ug.pultima_conexion", "%d/%m/%Y %H:%i:%s")' . " as xpultima_conexion, " . 
        "e.nombre as enombre " . 
        "from usuario u inner join usuario_grupo ug on u.oid=ug.oid_usuario " . 
        "left join empresa e on e.oid=u.oid_empresa " . 
        "where u.inactivo=0 and ug.usgr_inactivo=0 and ug.oid_grupo=$uid_grupo and ug.rol='$rol' " .
        "order by u.apellido_paterno";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();

        // $builder = $db->table('usuario');
        // $builder->select('usuario.*');
        // $builder->join('usuario_grupo', 'usuario_grupo.oid_usuario=usuario.oid');
        // $builder->join('grupo', 'grupo.oid=usuario_grupo.oid_grupo');
        
        // $builder->where('grupo.oid', $datos_busqueda['comunidad']);
        // if ($datos_busqueda['rol'] != '') $builder->where('usuario_grupo.rol', $datos_busqueda['rol']);
        // $builder->orderBy('usuario.apellido_paterno', 'ASC');

        // $query   = $builder->get();
        // $query = $query->getResult();
        // return $query;
    }

    public function eliminar_usuario_model($id_usuario){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');

        $builder->delete(['oid' => $id_usuario]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function editar_usuario_model($datos_usuario){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        
        $builder->where('oid', $datos_usuario['oid']);
        $response = $builder->update($datos_usuario);
        
        return $response;
    }

    /**
    / Consultar datos
    */

    public function getAllUsuario(){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('usuario.oid, usuario.nombres, usuario.apellidos');
        $builder->orderBy('oid', 'ASC');
        //$builder->limit(14);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getUsuario( $userid ){
        // echo $userid;
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('*');
        $builder->where('userid', $userid );
        $builder->orderBy('oid');
        $query = $builder->get();
        // echo var_dump($query);
        return $query->getRowArray();
    }

    public function getUsuario2( $oid ){
        // echo $userid;
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('*');
        $builder->where('oid', $oid );
        // $builder->orderBy('oid');
        $query = $builder->get();
        // echo var_dump($query);
        return $query->getRow();
    }

    

    public function login_validar_model( $datos ){

        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('*');
        $builder->where('userid', $datos['userid']);
        $builder->where('clave', md5($datos['clave']));
        $query = $builder->get();
        if ($db->affectedRows() > 0){
            return 1;
        }else {
            return 0;
        }

    }

    public function obtenerComunidades(){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select('*');
        $builder->orderBy('oid');
        $query = $builder->get();
        return $query->getResult();
    }

    public function crear_usuario_permisos_model($data){
        $db = \Config\Database::connect();
        
        $builder = $db->table('usuario_grupo');
        $builder->where( 'oid_grupo', $data['oid_grupo'] );
        $builder->where( 'oid_usuario', $data['oid_usuario'] );
        $query = $builder->get();
        
        if(count($query->getResult()) > 0){
			return 'existe';
		}else{
			$db->table('usuario_grupo')->insert($data);
			if ($db->affectedRows() > 0){
				return 'ok';
			}else {
				return 'error';
			}			
		}
    }

    public function find_grupo($data){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo');
        $builder->select('oid,nombre');
        $builder->like( 'nombre', $data['grupo_name'] );
        $builder->orderBy('oid');
        $query = $builder->get();
        return $query->getResult();
    }

    public function list_access_users($id){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario_grupo AS a');
        $builder->select('a.oid_usuario, a.oid_grupo, b.clave, c.nombre AS grupo, c.oid as grupo_id, c.nombre as nombre_grupo, c.descripcion as descripcion,ca.oid as categoria_oid ,ca.nombre as categoria');
        $builder->join('roles AS b', 'a.rol = b.clave');
        $builder->join('grupo AS c', 'a.oid_grupo = c.oid');
        $builder->join('grupo_categoria AS ca', 'c.oid_categoria = ca.oid','left');
        $builder->where( 'a.oid_usuario', $id );
        $builder->orderBy('ca.nombre, c.nombre, a.oid_grupo');
        $query = $builder->get();
        return $query->getResult();
    }

    public function editar_usuario_permisos_model( $datos ){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario_grupo');
        foreach ($datos['grupos_id'] as $key => $value) {
            
            $grupo_id = $datos['grupos_id'][$key];
            $builder->where( 'oid_usuario', $datos['id_usuario'] );
            $builder->where( 'oid_grupo', $grupo_id );
            $builder->update(array( 'rol' => $datos['roles_id'][$key] ));

        }
    }
    
    /* Verificar si un usuario pertenece a un grupo */
    public function verificarUsuarioGrupo($oid_usuario, $goid){
        $sql="select 1 from usuario_grupo where oid_usuario=$oid_usuario and oid_grupo=$goid";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }
    
    /* Registrar un usuario en un grupo y rol específico */
    public function registrarUsuarioGrupo($datos_usuario_grupo){
        $db = \Config\Database::connect();
        $db->table('usuario_grupo')->insert($datos_usuario_grupo);
        $id = $db->insertID();
        if ($db->affectedRows() > 0){
            return $id;
        }else {
            return FALSE;
        }
    }
    
    /* Obteber los usuarios de un grupo y rol específicos */
    public function obtenerUsuariosGrupoRol($coid, $rol){
        $sql="select u.oid, u.userid, u.clave, u.rut, " .
			   "u.nombres, u.apellido_paterno, u.apellido_materno, u.sexo, u.fecnac, " .
			   "u.profesion, u.email, u.fono, u.direccion, u.comuna, u.ciudad, ug.rol  " .
			   "from usuario_grupo ug inner join usuario u on ug.oid_usuario=u.oid and u.inactivo=0 " .
			   "where ug.oid_grupo = $coid and ug.rol='$rol' " .
			   "order by u.apellidos, u.nombres";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }
    
    /* Registrar un usuario con una consulta alternativa desde el controlador */
    public function registrarUsuarioAlt($sql){
        $db = \Config\Database::connect();
        $query = $db->query($sql);
        $id = $db->insertID();
        if ($db->affectedRows() > 0){
            return $id;
        }else {
            return FALSE;
        }
    }
    
    /* Obteber fecha actual en dos formatos */
    public function fecha_actual(){
        $sql="select date_format( now() , '%d/%m/%Y %H:%i:%s' ) as ahora, now() as today";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getRow();
    }

    /******************************************************************/
    // Cambio de contraseña
    /******************************************************************/

    public function getUsuarioEmail( $email ){
        
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('oid');
        $builder->where('email', $email );
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function change_password($data){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        
        $builder->where('email', $data['email_user']);
        $response = $builder->update( array( 'clave' => md5($data['password_one']) ) );
        
        return $response;
    }

    public function validarUserid($userid, $rut){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('*');
        $builder->where('usuario.userid='.$userid." or usuario.rut='".$rut."'");
        // $builder->orderBy('grupo.nombre', 'ASC');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }


    public function buscar_rol($oid_usuario, $grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario_grupo');
        // var_dump($datos_busqueda);
        $builder->select('usuario_grupo.rol');
      
        $builder->where("usuario_grupo.oid_usuario=".$oid_usuario." and  usuario_grupo.oid_grupo=".$grupo);
        // $builder->orderBy('grupo.nombre', 'ASC');
        $query = $builder->get();
        // echo var_dump($query);
        return $query->getRow();

    }

}

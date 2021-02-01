<?php namespace App\Models;

use CodeIgniter\Model;


class ForoPostModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'foro_post';
    protected $primaryKey = 'oid';

    protected $returnType     = 'array';

    protected $allowedFields = ['oid_foro', 'oid_padre','fecha','oid_usuario','asunto','texto','archivo','jerarquia','oid_team','inactivo','zona_home'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public $oid_padre= 0;

    public function getAllElement(){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('*');
        $builder->orderBy($this->primaryKey);
        $query = $builder->get();
        return $query->getResult();
    }

    public function setElement($data){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->where($this->primaryKey, $data[$this->primaryKey]);
        $response = $builder->update($data);
        return $response;
    }

    public function getTeam($oid_grupo, $oid_team){
        $db = \Config\Database::connect();
        $builder = $db->table('team'); 
       
        $builder->select('team.oid, team.nombre');
        $builder->where('team.oid_grupo', $oid_grupo);
        $builder->where('team.oid', $oid_team);
        $builder->limit(1);
        $query = $builder->get();

        if ($query->getRow())
            return $query->getRow();
        else
            return false;
    }

    public function getElement($id){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('*');
        $builder->where($this->primaryKey, $id);
        $query = $builder->get();
        return $query->getRow();
    }



    public function getElementFindName($name, $oidForo){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->selectCount('oid');
        $builder->where('asunto', $name);
        $builder->where('oid_padre', 0);
        $builder->where('oid_foro', $oidForo);
        $query = $builder->get();
        return $query->getRow();
    }

    public function getElementFindNameEdit($name, $oidForo, $id){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->selectCount('oid');
        $builder->where('asunto', $name);
        $builder->where('oid_padre', 0);
        $builder->where('oid_foro', $oidForo);
        $builder->where('oid', '<>', $id);
        $query = $builder->get();
        return $query->getRow();
    }

    public function getFilterElement($oid_foro){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('foro_post.oid, foro_post.oid_foro, foro_post.asunto, foro_post.oid_usuario, foro_post.fecha,foro_post.texto, foro_post.oid_team, usuario.nombres, usuario.apellidos, usuario.foto, foro_post.oid_usuario');
        $builder->join('usuario', "usuario.oid = ".$this->table.".oid_usuario", 'letf');
        $builder->where('oid_foro', $oid_foro);
        $builder->where('oid_padre', 0);
        $builder->orderBy($this->primaryKey);
        $query = $builder->get();
        return $query->getResult();
    }

     public function getFilterElementDesc($oid_foro){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('foro_post.oid, foro_post.oid_foro, foro_post.asunto, foro_post.oid_usuario, foro_post.fecha,foro_post.texto, usuario.nombres, usuario.apellidos, usuario.foto, foro_post.oid_usuario');
        $builder->join('usuario', "usuario.oid = ".$this->table.".oid_usuario", 'letf');
        $builder->where('oid_foro', $oid_foro);
        $builder->where('oid_padre', 0);
        $builder->orderBy('fecha', 'desc');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getFilterElementParent($oid_padre){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('foro_post.oid, foro_post.asunto, foro_post.fecha,foro_post.texto,foro_post.jerarquia, usuario.nombres, usuario.apellidos, usuario.foto');
        $builder->join('usuario', "usuario.oid = ".$this->table.".oid_usuario");
        //$builder->where('oid_foro', $oid_foro);
        $builder->where('oid_padre', $oid_padre);
        //$builder->orderBy($this->primaryKey);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getCountPost($oid_padre){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->selectCount('foro_post.oid');
        $builder->join('usuario', "usuario.oid = ".$this->table.".oid_usuario", 'left');
        //$builder->where('oid_foro', $oid_foro);
        $builder->where('oid_padre', $oid_padre);
        //$builder->orderBy($this->primaryKey);
        $query = $builder->get();
        return $query->getResult()[0]->oid;
    }

    public function getPostResponse($oid_padre){
        $this->oid_padre = $oid_padre;
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('foro_post.oid, foro_post.oid_foro, foro_post.oid_padre, foro_post.asunto, foro_post.archivo, foro_post.oid_usuario, foro_post.fecha,foro_post.texto,foro_post.jerarquia, usuario.nombres, usuario.apellidos, usuario.foto');
        $builder->join('usuario', "usuario.oid = ".$this->table.".oid_usuario", 'left');
        //$builder->where('oid_foro', $oid_foro);
        $builder->where('oid_padre', $oid_padre);
        $builder->orderBy('foro_post.jerarquia', 'asc');
        //$query = $builder->get();
        //return $query->getResult();
        return $this;
    }

     public function getPostResponseData($oid_padre){
        $this->oid_padre = $oid_padre;
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('foro_post.oid, foro_post.oid_foro, foro_post.oid_padre, foro_post.asunto, foro_post.archivo, foro_post.oid_usuario, foro_post.fecha,foro_post.texto,foro_post.jerarquia, usuario.nombres, usuario.apellidos, usuario.foto');
        $builder->join('usuario', "usuario.oid = ".$this->table.".oid_usuario", 'left');
        //$builder->where('oid_foro', $oid_foro);
        $builder->where('oid_padre', $oid_padre);
        $builder->orderBy('foro_post.jerarquia', 'asc');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getLastPost($oid_padre){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->selectMax('foro_post.fecha');
        $builder->join('usuario', "usuario.oid = ".$this->table.".oid_usuario");
        $builder->where('oid_padre', $oid_padre);
        $builder->orderBy('fecha', 'desc');
        $query = $builder->get();
        return $query->getResult()[0]->fecha;
    }

    public function addElement($data){
        $db = \Config\Database::connect();
        $db->table($this->table)->insert($data);
        $id = $db->insertID();
        if ($db->affectedRows() > 0){
            return $id;
        }else {
            return FALSE;
        }
    }

    public function deleteElement($id){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->delete([$this->primaryKey => $id]);

        if ($db->affectedRows() > 0){
            //Eliminos sus post hijos
            $builder = $db->table($this->table);
            $builder->delete(['oid_padre' => $id]);

            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function deletePost($id){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->delete([$this->primaryKey => $id]);

        if ($db->affectedRows() > 0){
           
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function findAll(int $limit = 10, int $offset = 0)
    {

        $builder = $this->builder();
        $builder->select('foro_post.oid, foro_post.oid_padre, foro_post.asunto, foro_post.oid_foro, foro_post.archivo, foro_post.oid_usuario, foro_post.fecha,foro_post.texto,foro_post.jerarquia, usuario.nombres, usuario.apellidos, usuario.foto');
        $builder->join('usuario', "usuario.oid = ".$this->table.".oid_usuario", 'left');
        //$builder->where('oid_foro', $oid_foro);
        $builder->where('oid_padre', $this->oid_padre);
        $builder->orderBy('foro_post.jerarquia', 'asc');
      
        if ($this->tempUseSoftDeletes === true)
        {
            $builder->where($this->table . '.' . $this->deletedField, null);
        }

        $row = $builder->limit($limit, $offset)
                ->get();

        $row = $row->getResult($this->tempReturnType);

        $eventData = $this->trigger('afterFind', ['data' => $row, 'limit' => $limit, 'offset' => $offset]);

        $this->tempReturnType     = $this->returnType;
        $this->tempUseSoftDeletes = $this->useSoftDeletes;


        return $eventData['data'];
    }

    public function countAllResults(bool $reset = true, bool $test = false)
    {
        if ($this->tempUseSoftDeletes === true)
        {
            $this->builder()->where($this->table . '.' . $this->deletedField, null);
        }
        $this->tempUseSoftDeletes = $this->useSoftDeletes;

      
        //$this->builder()->join('usuario', "usuario.oid = ".$this->table.".oid_usuario", 'left');
  
        $this->builder()->where('oid_padre', $this->oid_padre);

        return $this->builder()->testMode($test)->countAllResults($reset);
    }

    public function getParticipacionesUser($tema, $grupo_id){
        $db = \Config\Database::connect();

        $query = $db->query("select u.apellido_paterno, u.apellido_materno, u.nombres, ug.rol, 
           (select count(1) from foro_post p where p.oid_padre=$tema->oid and p.oid_usuario=u.oid ) as cnt,
           IFNULL('tm.oid_usuario', '0' )  as team_member 
            from usuario u 
            inner join usuario_grupo ug on u.oid=ug.oid_usuario and ug.oid_grupo=$grupo_id 
            left join team_member tm on tm.oid_usuario=u.oid and tm.oid_team=$tema->oid_team and tm.oid_grupo=$grupo_id
            where u.inactivo=0 
            order by ug.rol, u.apellido_paterno, u.apellido_materno, u.nombres");

        $results = $query->getResult();
   
        if (count($results) > 0)
            return $results;
        else
            return false;

    }
}
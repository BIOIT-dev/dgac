<?php namespace App\Models;

use CodeIgniter\Model;

class AgendaModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'agenda';
    protected $primaryKey = 'oid';

    protected $returnType     = 'array';

    protected $allowedFields = ['oid_usuario', 'dia','hora','titulo','descripcion','global','oid_grupo','fecha'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


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


    public function getElement($id){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('*');
        $builder->where($this->primaryKey, $id);
        $query = $builder->get();
        return $query->getRow();
    }

    public function addElement($data){
        $db = \Config\Database::connect();
        $db->table($this->table)->insert($data);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function deleteElement($id){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->delete([$this->primaryKey => $id]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function MostrarAgendaHome($cuando,$uid_grupo){
        if( $cuando=="hoy" ){
            $sql="select oid, hora, titulo, descripcion, oid_usuario" .
                "dia as laFecha, " .
                "hora as laHora " .
                "from agenda " .
                "where dia=substring(now(), 1, 10 ) and " .
                "(oid_grupo=$uid_grupo or global=1) " .
                "order by dia asc, hora asc ";
        }
        elseif( $cuando=="proximas" ){
            $sql="select oid, hora, titulo, descripcion, oid_usuario" .
                "dia as laFecha, " .
                "hora as laHora " .
                "from agenda " .
                "where dia>substring( now() , 1, 10 ) and " .
                "(oid_grupo=$uid_grupo or global=1) " .
                "order by dia asc, hora asc limit 0,5";
                // $sql="select oid, hora, titulo, " .
                // "date_format( dia ,'%d.%m.%Y') as laFecha, " .
                // "date_format( hora, '%H:%i' ) as laHora " .
                // "from agenda " .
                // "where dia>substring( now() , 1, 10 ) and " .
                // "(oid_grupo=$uid_grupo or global=1) " .
                // "order by dia asc, hora asc limit 0,5";
        }
        elseif( $cuando=="pasadas" ){
            $sql="select oid, hora, titulo, descripcion, oid_usuario" .
                "dia as laFecha, " .
                "hora as laHora " .
                "from agenda " .
                "where dia<substring( now(), 1, 10 ) and " .
                "(oid_grupo=$uid_grupo or global=1) " .
                "order by dia asc, hora asc limit 0,5";
        }
        $sql="select oid, hora, titulo, descripcion, oid_usuario, " .
                "dia as laFecha, " .
                "hora as laHora " .
                "from agenda " .
                "where " .
                "(oid_grupo=$uid_grupo or global=1) " .
                "order by dia asc, hora asc ";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);  
        return $query->getResult();
    }


}
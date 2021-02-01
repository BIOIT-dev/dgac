<?php namespace App\Models;

use CodeIgniter\Model;

class ForoForoModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'foro_foro';
    protected $primaryKey = 'oid';

    protected $returnType     = 'array';

    protected $allowedFields = ['oid_categoria', 'nombre','descripcion','inactivo','permisos','fecha','oid_usuario'];

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

    public function getFilterElement($oid_categoria){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('*');
        $builder->where('oid_categoria', $oid_categoria);
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

    public function getFilterElementData($id){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('foro_foro.*, usuario.nombres, usuario.apellidos, usuario.foto');
        $builder->join('usuario', "usuario.oid = ".$this->table.".oid_usuario", 'letf');
        $builder->where('foro_foro.oid', $id);
        $builder->orderBy($this->primaryKey);
        $query = $builder->get();
        return $query->getResult()[0];
    }

    public function getElementName($name, $oid_categoria){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->selectCount('oid');
        $builder->where('nombre', $name);
        $builder->where('oid_categoria', $oid_categoria);
        $query = $builder->get();
        return $query->getRow();
    }

    public function getElementFindName($name, $id, $oid_categoria){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->selectCount('oid');
        $builder->where('nombre', $name);
        $builder->where('oid_categoria', $oid_categoria);
        $builder->where('oid !=', $id);
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


}
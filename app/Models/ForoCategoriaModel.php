<?php namespace App\Models;

use CodeIgniter\Model;

class ForoCategoriaModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'foro_categoria';
    protected $primaryKey = 'oid';

    protected $returnType     = 'array';

    protected $allowedFields = ['nombre', 'global','inactivo','fecha','oid_usuario','oid_grupo'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function getAllElement($oid_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('*');
        $builder->where('oid_grupo', $oid_grupo);
        $builder->orderBy($this->primaryKey);
        // $builder->limit(1086);
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

    public function getElementName($name, $oid_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->selectCount('oid');
        $builder->where('nombre', $name);
        $builder->where('oid_grupo', $oid_grupo);
        $query = $builder->get();
        return $query->getRow();
    }

    public function getElementEdit($name, $oid_grupo, $id){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->selectCount('oid');
        $builder->where('nombre', $name);
        $builder->where('oid !=', $id);
        $builder->where('oid_grupo', $oid_grupo);
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
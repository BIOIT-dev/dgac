<?php namespace App\Models;

use CodeIgniter\Model;

class ScormModel extends Model
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
    public function obtenerScorms($datos_busqueda){
        $db = \Config\Database::connect();
        $builder = $db->table('scorm_sco');
        $builder->select('*, scorm_sco.oid as scorm_id');
        $builder->like('scorm_sco.titulo', $datos_busqueda['titulo']);
        if($datos_busqueda['oid_grupo'] != 'null'){
            $builder->where('scorm_sco.oid_grupo', $datos_busqueda['oid_grupo']);
        }
        $builder->join('grupo', 'grupo.oid=scorm_sco.oid_grupo', 'left');
        // $builder->orderBy('grupo.nombre', 'ASC');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;

    }
    /********************************************/
    public function getScorm($id_scorm){
        $db = \Config\Database::connect();
        $builder = $db->table('scorm_sco');
        $builder->select('*, scorm_sco.oid as scorm_id');
        $builder->where('scorm_sco.oid', $id_scorm);
        $builder->join('grupo', 'grupo.oid=scorm_sco.oid_grupo', 'left');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query[0];
    }
    /********************************************/
    public function insertScorm($datos){
        $db = \Config\Database::connect();
        try {
            $db->table('scorm_sco')->insert($datos);
            if ($db->affectedRows() > 0)
                return TRUE;
            else
                return FALSE;
        }catch (\Exception $e){
            return FALSE;
        }   
    }
    /********************************************/
    public function editScorm($datos){
        $db = \Config\Database::connect();

        $datos['attr_scrollbar'] = isset($datos['attr_scrollbar']) ? "1" : "0";
        $datos['attr_toolbar'] = isset($datos['attr_toolbar']) ? "1" : "0";
        $datos['attr_statusbar'] = isset($datos['attr_statusbar']) ? "1" : "0";
        $datos['attr_menubar'] = isset($datos['attr_menubar']) ? "1" : "0";
        $datos['attr_linkbar'] = isset($datos['attr_linkbar']) ? "1" : "0";
        $datos['attr_resizable'] = isset($datos['attr_resizable']) ? "1" : "0";

        $builder = $db->table('scorm_sco');
        $builder->where('oid', $datos['oid']);
        $response = $builder->update($datos);
        return $response;
    }
    /********************************************/
    public function deleteScorm($id_scorm){
        $db = \Config\Database::connect();
        $builder = $db->table('scorm_sco');
        $builder->delete(['oid' => $id_scorm]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
}
<?php namespace App\Models;

use CodeIgniter\Model;

class CategoriaComunidadModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'grupo_categoria';
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

    public function crear_categoria_comunidad($datos){
        $db = \Config\Database::connect();
        $db->table('grupo_categoria')->insert($datos);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function getCarreras(){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo_categoria');
        $builder->select('*');
        $builder->orderBy('nombre');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function getClasificaciones(){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo_clasificacion');
        $builder->select('*');
        $builder->orderBy('grcl_nombre');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function buscar_categoria_comunidad($datos_busqueda){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo_categoria');
        // var_dump($datos_busqueda);
        $builder->select('*, (select count( 1 ) from grupo g where grupo_categoria.oid=g.oid_categoria ) as cnt');
        if ($datos_busqueda['nombre'] != '') $builder->like('grupo_categoria.nombre', $datos_busqueda['nombre']);
        $builder->orderBy('grupo_categoria.nombre');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function eliminar_categoria_comunidad($id_carrera){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo_categoria');

        $builder->delete(['oid' => $id_carrera]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function editar_categoria_comunidad($datos){
        $db = \Config\Database::connect();
        $builder = $db->table('grupo_categoria');
        $builder->where('oid', $datos['oid']);
        $response = $builder->update($datos);
        return $response;
    }
}

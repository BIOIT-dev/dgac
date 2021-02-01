<?php namespace App\Models;

use CodeIgniter\Model;

class PagoModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'pagos';
    protected $primaryKey = 'oid';

    protected $returnType     = 'array';

    protected $allowedFields = ['*'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function crear_pago_model($data){
        $db = \Config\Database::connect();
        $db->table('pagos')->insert($data);
        $insertID = $db->insertID();
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function historialPagos( $usuario_oid ){
        $db = \Config\Database::connect();
        $builder = $db->table('pagos AS a');
        $builder->select('a.*');
        $builder->where('a.usuario_oid', $usuario_oid );
        $builder->orderBy('a.oid','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getPagos($oid_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('pagos AS a');
        $builder->select('a.*, b.nombres, b.apellidos');
        $builder->join("usuario AS b", "a.usuario_oid = b.oid");
        $builder->where('a.grupo_oid', $oid_grupo );
        $builder->orderBy('a.oid','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    // Metodo de cambio de estatus de pagos
    public function change_pay( $data ){
        $db = \Config\Database::connect();
        $builder = $db->table('pagos');
        
        $builder->where('oid', $data['oid']);
        $builder->update( array( 'revisado' => $data['revisado'] ) );
    }

}
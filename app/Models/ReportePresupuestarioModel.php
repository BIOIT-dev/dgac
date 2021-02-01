<?php namespace App\Models;

use CodeIgniter\Model;

class ReportePresupuestarioModel extends Model{
    protected $table      = 'presupuestototal';
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
    /******************************************************************/
    public function getAllRP(){
        $db = \Config\Database::connect();
        $builder = $db->table('presupuestototal');
        $builder->select('*');
        $builder->orderBy('cohorte');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function getPresupuesto($id_presupuesto){
        $db = \Config\Database::connect();
        $builder = $db->table('presupuestototal');
        $builder->select('*');
        $builder->where('oid', $id_presupuesto);
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }
    /******************************************************************/
    public function getTotal($cohorte, $total){
        $db = \Config\Database::connect();
        switch ($total){
            case 'total1':
                $sql = "select count(oid) as num from grupo where grti_cod in ('1','2') and YEAR(grup_finicio)=".$cohorte;
                break;
            case 'total3':
                $sql = "select sum(costos) as num from grupo where grti_cod in ('1','2') and is_pac =1  and YEAR(grup_finicio)=".$cohorte;
                break;
            case 'total4':
                $sql = "select count(oid) as num from grupo where grti_cod in ('1','2') and is_pac =1  and YEAR(grup_finicio)=".$cohorte;
                break;
            case 'total5':
                $sql = "select count(oid) as num from grupo where grti_cod =1 and is_pac =1  and YEAR(grup_finicio)=".$cohorte;
                break;
            case 'total6':
                $sql = "select count(oid) as num from grupo where grti_cod =2 and is_pac =1  and YEAR(grup_finicio)=".$cohorte;
                break;
            case 'total7':
                $sql = "select sum(costos) as num from grupo where grti_cod in ('1','2') and is_pac =1  and YEAR(grup_finicio)=".$cohorte;
                break;
            case 'total8':
                $sql = "select sum(costos) as num from grupo where grti_cod =1 and is_pac =1  and YEAR(grup_finicio)=".$cohorte;
                break;
            case 'total9':
                $sql = "select sum(costos) as num from grupo where grti_cod =2 and is_pac =1  and YEAR(grup_finicio)=".$cohorte;
                break;
            case 'total10':
                $sql = "select count(oid) as num from grupo where grti_cod in ('1','2') and is_pac =0  and YEAR(grup_finicio)=".$cohorte;
                break;
            case 'total11':
                $sql = "select count(oid) as num from grupo where grti_cod =1 and is_pac =0  and YEAR(grup_finicio)=".$cohorte;
                break;
            case 'total12':
                $sql = "select count(oid) as num from grupo where grti_cod =2 and is_pac =0  and YEAR(grup_finicio)=".$cohorte;
                break;
            case 'total13':
                $sql = "select sum(costos) as num from grupo where grti_cod in ('1','2') and is_pac =0  and YEAR(grup_finicio)=".$cohorte;
                break;
            case 'total14':
                $sql = "select sum(costos) as num from grupo where grti_cod =1 and is_pac =0  and YEAR(grup_finicio)=".$cohorte;
                break;
            case 'total15':
                $sql = "select sum(costos) as num from grupo where grti_cod =2 and is_pac =0  and YEAR(grup_finicio)=".$cohorte;
                break;
        }
        $query = $db->query($sql);
        return $query->getRow();
    }
    /******************************************************************/
    public function agregar_presupuesto($datos){
        $db = \Config\Database::connect();
        try {
            $db->table('presupuestototal')->insert($datos);
            if ($db->affectedRows() > 0){
                return TRUE;
            }else {
                return FALSE;
            }
        }catch (\Exception $e){
            return FALSE;
        }   
    }
    /******************************************************************/
    public function editar_presupuesto($id_presupuesto, $datos){
        $db = \Config\Database::connect();
        $builder = $db->table('presupuestototal');
        $builder->where('oid', $id_presupuesto);
        $response = $builder->update($datos);
        return $response;
    }
    /******************************************************************/
    public function eliminar_presupuesto($id_presupuesto){
        $db = \Config\Database::connect();
        $builder = $db->table('presupuestototal');
        $builder->delete(['oid' => $id_presupuesto]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }
}
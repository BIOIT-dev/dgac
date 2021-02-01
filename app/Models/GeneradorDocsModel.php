<?php namespace App\Models;

use CodeIgniter\Model;

class GeneradorDocsModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'documentos';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = ['activo', 'nombre', 'url', 'orden'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function crear_documento_model($fields){
        $db = \Config\Database::connect();
        
        $builder = $db->table('documentos');
        $builder->where( 'nombre', $fields['nombre'] );
        $builder->orWhere( 'url', $fields['url'] );
        $query = $builder->get();
        
        if(count($query->getResult()) > 0){
			return 'existe';
		}else{
			$db->table('documentos')->insert($fields);
			if ($db->affectedRows() > 0){
				return 'ok';
			}else {
				return 'error';
			}			
		}
        
    }

    public function buscar_documento_model($datos_busqueda){
        $db = \Config\Database::connect();
        $builder = $db->table('documentos');
        $builder->select('*');
        $builder->where('documentos.nombre', $datos_busqueda['nombre']);
        $builder->orderBy('documentos.nombre', 'ASC');
        $query   = $builder->get();
        $query = $query->getResult();
        return $query;
    }

    public function eliminar_documento_model($id){
        $db = \Config\Database::connect();
        $builder = $db->table('documentos');

        $builder->delete(['id' => $id]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function editar_documento_model($data_documento){
        $db = \Config\Database::connect();
        
        $builder = $db->table('documentos');
        $builder->where( 'nombre', $data_documento['nombre'] );
        $builder->where( 'url', $data_documento['url'] );
        $builder->where( 'id !=', $data_documento['id'] );
        $query = $builder->get();
        
        if(count($query->getResult()) > 0){
			return 'existe';
		}else{
			$builder2 = $db->table('documentos');
			$builder2->where('id', $data_documento['id']);
			$response = $builder2->update($data_documento);
			if ($db->affectedRows() > 0){
				return 'ok';
			}else {
				return 'error';
			}			
		}
		
    }

    /**
    / Consultar datos
    */

    public function obtenerDocumentos(){
        $db = \Config\Database::connect();
        $builder = $db->table('documentos AS d');
        $builder->select('d.id, d.activo, d.nombre, d.url, d.orden');
        $builder->orderBy('d.id');
        $query = $builder->get();
        return $query->getResult();
    }
    
    // Obtener compromiso docente
	public function obtenerCompromisoDocente($oid_comunidad, $oid_curso){
        $sql="select c.oid, c.titulo, c.inactivo, c.oid_profesor, u.rut, u.nombres,u.apellido_paterno,u.apellido_materno, u.apellidos, u.sexo, u.email,u.profesion,u.empresa_unidad,u.especialidad,u.empresa_unidad,
c.oid_profesor2,u2.rut as rut2, u2.nombres as nombres2, u2.apellidos as apellidos2,u2.apellido_paterno as a_paterno,u2.apellido_materno as a_materno, u2.sexo as sexo2, u2.email as email2,u2.profesion as profesion2,u2.empresa_unidad as unidad2,u2.especialidad as especialidad2,u2.empresa_unidad as empresa_unidad2,
g.nombre as nombre_grupo,
c.curs_horas as horas, c.finicio as f_inicio, c.ftermino as f_termino
 from curso c 
left join usuario u on u.oid=c.oid_profesor 
left join usuario u2 on u2.oid=c.oid_profesor2 
left join grupo g on g.oid= c.oid_grupo
where c.oid_grupo=$oid_comunidad and c.oid=$oid_curso";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }
    
    // Obtener informe de asunción
	public function obtenerInformeAsuncion($oid_comunidad, $oid_curso){
        $sql="select c.oid, c.titulo, c.inactivo, c.oid_profesor, u.rut, u.nombres, u.apellidos,u.apellido_paterno,u.apellido_materno, u.sexo,u.fecnac, u.direccion ,u.comuna, u.ciudad,u.email,u.profesion,u.empresa_unidad,u.empresa_cargo,u.estado_civil,u.trienios,u.especialidad,u.sistema_previsional,u.sistema_salud,u.pensionado,u.reliquidado,u.asignacion_academica,
c.oid_profesor2,u2.rut as rut2, u2.nombres as nombres2, u2.apellidos as apellidos2, u2.apellido_paterno as a_paterno ,u2.apellido_materno as a_materno, u2.sexo as sexo2,u2.fecnac as fecnac2 ,u2.direccion as direccion2,u2.comuna as comuna2, u2.ciudad as ciudad2,u2.email as email2,u2.profesion as profesion2,u2.empresa_unidad as unidad2,u2.empresa_cargo as empresa_cargo2,u2.estado_civil as estado_civil2 , u2.trienios as trienios2,u2.especialidad as especialidad2,u2.sistema_previsional as sistema_previsional2,u2.sistema_salud as sistema_salud2,u2.pensionado as pensionado2,u2.reliquidado as reliquidado2,u2.asignacion_academica as asignacion_academica2,
g.nombre as nombre_grupo,
c.curs_horas as horas, c.finicio as f_inicio, c.ftermino as f_termino
 from curso c 
left join usuario u on u.oid=c.oid_profesor 
left join usuario u2 on u2.oid=c.oid_profesor2 
left join grupo g on g.oid= c.oid_grupo
where c.oid_grupo=$oid_comunidad and c.oid=$oid_curso";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }
    
    // Obtener oficio portador
	public function obtenerOficioPortador($opciones){
        $sql="select nombre_grupo, unidad from compromiso_docente where id=$opciones[0]";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }
    
    // Obtener oficio portador
	public function obtenerDocentesPortador($opciones){
        $sql="SELECT * FROM compromiso_docente where id IN($opciones)";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        return $query->getResult();
    }
    
    // Quitar portador del listado
	public function quitarPortador($id){
        $sql="UPDATE compromiso_docente SET estado = 1 WHERE id=$id;";
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
        if ($db->affectedRows() > 0){
			return 'ok';
		}else {
			return 'error';
		}
    }

}

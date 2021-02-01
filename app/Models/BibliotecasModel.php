<?php namespace App\Models;

use CodeIgniter\Model;

class BibliotecasModel extends Model
{
    // protected $DBGroup = 'default';
    protected $table      = 'biblio_categoria';
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

    /**============================================================================================
    /  Inicio Categoria de documentos
    /  ============================================================================================
    */

    public function biblio_categoria($oid_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('biblio_categoria AS a');
        $builder->select('*');
        $builder->where('a.oid_grupo', $oid_grupo);
        $query = $builder->get();
        return $query->getResult();
    }

    public function ultima_biblio_categoria(){

        $db = \Config\Database::connect();
        $builder = $db->table('biblio_categoria');
        $builder->selectMax('oid');
        $query = $builder->get();
        return $query->getResult();
    }

    public function crear_biblio_categoria_model($data){

        $db = \Config\Database::connect();
        $db->table('biblio_categoria')->insert($data);
        if ($db->affectedRows() > 0){

            return TRUE;
        }else {
            return FALSE;
        }
        /*echo "<pre>";
        print_r($data);*/
    }

    public function editar_biblio_categoria_model($data){
        $db = \Config\Database::connect();
        $builder = $db->table('biblio_categoria');
        
        $builder->where('oid', $data['oid']);
        $response = $builder->update($data);
        
        return $response;
    }
    
    public function eliminar_biblio_categoria_model($id){
        $db = \Config\Database::connect();
        $builder = $db->table('biblio_categoria');

        $builder->delete(['oid' => $id]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function obtenerBiblioCategoria($oid_grupo,$oid=0){
        $db = \Config\Database::connect();
        $builder = $db->table('biblio_categoria AS a');
        $builder->select('a.*, b.nombres, b.apellidos, a.fecha AS datetime');
        $builder->join("usuario AS b", "a.oid_usuario = b.oid");
        $builder->whereIN('a.global', array(0,1));
        $builder->where('a.oid_grupo', $oid_grupo);
        $builder->where('a.oid_padre', $oid);
        $builder->orderBy('a.oid','DESC');
        $query = $builder->get();

        return $query->getResult();
    }


    public function obtenerCategoria($oid_grupo,$oid=0){
        $db = \Config\Database::connect();
        $builder = $db->table('biblio_categoria AS a');
        $builder->select('a.*, b.nombres, b.apellidos, a.fecha AS datetime');
        $builder->join("usuario AS b", "a.oid_usuario = b.oid");
        $builder->whereIN('a.global', array(0,1));
        $builder->where('a.oid_grupo', $oid_grupo);
        $builder->where('a.oid_padre', $oid);
        $builder->orderBy('a.oid','DESC');
        $query = $builder->get();
        return $query->getResult();
    }


    public function obtenerSubCategoria($id_padre){
        $db = \Config\Database::connect();
        $builder = $db->table('biblio_categoria AS a');
        $builder->select('a.*');
        $builder->where('a.oid_padre', $id_padre);
        $builder->orderBy('a.oid','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function obtenerHijoCategoria($id_categoria){
        $db = \Config\Database::connect();
        $builder = $db->table('biblio_categoria AS a');
        $builder->select('a.*, a.fecha AS datetime');
        $builder->where('a.oid_padre', $id_categoria);
        $builder->orderBy('a.oid','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function obtenerbiblio_categoriasPublic(){
        $db = \Config\Database::connect();
        $builder = $db->table('biblio_categoria AS a');
        $builder->select('a.*, b.nombres, b.apellidos, a.fecha AS datetime');
        $builder->join("usuario AS b", "a.oid_usuario = b.oid");
        $builder->whereIN('a.global', array(1));
        $builder->orderBy('a.oid');
        $query = $builder->get();
        return $query->getResult();
    }

    public function obtenerbiblio_categoriasPreview($oid_grupo){
        $db = \Config\Database::connect();
        $builder = $db->table('biblio_categoria AS a');
        $builder->select('a.*, b.nombres, b.apellidos, a.fecha AS datetime');
        $builder->join("usuario AS b", "a.oid_usuario = b.oid");
        $builder->where('a.oid_grupo', $oid_grupo);
        $builder->orderBy('a.oid');
        $query = $builder->get();
        return $query->getRow();
    }

    public function obtenerbiblio_categoriasPreviewPublic( $id ){
        $db = \Config\Database::connect();
        $builder = $db->table('biblio_categoria AS a');
        $builder->select('a.*, b.nombres, b.apellidos, a.fecha AS datetime');
        $builder->join("usuario AS b", "a.oid_usuario = b.oid");
        $builder->where('a.oid', $id);
        $builder->orderBy('a.oid');
        $query = $builder->get();
        return $query->getRow();
    }

    public function biblio_categoriaVisitas( $data ){
        $db = \Config\Database::connect();
        $builder = $db->table('biblio_categoria');
        
        $builder->where('oid', $data['oid']);
        $builder->update( array( 'hits' => $data['hits'] ) );
    }

    /**
    / Comentarios
    */

    public function obtenerComentarios($oid_objeto){
        $db = \Config\Database::connect();
        $builder = $db->table('comentario AS a');
        $builder->select('a.oid, a.texto AS comentario, b.nombres, b.apellidos, a.fecha AS datetime');
        $builder->join("usuario AS b", "a.oid_usuario = b.oid");
        $builder->where('a.oid_objeto', $oid_objeto );
        $builder->orderBy('a.oid');
        $query = $builder->get();
        return $query->getResult();
    }

    public function crear_biblio_categoria_comentario_model($data){

        $db = \Config\Database::connect();
        $db->table('comentario')->insert($data);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
        /*echo "<pre>";
        print_r($data);*/
    }

    /**============================================================================================
    /  Inicio Carga de documentos
    /  ============================================================================================
    */

    public function docVisitas( $data ){
        $db = \Config\Database::connect();
        $builder = $db->table('biblio_archivo');
        
        $builder->where('oid', $data['oid']);
        $builder->update( array( 'hits' => $data['hits'] ) );
    }

    public function find_doc($oid){
        $db = \Config\Database::connect();
        $builder = $db->table('biblio_archivo AS a');
        $builder->select('a.*, b.nombres, b.apellidos, a.fecha AS datetime');
        $builder->join("usuario AS b", "a.oid_usuario = b.oid");
        $builder->where('a.oid', $oid );
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function crear_biblio_archivo_model($data){

        $db = \Config\Database::connect();
        $db->table('biblio_archivo')->insert($data);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
        /*echo "<pre>";
        print_r($data);*/
    }

    public function editar_biblio_archivo_model($data){
        $db = \Config\Database::connect();
        $builder = $db->table('biblio_archivo');
        
        $builder->where('oid', $data['oid']);
        $response = $builder->update($data);
        
        return $response;
    }

    public function eliminar_biblio_doc_model($oid){
        $db = \Config\Database::connect();
        $builder = $db->table('biblio_archivo');

        $builder->delete(['oid' => $oid]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function obtenerBiblioArchivo($oid_categoria){
        $db = \Config\Database::connect();
        $builder = $db->table('biblio_archivo AS a');
        $builder->select('a.*, b.nombres, b.apellidos');
        $builder->join("usuario AS b", "a.oid_usuario = b.oid");
        // $builder->where('a.esurl', 0);
        // $builder->where('a.esmicrositio', 0);
        $builder->where('a.oid_categoria', $oid_categoria);
        $builder->orderBy('a.oid','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function obtenerComentariosDoc($oid_objeto){
        $db = \Config\Database::connect();
        $builder = $db->table('comentario AS a');
        $builder->select('a.oid, a.texto AS comentario, b.nombres, b.apellidos, a.fecha AS datetime');
        $builder->join("usuario AS b", "a.oid_usuario = b.oid");
        $builder->where('a.seccion', 'BIBLIOTECA');
        $builder->where('a.oid_objeto', $oid_objeto);
        $builder->orderBy('a.oid','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function crear_doc_comentario_model($data){

        $db = \Config\Database::connect();
        $db->table('comentario')->insert($data);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
        /*echo "<pre>";
        print_r($data);*/
    }

    public function eliminar_comentario_model($oid_objeto){
        $db = \Config\Database::connect();
        $builder = $db->table('comentario');

        $builder->delete(['oid' => $oid_objeto]);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function count_comentarios($oid_objeto){
        $db = \Config\Database::connect();
        $builder = $db->table('comentario AS a');
        $builder->select('count(a.oid) AS cantidad');
        $builder->where('a.seccion', 'BIBLIOTECA');
        $builder->where('a.oid_objeto', $oid_objeto);
        $query = $builder->get();
        return $query->getRow();
    }

    /**============================================================================================
    /  Agregar MicroSitio
    /  ============================================================================================
    */

    public function crear_micrositio_model($data){

        $db = \Config\Database::connect();
        $db->table('biblio_archivo')->insert($data);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
        /*echo "<pre>";
        print_r($data);*/
    }

    /**============================================================================================
    /  Agregar Url en Internet
    /  ============================================================================================
    */

    public function crear_url_model($data){

        $db = \Config\Database::connect();
        $db->table('biblio_archivo')->insert($data);
        if ($db->affectedRows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
        /*echo "<pre>";
        print_r($data);*/
    }

    public function buscar_usuario_model( $grupo_ids, $comunidad_ids ){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('usuario.email');
        $builder->join('usuario_grupo', 'usuario_grupo.oid_usuario=usuario.oid');
        $builder->join('grupo', 'grupo.oid=usuario_grupo.oid_grupo');
        $builder->whereIn('usuario_grupo.rol', $grupo_ids );
        $builder->whereIn('usuario_grupo.oid_grupo', $comunidad_ids );
        $builder->orderBy('usuario.apellido_paterno', 'ASC');
        $query   = $builder->get();
        return $query->getResult();

    }
    public function all_buscar_usuario_model( $grupo_ids ){
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('usuario.email');
        $builder->join('usuario_grupo', 'usuario_grupo.oid_usuario=usuario.oid');
        $builder->join('grupo', 'grupo.oid=usuario_grupo.oid_grupo');
        $builder->whereIn('usuario_grupo.rol', $grupo_ids );
        $builder->orderBy('usuario.apellido_paterno', 'ASC');
        $query   = $builder->get();
        return $query->getResult();

    }

}
<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ForoPostModel;
use App\Models\ForoCategoriaModel;
use App\Models\ForoForoModel;

class ForoPost extends BaseController
{
    private $dir_view = 'foro_post';
    private $controller_name = 'ForoCategoria';
    private $base_url_controller = 'public/foro_post/method';
    private $findUsuario ="";
    private $datos = array();

    function __construct() {
        $session = session();
        $this->findUsuario = new UsuarioModel($db);
        $this->findUsuario = $this->findUsuario->find($session->user_id);
        $this->datos['profile_data'] = $this->findUsuario;
        $this->datos['oid_usuario']=$session->user_id;
        $this->datos['oid_grupo']=$session->grupo_id;
        $this->datos['controller_name'] = 'ForoPost';
        $this->datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $this->datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Gestion de Categoria de Foros');
    }

    public function index(){
        return redirect()->to(base_url($this->base_url_controller.'/index'));
    }

    public function method($accion,$id=null,$oid_categoria){
        $datos                  = $this->datos;
        $obj                    = new ForoPostModel($db);
        $foro_cate              = new ForoCategoriaModel($db);
        $foro                   = new ForoForoModel($db);
        $obj_foro               = $foro->find($id);
        $obj_cate               = $foro_cate->find($oid_categoria);
        $datos['oid_categoria'] = $oid_categoria;
        $datos['category_name'] = $obj_cate['nombre'];
        $datos['foro_name']     = $obj_foro['nombre'];
        $datos['oid_foro']      = $id;
        switch($accion){
            case 'add':
                if ($this->request->getMethod() == 'post') {
                    $fields = $this->request->getPost();
                    $fields['oid_foro']      = $id;
                    $fields['jerarquia']     = 0;
                    
                    if($imagefile = $this->request->getFiles()){
                        if($img = $imagefile['archivo'])
                        {
                            if ($img->isValid() && ! $img->hasMoved())
                            {
                                $archivo = $img->getClientName(); //This is if you want to change the file name to encrypted 
                                $img->move(realpath(FCPATH . '../assets/uploads/foro'), $archivo);
                                $fields['archivo'] = $archivo;

                                // You can continue here to write a code to save the name to database
                                // db_connect() or model format

                            }
                        }
                    }
                    $fields['fecha'] = date('Y-m-d H:i:s');
                    $respuesta = $obj->addElement($fields);

                    $fields = array(
                        'oid' => $respuesta,
                        'jerarquia' => sprintf( "/%010d", $respuesta )
                    );
                    $obj->setElement($fields);

                    $datos = array_merge($datos,$this->respuesta($respuesta));
                    return view($datos['vista_respuesta'], $datos);
                }
                return view($this->dir_view.'/add', $datos);
            break;
            case 'edit':
                if($id){
                    $datos['resultado_busqueda'] = $obj->getElement($id);
                    if($datos['resultado_busqueda']){
                        if ($this->request->getMethod() == 'post') {
                            $fields = $this->request->getPost();

                            $fields_array = array(
                                'oid' => $fields['oid'],
                                'asunto' => $fields['asunto'],
                                'texto' => $fields['texto'],
                                'zona_home' => $fields['zona_home'],
                                'oid_team' => $fields['oid_team'],
                                'inactivo' => $fields['inactivo'],
                            );

                            if($imagefile = $this->request->getFiles()){
                                if($img = $imagefile['archivo'])
                                {
                                    if ($img->isValid() && ! $img->hasMoved())
                                    {
                                        $archivo = $img->getClientName(); //This is if you want to change the file name to encrypted 
                                        $img->move(realpath(FCPATH . '../assets/uploads/foro'), $archivo);
                                        $fields_array['archivo'] = $archivo;

                                        // You can continue here to write a code to save the name to database
                                        // db_connect() or model format

                                    }
                                }
                            }

                            $respuesta = $obj->setElement($fields_array);
                            $datos = array_merge($datos,$this->respuesta($respuesta));
                            return view($datos['vista_respuesta'], $datos);
                        }else{
                            return view($this->dir_view.'/edit', $datos);
                        }
                    }
                }
                return redirect()->to(base_url($this->base_url_controller.'/index'));
            break;
            case 'delete':
                if ($this->request->getMethod() == 'post') {
                    $data = $this->request->getPost();
                    foreach ($data as $id){
                        $respuesta = $obj->deleteElement($id);
                    }
                    return $respuesta;
                }
                return redirect()->to(base_url($this->base_url_controller.'/index'));
            break;
            case 'index':
                $datos['resultado_busqueda'] = $obj->getAllElement();
                return view($this->dir_view.'/index', $datos);
            break;
        }   
    }

    public function foro_tema_detalle( $foid, $toid ){
        $datos = $this->datos;
        $datos['oid_usuario'] = $this->datos['oid_usuario'];
        $datos['oid_foro']    = $foid; // ID Foro
        $datos['oid_padre']   = $toid; // ID de Tema Post
        return view($this->dir_view.'/foro_tema_detalle', $datos);
    }

    public function foro_tema_detalle_post(){

        $obj = new ForoPostModel($db);
        $data = $this->request->getPost();
        if($imagefile = $this->request->getFiles()){
            if($img = $imagefile['archivo'])
            {
                if ($img->isValid() && ! $img->hasMoved())
                {
                    $archivo = $img->getClientName(); //This is if you want to change the file name to encrypted 
                    $img->move(realpath(FCPATH . '../assets/uploads/foro'), $archivo);
                    $data['archivo'] = $archivo;

                    // You can continue here to write a code to save the name to database
                    // db_connect() or model format

                }
            }
        }

        $data['fecha'] = date('Y-m-d H:i:s');
        $respuesta = $obj->addElement($data);

        $fields = array(
            'oid' => $respuesta,
            'jerarquia' => sprintf( "/%010d", $respuesta )
        );
        $obj->setElement($fields);

        return redirect()->to(base_url("public/ForoPost/foro_tema_detalle/".$data['oid_foro']."/".$data['oid_padre']));

    }

    function respuesta($respuesta){
        if($respuesta){
            $datos['mensaje_servidor'] = 'El registro ha sido creado correctamente!';
            $datos['url_retorno']=$this->controller_name.'/method/index';
            $datos['vista_respuesta'] = 'respuestas_servidor/exito';
        }else{
            $datos['mensaje_servidor'] = 'No se ha podido crear el registro!';
            $datos['url_retorno']=$this->controller_name.'/method/index';
            $datos['vista_respuesta'] = 'respuestas_servidor/error';
        }
        return $datos;
    }

}
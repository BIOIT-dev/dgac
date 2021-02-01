<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ForoForoModel;
use App\Models\RolesModel;
use App\Models\ForoCategoriaModel;

class ForoForo extends BaseController
{
    private $dir_view = 'foro_foro';
    private $controller_name = 'ForoCategoria';
    private $base_url_controller = 'public/ForoForo/method';
    private $findUsuario ="";
    private $datos = array();

    function __construct() {
        $session = session();
        $this->findUsuario = new UsuarioModel($db);
        $this->findUsuario = $this->findUsuario->find($session->user_id);
        $this->datos['profile_data'] = $this->findUsuario;
        $this->datos['oid_usuario']=$session->user_id;
        $this->datos['oid_grupo']=$session->grupo_id;
        $this->datos['controller_name'] = 'ForoForo';
        $this->datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $this->datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Gestion de Categoria de Foros');
    }

    public function index(){
        //echo "HOLA MUNDO";
        //exit;
        return redirect()->to(base_url($this->base_url_controller.'/index'));
    }

    public function method($accion,$id=null){
        $datos = $this->datos;
        $obj       = new ForoForoModel($db);
        $foro_cate = new ForoCategoriaModel($db);
        $grupo     = new RolesModel($db);
        switch($accion){
            case 'add':
                $obj_cate = $foro_cate->find($id);
                if ($this->request->getMethod() == 'post') {
                    $fields = $this->request->getPost();
                    if( isset($fields['permisos']) ){
                        $fields['permisos'] = implode(',', $fields['permisos']);
                    }else{
                        $fields['permisos'] = '';
                    }
                    $fields['fecha']        = date('Y-m-d H:i:s');

                    $respuesta = $obj->addElement($fields);
                    $datos = array_merge($datos,$this->respuesta($respuesta));
                    return view($datos['vista_respuesta'], $datos);
                }

                $datos['oid_categoria'] = $id;
                $datos['grupo']         = $grupo->obtenerRules();
                $datos['category_name'] = $obj_cate['nombre'];
                return view($this->dir_view.'/add', $datos);
            break;
            case 'edit':
                if($id){
                    $datos['resultado_busqueda'] = $obj->getElement($id);
                    $obj_cate = $foro_cate->find($datos['resultado_busqueda']->oid_categoria);
                    if($datos['resultado_busqueda']){
                        if ($this->request->getMethod() == 'post') {
                            $fields = $this->request->getPost();
                            $respuesta = $obj->setElement($fields);
                            $datos = array_merge($datos,$this->respuesta($respuesta));
                            return view($datos['vista_respuesta'], $datos);
                        }else{
                            $datos['oid_categoria']  = $id;
                            $datos['grupo']          = $grupo->obtenerRules();
                            $datos['category_name']  = $obj_cate['nombre'];
                            $datos['foro_categoria'] = $foro_cate->getAllElement($this->datos['oid_grupo']);
                            return view($this->dir_view.'/edit', $datos);
                        }
                    }
                }
                return redirect()->to(base_url($this->base_url_controller.'/index'));
            break;
            case 'delete':
                if ($this->request->getMethod() == 'post') {
                    $data = $this->request->getPost();
                    print_r($data);
                    //foreach ($data as $id){
                    //    $respuesta = $obj->deleteElement($id);
                    //}
                    //return $respuesta;
                }
                //return redirect()->to(base_url($this->base_url_controller.'/index'));
            break;
            case 'index':
                $datos['resultado_busqueda'] = $obj->getAllElement();
                return view($this->dir_view.'/index', $datos);
            break;
        }   
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
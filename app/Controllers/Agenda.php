<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\AgendaModel;

class Agenda extends BaseController
{
    private $dir_view = 'agenda';
    private $controller_name = 'agenda';
    private $base_url_controller = 'public/agenda/method';
    private $findUsuario ="";
    private $datos = array();

    function __construct() {
        $session = session();
        $this->findUsuario = new UsuarioModel($db);
        $this->findUsuario = $this->findUsuario->find($session->user_id);
        $this->datos['profile_data'] = $this->findUsuario;
        $this->datos['oid_usuario']=$session->user_id;
        $this->datos['oid_grupo']=$session->grupo_id;
        $this->datos['controller_name'] = 'agenda';
        $this->datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $this->datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Gestion de Agenda');
    }

    public function index(){
        return redirect()->to(base_url($this->base_url_controller.'/index'));
    }

    public function method($accion,$id=null){
        $datos = $this->datos;
        $obj = new AgendaModel($db);
        switch($accion){
            case 'add':
                if ($this->request->getMethod() == 'post') {
                    $fields = $this->request->getPost();
                    $respuesta = $obj->addElement($fields);
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
                            $respuesta = $obj->setElement($fields);
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
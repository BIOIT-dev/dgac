<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ForoCategoriaModel;

class CategoriasForos extends BaseController
{
    private $dir_view = 'foro_categoria';
    private $findUsuario ="";
    private $datos = array();

    function __construct() {

        $session = session();
        $this->findUsuario = new UsuarioModel($db);
        $this->findUsuario = $this->findUsuario->find($session->user_id);
        $user = new UsuarioModel($db);
        $rol =  $user->buscar_rol($session->user_id, $session->grupo_id);

        $this->datos['profile_data'] = $this->findUsuario;
        $this->datos['oid_usuario']=$session->user_id;
        $this->datos['oid_grupo']=$session->grupo_id;
        $this->datos['rol'] = $rol->rol;

        $this->datos['controller_name'] = 'ForoCategoria';
        $this->datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $this->datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Gestion de Categoria de Foros');
    }

    public function index(){
        $session = session();
        $obj = new ForoCategoriaModel($db);
        $datos = $this->datos;
        $datos['categorias'] = $obj->getAllElement($this->datos['oid_grupo']);  
        
        return view('foro_categoria/index', $datos);
    }

    public function add(){
        $session = session();
        $obj = new ForoCategoriaModel($db);
        $datos = $this->datos; 
  
        
        if($datos['rol'] !== 'ADM' && $datos['rol'] !== 'PRO')
        {
            $respuesta = false;
      
            $error = "Rol no autorizado para esta operación";
            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
       
            return view($datos['vista_respuesta'], $datos);
        } 

        if ($this->request->getMethod() == 'post') {
            $fields = $this->request->getPost();
            $fields['fecha'] =  date('Y-m-d H:i:s');

            $existe = $obj->getElementName($fields['nombre'], $this->datos['oid_grupo']);

           if($existe->oid >= 1){
                $respuesta = false;
                $error = "Existe una categoria con el mismo nombre";
                $datos = array_merge($datos,$this->respuesta($respuesta, $error));
           }else{
                $respuesta = $obj->addElement($fields);
                $datos = array_merge($datos,$this->respuesta($respuesta));
           }


            return view($datos['vista_respuesta'], $datos);
        }
        
        return view('foro_categoria/add', $datos);
    }


    //Editar categoria
    public function edit($id){
        $obj = new ForoCategoriaModel($db);
        $datos = $this->datos; 
        $datos['categorias'] = $obj->getAllElement($this->datos['oid_grupo']);  

        if($datos['rol'] !== 'ADM' && $datos['rol'] !== 'PRO')
        {
            $respuesta = false;
      
            $error = "Rol no autorizado para esta operación";
            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
       
            return view($datos['vista_respuesta'], $datos);
        } 

        if(!$id){
            $respuesta = false;
            $error = "No envio el id de la Categoria";
            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
            return view($datos['vista_respuesta'], $datos);
        }else{

            $categoria = $obj->getElement($id);

            if($categoria->oid > 0){
                if ($this->request->getMethod() == 'post') {
                    $fields = $this->request->getPost();

                    //Si existe otra categoria con el mismo nombre
                    $existe = $obj->getElementEdit($fields['nombre'], $this->datos['oid_grupo'], $id);

            
                    if($existe->oid >= 1){
                            $respuesta = false;
                            $error = "Existe una categoria con el mismo nombre";
                            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
                            return view($datos['vista_respuesta'], $datos);
                    }

                    $respuesta = $obj->setElement($fields);
                    $datos = array_merge($datos,$this->respuesta($respuesta));
                    return view($datos['vista_respuesta'], $datos);
                }else{
                    $datos['resultado_busqueda'] =  $categoria;

                    return view('foro_categoria/edit', $datos);
                }
            }

        }
        
       
        return view('foro_categoria/index', $datos);
    }

    
    function respuesta($respuesta, $error=''){
        
        if($respuesta){
            $datos['mensaje_servidor'] = 'El registro ha sido procesado correctamente!';
            $datos['url_retorno'] = 'CategoriasForos/index';
            $datos['vista_respuesta'] = 'respuestas_servidor/exito';
        }else{
            if($error!= ''){
                $datos['mensaje_servidor'] = $error;
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido procesar el registro!';
            }
            
            $datos['url_retorno'] = 'CategoriasForos/index';
            $datos['vista_respuesta'] = 'respuestas_servidor/error';
        }
        return $datos;
    }

}
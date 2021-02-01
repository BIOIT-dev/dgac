<?php
use App\Models\UsuarioModel;

// namespace App\Controllers;
if(!function_exists("CrearBreadCrum"))
{
 
function CrearBreadCrum()
{
    // $session = session();
    $currentURL = current_url();
    $config = \CodeIgniter\Config\Services::request()->config;
    $baseUrl = ! empty($config->baseURL) && $config->baseURL !== '/'
			? rtrim($config->baseURL, '/ ') . '/'
			: $config->baseURL;
    $url = new \CodeIgniter\HTTP\URI($baseUrl);
    if (! empty($uri))
    {
        $url = $url->resolveRelativeURI($uri);
    }
    if (empty($protocol) && \CodeIgniter\Config\Services::request()->isSecure())
    {
        $protocol = 'https';
    }

    if (! empty($protocol))
    {
        $url->setScheme($protocol);
    }
    $uri = explode('/',explode($baseUrl,$currentURL)[1]);
    $url_enviar = '';
    $contador = 0;
    foreach($uri as $valor){
        if($contador==0){
            $tmp_h = site_url($valor.'/index');
            $href="href='".$tmp_h."'";
            $contador = 1;
        }else{
            $href="#";
        }
        $url_enviar = $url_enviar . '<li class="breadcrumb-item"><a '.$href.'>'.$valor.'</a></li>';
    }
    return $url_enviar;
}

function VerificarControlador($controller)
{
    // $session = session();
    $currentURL = current_url();
    $config = \CodeIgniter\Config\Services::request()->config;
    $baseUrl = ! empty($config->baseURL) && $config->baseURL !== '/'
			? rtrim($config->baseURL, '/ ') . '/'
			: $config->baseURL;
    $url = new \CodeIgniter\HTTP\URI($baseUrl);
    if (! empty($uri))
    {
        $url = $url->resolveRelativeURI($uri);
    }
    if (empty($protocol) && \CodeIgniter\Config\Services::request()->isSecure())
    {
        $protocol = 'https';
    }

    if (! empty($protocol))
    {
        $url->setScheme($protocol);
    }
    $uri = explode('/',explode($baseUrl,$currentURL)[1]);
    $url_enviar = '';
    echo $uri . "==" . $controller;
    return;
}

function fotoPerfil($id){
    // echo $id;
    $findUsuario = new UsuarioModel($db);
    $findUsuario = $findUsuario->getUsuario2($id);
    if(isset($findUsuario->foto) && !empty($findUsuario->foto)){
        if(file_exists('../assets/uploads/users/'.$findUsuario->foto)){
            $url = 'assets/uploads/users/'.$findUsuario->foto;
        }else{
            if($findUsuario->sexo=='m'){
                $url = 'assets/images/no_avatar.jpg';
            }else{
                $url = 'assets/images/no_avatar1.jpg';
            } 
        }
    }else{
        try{
            if($findUsuario->sexo=='m'){
                $url = 'assets/images/no_avatar.jpg';
            }else{
                $url = 'assets/images/no_avatar1.jpg';
            }
        }catch (\Exception $e){
            $url = 'assets/images/no_avatar.jpg';
        }
    }
    // echo "XXXXXXXX-12";
    // echo var_dump();
    return $url;
    

}

function NombrePerfil($id){
    // echo $id;
    $usuarioModel = new UsuarioModel($db);
    $findUsuario = $usuarioModel->getUsuario2($id);
    try{
        $nombre = $findUsuario->nombres.' '.$findUsuario->apellido_paterno.' '.$findUsuario->apellido_materno;
    }catch (\Exception $e){
        $nombre = $id;
    }
    return $nombre;
}

function MostrarElemento($url,$dato=false){
    $session = \Config\Services::session();
    if(!$dato){
        if($session->menu['permisos']->rol=='ADM'){
            return true;
        }
        $resultado = false;
        $urls_permitidas = array();
        foreach($session->menu['role_permisos'] as $module){
            $urls_permitidas[] = $module->url;
        }
        $array_resultado = array_intersect($urls_permitidas, $url);
        $numero = count($array_resultado);
        if($numero>0){
            $resultado = true;
        }
        return $resultado;
    }else{
        if(in_array($session->menu['permisos']->rol,$dato)){
            return true;
        }else{
            return false;
        }
    }
}

 
}
?>
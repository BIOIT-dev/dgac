<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;

class Profile extends BaseController
{   
    public $usuarioActual;
    public $profile_foto;

    function __construct() {
        $this->usuarioActual = $this->actualUser();
        $this->profile_foto = array('foto'=>base_url().'/assets/images/users/5.jpg');
        // $this->load->helper('bread');
        helper('bread');
    }

	public function index()
	{
        $session = session();
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        // var_dump($findUsuario);
        $datos['profile_data'] = $findUsuario;
        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');

        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Perfil');
        // load_profile($datos);
        // $datos['profile_data'] = array(
        //     'nombres' => 'Guido',
        //     'apellidop' => 'Martinez',
        //     'apellidom' => 'Salazar',
        //     'autentificacion' => '0',
        //     'userid' => 'root',
        //     'sexo' => 'M',
        //     'fecha_nac' => '1964-06-01',
        //     'foto' => base_url().'/assets/images/users/5.jpg',
        //     'profesion' => 'Ingeniero en Informática, Magister en Educación',
        //     'correo' => 'admin@sanpedroconsultores.cl',
        //     'telefono' => '224364422',
        //     'ciudad' => 'Región Metropolitana',
        //     'cargo' => 'Encargado Gestión Administrativa',
        //     'unidad' => 'Escuela Técnica Aeronáutica',
        //     'estadocivil' => 'Casado',
        //     'asig_academica' => 'Doctor',
        //     'pensionado' => 'No',
        //     'reliquidado' => 'No',
        //     'quiensoy' => '<p>Mi nombre es Guido Mart&iacute;nez Salazar, tengo el grado de Magister en Educaci&oacute;n con menci&oacute;n en Curriculum y Evaluaci&oacute;n y adem&aacute;s con menci&oacute;n en Pol&iacute;tica y Gesti&oacute;n Educacional, soy Ingeniero en Inform&aacute;tica y Multimedios, realic&eacute; un Diplomado en Formaci&oacute;n por Competencias para Formadores, soy Controlador de Tr&aacute;nsito A&eacute;reo Militar, Auditor interno ISO 9001:2008 entre otras cosas.</p>

        //     <p>Estuve a cargo de Educaci&oacute;n a Distancia desde el a&ntilde;o 2005 y hasta el a&ntilde;o 2015, a&ntilde;o que pase a cargo de Gesti&oacute;n TICs de la ETA. Actualmente estoy a cargo de la Oficina de Gesti&oacute;n Administrativa de la ETA.</p>
            
        //     <p>Soy pap&aacute; de 4 hijos y tengo un nietecito. Estoy para ayudarlo en lo referente a problemas t&eacute;cnicos de la plataforma web y en general a cualquier tema inform&aacute;tico relacionado con esta plataforma.</p>',
        // );
		return view('profile', $datos);
	}

	// public function login()
	// {
	// 	return view('login');
	// }

    //--------------------------------------------------------------------
     public function send_profile(){
        $data = $this->request->getPost();
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Perfil');
        $datos['profile_data'] = $this->usuarioActual;
        if ($this->request->getMethod() == 'post'){

            $array = array(
                'oid' => $data['oid'],
                'inactivo' => $data['inactivo'],
                'rut' => $data['rut'],
                'fecnac' => $data['fecnac'],
                'profesion' => $data['profesion'],
                'email' => $data['email'],
                'skype' => $data['skype'],
                'msn' => $data['msn'],
                'fono' => $data['fono'],
                'direccion' => $data['direccion'],
                'comuna' => $data['comuna'],
                'ciudad' => $data['ciudad'],
                'empresa_cargo' => $data['empresa_cargo'],
                'empresa_telefono' => $data['empresa_telefono'],
                'empresa_direccion' => $data['empresa_direccion'],
                'empresa_comuna' => $data['empresa_comuna'],
                'empresa_ciudad' => $data['empresa_ciudad'],
                'estado_civil' => $data['estado_civil'],
                'trienios' => $data['trienios'],
                'especialidad' => $data['especialidad'],
                'sistema_previsional' => $data['sistema_previsional'],
                'sistema_salud' => $data['sistema_salud'],
                'asignacion_academica' => $data['asignacion_academica'],
                'pensionado' => $data['pensionado'],
                'reliquidado' => $data['reliquidado']
            );

            if($imagefile = $this->request->getFiles())
            {
                if($img = $imagefile['foto'])
                {
                    if ($img->isValid() && ! $img->hasMoved())
                    {
                        $foto = $img->getClientName(); //This is if you want to change the file name to encrypted 
                        $img->move(realpath(FCPATH . '../assets/uploads/users'), $foto);
                        $array['foto'] = $foto;
                    }
                }
            }

            if( $data['clave'] != '' ){
                $array['clave'] = md5($data['clave']);
            }
            
            $obj = new UsuarioModel($db);
            $result = $obj->editar_usuario_model($array);
            if( $result ){
                $datos['mensaje_servidor'] = 'Los datos de perfil ha sido actualizado correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }
            return redirect()->to(base_url('public/Profile'));
        }
     }

    function administracion(){
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find(1);
        $datos['profile_data'] = $findUsuario;
        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Administración');
        return view('administracion', $datos);
    }
    function actualUser(){
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find(1);
        return $findUsuario;
    }

}

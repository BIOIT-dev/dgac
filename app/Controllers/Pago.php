<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\PagoModel;

class Pago extends BaseController
{
    /******************************************************************/
	public function index()
	{   
        $session = session();

        if( $session->role_id == 1 ){
            $ubicacion = "Formulario de Registro de pago";
        }else{
            $ubicacion = "Listado de Pagos por Alumnos";
        }

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=> $ubicacion);
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $obj = new PagoModel($db);
        /**
        / Historial de Pagos del estudiante
        */
        $datos['historia_pagos'] = $obj->historialPagos( $session->user_id );

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getPost();
            $data['usuario_oid'] = $session->user_id;
            $data['grupo_oid']   = $session->grupo_id;
            $data['fecha']       = date('Y-m-d H:i:s');
            $data['revisado']    = 0;

            if($imagefile = $this->request->getFiles())
            {
                //print_r($imagefile);
                if($img = $imagefile['ruta'])
                {
                    if ($img->isValid() && ! $img->hasMoved())
                    {
                        $file = $img->getClientName(); //This is if you want to change the file name to encrypted 
                        $img->move(realpath(FCPATH . '../assets/uploads/pago'), $file);
                        $data['ruta'] = $file;
                    }
                }
            }

            $respuesta = $obj->crear_pago_model($data);

            if ($respuesta == TRUE){
                $datos['mensaje_servidor'] = 'Pago ha sido creado correctamente!';
                return redirect()->to(base_url('public/Pago'));
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el Pago!';
            }
        }

        if( $session->role_id == 1 ){
            return view('pago/agregar-pago', $datos);
        }else{
            $datos['oid_grupo'] = $session->grupo_id;
            $datos['pagos'] = $obj->getPagos($datos['oid_grupo']);
            return view('pago/listado-pago', $datos);
        }

	}

    // Metodo de cambio de estatus de pagos
    public function change_pay(){
        $data = $this->request->getPost();
        $obj = new PagoModel($db);
        return $obj->change_pay($data);
    }

}
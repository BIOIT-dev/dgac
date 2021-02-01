<?php

namespace App\Controllers;
use App\Models\NoticiasModel;
use App\Models\AgendaModel;
use App\Models\EncuestasModel; //Modelo encuestas pública
use Vendor\phpoffice\phpword;

class Home extends BaseController
{
	public function index($accion='hoy')
	{
		$session = session();
		$datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
		$datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Noticias','ubicacion_url'=>'public/Noticias/index');
		$obj = new NoticiasModel($db);
		$agenda = new AgendaModel($db);
		// $datos['noticias'] = $obj->obtenerNoticiasPublic();
		try{
			$datos['noticias'] = $obj->obtenerNoticias($session->grupo_id);
			// var_dump($datos['noticias']);
			// return;
		}catch (\Exception $e)
		{
			$datos['noticias'] = [];
		}
		try{
			$datos['UltimosDocumentos'] = $obj->UltimosDocumentos($session->grupo_id);
		}catch (\Exception $e)
		{
			$datos['UltimosDocumentos'] = [];
		}

		try{
			$datos['linksDirectos'] = $obj->linksDirectos($session->grupo_id);
		}catch (\Exception $e)
		{
			$datos['linksDirectos'] = [];
		}

		try{
			$datos['Agenda'] = $agenda->MostrarAgendaHome($accion,$session->grupo_id);
		}catch (\Exception $e)
		{
			$datos['Agenda'] = [];
		}

		try{
			$datos['UltimasHistorias'] = $obj->ultimasHistorias($session->grupo_id,$session->user_id);
		}catch (\Exception $e)
		{
			$datos['UltimasHistorias'] = [];
		}
		
		
		$datos['profile_data'] = array(
            'nombres' => 'Guido',
            'apellido_paterno' => 'Martinez',
            'apellido_materno' => 'Salazar',
			'email' => 'admin@sanpedroconsultores.cl',
			'foto' => base_url().'/assets/images/users/5.jpg',);

		$encuestasModel = new EncuestasModel($db);
		$datos['resultado_busqueda'] = $encuestasModel->getEncuestas($session->grupo_id);
		foreach($datos['resultado_busqueda'] as $rb => $value){
			$respuesta = $encuestasModel->getRespondida($value->oid, $session->grupo_id, $session->user_id);
			if($respuesta != "0") 
				unset($datos['resultado_busqueda'][$rb]);
		}
		$datos['encuestas_flag'] = count($datos['resultado_busqueda']);

		return view('index', $datos);
	}

	public function login()
	{
		return view('login');
	}

	public function noMostrar(){
		if ($this->request->getMethod() == 'post') {
			$dataForm = $this->request->getPost();
			$session = session();
			$session->mostrar_encuestas = $dataForm['noMostrar'];
		}
	}

	public function test(){
		// $this->load->library('Phpword');
		// $word = new \PhpOffice\PhpWord\PhpWord();
		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		$phpWord->getCompatibility()->setOoxmlVersion(14);
		$phpWord->getCompatibility()->setOoxmlVersion(15);


		$filename = 'test.docx';
		// add style settings for the title and paragraph

		$section = $phpWord->addSection();
		$section->addText("Hello, world");
		$section->addTextBreak(1);
		$section->addText("It's cold outside.");

		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
		$objWriter->save($filename);
		// send results to browser to download
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$filename);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filename));
		flush();
		readfile($filename);
		unlink($filename); // deletes the temporary file
		exit;
	}

	//--------------------------------------------------------------------

}

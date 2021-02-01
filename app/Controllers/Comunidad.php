<?php namespace App\Controllers;

use CodeIgniter\Models;
use App\Models\ComunidadModel;
use App\Models\CategoriaComunidadModel;
use App\Models\UsuarioModel;
use App\Models\CarreraModel;
use App\Models\GrupoTipoModel;
use App\Models\GrupoCategoriaModel;
use App\Models\TemaModel;
use App\Models\AccesoModel;
// use System\Helper\breadss;
use PHPExcel; 
use PHPExcel_IOFactory;

class Comunidad extends BaseController
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
        helper('breadsss');
        $findComunidades = new ComunidadModel($db);
        $obj = new UsuarioModel($db);
        $query = $obj->list_access_users($session->user_id);
        // echo var_dump($query);
        // return;
        $datos['query'] = $query;

        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Mis Comunidades');
        $datos['profile_data'] = $this->usuarioActual;
		return view('comunidad/misComunidades', $datos);
    }
    
     /******************************************************************/
	public function crear_comunidad()
	{
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Crear Comunidad');
        
        $session = session();
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->getUsuario( $session->username );
        
        if ($this->request->getMethod() == 'post') {
            $data_comunidad = $this->request->getPost();

            $crearComunidad = new ComunidadModel($db);
            $respuesta = $crearComunidad->crear_comunidad($data_comunidad, $findUsuario['oid']);

            if ($respuesta == TRUE){
                $datos['mensaje_servidor'] = 'La comunidad ha sido creada correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear la comunidad!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $r_carreras = new CarreraModel($db);
        $datos['r_carreras'] = $r_carreras->getCarreras();

        $r_grupotipo = new GrupoTipoModel($db);
        $datos['r_grupotipo'] = $r_grupotipo->getGrupoTipo();

        $r_grupocategoria = new GrupoCategoriaModel($db);
        $datos['r_grupocategoria'] = $r_grupocategoria->getGrupoCategoria();

        $r_temas = new TemaModel($db);
        $datos['r_temas'] = $r_temas->getTemas();

		return view('comunidad/crear-comunidad', $datos);
	}
	/******************************************************************/
    function buscar_comunidad(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Buscar Comunidad');
        $r_grupocategoria = new GrupoCategoriaModel($db);
        $datos['r_grupocategoria'] = $r_grupocategoria->getGrupoCategoria();

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();
            $buscarComunidad = new ComunidadModel($db);
            $datos['resultado_busqueda'] = $buscarComunidad->buscarComunidad($data_busqueda);
            // var_dump($datos['resultado_busqueda']);
            return view('comunidad/listado-comunidad', $datos);
        }

        // $findComunidades = new ComunidadModel($db);
        // $query = $findComunidades->obtenerComunidades();
        // $datos['query'] = $query;

        return view('comunidad/buscar-comunidad', $datos);
    }
    /******************************************************************/
    /******************************************************************/
    function eliminar_comunidad(){
        if ($this->request->getMethod() == 'post') {
            $comunidad_recibidas = $this->request->getPost();
            $eliminarComunidad = new ComunidadModel($db);

            foreach ($comunidad_recibidas as $id_comunidad){
                $respuesta = $eliminarComunidad->eliminar_comunidad($id_comunidad);
                var_dump($respuesta);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    /******************************************************************/
    function editar($id_comunidad){
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Comunidad');
        $datos['profile_data'] = $this->usuarioActual;

        $findComunidad_edit = new ComunidadModel($db);
        $findComunidad = $findComunidad_edit->find($id_comunidad);
        $datos['profile_data_edit'] = $findComunidad;
        $datos['modulos'] = $findComunidad_edit->modulos($id_comunidad);


        if ($this->request->getMethod() == 'post') {
            $data_comunidad = $this->request->getPost();
            
            $editarComunidad = new ComunidadModel($db);
            $respuesta = $editarComunidad->editar_comunidad($data_comunidad);

            if ($respuesta == TRUE){
                $datos['mensaje_servidor'] = 'La comunidad se editó correctamente!';
                return view('respuestas_servidor/exito', $datos);
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido editar la comunidad!';
                return view('respuestas_servidor/error', $datos);
            }
        }
        $r_carreras = new CarreraModel($db);
        $datos['r_carreras'] = $r_carreras->getCarreras();

        $r_grupotipo = new GrupoTipoModel($db);
        $datos['r_grupotipo'] = $r_grupotipo->getGrupoTipo();

        $r_grupocategoria = new GrupoCategoriaModel($db);
        $datos['r_grupocategoria'] = $r_grupocategoria->getGrupoCategoria();

        $r_temas = new TemaModel($db);
        $datos['r_temas'] = $r_temas->getTemas();

        return view('comunidad/editar-comunidad', $datos);
    }

    function guardar_modulos($id_comunidad){
        echo $id_comunidad;
        if ($this->request->getMethod() == 'post') {
            $modulos = $this->request->getPost();
            foreach($modulos as $modulo){
                $datos = ['grupo_id'=>$id_comunidad,'modulo_id'=>$modulo];
                $crear_modulos = new ComunidadModel($db);
                $respuesta = $crear_modulos->crear_modulo_comunidad($datos);
                echo var_dump($respuesta);
                
                if(!$respuesta){
                    echo "--";
                    $respuesta = $crear_modulos->eliminar_modulo_comunidad($datos);
                    echo var_dump($respuesta);
                    echo "..";
                }
            }
        }else{
            return false;
        }
    }

    /******************************************************************/
    function actualUser(){
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find(1);
        return $findUsuario;
    }

    /**
    / Menu
    */
    public function menu( $user_id, $grupo_id )
    {
        /**
        / Permisos de usuario
        */
        $instance = new AccesoModel($db);
        $data['permisos'] = $instance->UsuarioPermisosGrupo( $user_id, $grupo_id );

        /**
        / Permisos por Role
        */
        if($data['permisos'] != "" && $data['permisos'] != null){
			$role_id               = $data['permisos']->role_id;
			$data['role_id']       = $data['permisos']->role_id;
			$data['grupo_id']      = $data['permisos']->grupo_id;
		}else{
			$role_id               = 0;
			$data['role_id']       = 0;
			$data['grupo_id']      = 0;
		}

        // foreach ($data['permisos'] as $key => $value) {
        //     // $role_id = $value->role_id;
        //     $data['panel_admin']   = $instance->PanelAdmin( $role_id );
        //     $data['role_permisos'] = $instance->RolePermisos( $role_id );

        // }
        $data['panel_admin']   = $instance->PanelAdmin( $role_id );
        $data['role_permisos'] = $instance->RolePermisos( $role_id, $data['grupo_id']);
        
        //echo "<pre>";
        //print_r($data);
        return $data;
    }

    /**
    / Procesar datos de logeo
    */
    function iniciar_comunidad( $grupo_id ){

        $session = session();
        
        if( $session->user_id ){

            $findUsuario = new UsuarioModel($db);
            $findUsuario = $findUsuario->getUsuario( $session->username );
            $headers['profile_data'] = $findUsuario;
            $headers['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
            $headers['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Administración');
            $buscarComunidad = new ComunidadModel($db);
            $datos['resultado_busqueda'] = $buscarComunidad->buscarComunidadId($grupo_id);
            
            $newdata = [
                'sessionExpiration'  => 7200,
                'user_id'  => $session->user_id,
                'username'  => $session->username,
                'grupo_id'  => $grupo_id,
                'role_id'  => $this->menu( $findUsuario['oid'], $grupo_id)['role_id'],
                'aulavirtual'  => $datos['resultado_busqueda'][0]->aulavirtual,
                'grupo_nombre' => $datos['resultado_busqueda'][0]->nombre,
                'menu'  => $this->menu( $session->user_id, $grupo_id )
            ];

            
            $dataEvento = [
                'session' => $this->request->getCookie('ci_session'),
                'oid_usuario' => $session->user_id,
                'fecha' => date("Y-m-d H:i:s"),
                'seccion' => 'HOME',
                'oid_grupo' => $grupo_id,
                'evento' => 'VIEW'
            ];
            $buscarComunidad->insertEventoCambioComunidad($dataEvento);
            // var_dump($dataEvento);
            // return;
            // $buscarComunidad = new ComunidadModel($db);
            // $datos['resultado_busqueda'] = $buscarComunidad->buscarComunidadId($grupo_id);
            $session->set($newdata);
            // $datos->nombre;
            // print_r($datos['resultado_busqueda'][0]->nombre);
            // return;
            //$headers['username'] = $session->username;
            //return view('index', $headers);
            return redirect()->to(base_url('public/Home'));
            
        }

    }
    /******************************************************************/
    function carga(){
        $datos['profile_data'] = $this->usuarioActual;
        $datos['profile_foto'] = $this->profile_foto;
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Carga Masiva de Carreras');
		
		$session = session();
		$findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->getUsuario( $session->username );
        
        $objCategoriaComunidad = new CategoriaComunidadModel($db);
        
        $datos['categorias'] = $objCategoriaComunidad->getCarreras();

        $datos['clasificaciones'] = $objCategoriaComunidad->getClasificaciones();

        if ($this->request->getMethod() == 'post') {
            $data_form['datos'] = $this->request->getPost();
            
            //~ $data_form['archivo'] = $this->request->getFiles();  // Es muy restrictivo
            $data_form['archivo'] = $_FILES;
            
            $data_form['validate_file'] = json_decode($this->validate_file($_FILES['archivo']), true);
            
            $get_data_import = $this->get_data_import($data_form['datos']['categoria'], $data_form['datos']['clasificacion'], $data_form['archivo']['archivo']);
            
            $insert_data_import = $this->insert_data_import($get_data_import, $findUsuario['oid']);
            
            $data_form['result'] = $insert_data_import;
            
            return view('comunidad/carga_result', $data_form);
        }
        return view('comunidad/carga', $datos);
    }
    /******************************************************************/
    public function get_data_import( $categoria, $clasificacion, $file )
    {
		$data = array();
		$validate = json_decode($this->validate_file($file), true);
		if($validate['result'] == "ok"){
			$extension = explode('.',$file['name']);
			$extension = $extension[1];
			$rand= rand(0,100);
			$nombreArchivo = "carga_".$rand.".".$extension;
			
			$carpeta_proyecto = $this->carpeta_proyecto();
			$ruta_origen = $file['tmp_name'];
			$ruta_destino = $_SERVER['DOCUMENT_ROOT']."/$carpeta_proyecto/assets/uploads/".$nombreArchivo;
			/* copiamos el archivo*/
			if (move_uploaded_file($ruta_origen,$ruta_destino)) {
				//~ echo "archivo copiado";
				if (file_exists($ruta_destino)) {
					$objPHPExcel = PHPExcel_IOFactory::load($ruta_destino);
					// Número de hojas en el archivo
                    $sheetCount = $objPHPExcel->getSheetCount();
                    //~ echo $sheetCount;
                    for ($inicio = 0 ; $inicio < $sheetCount;$inicio++)
					{
						$sheet = $objPHPExcel->getSheet($inicio);
						$numRows = $sheet->getHighestRow();//Ultima
						$numCols = $sheet->getHighestColumn();//Ulima Columna (N)
						
						$j=0;
						for ($i = 2; $i <= $numRows; $i++)
						{
							$elimina = false;
							//Capturamos el rut para consultar el pers_cod
							$id = $sheet->getCell("A".$i)->getValue();
							if(empty($id)){
								continue;
								$elimina = true;
							}
							$data[$j]['Grupo']['id'] =$id;
							$data[$j]['Grupo']['nombre'] = $nombre = $sheet->getCell("B".$i)->getValue();
							if(empty($nombre)){
								$elimina = true;
							}

							$data[$j]['Grupo']['anio'] = $anio = $sheet->getCell("C".$i)->getValue();
							$objGrupoTipo = new GrupoTipoModel($db);
							$tipo = $objGrupoTipo->getGrupoTipoNombre(trim($sheet->getCell("D".$i)->getValue()));
							if(!empty($tipo) ){
								$data[$j]['Grupo']['tipo'] = $tipo->grti_cod;
							}else{
								$elimina = true;
							}

							$data[$j]['Grupo']['ing'] = $ing = $sheet->getCell("E".$i)->getValue();
							$data[$j]['Grupo']['egre'] = $egre = $sheet->getCell("F".$i)->getValue();
							$data[$j]['Grupo']['especialidad'] = $especialidad = $sheet->getCell("G".$i)->getValue();
							$data[$j]['Grupo']['horas'] = $horas = trim($sheet->getCell("I".$i));
							$data[$j]['Grupo']['periodo'] = $periodo = trim($sheet->getCell("H".$i));

							$data[$j]['Grupo']['oid_categoria'] = $categoria;

							$nf = explode("al",$periodo);
							if(isset($nf[1])){
								$data[$j]['Grupo']['inicio'] = $fi = $this->cambiaFecha(trim($nf[0]), $anio);
								$data[$j]['Grupo']['termino'] = $ff = $this->cambiaFecha(trim($nf[1]), $anio);
								//~ $data[$j]['Grupo']['duracion'] = ($ff - $fi)/5;
							}else{
								$data[$j]['Grupo']['inicio'] = "";
								$data[$j]['Grupo']['termino'] = "";
								$data[$j]['Grupo']['duracion'] = "";
							}

							if($elimina){
								unset($data[$j]);
							}

							$j++;
						}
					}
				}
			}
		}
		return $data;
	}
    /******************************************************************/
    public function insert_data_import( $data, $oid_usuario )
    {
		$regs = array();  // Registros
		
		$result;
		
		foreach($data as $k => $v){
            if(empty($v)){
                continue;
            }
            //consulto si existe
            $objGrupo = new ComunidadModel($db);
			$existe = $objGrupo->buscarComunidadHistorico($v['Grupo']['id']);
            if(count($existe) > 0){
                $reg['oid'] = $existe[0]->oid;
            }else{
                $reg['oid'] = NULL;
            }

            $reg['nombre'] = $v['Grupo']['anio']." ".$v['Grupo']['nombre'];
            $reg['inactivo'] = 0;
            $reg['oid_tema'] = 1;
            $reg['descripcion'] ='<!-- WYSIWYG --><strong style="font-family: Arial, sans-serif; line-height: 21.6px; color: #ff0000; font-size: medium; text-align: center; background-color: #f8f8f8">FINALIZADO</strong><br>'.$v['Grupo']['periodo'];
            $reg['webmaster_email'] = 'gmartinezs@dgac.cl';
            $reg['novisible'] = '(AULAVIRTUAL)';
            $reg['palabra_alumnos'] = 'Alumnos';
            $reg['palabra_tutores'] = 'Tutores';
            $reg['palabra_profesores'] = 'Profesores';
            $reg['palabra_publicadores'] = 'Coordinadores';
            $reg['oid_categoria'] = $v['Grupo']['oid_categoria'];
            $reg['autoincorporacion'] = 0;
            $reg['registra_emocion']= 0;
            $reg['top5_activo']= 0;
            $reg['lang'] = 'spanish';
            $reg['grti_cod'] = $v['Grupo']['tipo'];
            $reg['horas'] = (empty($v['Grupo']['horas']))?0:$v['Grupo']['horas'];
            //~ $reg['anio'] = $v['Grupo']['anio'];
            //~ $reg['ingresan']= $v['Grupo']['ing'];
            //~ $reg['egresan']= $v['Grupo']['egre'];
            //~ $reg['especialidad']= $v['Grupo']['especialidad'];
            $reg['grup_finicio']= $v['Grupo']['inicio'];
            $reg['grup_ftermino']= $v['Grupo']['termino'];
            //~ $reg['grup_finicio']= "";
            //~ $reg['grup_ftermino']= "";
            $reg['oid_historico'] = $v['Grupo']['id'];
            
            $regs[] = $reg;
            
            $validate = json_decode($this->validate_fields($reg), true);
			
			if($validate['result'] == 'ok'){
				if($objGrupo->crear_comunidad($reg, $oid_usuario)){
					if(count($existe) == 0){
						$oid_grupo = $objGrupo->getLastInsertID();
						$objUsuario = new UsuarioModel($db);
						$new_data = array(
							'oid_usuario' => 1,
							'oid_grupo' => $oid_grupo->oid,
							'rol' => 'ADM',
							'oid_tutor' => 0,
							'conexiones' => 0,
							'hits_click' => 0,
							'hits_download' => 0,
							'hits_post' => 0,
							'hits_scorm' => 0
						);
						$respuesta = $objUsuario->crear_usuario_permisos_model($new_data);
					}
					$result = "ok";
				}else{
					$result = "error";
				}
			}else{
				$result = "error";
				echo $v['Grupo']['nombre'];
                echo "<pre>";
                print_r(json_decode($this->validate_fields($reg), true));
			}

        }
        
		return $result;
	}
    /******************************************************************/
    /* Valida archivo */
    public function validate_file( $file )
    {
		$result = "error";
		$mensaje = "";
		
		// Tipos permitidos
		$types = array('application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		
		$tipo = "fail";
		if(in_array($file['type'], $types)){
			$tipo = "ok";
		}else{
			$mensaje = "La extensión no es válida.";
		}
		
		$size = "fail";
		if((int)$file['size'] <= 15000000){
			$size = "ok";
		}else{
			$mensaje = "El tamaño excede el máximo de 15M.";
		}
		
		if($tipo == "ok" && $size == "ok"){
			$result = "ok";
			$mensaje = "Archivo válido.";
		}
		
		return '{"result":"'.$result.'", "mensaje":"'.$mensaje.'"}';
	}
    /******************************************************************/
    /* Valida columnas */
    public function validate_fields( $fields )
    {
		$result = "ok";
		$mensajes = array();
		
		if($fields['nombre'] == ''){
			$mensajes[] = "El nombre es requerido.";
			$result = "error";
		}
		
		//consulto si existe
		$objGrupo = new ComunidadModel($db);
		$existe_nombre = $objGrupo->buscarComunidadNombre($fields['nombre']);
		$existe_id = $objGrupo->buscarComunidadId($fields['oid']);
		
		if(count($existe_nombre) > 0 || count($existe_id) > 0){
			$mensajes[] = "La carrera ya existe.";
			$result = "error";
		}
		
		if($fields['horas'] == ''){
			$mensajes[] = "La duración es requerida.";
			$result = "error";
		}
		
		if((int)$fields['horas'] == 0){
			$mensajes[] = "La carrera debe tener una duración mínima de 1 hora.";
			$result = "error";
		}
		
		return '{"result":"'.$result.'", "mensaje":'.json_encode($mensajes).'}';
	}
    /******************************************************************/
    /* Transforma texto a fecha (date) */
    public function cambiaFecha( $segmento_fecha, $anyo )
    {
		$divide_fecha = explode("de", $segmento_fecha);
	
		$dia = trim($divide_fecha[0]);
		$mes = $this->cambiaMes(trim($divide_fecha[1]));
		
		if(count($divide_fecha) > 2){
			$anyo = trim($divide_fecha[2]);
		}else{
			$anyo = trim((string)$anyo);
		}
		
		$fecha_sql = "".$anyo."-".$mes."-".$dia;
		
		return $fecha_sql;
	}
    /******************************************************************/
    /* Transforma mes de texto a número */
    public function cambiaMes( $mes )
    {
		$num_mes = '01';
	
		$meses = array(
			'Enero' => '01',
			'Febrero' => '02',
			'Marzo' => '03',
			'Abril' => '04',
			'Mayo' => '05',
			'Junio' => '06',
			'Julio' => '07',
			'Agosto' => '08',
			'Septiembre' => '09',
			'Octubre' => '10',
			'Noviembre' => '11',
			'Diciembre' => '12'
		);
		
		foreach($meses as $k => $m){
			if(ucfirst($mes) == $k){
				$num_mes = $m;
			}
		}
		
		return $num_mes;
	}
	/******************************************************************/
	/* Obtiene el nombre de la carpeta del proyecto */
    function carpeta_proyecto(){
        
        $divide_ruta = explode($_SERVER['DOCUMENT_ROOT'], $_SERVER['SCRIPT_FILENAME']);
        
        $segment = explode("/", $divide_ruta[1]);
        
        $carpeta_proyecto = $segment[1];
        
        return $carpeta_proyecto;
    }

}

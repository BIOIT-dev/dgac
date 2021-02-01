<?php namespace App\Controllers;
// namespace App\Models;

use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\GeneradorDocsModel;
use App\Models\ComunidadModel;
use App\Models\CursosModel;
use App\Models\SedeModel;

class GeneradorDocs extends BaseController
{
    /******************************************************************/
    function index(){

        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Listado Documentos');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;

        if ($this->request->getMethod() == 'post') {
            $data_busqueda = $this->request->getPost();
            $buscarDoc = new GeneradorDocsModel($db);
            $datos['resultado_busqueda'] = $buscarDoc->buscar_documento_model($data_busqueda);
            
            return view('generador_documentos/listado-documentos', $datos);
        }

        $findDocumentos = new GeneradorDocsModel($db);
        $datos['resultado_busqueda'] = $findDocumentos->obtenerDocumentos();
        // $datos['query'] = $query;
        return view('generador_documentos/listado-documentos', $datos);
        // return view('generador_documentos/buscar-documento', $datos);
    }
    /******************************************************************/
	public function crear_documento()
	{   
        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Crear Documento');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;
        $obj = new GeneradorDocsModel($db);
        if ($this->request->getMethod() == 'post') {
            $fields = $this->request->getPost();
            $respuesta = $obj->crear_documento_model($fields);

            if ($respuesta == 'ok'){
                $datos['mensaje_servidor'] = 'El documento ha sido creado correctamente!';
                $findDocumentos = new GeneradorDocsModel($db);
                $query = $findDocumentos->obtenerDocumentos();
                $datos['query'] = $query;

                return view('generador_documentos/buscar-documento', $datos);
            }else if($respuesta == 'existe'){
                $datos['mensaje_servidor'] = 'El documento ya existe. Verifique el nombre y la url.!';
            }else{
                $datos['mensaje_servidor'] = 'No se ha podido crear el documento!';
            }
        }
		return view('generador_documentos/crear-documento', $datos);
	}
    /******************************************************************/
    function editar_documento($id){

        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Editar Documento');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;

        $obj = new GeneradorDocsModel($db);
        $findDocument_edit = $obj->find($id);
        $datos['documento_data_edit'] = $findDocument_edit;

        if ($this->request->getMethod() == 'post') {
            $data_documento = $this->request->getPost();
            $data_documento['activo'];
            $data_documento['nombre'];
            $data_documento['url'];
            $data_documento['orden'];
            
            $editarDocumento = new GeneradorDocsModel($db);
            $respuesta = $editarDocumento->editar_documento_model($data_documento);

            if ($respuesta == 'ok'){
                $datos['mensaje_servidor'] = 'El documento ha sido actualizado correctamente!';
                $findDocumentos = new GeneradorDocsModel($db);
                $query = $findDocumentos->obtenerDocumentos();
                $datos['query'] = $query;

                return view('generador_documentos/buscar-documento', $datos);
            }else if($respuesta == 'existe'){
                $datos['mensaje_servidor'] = 'El documento ya existe. Verifique el nombre y la url.!';
            }else{
                $datos['mensaje_servidor'] = 'Sin cambios!';
            }
        }
        return view('generador_documentos/editar-documento', $datos);
    }
    /******************************************************************/

	// public function login()
	// {
	// 	return view('login');
    // }
    /******************************************************************/
    function eliminar_documento(){
        //echo "entro";
        if ($this->request->getMethod() == 'post') {
            
            $documentos_recibidos = $this->request->getPost();
            $eliminarDocumento = new GeneradorDocsModel($db);
            //print_r($documentos_recibidos);
            foreach ($documentos_recibidos as $id_documento){
                $respuesta = $eliminarDocumento->eliminar_documento_model($id_documento);
                //var_dump($respuesta);
            }
        }else{
            var_dump("ERROR Controlador");
        }
    }
    /******************************************************************/
    function reporte_compromiso(){

        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Reporte de compromiso docente');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;

        $objComunidad = new ComunidadModel($db);
        $datos['comunidades'] = $objComunidad->obtenerComunidades();

        $objCurso = new CursosModel($db);
        $datos['cursos'] = $objCurso->obtenerCursosGeneral();

        if ($this->request->getMethod() == 'post') {
            $data_documento['datos'] = $this->request->getPost();
            
            $objGenerador = new GeneradorDocsModel($db);
            $compromiso_docente = $objGenerador->obtenerCompromisoDocente($data_documento['datos']['comunidad'], $data_documento['datos']['curso']);
            $data_documento['compromiso_docente'] = $compromiso_docente;
            $data_documento['document_root'] = $_SERVER['DOCUMENT_ROOT'];
            $data_documento['carpeta_proyecto'] = $this->carpeta_proyecto();
            
            return view('generador_documentos/compromisoDocenteDO', $data_documento);
            //~ return view('generador_documentos/testDO2', $data_documento);
        }
        return view('generador_documentos/reporte-compromiso', $datos);
    }
    /******************************************************************/
    function reporte_oficio(){

        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Reporte de oficio portador');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;

        $objCurso = new CursosModel($db);
        $datos['cursos'] = $objCurso->obtenerCursos0();

        if ($this->request->getMethod() == 'post') {
            $data_documento['datos'] = $this->request->getPost();
            
            $objGenerador = new GeneradorDocsModel($db);
            $oficio_portador = $objGenerador->obtenerOficioPortador($data_documento['datos']['doc']);
            $data_documento['oficio_portador'] = $oficio_portador;
            $ids_compromiso_docentes = implode(',', $data_documento['datos']['doc']);
            $data_documento['compromiso_docentes'] = $objGenerador->obtenerDocentesPortador($ids_compromiso_docentes);
            $data_documento['document_root'] = $_SERVER['DOCUMENT_ROOT'];
            $data_documento['carpeta_proyecto'] = $this->carpeta_proyecto();
            
            return view('generador_documentos/oficioPortadorDO', $data_documento);
            //~ return view('generador_documentos/resultado', $data_documento);
        }
        return view('generador_documentos/reporte-oficio', $datos);
    }
    /******************************************************************/
    function reporte_asuncion(){

        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Reporte de documento de asunción');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;

        $objComunidad = new ComunidadModel($db);
        $datos['comunidades'] = $objComunidad->obtenerComunidades();

        $objCurso = new CursosModel($db);
        $datos['cursos'] = $objCurso->obtenerCursosGeneral();

        if ($this->request->getMethod() == 'post') {
            $data_documento['datos'] = $this->request->getPost();
            
            $objGenerador = new GeneradorDocsModel($db);
            $informe_asuncion = $objGenerador->obtenerInformeAsuncion($data_documento['datos']['comunidad'], $data_documento['datos']['curso']);
            $data_documento['informe_asuncion'] = $informe_asuncion;
            $data_documento['document_root'] = $_SERVER['DOCUMENT_ROOT'];
            $data_documento['carpeta_proyecto'] = $this->carpeta_proyecto();
            
            return view('generador_documentos/informeAsuncionDO', $data_documento);
        }
        return view('generador_documentos/reporte-asuncion', $datos);
    }
    /******************************************************************/
    function reporte_presupuesto(){

        $session = session();

        $datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Reporte presupuestario');
        $findUsuario = new UsuarioModel($db);
        $findUsuario = $findUsuario->find($session->user_id);
        $datos['profile_data'] = $findUsuario;

        $objComunidad = new ComunidadModel($db);
        $datos['comunidades'] = $objComunidad->obtenerComunidades();

        $objCurso = new CursosModel($db);
        $datos['cursos'] = $objCurso->obtenerCursosGeneral();

        if ($this->request->getMethod() == 'post') {
            $data_documento['datos'] = $this->request->getPost();
            
            return view('generador_documentos/resultado', $data_documento);
        }
        return view('generador_documentos/reporte-presupuesto', $datos);
    }
    /******************************************************************/
    function find_cursos(){
        $data = $this->request->getPost();
        $obj = new CursosModel($db);
        $res = $obj->obtenerCursos($data['oid_grupo']);
        echo json_encode($res);
    }
    /******************************************************************/
    function find_profesores(){
        $data = $this->request->getPost();
        $obj = new CursosModel($db);
        $res = $obj->obtenerProfesores($data['oid_grupo'], $data['oid_curso']);
        echo json_encode($res);
    }
    /******************************************************************/
    function find_unidades(){
        $data = $this->request->getPost();
        $obj = new CursosModel($db);
        $res = $obj->obtenerUnidades($data['curso']);
        echo json_encode($res);
    }
    /******************************************************************/
    function find_oficioPortador(){
        $data = $this->request->getPost();
        $obj = new CursosModel($db);
        $res = $obj->obtenerOficioPortador($data['curso'], $data['unidad']);
        
        // Control de flujo de salida
        ob_start();
        ?>
        <tr>
		  <td class="list_titulo">seleccion</td>
		  <td class="list_titulo">ID</td>
		  <td class="list_titulo">Nombre Docente</td>
		  <td class="list_titulo">Unidad</td>
		  <td class="list_titulo">Asignatura</td>
		  <td class="list_titulo">Curso</td>
		  <td class="list_titulo">Inicio/termino</td>
		  <td class="list_titulo">horas</td>
		  <td class="list_titulo">accion</td
		</tr>
        <?php
        foreach($res as $r){
			?>
			<tr valign="top" class="results">
			  <td class="list_texto3"><input type="checkbox" class="chkboxes" name="doc[]" value="<?=$r->id?>"/></td>
			  <td class="list_texto1"><div id="oid" name="oid"><?=$r->id?></div></td>
			  <td class="list_texto1"><?=$r->nombres.' '.$r->a_paterno .' '.$r->a_materno?></td>
			  <td class="list_texto1"><?=$r->unidad?></td>
			  <td class="list_texto1"><?=$r->asignatura?></td>
			  <td class="list_texto1"><?=$r->nombre_grupo?></td>
			  <td class="list_texto1"><?=$r->f_desde.' al '.$r->f_hasta?></td>
			  <td class="list_texto1"><?=$r->horas?></td>
			  <td class="list_texto1"> <a class="quitar_portador" data-id="<?php echo $r->id; ?>"><img src="<?php echo base_url() ?>/assets/images/icon/remove.gif" class="confirmation"></a></td>
		    </tr>
			<?php
		}
        $html = ob_get_clean();
        
        echo $html;
    }
    /******************************************************************/
    function quitar_portador(){
        $data = $this->request->getPost();
        $obj = new GeneradorDocsModel($db);
        $res = $obj->quitarPortador($data['id']);
        echo json_encode($res);
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

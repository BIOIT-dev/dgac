<?php 
namespace App\Controllers;
// namespace App\Models;


use CodeIgniter\Models;
use App\Models\UsuarioModel;
use App\Models\ForoCategoriaModel;
use App\Models\ForoForoModel;
use App\Models\ForoPostModel;
use App\Models\ComunidadModel;
use App\Models\RolesModel;
use PHPExcel;
use PHPExcel_IOFactory;
use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Foro extends BaseController
{
    private $dir_view = 'foro_foro';
    private $findUsuario ="";
    private $datos = array();

    function __construct() {
        $session = session();
        $this->findUsuario = new UsuarioModel($db);
        $this->findUsuario = $this->findUsuario->find($session->user_id);
        $user = new UsuarioModel($db);
        $rol =  $user->buscar_rol($session->user_id, $session->grupo_id);

        $this->datos['rol'] = $rol->rol;
        $this->datos['profile_data'] = $this->findUsuario;
        $this->datos['oid_usuario']=$session->user_id;
        $this->datos['oid_grupo']=$session->grupo_id;
        $this->datos['profile_foto'] = array('foto'=>base_url().'/assets/images/users/5.jpg');
        $this->datos['headers'] = array('headersView'=>view('dgac/headers'), 'ubicacion'=>'Gestion de Categoria de Foros');
    }

    public function index(){
        $obj = new ForoForoModel($db);
        $datos = $this->datos;
        $datos['foros'] = $obj->getAllElement($this->datos['oid_grupo']);  

        return view('foro_foro/index', $datos);
    }

    public function exportarForo($idForo){
        $obj_foro = new ForoForoModel($db);
        $cate = new ForoCategoriaModel($db);
        $oPost = new ForoPostModel($db);
        $fields = $this->request->getPost();
        $datos = $this->datos;


        if($datos['rol'] !== 'ADM' && $datos['rol'] !== 'PRO')
        {
            $respuesta = false;
      
            $error = "Rol no autorizado para esta operación";
            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
       
            return view($datos['vista_respuesta'], $datos);
        } 

        if(!$idForo){
            $respuesta = false;
            $error = "No envio el id del Foro";
            $datos = array_merge($datos, $this->respuesta($respuesta, $error));
            return view($datos['vista_respuesta'], $datos);
        }else{

            $foro = $obj_foro->getElement($idForo);

            if($foro->oid > 0){
                $categoria = $cate->getElement($foro->oid_categoria);

                //Temas en discusion
                $temas = $oPost->getFilterElementDesc($foro->oid);

                $datos['categoria'] = $categoria;
                $datos['foro'] = $foro;
                $datos['temas'] = $temas;
                $datos['rol'] = $datos['rol'];

                return view('/foro_foro/foroExportar', $datos);

            } else {
                $respuesta = false;
                $error = "No existe el Foro";
                $datos = array_merge($datos, $this->respuesta($respuesta, $error));
                return view($datos['vista_respuesta'], $datos);
            }

        } 
    }

    public function estadisticasForo($idForo){

        //Buscar datos 
        $datos = $this->datos;
        $obj_foro = new ForoForoModel($db);
        $cate = new ForoCategoriaModel($db);
        $oPost = new ForoPostModel($db);
        $obj_comun = new ComunidadModel($db);
        $findUsuario = new UsuarioModel($db);
    
        if($datos['rol'] !== 'ADM' && $datos['rol'] !== 'PRO')
        {
            $respuesta = false;
      
            $error = "Rol no autorizado para esta operación";
            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
       
            return view($datos['vista_respuesta'], $datos);
        } 
        $foro = $obj_foro->getFilterElementData($idForo);

        $findUsuario = $findUsuario->getUsuario2($foro->oid_usuario);
        $categoria = $cate->getElement($foro->oid_categoria);
       
        //grupo del usuario
        $comunidad  = $obj_comun->buscarComunidadId($findUsuario->oid_grupo)[0];

        //Temas
        $temas = $oPost->getFilterElement($foro->oid);

        //Creo la hoja de excel
        $spreadsheet = new Spreadsheet();
        
        $roles['ALU'] = 'Alumnos';
        $roles['TUT'] = 'Gestor Administrativo';
        $roles['PRO'] = 'Profesores';
        $roles['PUB'] = 'Coordinadores';
        $roles['VIS'] = 'Curricular';
        $roles['ADM'] = 'Administradores';
        $roles['POS'] = 'Administrador de Admisión';

        $pag = 1;
        $i=0;
        foreach ($temas as $key => $tem) {
            $col = 11;

            $equipo='Toda la Comunidad';
            $equi = $oPost->getTeam($findUsuario->oid_grupo, $tem->oid_team);

            if($equi){
                $equipo = $equi->nombre;
            }

            $spreadsheet->createSheet();
            $sheet = $spreadsheet->setActiveSheetIndex($i);

            $spreadsheet->getActiveSheet()->setTitle('Tema'.++$key.'-'.$pag);

            $sheet->setCellValue('B2', 'Comunidad:');
            $sheet->setCellValue('B3', 'Fecha:');
            $sheet->setCellValue('B4', 'Categoría:');
            $sheet->setCellValue('B5', 'Foro:');
            $sheet->setCellValue('B6', 'Tema:');
            $sheet->setCellValue('B7', 'Equipo:');
            $sheet->setCellValue('B8', 'Publicado por:');
            $sheet->setCellValue('B9', 'Fecha de creación:');

            $sheet->getStyle('B2:B9')->getFont()->setBold(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);

            $sheet->setCellValue('C2', $comunidad->nombre);
            $sheet->setCellValue('C3', date('d/m/Y h:i:s'));
            $sheet->setCellValue('C4', $categoria->nombre);
            $sheet->setCellValue('C5', $foro->nombre);
            $sheet->setCellValue('C6', $tem->asunto);
            $sheet->setCellValue('C7', $equipo);
            $sheet->setCellValue('C8', $foro->apellidos.", ".$foro->nombres);
            $sheet->setCellValue('C9', date('d/m/Y h:i:s', strtotime($tem->fecha)));
            $sheet->getColumnDimension('C')->setAutoSize(true);

            //Cabecera Datos 
            $sheet->setCellValue('B11', 'Rol');
            $sheet->setCellValue('C11', 'Apellido Paterno');
            $sheet->setCellValue('D11', 'Apellido Materno');
            $sheet->setCellValue('E11', 'Nombres');
            $sheet->setCellValue('F11', 'participaciones');
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);

            $styleArray = [
                'font' => [
                    'bold' => true,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                         'color' => array('rgb' => '000000'),
                    ],
                ]
            ];

            $sheet->getStyle('B11:F11')->applyFromArray($styleArray);
            $sheet->getStyle('B11:F11')->getAlignment()->setHorizontal('center');


            //Cuerpo Datos
            $usuarios = $oPost->getParticipacionesUser($tem,$comunidad->oid);


             $styleCuerpo = [
                    'font' => [
                        'bold' => false,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                             'color' => array('rgb' => '000000'),
                        ],
                    ]
                ];

                foreach ($usuarios as $usu) {

                    if($tem->oid_team && !$usu->team_member) continue;

                    
                    if(!empty($usu->rol)){
                        $rol = $roles[$usu->rol];
                    }else{
                        $rol = 'Ninguno';
                    }

                    $col++;
                    $sheet->setCellValue('B'.$col, $rol);
                    $sheet->setCellValue('C'.$col, $usu->apellido_paterno);
                    $sheet->setCellValue('D'.$col, $usu->apellido_materno);
                    $sheet->setCellValue('E'.$col, $usu->nombres);
                    $sheet->setCellValue('F'.$col, $usu->cnt);

                    $sheet->getStyle('B'.$col.':'.'F'.$col)->applyFromArray($styleCuerpo);
                   
                }
               
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
                $sheet->getColumnDimension('F')->setAutoSize(true);

            $i++;
            //$pag++;  
        }
        
  
        $spreadsheet->setActiveSheetIndex(0);
        $writer = new Xlsx($spreadsheet);

        $filename = "EstadisticasForos.G".$comunidad->oid."F".$foro->oid.date('%d/%m/%Y %H:%i:%s');
       

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

         /* Obtenemos los caracteres adicionales o mensajes de advertencia y los
          guardamos en el archivo "depuracion.txt" si tenemos permisos */
        file_put_contents('depuracion.txt', ob_get_contents());
        /* Limpiamos el búfer */
        ob_end_clean();
        
        $writer->save('php://output'); // download file 
        
    }

    public function add($id){
        $obj = new ForoForoModel($db);
        $cate = new ForoCategoriaModel($db);
        $grupo     = new RolesModel($db);
        $datos = $this->datos; 
        $fields = $this->request->getPost();

        $categoria = $cate->getElement($id);

        if($datos['rol'] !== 'ADM' && $datos['rol'] !== 'PRO')
        {
            $respuesta = false;
      
            $error = "Rol no autorizado para esta operación";
            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
       
            return view($datos['vista_respuesta'], $datos);
        } 

        if( $categoria->oid > 0){
            if ($this->request->getMethod() == 'post') {

                //verifico si existe otro foro igual para el mismo grupo
                $existe = $obj->getElementName($fields['nombre'], $categoria->oid);

                if($existe->oid >= 1){
                    $respuesta = false;
                    $error = "Existe un con el mismo nombre";
                    $datos = array_merge($datos,$this->respuesta($respuesta, $error));
                }else{
                    if( isset($fields['permisos']) ){
                        $fields['permisos'] = implode(',', $fields['permisos']);
                    }else{
                        $fields['permisos'] = '';
                    }

                    $fields['fecha']        = date('Y-m-d H:i:s');

                    $respuesta = $obj->addElement($fields);
                    $datos = array_merge($datos,$this->respuesta($respuesta));
                }

               return view($datos['vista_respuesta'], $datos);
            }

        }else {
            $respuesta = false;
            $error = "No existe la categoria, para agregar un foro";
            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
        }
        
        $datos['oid_categoria'] = $id;
        $datos['grupo']         = $grupo->obtenerRules();
        $datos['category_name'] = $categoria->nombre;
        
        return view('foro_foro/add', $datos);
    }


    //Editar categoria
    public function edit($id){
        $datos = $this->datos;
        $obj_foro  = new ForoForoModel($db);
        $cate      = new ForoCategoriaModel($db);
        $grupo     = new RolesModel($db);
        $datos['categorias'] = $cate->getAllElement($this->datos['oid_grupo']);  

        if($datos['rol'] !== 'ADM' && $datos['rol'] !== 'PRO')
        {
            $respuesta = false;
      
            $error = "Rol no autorizado para esta operación";
            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
       
            return view($datos['vista_respuesta'], $datos);
        } 

        if(!$id){
            $respuesta = false;
            $error = "No envio el id del Foro";
            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
            return view($datos['vista_respuesta'], $datos);
        }else{

            
            $foro = $obj_foro->getElement($id);

            if($foro->oid > 0){
                $categoria = $cate->getElement($foro->oid_categoria);

                if ($this->request->getMethod() == 'post') {
                    $fields = $this->request->getPost();

                    //Si existe otra categoria con el mismo nombre
                    $existe = $obj_foro->getElementFindName($fields['nombre'], $id, $categoria->oid);

                    if($existe->oid >= 1){
                            $respuesta = false;
                            $error = "Existe un foro con el mismo nombre dentro de la categoria";
                            $datos = array_merge($datos,$this->respuesta($respuesta, $error));
                            return view($datos['vista_respuesta'], $datos);
                    }

                    $respuesta = $obj_foro->setElement($fields);
                    $datos = array_merge($datos,$this->respuesta($respuesta));
                    return view($datos['vista_respuesta'], $datos);
                }else{

                    $datos['resultado_busqueda'] =  $foro;
                    $datos['oid_categoria']  = $categoria->oid;
                    $datos['grupo']          = $grupo->obtenerRules();
                    $datos['category_name']  = $categoria->nombre;
                    $datos['foro_categoria'] = $cate->getAllElement($this->datos['oid_grupo']);

                    return view('foro_foro/edit', $datos);
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
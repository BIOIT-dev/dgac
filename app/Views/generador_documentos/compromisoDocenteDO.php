<?php 
//~ echo "<pre>";
//~ print_r($datos);
//~ echo "<br>";
//~ echo "<pre>";
//~ print_r($compromiso_docente);
//~ exit();

//~ json_decode(json_encode($compromiso_docente[0]), false);

//~ require_once( APPPATH.'ThirdParty/PhpWord7/Autoloader.php');

//~ \PhpOffice\PhpWord\Autoloader::register();
//~ use PhpOffice\PhpWord\Autoloader;
//~ Autoloader::register();
setlocale(LC_ALL,"es_ES");
require_once $document_root."/$carpeta_proyecto/vendor/autoload.php";

ini_set('memory_limit', '-1');

// Armado de datos
$date2= strftime(" %d de %B del %Y");
$oid_docente=$compromiso_docente[0]->oid_profesor;
$nombres=$compromiso_docente[0]->nombres;
$a_paterno=$compromiso_docente[0]->apellido_paterno;
$a_materno=$compromiso_docente[0]->apellido_materno;
$asignatura=$compromiso_docente[0]->titulo;
$comunidad = $compromiso_docente[0]->nombre_grupo;
$unidad = $compromiso_docente[0]->empresa_unidad;
$horas=$compromiso_docente[0]->horas;
$f_desde=$compromiso_docente[0]->f_inicio;
$f_hasta=$compromiso_docente[0]->f_termino;
$estado=0;
$format_f_desde= new DateTime($f_desde);
$format_f_hasta= new DateTime($f_hasta);

$dif=$format_f_desde->diff($format_f_hasta);
$dias=$dif->days;
$semanas=$dias/7;
if($semanas==0||$semanas=='0'||$semanas==null){
    $horas_semanales =$horas;
}else{
    $horas_semanales =$horas/$semanas;
}

$documento = new \PhpOffice\PhpWord\PhpWord();
$documento->getCompatibility()->setOoxmlVersion(14);
$documento->getCompatibility()->setOoxmlVersion(15);
// estilos


    //Encabezao
    $seccion = $documento->addSection(array('paperSize' => 'Letter', 'orientation' => 'portrait',
    'marginLeft' => 1411, 'marginRight' => 1411, 'marginTop' => 850, 'marginBottom' => 1411));

    $fontNormal=array('name' => 'Arial', 'size' => 11);
    $fontNorma9=array('name' => 'Arial', 'size' => 9);
    $fontNormal8=array('name' => 'Arial', 'size' => 8);
    $fontNormal16=array('name' => 'Arial', 'size' => 16);
    $paraNormal=array('align' => 'justify', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);
    $paraNormalCenter=array('align' => 'center', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);
    $paraNormalRight=array('align' => 'right', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);

    $fontFirma=array('name' => 'Arial', 'size' => 11, 'bold' => true );
    $paraFirma=array('align' => 'center', 'lineHeight' => 1, 'indent' => 6, 'spaceBefore' => 0, 'spaceAfter' => 0);

    $bold = array('bold' => true);
    $italic = array('italic' => true);
    $underline = array('underline' => 'single');
    $allCaps = array('allCaps' => true);
    $lIndent = array( 'indent' => 0.52);

    $tStyle = array('borderTopSize'=>null, 'borderBottomSize'=>null, 'borderLeftSize'=>null, 'borderRightSize'=>null,
                    'cellMarginTop'=>0, 'cellMarginBottom'=>0, 'cellMarginLeft'=>0, 'cellMarginRight'=>0, 'align' =>\PhpOffice\PhpWord\SimpleType\Jc::CENTER );

    
    $cabecera = $seccion->addHeader();
    $cabecera->firstPage();

    $cabecera->addTableStyle("estilo", $tStyle);
    $tabla = $cabecera->addTable("estilo");

    $tabla->addRow();
    $celda = $tabla->addCell(4800, array('align' => 'right'));

    $letra = array('name' => 'Arial', 'size' => 9, 'bold' => true, 'underline' => 'single');

    //Titulo de la cabecera

    $parrafo= array( 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);
    $textrun = $celda->addTextRun($parrafo);
    
    //estilos
    $letra_underline = array('name' => 'Arial', 'size' => 9, 'bold' => true, 'underline' => 'single');
    $fontNormal = array('name' => 'Arial', 'size' => 11);


    $textrun->addText(htmlspecialchars('DEPARTAMENTO RECURSOS HUMANOS'), array('name' => 'Arial', 'size' => 9, 'bold' => true,'alignment' => 'center', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0));

    $textrun->addText(htmlspecialchars('          '), $parrafo);
    $textrun->addText(htmlspecialchars('ESCUELA TÉCNICA AERONÁUTICA'), $letra_underline, array('align' => 'justify', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0));
    $textrun = $celda->addTextRun($parrafo);

    $textrun->addText(htmlspecialchars('          '), $parrafo);
    $textrun->addText(htmlspecialchars('Subdirección Administrativa'), $letra_underline, array('align' => 'justify', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0));
    $textrun = $celda->addTextRun($parrafo);
    $textrun->addText(htmlspecialchars('            '),  $parrafo);
    $textrun->addText(htmlspecialchars('Oficina Personal Docente'), $letra_underline, array('align' => 'justify', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0));
    $textrun = $celda->addTextRun($parrafo);
    $textrun->addText(htmlspecialchars('                            '), $parrafo);
    $textrun->addText(htmlspecialchars('AUT.42'), $letra, array('align' => 'justify', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0));
    $cabecera->addTextBreak(1, $fontNormal, $parrafo);
    //Fin de cabecera

    //Cuerpo del documento
    $letraNormal = array('name' => 'Arial', 'size' => 11);
    $paraNormal = array('align' => 'justify', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);
    $paraNormalLetra=array('name' => 'Arial', 'size' => 11, 'align' => 'justify', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);
    $fontNormal_16=array('name' => 'Arial', 'size' => 16, 'bold' => true, 'underline' => 'single', 'align' => 'center', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);

    $seccion->addText(htmlspecialchars('COMPROMISO DE DOCENCIA'), $fontNormal_16, array('align' => 'center', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0));

    $seccion->addTextBreak(1, $paraNormalLetra);

    $seccion->addText(htmlspecialchars('                    Por el presente documento me comprometo a asumir las responsabilidades docentes (planificación, realización de horas de clases, registro de actividades y evaluación de aprendizajes) implicadas en el desarrollo de las actividades que determina el Programa de Estudios de la Escuela Técnica Aeronáutica de la Dirección General de Aeronáutica Civil, en la asignatura que se indica a continuación, conforme a lo establecido en los artículos 87 y 88 inciso primero de la Ley 18.834 Estatuto Administrativo, que me permiten compatibilizar el actual cargo que poseo más 12 horas semanales/mensual en funciones docentes, con la obligación de prolongar la jornada, para compensar las horas que no pueda trabajar por causa del desempeño de la presente actividad docente:'), array('name' => 'Arial', 'size' => 11), array('align'=>'both'));

        $seccion->addTextBreak(1, $paraNormalLetra);
        
        $parrafoR =array('align' => 'right', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);
        
        $table1 = $seccion->addTable(); // creamos la tabla

        $table1->addRow(); 
        $table1->addCell(3000, array('vMerge' => 'restart', 'borderLeftColor' =>'999999','borderLeftSize' => 12, 'borderTopColor' =>'999999', 'borderTopSize' => 12,
    'valign'=>'center','width'=>1))->addText(htmlspecialchars('  CURSO'), array('name' => 'Arial', 'size' => 11, 'bold'=> true), $parrafo); 

        $table1->addCell(1, array('vMerge' => 'restart','borderTopColor' =>'999999', 'borderTopSize' => 12))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11, 'bold'=> true),  $parrafoR);
     
     $table1->addCell(4900, array('vMerge' => 'restart', 'borderRightColor' =>'999999','borderRightSize' => 12, 'borderTopColor' =>'999999', 'borderTopSize' => 12,
    'valign'=>'center','width'=>1))->addText(htmlspecialchars($compromiso_docente[0]->nombre_grupo), array('name' => 'Arial', 'size' => 11, 'bold'=> true), $parrafo);

    $table1->addRow(); 
    $table1->addCell(3000, array('vMerge' => 'restart', 'borderLeftColor' =>'999999','borderLeftSize' => 12,
    'valign'=>'center','width'=>1))->addText(htmlspecialchars('  ASIGNATURA'), array('name' => 'Arial', 'size' => 11), $parrafo); 

    $table1->addCell(1, array('vMerge' => 'restart'))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11, 'bold'=> true),  $parrafoR);
     
     $table1->addCell(4900, array('vMerge' => 'restart', 'borderRightColor' =>'999999','borderRightSize' => 12,
    'valign'=>'center','width'=>1))->addText(htmlspecialchars($compromiso_docente[0]->titulo), array('name' => 'Arial', 'size' => 11), $parrafo);


    $table1->addRow(); 
    $table1->addCell(3000, array('vMerge' => 'restart', 'borderLeftColor' =>'999999','borderLeftSize' => 12,
    'valign'=>'center','width'=>1))->addText(htmlspecialchars('  HORAS PROGRAMA'), array('name' => 'Arial', 'size' => 11), $parrafo); 

    $table1->addCell(1, array('vMerge' => 'restart'))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11, 'bold'=> true),  $parrafoR);
     
     $table1->addCell(4900, array('vMerge' => 'restart', 'borderRightColor' =>'999999','borderRightSize' => 12,
    'valign'=>'center','width'=>1))->addText(htmlspecialchars($compromiso_docente[0]->horas), array('name' => 'Arial', 'size' => 11), $parrafo);

    $table1->addRow(); 
    $table1->addCell(3000, array('vMerge' => 'restart', 'borderLeftColor' =>'999999','borderLeftSize' => 12,
    'valign'=>'center','width'=>1))->addText(htmlspecialchars('  HORAS Semanales'), array('name' => 'Arial', 'size' => 11), $parrafo); 

    $table1->addCell(1, array('vMerge' => 'restart'))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11, 'bold'=> true),  $parrafoR);
     
     $table1->addCell(4900, array('vMerge' => 'restart', 'borderRightColor' =>'999999','borderRightSize' => 12,
    'valign'=>'center','width'=>1))->addText(htmlspecialchars(round($horas_semanales)), array('name' => 'Arial', 'size' => 11), $parrafo);

    $table1->addRow(); 
    $table1->addCell(3000, array('vMerge' => 'restart', 'borderLeftColor' =>'999999','borderLeftSize' => 12, 'borderBottomColor' =>'999999','borderBottomSize' => 12,
    'valign'=>'center','width'=>1))->addText(htmlspecialchars('  PERÍODO'), array('name' => 'Arial', 'size' => 11), $parrafo); 

    $table1->addCell(1, array('vMerge' => 'restart','borderBottomSize' => 12,
    'borderBottomColor' =>'999999'))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11),  $parrafoR);
     
     $table1->addCell(4900, array('vMerge' => 'restart', 'borderRightColor' =>'999999','borderRightSize' => 12, 'borderBottomSize' => 12,
    'borderBottomColor' =>'999999',
    'valign'=>'center','width'=>1))->addText(htmlspecialchars($compromiso_docente[0]->f_inicio.' al '.$compromiso_docente[0]->f_termino), array('name' => 'Arial', 'size' => 11), $parrafo);


     //Segunda parte de la tabla
    $seccion->addTextBreak(1);
    $table1 = $seccion->addTable(); // creamos la tabla
    
    //SEGEMENTO 2
    $table1->addRow(); 
    $table1->addCell(3000, array('vMerge' => 'restart', 
    'valign'=>'center','width'=>1))->addText(htmlspecialchars('  NOMBRE'), array('name' => 'Arial', 'size' => 11), $parrafo); 

        $table1->addCell(1, array('vMerge' => 'restart'))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11),  $parrafoR);
     
     $table1->addCell(4900, array('vMerge' => 'restart',
    'valign'=>'center','width'=>1))->addText(htmlspecialchars($compromiso_docente[0]->apellidos.', '.$compromiso_docente[0]->nombres), array('name' => 'Arial', 'size' => 11), $parrafo);

    $table1->addRow(); 
    $table1->addCell(3000, array('vMerge' => 'restart',
    'valign'=>'center','width'=>1))->addText(htmlspecialchars('  RUN Nº'), array('name' => 'Arial', 'size' => 11), $parrafo); 

    $table1->addCell(1, array('vMerge' => 'restart'))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11, 'bold'=> true),  $parrafoR);
     
     $table1->addCell(4900, array('vMerge' => 'restart',
    'valign'=>'center','width'=>1))->addText(htmlspecialchars($compromiso_docente[0]->rut), array('name' => 'Arial', 'size' => 11), $parrafo);


    $table1->addRow(); 
    $table1->addCell(3000, array('vMerge' => 'restart', 
    'valign'=>'center','width'=>1))->addText(htmlspecialchars('  CATEGORÍA'), array('name' => 'Arial', 'size' => 11), $parrafo); 

    $table1->addCell(1, array('vMerge' => 'restart'))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11),  $parrafoR);
     
     $table1->addCell(4900, array('vMerge' => 'restart',
    'valign'=>'center','width'=>1))->addText(htmlspecialchars($compromiso_docente[0]->profesion), array('name' => 'Arial', 'size' => 11), $parrafo);

    $table1->addRow(); 
    $table1->addCell(3000, array('vMerge' => 'restart',
    'valign'=>'center','width'=>1))->addText(htmlspecialchars('  ESPECIALIDAD'), array('name' => 'Arial', 'size' => 11), $parrafo); 

    $table1->addCell(1, array('vMerge' => 'restart'))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11, 'bold'=> true),  $parrafoR);
     
     $table1->addCell(4900, array('vMerge' => 'restart', 
    'valign'=>'center','width'=>1))->addText(htmlspecialchars(round($compromiso_docente[0]->especialidad)), array('name' => 'Arial', 'size' => 11), $parrafo);

    $table1->addRow(); 
    $table1->addCell(3000, array('vMerge' => 'restart', 
    'valign'=>'center','width'=>1))->addText(htmlspecialchars('  UNIDAD'), array('name' => 'Arial', 'size' => 11), $parrafo); 

    $table1->addCell(1, array('vMerge' => 'restart'))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11),  $parrafoR);
     
     $table1->addCell(4900, array('vMerge' => 'restart', 
    'valign'=>'center','width'=>1))->addText(htmlspecialchars($compromiso_docente[0]->empresa_unidad), array('name' => 'Arial', 'size' => 11), $parrafo);

    //Frirma
    $seccion->addTextBreak(13, array('name' => 'Arial', 'size' => 11), $parrafo);
    $seccion->addText(htmlspecialchars('                       ___________________________           _________________________'), array('name' => 'Arial', 'size' => 11) , $parrafo);
    $seccion->addText(htmlspecialchars('                            Autorización Jefe Unidad                                    Firma'), array('name' => 'Arial', 'size' => 11, 'bold' => true), $parrafo);
    $seccion->addTextBreak(1, array('name' => 'Arial', 'size' => 11), $parrafo);

    /////////////////////////////////////si existe Otro PROFESOR////////////////////////////
    if($compromiso_docente[0]->oid_profesor2>0||$compromiso_docente[0]->oid_profesor2>'0')
    {

        $fontNormal=array('name' => 'Arial', 'size' => 11);
        $fontNorma9=array('name' => 'Arial', 'size' => 9);
        $fontNormal8=array('name' => 'Arial', 'size' => 8);
        $fontNormal16=array('name' => 'Arial', 'size' => 16);
        $paraNormal=array('align' => 'justify', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);
        $paraNormalCenter=array('align' => 'center', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);
        $paraNormalRight=array('align' => 'right', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);

        $fontFirma=array('name' => 'Arial', 'size' => 11, 'bold' => true );
        $paraFirma=array('align' => 'center', 'lineHeight' => 1, 'indent' => 6, 'spaceBefore' => 0, 'spaceAfter' => 0);

        $bold = array('bold' => true);
        $italic = array('italic' => true);
        $underline = array('underline' => 'single');
        $allCaps = array('allCaps' => true);
        $lIndent = array( 'indent' => 0.52);

        $tStyle = array('borderTopSize'=>null, 'borderBottomSize'=>null, 'borderLeftSize'=>null, 'borderRightSize'=>null,
                        'cellMarginTop'=>0, 'cellMarginBottom'=>0, 'cellMarginLeft'=>0, 'cellMarginRight'=>0, 'align' =>\PhpOffice\PhpWord\SimpleType\Jc::CENTER );

        
        $cabecera = $seccion->addHeader();
        $cabecera->firstPage();

        $cabecera->addTableStyle("estilo", $tStyle);
        $tabla = $cabecera->addTable("estilo");

        $tabla->addRow();
        $celda = $tabla->addCell(4800, array('align' => 'right'));

        $letra = array('name' => 'Arial', 'size' => 9, 'bold' => true, 'underline' => 'single');

        //Titulo de la cabecera

        $parrafo= array( 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);
        $textrun = $celda->addTextRun($parrafo);
        
        //estilos
        $letra_underline = array('name' => 'Arial', 'size' => 9, 'bold' => true, 'underline' => 'single');
        $fontNormal = array('name' => 'Arial', 'size' => 11);


        $textrun->addText(htmlspecialchars('DEPARTAMENTO RECURSOS HUMANOS'), array('name' => 'Arial', 'size' => 9, 'bold' => true,'alignment' => 'center', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0));

        $textrun->addText(htmlspecialchars('          '), $parrafo);
        $textrun->addText(htmlspecialchars('ESCUELA TÉCNICA AERONÁUTICA'), $letra_underline, array('align' => 'justify', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0));
        $textrun = $celda->addTextRun($parrafo);

        $textrun->addText(htmlspecialchars('          '), $parrafo);
        $textrun->addText(htmlspecialchars('Subdirección Administrativa'), $letra_underline, array('align' => 'justify', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0));
        $textrun = $celda->addTextRun($parrafo);
        $textrun->addText(htmlspecialchars('            '),  $parrafo);
        $textrun->addText(htmlspecialchars('Oficina Personal Docente'), $letra_underline, array('align' => 'justify', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0));
        $textrun = $celda->addTextRun($parrafo);
        $textrun->addText(htmlspecialchars('                            '), $parrafo);
        $textrun->addText(htmlspecialchars('AUT.42'), $letra, array('align' => 'justify', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0));
        $cabecera->addTextBreak(1, $fontNormal, $parrafo);
        //Fin de cabecera

        //Cuerpo del documento
        $letraNormal = array('name' => 'Arial', 'size' => 11);
        $paraNormal = array('align' => 'justify', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);
        $paraNormalLetra=array('name' => 'Arial', 'size' => 11, 'align' => 'justify', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);
        $fontNormal_16=array('name' => 'Arial', 'size' => 16, 'bold' => true, 'underline' => 'single', 'align' => 'center', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);

        $seccion->addText(htmlspecialchars('COMPROMISO DE DOCENCIA'), $fontNormal_16, array('align' => 'center', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0));

        $seccion->addTextBreak(1, $paraNormalLetra);

        $seccion->addText(htmlspecialchars('                    Por el presente documento me comprometo a asumir las responsabilidades docentes (planificación, realización de horas de clases, registro de actividades y evaluación de aprendizajes) implicadas en el desarrollo de las actividades que determina el Programa de Estudios de la Escuela Técnica Aeronáutica de la Dirección General de Aeronáutica Civil, en la asignatura que se indica a continuación, conforme a lo establecido en los artículos 87 y 88 inciso primero de la Ley 18.834 Estatuto Administrativo, que me permiten compatibilizar el actual cargo que poseo más 12 horas semanales/mensual en funciones docentes, con la obligación de prolongar la jornada, para compensar las horas que no pueda trabajar por causa del desempeño de la presente actividad docente:'), array('name' => 'Arial', 'size' => 11), array('align'=>'both'));

            $seccion->addTextBreak(1, $paraNormalLetra);
            
            $parrafoR =array('align' => 'right', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);
            
            $table1 = $seccion->addTable(); // creamos la tabla

            $table1->addRow(); 
            $table1->addCell(3000, array('vMerge' => 'restart', 'borderLeftColor' =>'999999','borderLeftSize' => 12, 'borderTopColor' =>'999999', 'borderTopSize' => 12,
        'valign'=>'center','width'=>1))->addText(htmlspecialchars('  CURSO'), array('name' => 'Arial', 'size' => 11, 'bold'=> true), $parrafo); 

            $table1->addCell(1, array('vMerge' => 'restart','borderTopColor' =>'999999', 'borderTopSize' => 12))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11, 'bold'=> true),  $parrafoR);
         
         $table1->addCell(4900, array('vMerge' => 'restart', 'borderRightColor' =>'999999','borderRightSize' => 12, 'borderTopColor' =>'999999', 'borderTopSize' => 12,
        'valign'=>'center','width'=>1))->addText(htmlspecialchars($compromiso_docente[0]->nombre_grupo), array('name' => 'Arial', 'size' => 11, 'bold'=> true), $parrafo);

        $table1->addRow(); 
        $table1->addCell(3000, array('vMerge' => 'restart', 'borderLeftColor' =>'999999','borderLeftSize' => 12,
        'valign'=>'center','width'=>1))->addText(htmlspecialchars('  ASIGNATURA'), array('name' => 'Arial', 'size' => 11), $parrafo); 

        $table1->addCell(1, array('vMerge' => 'restart'))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11, 'bold'=> true),  $parrafoR);
         
         $table1->addCell(4900, array('vMerge' => 'restart', 'borderRightColor' =>'999999','borderRightSize' => 12,
        'valign'=>'center','width'=>1))->addText(htmlspecialchars($compromiso_docente[0]->titulo), array('name' => 'Arial', 'size' => 11), $parrafo);


        $table1->addRow(); 
        $table1->addCell(3000, array('vMerge' => 'restart', 'borderLeftColor' =>'999999','borderLeftSize' => 12,
        'valign'=>'center','width'=>1))->addText(htmlspecialchars('  HORAS PROGRAMA'), array('name' => 'Arial', 'size' => 11), $parrafo); 

        $table1->addCell(1, array('vMerge' => 'restart'))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11, 'bold'=> true),  $parrafoR);
         
         $table1->addCell(4900, array('vMerge' => 'restart', 'borderRightColor' =>'999999','borderRightSize' => 12,
        'valign'=>'center','width'=>1))->addText(htmlspecialchars($compromiso_docente[0]->horas.' hrs.'), array('name' => 'Arial', 'size' => 11), $parrafo);

        $table1->addRow(); 
        $table1->addCell(3000, array('vMerge' => 'restart', 'borderLeftColor' =>'999999','borderLeftSize' => 12,
        'valign'=>'center','width'=>1))->addText(htmlspecialchars('  HORAS Semanales'), array('name' => 'Arial', 'size' => 11), $parrafo); 

        $table1->addCell(1, array('vMerge' => 'restart'))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11, 'bold'=> true),  $parrafoR);
         
         $table1->addCell(4900, array('vMerge' => 'restart', 'borderRightColor' =>'999999','borderRightSize' => 12,
        'valign'=>'center','width'=>1))->addText(htmlspecialchars(round($horas_semanales)), array('name' => 'Arial', 'size' => 11), $parrafo);

        $table1->addRow(); 
        $table1->addCell(3000, array('vMerge' => 'restart', 'borderLeftColor' =>'999999','borderLeftSize' => 12, 'borderBottomColor' =>'999999','borderBottomSize' => 12,
        'valign'=>'center','width'=>1))->addText(htmlspecialchars('  PERÍODO'), array('name' => 'Arial', 'size' => 11), $parrafo); 

        $table1->addCell(1, array('vMerge' => 'restart','borderBottomSize' => 12,
        'borderBottomColor' =>'999999'))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11),  $parrafoR);
         
         $table1->addCell(4900, array('vMerge' => 'restart', 'borderRightColor' =>'999999','borderRightSize' => 12, 'borderBottomSize' => 12,
        'borderBottomColor' =>'999999',
        'valign'=>'center','width'=>1))->addText(htmlspecialchars($compromiso_docente[0]->f_inicio.' al '.$compromiso_docente[0]->f_termino), array('name' => 'Arial', 'size' => 11), $parrafo);


         //Segunda parte de la tabla
        $seccion->addTextBreak(1);
        $table1 = $seccion->addTable(); // creamos la tabla
        
        //SEGEMENTO 2
        $table1->addRow(); 
        $table1->addCell(3000, array('vMerge' => 'restart', 
        'valign'=>'center','width'=>1))->addText(htmlspecialchars('  NOMBRE'), array('name' => 'Arial', 'size' => 11), $parrafo); 

            $table1->addCell(1, array('vMerge' => 'restart'))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11),  $parrafoR);
         
         $table1->addCell(4900, array('vMerge' => 'restart',
        'valign'=>'center','width'=>1))->addText(htmlspecialchars($compromiso_docente[0]->apellidos2.', '.$compromiso_docente[0]->nombres2), array('name' => 'Arial', 'size' => 11), $parrafo);

        $table1->addRow(); 
        $table1->addCell(3000, array('vMerge' => 'restart',
        'valign'=>'center','width'=>1))->addText(htmlspecialchars('  RUN Nº'), array('name' => 'Arial', 'size' => 11), $parrafo); 

        $table1->addCell(1, array('vMerge' => 'restart'))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11, 'bold'=> true),  $parrafoR);
         
         $table1->addCell(4900, array('vMerge' => 'restart',
        'valign'=>'center','width'=>1))->addText(htmlspecialchars($compromiso_docente[0]->rut2), array('name' => 'Arial', 'size' => 11), $parrafo);


        $table1->addRow(); 
        $table1->addCell(3000, array('vMerge' => 'restart', 
        'valign'=>'center','width'=>1))->addText(htmlspecialchars('  CATEGORÍA'), array('name' => 'Arial', 'size' => 11), $parrafo); 

        $table1->addCell(1, array('vMerge' => 'restart'))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11),  $parrafoR);
         
         $table1->addCell(4900, array('vMerge' => 'restart',
        'valign'=>'center','width'=>1))->addText(htmlspecialchars($compromiso_docente[0]->profesion2), array('name' => 'Arial', 'size' => 11), $parrafo);

        $table1->addRow(); 
        $table1->addCell(3000, array('vMerge' => 'restart',
        'valign'=>'center','width'=>1))->addText(htmlspecialchars('  ESPECIALIDAD'), array('name' => 'Arial', 'size' => 11), $parrafo); 

        $table1->addCell(1, array('vMerge' => 'restart'))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11, 'bold'=> true),  $parrafoR);
         
         $table1->addCell(4900, array('vMerge' => 'restart', 
        'valign'=>'center','width'=>1))->addText(htmlspecialchars(round($compromiso_docente[0]->especialidad2)), array('name' => 'Arial', 'size' => 11), $parrafo);

        $table1->addRow(); 
        $table1->addCell(3000, array('vMerge' => 'restart', 
        'valign'=>'center','width'=>1))->addText(htmlspecialchars('  UNIDAD'), array('name' => 'Arial', 'size' => 11), $parrafo); 

        $table1->addCell(1, array('vMerge' => 'restart'))->addText(htmlspecialchars(''),  array('name' => 'Arial', 'size' => 11),  $parrafoR);
         
         $table1->addCell(4900, array('vMerge' => 'restart', 
        'valign'=>'center','width'=>1))->addText(htmlspecialchars($compromiso_docente[0]->empresa_unidad2), array('name' => 'Arial', 'size' => 11), $parrafo);

        //Frirma
        $seccion->addTextBreak(13, array('name' => 'Arial', 'size' => 11), $parrafo);
        $seccion->addText(htmlspecialchars('                       ___________________________           _________________________'), array('name' => 'Arial', 'size' => 11) , $parrafo);
        $seccion->addText(htmlspecialchars('                            Autorización Jefe Unidad                                    Firma'), array('name' => 'Arial', 'size' => 11, 'bold' => true), $parrafo);
        $seccion->addTextBreak(1, array('name' => 'Arial', 'size' => 11), $parrafo);
    
    }//Fin segundo profesor

    $seccion->addTextBreak(1, array('name' => 'Arial', 'size' => 11), $parrafo);
    $seccion->addText(htmlspecialchars('Santiago,'.$date2), array('name' => 'Arial', 'size' => 11), $parrafo);




    $filename = "Compromiso_Docente1.docx"; // Nombre del archivo que se va a crear
    $ruta_destino = $document_root."/$carpeta_proyecto/assets/uploads/".$filename;
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($documento, 'Word2007');
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
?>

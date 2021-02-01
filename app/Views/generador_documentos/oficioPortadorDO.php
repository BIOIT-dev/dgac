<?php 
//~ echo "<pre>";
//~ print_r($datos);
//~ echo "<br>";
//~ echo "<pre>";
//~ print_r($informe_asuncion);

//~ json_decode(json_encode($compromiso_docente[0]), false);

//~ require_once( APPPATH.'ThirdParty/PhpWord7/Autoloader.php');

//~ use PhpOffice\PhpWord\Autoloader;
//~ Autoloader::register();

require_once $document_root."/$carpeta_proyecto/vendor/autoload.php";

ini_set('memory_limit', '-1');

// Armado de datos
$date2= strftime(" %d de %B del %Y");
$firmante=$datos['firmante'];

// Nueva instancia del generador de documento
$word = new \PhpOffice\PhpWord\PhpWord();
// estilos
$fontNormal=array('name' => 'Arial', 'size' => 11);
$fontNormal10=array('name' => 'Arial', 'size' => 10);
$fontNormal9=array('name' => 'Arial', 'size' => 9);
$fontNormal8=array('name' => 'Arial', 'size' => 8);
$fontNormal16=array('name' => 'Arial', 'size' => 16);
$fontNormal5=array('name' => 'Arial', 'size' => 5);
$paraNormal=array('align' => 'justify', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);
$paraNormalCenter=array('align' => 'center', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);
$paraNormalRight=array('align' => 'right', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);
$paraNormalLeft=array('align' => 'left', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);

$fontFirma=array('name' => 'Arial', 'size' => 11, 'bold' => true );
$paraFirma=array('align' => 'center', 'lineHeight' => 1, 'indent' => 6, 'spaceBefore' => 0, 'spaceAfter' => 0);

$bold = array('bold' => true);
$italic = array('italic' => true);
$arialU = array('Arial Narrow' => true);
$underline = array('underline' => 'single');
$allCaps = array('allCaps' => true);
$lIndent = array( 'indent' => 0.52);

$tStyle = array('borderTopSize'=>null, 'borderBottomSize'=>null, 'borderLeftSize'=>null, 'borderRightSize'=>null,
                'cellMarginTop'=>0, 'cellMarginBottom'=>0, 'cellMarginLeft'=>0, 'cellMarginRight'=>0 );


    $section = $word->addSection(array('paperSize' => 'Letter', 'orientation' => 'portrait',
    'marginLeft' => 1411, 'marginRight' => 1411, 'marginTop' => 850, 'marginBottom' => 1411));
    
    //ENCABEAZADO
    $table = $section->addTable('encabezado');
    //SEGEMENTO 1
    $row = $table->addRow();
    $row->addCell(5000, array('vMerge' => 'restart'))->addText(htmlspecialchars('DEPARTAMENTO RECURSOS HUMANOS'), $fontNormal10 + $bold+$underline+$arialU, $paraNormalCenter);
    $row->addCell(1000, array('vMerge' => 'restart'))->addText(htmlspecialchars(''), $fontNormal10 + $bold+$underline+$arialU, $paraNormal);
    $row->addCell(4000, array('vMerge' => 'restart'))->addText(htmlspecialchars('ETA OF. (O) Nº 12 / 2 / 02 /                      /'), $fontNormal10+$underline+$arialU, $paraNormalLeft);
    
    $row = $table->addRow();
    $row->addCell(5000, array('vMerge' => 'restart'))->addText(htmlspecialchars('ESCUELA TÉCNICA AERONÁUTICA'), $fontNormal10 +$underline+$arialU, $paraNormalCenter);
    $row->addCell(1000, array('vMerge' => 'restart'))->addText(htmlspecialchars(''), $fontNormal10 + $bold+$underline+$arialU, $paraNormal);
    $row->addCell(4000, array('vMerge' => 'restart'))->addText(htmlspecialchars(''), $fontNormal10+$arialU, $paraNormal);
    
    $row = $table->addRow();
    $row->addCell(5000, array('vMerge' => 'restart'))->addText(htmlspecialchars('SUBDIRECCIÓN ADMINISTRATIVA'), $fontNormal10 +$underline+$arialU, $paraNormalCenter);
    $row->addCell(1000, array('vMerge' => 'restart'))->addText(htmlspecialchars('OBJ. :'), $fontNormal10 +$underline+$bold+$arialU, $paraNormalRight);
    $row->addCell(4000, array('vMerge' => 'restart'))->addText(htmlspecialchars(' Remite documentos para devolución de horas.'), $fontNormal10+$arialU, $paraNormal);
    
    $row = $table->addRow();
    $row->addCell(10000, array('vMerge' => 'continue'));
    $row->addCell(10000, array('vMerge' => 'continue'));
    $row->addCell(10000, array('vMerge' => 'continue'));

    $row = $table->addRow();
    $row->addCell(5000, array('vMerge' => 'continue'));
    $row->addCell(1000, array('vMerge' => 'restart'))->addText(htmlspecialchars('REF. :'), $fontNormal10 +$underline+$arialU, $paraNormalRight);
    $row->addCell(4000, array('vMerge' => 'restart','borderBottomColor' =>'999999','borderBottomSize' => 12,))->addText(htmlspecialchars('Artículos 87 y 88 inciso primero de la Ley Nº 18.834, sobre Estatuto Administrativo'), $fontNormal10 +$arialU, $paraNormal);
   
    $row = $table->addRow();
    $row->addCell(10000, array('vMerge' => 'continue'));
    $row->addCell(10000, array('vMerge' => 'continue'));
    $row->addCell(10000, array('vMerge' => 'continue'));

    // Fecha
    $row = $table->addRow();
    $row->addCell(5000, array('vMerge' => 'continue'));    
    $row->addCell(5000, array('vMerge' => 'continue'));
    $row->addCell(4000, array('vMerge' => 'restart'))->addText(htmlspecialchars('Santiago,'.$date2), $fontNormal10 +$arialU, $paraNormal);
   
    $row = $table->addRow();
    $row->addCell(10000, array('vMerge' => 'continue'));
    $row->addCell(10000, array('vMerge' => 'continue'));
    $row->addCell(10000, array('vMerge' => 'continue'));


    $table2 = $section->addTable('cuerpo');

    $row = $table2->addRow();
    $row->addCell(1000, array('vMerge' => 'restart'))->addText(htmlspecialchars('DE'), $fontNormal10 +$bold+$arialU, $paraNormalRight);
    $row->addCell(500, array('vMerge' => 'restart'))->addText(htmlspecialchars(':'), $fontNormal10 +$bold+$arialU, $paraNormalRight);
    $row->addCell(8000, array('vMerge' => 'restart'))->addText(htmlspecialchars('  ESCUELA TÉCNICA AERONÁUTICA'), $fontNormal10 +$bold+$arialU, $paraNormal);
    $row = $table2->addRow();
    $row->addCell(1000, array('vMerge' => 'restart'))->addText(htmlspecialchars('PARA'), $fontNormal10 +$bold+$arialU, $paraNormalRight);
    $row->addCell(500, array('vMerge' => 'restart'))->addText(htmlspecialchars(':'), $fontNormal10 +$bold+$arialU, $paraNormalRight);
    $row->addCell(8000, array('vMerge' => 'restart'))->addText(htmlspecialchars('  '.$oficio_portador[0]->unidad), $fontNormal10 +$bold+$arialU, $paraNormal);

    $section->addTextBreak(1, $fontNormal, $paraNormal);
    $section->addText(htmlspecialchars('            Sírvase encontrar adjunto al presente oficio los documentos signados como Compromisos de  Docencia,  Formularios Devolución de Horas  y copia de Resoluciones de Contratos,  con el propósito que esa Oficina de Personal dicte las resoluciones que establezcan las respectivas devoluciones de horas, prolongando las jornadas de trabajo de los funcionarios de esta escuela que se mencionan, si fuere el caso, para compensar las horas que no puedan trabajar por causa de dicho desempeño, de acuerdo a lo establecido en los artículos de la referencia :'), $fontNormal , $paraNormal);
    $section->addTextBreak(1, $fontNormal, $paraNormal);
    
    $table3 = $section->addTable('ESTRUCTURA');
    $row = $table3->addRow();
    $row->addCell(2500, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000','bgColor'=>'F1F1F1'))->addText(htmlspecialchars('Autorización ETA'), $fontNormal10 +$bold, $paraNormalCenter);
    $row->addCell(2500, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000','bgColor'=>'F1F1F1'))->addText(htmlspecialchars('Resolución CGR'), $fontNormal10 +$bold, $paraNormalCenter);
    $row->addCell(5000, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000','bgColor'=>'F1F1F1'))->addText(htmlspecialchars('Curso'), $fontNormal10 +$bold, $paraNormalCenter);
    
    $row = $table3->addRow();
    $row->addCell(2500, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000'))->addText(htmlspecialchars('16'), $fontNormal10 +$arialU, $paraNormalCenter);
    $row->addCell(2500, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000'))->addText(htmlspecialchars('1368737'), $fontNormal10 +$arialU, $paraNormalCenter);
    $row->addCell(5000, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000'))->addText(htmlspecialchars($oficio_portador[0]->nombre_grupo), $fontNormal10 +$arialU, $paraNormalCenter);
    //datos BD
    $table4 = $section->addTable('BD');
    $row = $table4->addRow();
    $row->addCell(1500, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000','bgColor'=>'F1F1F1'))->addText(htmlspecialchars('A. Paterno'), $fontNormal10 +$bold+$arialU, $paraNormalCenter);
    $row->addCell(1500, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000','bgColor'=>'F1F1F1'))->addText(htmlspecialchars('A. Materno'), $fontNormal10 +$bold+$arialU, $paraNormalCenter);
    $row->addCell(2000, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000','bgColor'=>'F1F1F1'))->addText(htmlspecialchars('Nombres'), $fontNormal10 +$bold+$arialU, $paraNormalCenter);
    $row->addCell(2000, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000','bgColor'=>'F1F1F1'))->addText(htmlspecialchars('Asignatura'), $fontNormal10 +$bold+$arialU, $paraNormalCenter);
    $row->addCell(1000, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000','bgColor'=>'F1F1F1'))->addText(htmlspecialchars('Horas'), $fontNormal10 +$bold+$arialU, $paraNormalCenter);
    $row->addCell(1000, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000','bgColor'=>'F1F1F1'))->addText(htmlspecialchars('Desde'), $fontNormal10 +$bold+$arialU, $paraNormalCenter);
    $row->addCell(1000, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000','bgColor'=>'F1F1F1'))->addText(htmlspecialchars('Hasta'), $fontNormal10 +$bold+$arialU, $paraNormalCenter);
    
    foreach ($compromiso_docentes as $compromiso) {

        $row = $table4->addRow();
        $row->addCell(1500, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000'))->addText(htmlspecialchars($compromiso->a_paterno), $fontNormal10 +$arialU, $paraNormalCenter);
        $row->addCell(1500, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000'))->addText(htmlspecialchars($compromiso->a_materno), $fontNormal10 +$arialU, $paraNormalCenter);
        $row->addCell(2000, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000'))->addText(htmlspecialchars($compromiso->nombres), $fontNormal10 +$arialU, $paraNormalCenter);
        $row->addCell(2000, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000'))->addText(htmlspecialchars($compromiso->asignatura), $fontNormal10 +$arialU, $paraNormalCenter);
        $row->addCell(1000, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000'))->addText(htmlspecialchars($compromiso->horas), $fontNormal10 +$arialU, $paraNormalCenter);
        $row->addCell(1000, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000'))->addText(htmlspecialchars($compromiso->f_desde), $fontNormal10 +$arialU, $paraNormalCenter);
        $row->addCell(1000, array('vMerge' => 'restart','borderSize' => 1, 'borderColor' =>'000000'))->addText(htmlspecialchars($compromiso->f_hasta), $fontNormal10 +$arialU, $paraNormalCenter);

    }
    

    $section->addTextBreak(1, $fontNormal, $paraNormal);
    $section->addText(htmlspecialchars('                Consecuente con lo expuesto, solicito coordinar con los interesados el horario en que realizarán  las devoluciones.'), $fontNormal , $paraNormal);
    $section->addTextBreak(1, $fontNormal, $paraNormal);
    $section->addText(htmlspecialchars('                Saluda a Ud.,'), $fontNormal , $paraNormal);
    $section->addTextBreak(4, $fontNormal, $paraNormal);
    $section->addText(htmlspecialchars($firmante), $fontNormal10 +$bold, $paraNormalRight);
    $section->addText(htmlspecialchars('DIRECTOR (E)'), $fontNormal10 +$bold, $paraNormalRight);   


    $section->addTextBreak(2, $fontNormal, $paraNormal);
    $section->addText(htmlspecialchars('DISTRIBUCIÓN:'), $fontNormal9 +$bold+$underline, $paraNormal);    
    $section->addText(htmlspecialchars('1.-   E.T.A.  -  OFICINA DE   PERSONAL'), $fontNormal9 +$bold, $paraNormal);    
    $section->addText(htmlspecialchars('2.-   E.T.A.  -   Oficina de Partes. (A)'), $fontNormal9 , $paraNormal);    
    $section->addText(htmlspecialchars('3.-   E.T.A.  -   Sd. Administrativa - Oficina de Personal Docente (A)'), $fontNormal9 , $paraNormal);    
    $section->addText(htmlspecialchars('OF. ETA-OFICINA DE PERSONAL – AHUMADA LOYOLA, MANUEL Y OTROS –AUT. 16 CURSO FORMACION DE INSTRUCTORES ETA.  RCU/FCO/gpz.'.$date2), $fontNormal5 , $paraNormal);   


    // Guardarlo para usarlo más tarde
   
    $filename = "Oficio_Portador.docx"; // Nombre del archivo que se va a crear
    $ruta_destino = $document_root."/$carpeta_proyecto/assets/uploads/".$filename;
    // $ruta_destino = $document_root."/$carpeta_proyecto/assets/uploads/".$filename;
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($word, 'Word2007');
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

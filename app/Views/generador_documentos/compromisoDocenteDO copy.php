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

$word = new \PhpOffice\PhpWord\PhpWord();
$word->getCompatibility()->setOoxmlVersion(14);
$word->getCompatibility()->setOoxmlVersion(15);
// estilos
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
                'cellMarginTop'=>0, 'cellMarginBottom'=>0, 'cellMarginLeft'=>0, 'cellMarginRight'=>0 );


    $section = $word->addSection(array('paperSize' => 'Letter', 'orientation' => 'portrait',
    'marginLeft' => 1411, 'marginRight' => 1411, 'marginTop' => 850, 'marginBottom' => 1411));
    
    $header = $section->addHeader();
    $header->firstPage();
    $table = $header->addTable($tStyle);
    $table->addRow();
    $cell = $table->addCell(4800);
    $cell->addText(htmlspecialchars('DEPARTAMENTO RECURSOS HUMANOS'), $fontNorma9 + $bold, $paraNormal);
    $textrun = $cell->addTextRun($paraNormal);
    $textrun->addText(htmlspecialchars('     '), $fontNorma9 + $bold);
    $textrun->addText(htmlspecialchars('ESCUELA TÉCNICA AERONÁUTICA'), $fontNorma9 + $bold + $underline);
    $textrun = $cell->addTextRun($paraNormal);
    $textrun->addText(htmlspecialchars('          '), $fontNorma9 + $bold);
    $textrun->addText(htmlspecialchars('Subdirección Administrativa'), $fontNorma9 + $bold + $underline);
    $textrun = $cell->addTextRun($paraNormal);
    $textrun->addText(htmlspecialchars('            '), $fontNorma9 + $bold);
    $textrun->addText(htmlspecialchars('Oficina Personal Docente'), $fontNorma9 + $bold + $underline);
    $textrun = $cell->addTextRun($paraNormal);
    $textrun->addText(htmlspecialchars('                            '), $fontNorma9 + $bold);
    $textrun->addText(htmlspecialchars('AUT.42'), $fontNorma9 + $bold + $underline);
    $header->addTextBreak(1, $fontNormal, $paraNormal);
// titulo
  
    $section->addText(htmlspecialchars('COMPROMISO DE DOCENCIA'), $fontNormal16 + $bold + $underline, $paraNormalCenter);
   
    $section->addTextBreak(1, $fontNormal, $paraNormal);
    $section->addText(htmlspecialchars('                    Por el presente documento me comprometo a asumir las responsabilidades docentes (planificación, realización de horas de clases, registro de actividades y evaluación de aprendizajes) implicadas en el desarrollo de las actividades que determina el Programa de Estudios de la Escuela Técnica Aeronáutica de la Dirección General de Aeronáutica Civil, en la asignatura que se indica a continuación, conforme a lo establecido en los artículos 87 y 88 inciso primero de la Ley 18.834 Estatuto Administrativo, que me permiten compatibilizar el actual cargo que poseo más 12 horas semanales/mensual en funciones docentes, con la obligación de prolongar la jornada, para compensar las horas que no pueda trabajar por causa del desempeño de la presente actividad docente:'), $fontNormal , $paraNormal);
    $section->addTextBreak(1, $fontNormal, $paraNormal);
    
    // $section->addPageBreak();   
    //  $styleTable = array('borderSize' => 6, 'border(Top|Right|Bottom|Left)Color' => '999999');
    // $word->addTableStyle('Colspan Rowspan', $styleTable);
    $table = $section->addTable('datos');
    //SEGEMENTO 1
    $row = $table->addRow();
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart','borderTopColor' =>'999999', 'borderTopSize' => 12, 'borderLeftColor' =>'999999','borderLeftSize' => 12,
    'valign'=>'center'))->addText(htmlspecialchars('  CURSO'), $fontNormal + $bold, $paraNormal);
    $row->addCell(1, array('vMerge' => 'restart','borderTopColor' =>'999999', 'borderTopSize' => 12))->addText(htmlspecialchars(':'), $fontNormal + $bold, $paraNormalRight );
    $row->addCell(4900, array('vMerge' => 'restart','borderTopColor' =>'999999',  'borderTopSize' => 12,'borderRightColor' =>'999999','borderRightSize' => 12,))->addText(htmlspecialchars($compromiso_docente[0]->nombre_grupo), $fontNormal + $bold );

    $row = $table->addRow();
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart', 'borderLeftColor' =>'999999','borderLeftSize' => 12,
    'valign'=>'center','width'=>1))->addText(htmlspecialchars('  ASIGNATURA'), $fontNormal , $paraNormal);
    $row->addCell(100, array('vMerge' => 'restart'))->addText(htmlspecialchars(':'), $fontNormal , $paraNormalRight  );
    $row->addCell(4900, array('vMerge' => 'restart','borderRightColor' =>'999999',
    'borderRightSize' => 12,))->addText(htmlspecialchars($compromiso_docente[0]->titulo), $fontNormal );


    $row = $table->addRow();
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart', 'borderLeftColor' =>'999999','borderLeftSize' => 12,
    'valign'=>'center'))->addText(htmlspecialchars('  HORAS PROGRAMA'), $fontNormal , $paraNormal);
    $row->addCell(100, array('vMerge' => 'restart'))->addText(htmlspecialchars(':'), $fontNormal , $paraNormalRight  );
    $row->addCell(4900, array('vMerge' => 'restart','borderRightColor' =>'999999',
    'borderRightSize' => 12,))->addText(htmlspecialchars($compromiso_docente[0]->horas.' hrs.'), $fontNormal );

    
    $row = $table->addRow();
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart', 'borderLeftColor' =>'999999','borderLeftSize' => 12,
    'valign'=>'center'))->addText(htmlspecialchars('  HORAS Semanales'), $fontNormal , $paraNormal);
    $row->addCell(100, array('vMerge' => 'restart'))->addText(htmlspecialchars(':'), $fontNormal , $paraNormalRight  );
    $row->addCell(4900, array('vMerge' => 'restart','borderRightColor' =>'999999',
    'borderRightSize' => 12,))->addText(htmlspecialchars(round($horas_semanales)), $fontNormal );

    $row = $table->addRow();
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart', 'borderLeftColor' =>'999999','borderLeftSize' => 12,'borderBottomColor' =>'999999','borderBottomSize' => 12,
    'valign'=>'center'))->addText(htmlspecialchars('  PERÍODO'), $fontNormal , $paraNormal);
    $row->addCell(100, array('vMerge' => 'restart','borderBottomColor' =>'999999','borderBottomSize' => 12,))->addText(htmlspecialchars(':'), $fontNormal, $paraNormalRight   );
    $row->addCell(4900, array('vMerge' => 'restart','borderRightColor' =>'999999','borderBottomColor' =>'999999','borderBottomSize' => 12,
    'borderRightSize' => 12,))->addText(htmlspecialchars($compromiso_docente[0]->f_inicio.' al '.$compromiso_docente[0]->f_termino), $fontNormal );

    $row = $table->addRow();
    $row->addCell(100000, array('vMerge' => 'continue'));
    //SEGEMENTO 2
    $row = $table->addRow();
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart'))->addText(htmlspecialchars('  NOMBRE'), $fontNormal , $paraNormal);
    $row->addCell(100, array('vMerge' => 'restart'))->addText(htmlspecialchars(':'), $fontNormal, $paraNormalRight);
    $row->addCell(4900, array('vMerge' => 'restart'))->addText(htmlspecialchars($compromiso_docente[0]->apellidos.', '.$compromiso_docente[0]->nombres), $fontNormal);

    $row = $table->addRow();
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart'))->addText(htmlspecialchars('  RUN Nº'), $fontNormal , $paraNormal);
    $row->addCell(100, array('vMerge' => 'restart'))->addText(htmlspecialchars(':'), $fontNormal , $paraNormalRight  );
    $row->addCell(4900, array('vMerge' => 'restart'))->addText(htmlspecialchars($compromiso_docente[0]->rut), $fontNormal );


    $row = $table->addRow();
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart'))->addText(htmlspecialchars('  CATEGORÍA'), $fontNormal , $paraNormal);
    $row->addCell(1000, array('vMerge' => 'restart'))->addText(htmlspecialchars(':'), $fontNormal, $paraNormalRight   );
    $row->addCell(4000, array('vMerge' => 'restart'))->addText(htmlspecialchars($compromiso_docente[0]->profesion), $fontNormal );

    
    $row = $table->addRow();
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart'))->addText(htmlspecialchars('  ESPECIALIDAD'), $fontNormal , $paraNormal);
    $row->addCell(1000, array('vMerge' => 'restart'))->addText(htmlspecialchars(':'), $fontNormal  , $paraNormalRight );
    $row->addCell(4000, array('vMerge' => 'restart'))->addText(htmlspecialchars($compromiso_docente[0]->especialidad), $fontNormal );

    $row = $table->addRow();
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart'))->addText(htmlspecialchars('  UNIDAD'), $fontNormal , $paraNormal);
    $row->addCell(1000, array('vMerge' => 'restart'))->addText(htmlspecialchars(':'), $fontNormal , $paraNormalRight  );
    $row->addCell(4000, array('vMerge' => 'restart'))->addText(htmlspecialchars($compromiso_docente[0]->empresa_unidad), $fontNormal );

    $section->addTextBreak(8, $fontNormal, $paraNormal);
    $section->addText(htmlspecialchars('                            ___________________________           _________________________'), $fontNormal , $paraNormal);
    $section->addText(htmlspecialchars('                                 Autorización Jefe Unidad                                    Firma'), $fontNormal+$bold , $paraNormal);
    $section->addTextBreak(2, $fontNormal, $paraNormal);

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
                'cellMarginTop'=>0, 'cellMarginBottom'=>0, 'cellMarginLeft'=>0, 'cellMarginRight'=>0 );


    $section = $word->addSection(array('paperSize' => 'Letter', 'orientation' => 'portrait',
    'marginLeft' => 1411, 'marginRight' => 1411, 'marginTop' => 850, 'marginBottom' => 1411));
    
    $header = $section->addHeader();
    $header->firstPage();
    $table = $header->addTable($tStyle);
    $table->addRow();
    $cell = $table->addCell(4800);
    $cell->addText(htmlspecialchars('DEPARTAMENTO RECURSOS HUMANOS'), $fontNorma9 + $bold, $paraNormal);
    $textrun = $cell->addTextRun($paraNormal);
    $textrun->addText(htmlspecialchars('     '), $fontNorma9 + $bold);
    $textrun->addText(htmlspecialchars('ESCUELA TÉCNICA AERONÁUTICA'), $fontNorma9 + $bold + $underline);
    $textrun = $cell->addTextRun($paraNormal);
    $textrun->addText(htmlspecialchars('          '), $fontNorma9 + $bold);
    $textrun->addText(htmlspecialchars('Subdirección Administrativa'), $fontNorma9 + $bold + $underline);
    $textrun = $cell->addTextRun($paraNormal);
    $textrun->addText(htmlspecialchars('            '), $fontNorma9 + $bold);
    $textrun->addText(htmlspecialchars('Oficina Personal Docente'), $fontNorma9 + $bold + $underline);
    $textrun = $cell->addTextRun($paraNormal);
    $textrun->addText(htmlspecialchars('                            '), $fontNorma9 + $bold);
    $textrun->addText(htmlspecialchars('AUT.42'), $fontNorma9 + $bold + $underline);
    $header->addTextBreak(1, $fontNormal, $paraNormal);
// titulo
  
    $section->addText(htmlspecialchars('COMPROMISO DE DOCENCIA'), $fontNormal16 + $bold + $underline, $paraNormalCenter);
   
    $section->addTextBreak(1, $fontNormal, $paraNormal);
    $section->addText(htmlspecialchars('                    Por el presente documento me comprometo a asumir las responsabilidades docentes (planificación, realización de horas de clases, registro de actividades y evaluación de aprendizajes) implicadas en el desarrollo de las actividades que determina el Programa de Estudios de la Escuela Técnica Aeronáutica de la Dirección General de Aeronáutica Civil, en la asignatura que se indica a continuación, conforme a lo establecido en los artículos 87 y 88 inciso primero de la Ley 18.834 Estatuto Administrativo, que me permiten compatibilizar el actual cargo que poseo más 12 horas semanales/mensual en funciones docentes, con la obligación de prolongar la jornada, para compensar las horas que no pueda trabajar por causa del desempeño de la presente actividad docente:'), $fontNormal , $paraNormal);
    $section->addTextBreak(1, $fontNormal, $paraNormal);
    
    // $section->addPageBreak();   
    //  $styleTable = array('borderSize' => 6, 'border(Top|Right|Bottom|Left)Color' => '999999');
    // $word->addTableStyle('Colspan Rowspan', $styleTable);
    $table = $section->addTable('datos');
    //SEGEMENTO 1
    $row = $table->addRow();
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart','borderTopColor' =>'999999', 'borderTopSize' => 12, 'borderLeftColor' =>'999999','borderLeftSize' => 12,
    'valign'=>'center'))->addText(htmlspecialchars('  CURSO'), $fontNormal + $bold, $paraNormal);
    $row->addCell(1, array('vMerge' => 'restart','borderTopColor' =>'999999', 'borderTopSize' => 12))->addText(htmlspecialchars(':'), $fontNormal + $bold, $paraNormalRight );
    $row->addCell(4900, array('vMerge' => 'restart','borderTopColor' =>'999999',  'borderTopSize' => 12,'borderRightColor' =>'999999','borderRightSize' => 12,))->addText(htmlspecialchars($compromiso_docente[0]->nombre_grupo), $fontNormal + $bold );

    $row = $table->addRow(array('exactHeight'=>5));
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart', 'borderLeftColor' =>'999999','borderLeftSize' => 12,
    'valign'=>'center','width'=>1))->addText(htmlspecialchars('  ASIGNATURA'), $fontNormal , $paraNormal);
    $row->addCell(100, array('vMerge' => 'restart'))->addText(htmlspecialchars(':'), $fontNormal , $paraNormalRight  );
    $row->addCell(4900, array('vMerge' => 'restart','borderRightColor' =>'999999',
    'borderRightSize' => 12,))->addText(htmlspecialchars($compromiso_docente[0]->titulo), $fontNormal );


    $row = $table->addRow();
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart', 'borderLeftColor' =>'999999','borderLeftSize' => 12,
    'valign'=>'center'))->addText(htmlspecialchars('  HORAS PROGRAMA'), $fontNormal , $paraNormal);
    $row->addCell(100, array('vMerge' => 'restart'))->addText(htmlspecialchars(':'), $fontNormal , $paraNormalRight  );
    $row->addCell(4900, array('vMerge' => 'restart','borderRightColor' =>'999999',
    'borderRightSize' => 12,))->addText(htmlspecialchars($compromiso_docente[0]->horas.' hrs.'), $fontNormal );

    
    $row = $table->addRow();
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart', 'borderLeftColor' =>'999999','borderLeftSize' => 12,
    'valign'=>'center'))->addText(htmlspecialchars('  HORAS Semanales'), $fontNormal , $paraNormal);
    $row->addCell(100, array('vMerge' => 'restart'))->addText(htmlspecialchars(':'), $fontNormal , $paraNormalRight  );
    $row->addCell(4900, array('vMerge' => 'restart','borderRightColor' =>'999999',
    'borderRightSize' => 12,))->addText(htmlspecialchars($horas_semanales), $fontNormal );

    $row = $table->addRow();
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart', 'borderLeftColor' =>'999999','borderLeftSize' => 12,'borderBottomColor' =>'999999','borderBottomSize' => 12,
    'valign'=>'center'))->addText(htmlspecialchars('  PERÍODO'), $fontNormal , $paraNormal);
    $row->addCell(100, array('vMerge' => 'restart','borderBottomColor' =>'999999','borderBottomSize' => 12,))->addText(htmlspecialchars(':'), $fontNormal, $paraNormalRight   );
    $row->addCell(4900, array('vMerge' => 'restart','borderRightColor' =>'999999','borderBottomColor' =>'999999','borderBottomSize' => 12,
    'borderRightSize' => 12,))->addText(htmlspecialchars($compromiso_docente[0]->f_inicio.' al '.$compromiso_docente[0]->f_termino), $fontNormal );

    $row = $table->addRow();
    $row->addCell(100000, array('vMerge' => 'continue'));
    //SEGEMENTO 2
    $row = $table->addRow();
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart'))->addText(htmlspecialchars('  NOMBRE'), $fontNormal , $paraNormal);
    $row->addCell(100, array('vMerge' => 'restart'))->addText(htmlspecialchars(':'), $fontNormal, $paraNormalRight);
    $row->addCell(4900, array('vMerge' => 'restart'))->addText(htmlspecialchars($compromiso_docente[0]->apellidos2.', '.$compromiso_docente[0]->nombres2), $fontNormal);

    $row = $table->addRow();
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart'))->addText(htmlspecialchars('  RUN Nº'), $fontNormal , $paraNormal);
    $row->addCell(100, array('vMerge' => 'restart'))->addText(htmlspecialchars(':'), $fontNormal , $paraNormalRight  );
    $row->addCell(4900, array('vMerge' => 'restart'))->addText(htmlspecialchars($compromiso_docente[0]->rut2), $fontNormal );


    $row = $table->addRow();
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart'))->addText(htmlspecialchars('  CATEGORÍA'), $fontNormal , $paraNormal);
    $row->addCell(1000, array('vMerge' => 'restart'))->addText(htmlspecialchars(':'), $fontNormal, $paraNormalRight   );
    $row->addCell(4000, array('vMerge' => 'restart'))->addText(htmlspecialchars($compromiso_docente[0]->profesion2), $fontNormal );

    
    $row = $table->addRow();
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart'))->addText(htmlspecialchars('  ESPECIALIDAD'), $fontNormal , $paraNormal);
    $row->addCell(1000, array('vMerge' => 'restart'))->addText(htmlspecialchars(':'), $fontNormal  , $paraNormalRight );
    $row->addCell(4000, array('vMerge' => 'restart'))->addText(htmlspecialchars($compromiso_docente[0]->especialidad2), $fontNormal );

    $row = $table->addRow();
    $row->addCell(2000, array('vMerge' => 'continue'));
    $row->addCell(3000, array('vMerge' => 'restart'))->addText(htmlspecialchars('  UNIDAD'), $fontNormal , $paraNormal);
    $row->addCell(1000, array('vMerge' => 'restart'))->addText(htmlspecialchars(':'), $fontNormal , $paraNormalRight  );
    $row->addCell(4000, array('vMerge' => 'restart'))->addText(htmlspecialchars($compromiso_docente[0]->unidad2), $fontNormal );

    $section->addTextBreak(8, $fontNormal, $paraNormal);
    $section->addText(htmlspecialchars('                            ___________________________           _________________________'), $fontNormal , $paraNormal);
    $section->addText(htmlspecialchars('                                 Autorización Jefe Unidad                                    Firma'), $fontNormal+$bold , $paraNormal);
    $section->addTextBreak(2, $fontNormal, $paraNormal);


}
    // Fecha
    $section->addText(htmlspecialchars('Santiago,'.$date2), $fontNormal  , $paraNormal);
    // Guardarlo para usarlo más tarde
   
    $filename = "Compromiso_Docente1.docx"; // Nombre del archivo que se va a crear
    $ruta_destino = $document_root."/$carpeta_proyecto/assets/uploads/".$filename;
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

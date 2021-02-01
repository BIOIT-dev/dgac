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
$fecha_inicio=$informe_asuncion[0]->f_inicio;
$fecha_termino=$informe_asuncion[0]->f_termino;
$fecha_ini= date("d/m/Y", strtotime($fecha_inicio));
$fecha_term= date("d/m/Y", strtotime($fecha_termino));

// Nueva instancia del generador de documento
$word = new \PhpOffice\PhpWord\PhpWord();

// estilos


$fontNormal16=array('name' => 'Arial', 'size' => 16);
$paraNormal=array('align' => 'justify', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);

$fontFirma=array('name' => 'Arial', 'size' => 11, 'bold' => true );
$paraFirma=array('align' => 'center', 'lineHeight' => 1, 'indent' => 6, 'spaceBefore' => 0, 'spaceAfter' => 0);

$bold = array('bold' => true);
$italic = array('italic' => true);
$underline = array('underline' => 'single');
$allCaps = array('allCaps' => true);
$lIndent = array( 'indent' => 0.52);

$tStyle = array('borderTopSize'=>null, 'borderBottomSize'=>null, 'borderLeftSize'=>null, 'borderRightSize'=>null,
                'cellMarginTop'=>0, 'cellMarginBottom'=>0, 'cellMarginLeft'=>0, 'cellMarginRight'=>0 );
    
    // Produce error por incompatibilidad con php7 (pendiente)            
    $section = $word->addSection(array('paperSize' => 'Letter', 'orientation' => 'portrait',
        'marginLeft' => 1411, 'marginRight' => 1411, 'marginTop' => 850, 'marginBottom' => 1411));

    
    $header = $section->addHeader();
    $header->firstPage();
    $table = $header->addTable($tStyle);

    $table->addRow();
    $cell = $table->addCell(4800);


    $fontNorma9=array('name' => 'Arial', 'size' => 9);
    $fontNorma9B=array('name' => 'Arial', 'size' => 9);
    $fontNorma9B_under=array('name' => 'Arial', 'size' => 9, 'bold' => true, 'underline' => 'single');
    $parrafo= array( 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);
    $paraNormalRight=array('align' => 'right', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);
    $paraNormalCenter=array('align' => 'center', 'lineHeight' => 1, 'spaceBefore' => 0, 'spaceAfter' => 0);
    $fontNormal=array('name' => 'Arial', 'size' => 11);
    $fontNormal8=array('name' => 'Arial', 'size' => 8);
    
    $textrun = $cell->addTextRun($parrafo);
    $textrun->addText(htmlspecialchars('     '), $fontNorma9B);
    $textrun->addText(htmlspecialchars('ESCUELA TÉCNICA AERONÁUTICA'),
     array('name' => 'Arial', 'size' => 9, 'bold' => true, 'underline' => 'single'));
    $textrun = $cell->addTextRun($parrafo);
    $textrun->addText(htmlspecialchars('          '), $fontNorma9B);

    $textrun->addText(htmlspecialchars('Subdirección Administrativa'), $fontNorma9B_under);
    $textrun = $cell->addTextRun($parrafo);
    $textrun->addText(htmlspecialchars('            '), $fontNorma9B);
     
    $textrun->addText(htmlspecialchars('Oficina Personal Docente'), $fontNorma9B_under);
    $textrun = $cell->addTextRun($parrafo);
    $header->addTextBreak(1, array('name' => 'Arial', 'size' => 11), $parrafo);

    $section->addText(htmlspecialchars('Santiago,'.$date2), $fontNormal  , $paraNormalRight);



    // titulo  
    $section->addTextBreak(1, array('name' => 'Arial', 'size' => 11), $parrafo);
    $section->addText(htmlspecialchars('INFORME DE ASUNCIÓN DE FUNCIONES'), $fontNorma9B_under, $paraNormalCenter);
    $section->addText(htmlspecialchars('DE PROFESOR DE LA ESCUELA TÉCNICA AERONÁUTICA'), $fontNorma9B_under, $paraNormalCenter);
   
    $section->addTextBreak(1, array('name' => 'Arial', 'size' => 11), $parrafo);


    // $section->addPageBreak();   
    //  $styleTable = array('borderSize' => 6, 'border(Top|Right|Bottom|Left)Color' => '999999');
    // $word->addTableStyle('Colspan Rowspan', $styleTable);
    $table = $section->addTable('datos');
    //SEGEMENTO 1
    $row = $table->addRow(250, array("exactHeight" => true));
    $row->addCell(100, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Nombre'), $fontNorma9 , $parrafo);
    $row->addCell(200, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->nombres.' '.$informe_asuncion[0]->apellidos), $fontNorma9 );

    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Cédula de identidad N°'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->rut), $fontNorma9  );
    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Estado Civil'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->estado_civil), $fontNorma9  );


    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Fecha de nacimiento'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->fecnac), $fontNorma9  );


    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Dirección'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->direccion.','.$informe_asuncion[0]->ciudad), $fontNorma9);
    
    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', "valign" => "center"))->addText(htmlspecialchars(''), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', "valign" => "center"))->addText(htmlspecialchars(''), $fontNorma9  );
    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Especialidad'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->especialidad), $fontNorma9B );
    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Cargo '), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->empresa_cargo), $fontNorma9  );

    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Tipo de contrato'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Contrata Docente'), $fontNorma9  );
    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Curso'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->nombre_grupo), $fontNorma9  );

    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Asignatura'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->titulo), $fontNorma9  );
    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Vigencia'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($fecha_ini.' al '.$fecha_term), $fontNorma9B );
   
    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Trienios'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->trienios), $fontNorma9  );
    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Unidad'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->empresa_unidad), $fontNorma9  );
   
    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Sistema previsional'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->sistema_previsional), $fontNorma9  );
    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Sistema de salud'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->sistema_salud), $fontNorma9  );
    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Nº de Resolución'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars(''), $fontNorma9  );
    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart'))->addText(htmlspecialchars(''), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart'))->addText(htmlspecialchars(''), $fontNorma9  );


    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Alta '), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars(''), $fontNorma9  );
    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Prórroga'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('No'), $fontNorma9  );
    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Horas pedagógicas'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->horas), $fontNorma9  );
    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Ceda'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('2560'), $fontNorma9 + $bold );
    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Centro de costo'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('5034'), $fontNorma9  );
    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Asignación académica'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->asignacion_academica), $fontNorma9  );
    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Pensionado'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->pensionado), $fontNorma9  );
    $row = $table->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Reliquidado'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->reliquidado), $fontNorma9  );
   
   $section->addText(htmlspecialchars('Forma de pago'), $fontNorma9B, $paraNormalCenter);
    $table2 = $section->addTable('datos');
    $row = $table2->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Cuenta corriente'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars(''), $fontNorma9  );
    $row = $table2->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Cheque'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars(''), $fontNorma9  );
    $row = $table2->addRow(250, array("exactHeight" => true));  
    $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Tarjeta cuentamática'), $fontNorma9 , $parrafo);
    $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars(''), $fontNorma9  );

    $section->addTextBreak(4, $fontNormal, $parrafo);
    $section->addText(htmlspecialchars($firmante), $fontNorma9B, $paraNormalRight);
    $section->addText(htmlspecialchars(' DIRECTOR (E)'), $fontNorma9B, $paraNormalRight);   

    $section->addTextBreak(2, $fontNormal, $parrafo);
    $section->addText(htmlspecialchars('DISTRIBUCIÓN:'), $fontNorma9B_under, $parrafo);    
    $section->addText(htmlspecialchars('1.-     D.RR.HH. Ingresos y retiros'),$fontNorma9B, $parrafo);    
    $section->addText(htmlspecialchars('2.-     D.RR.HH. Sección Beneficios (Inf.)'), $fontNormal , $parrafo);    
    $section->addText(htmlspecialchars('3.- E.T.A. Docencia, Oficina Personal Docente (A)'), $fontNormal , $parrafo);    
    $section->addText(htmlspecialchars('MSV / nsl. 06102014 / Carpeta Oficina Personal Docente / 10 Informe Asunción Funciones / 2017 / '.$informe_asuncion[0]->apellidos.','.$informe_asuncion[0]->nombres.' / Aut. «Aut».doc PHP/FCO/anp '.$fecha_ini.' al '.$fecha_term ), $fontNormal8 , $parrafo);  


   /////////////////////////////////////si existe Otro PROFESOR////////////////////////////
    if($informe_asuncion[0]->oid_profesor2>0||$informe_asuncion[0]->oid_profesor2>'0')
    {
   
        $section->addText(htmlspecialchars('Santiago,'.$date2), $fontNormal  , $paraNormalRight);

    // titulo  
        $section->addTextBreak(1, $fontNormal, $parrafo);
        $section->addText(htmlspecialchars('INFORME DE ASUNCIÓN DE FUNCIONES'), $fontNorma9B_under, $paraNormalCenter);
        $section->addText(htmlspecialchars('DE PROFESOR DE LA ESCUELA TÉCNICA AERONÁUTICA'), $fontNorma9B_under, $paraNormalCenter);
       
        $section->addTextBreak(1, $fontNormal, $parrafo);

        $section->addText(htmlspecialchars('Santiago,'.$date2), $fontNormal  , $paraNormalRight);

        $table = $section->addTable('datos');
        //SEGEMENTO 1
        $row = $table->addRow(250, array("exactHeight" => true));
        $row->addCell(100, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Nombre'), $fontNorma9 , $parrafo);
        $row->addCell(200, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->nombres2.' '.$informe_asuncion[0]->apellidos2), $fontNorma9 );

        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Cédula de identidad N°'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->rut2), $fontNorma9  );
        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Estado Civil'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->estado_civil2), $fontNorma9  );


        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Fecha de nacimiento'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->fecnac2), $fontNorma9  );

        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Dirección'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->direccion2.','.$informe_asuncion[0]->ciudad2), $fontNorma9);
        
        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', "valign" => "center"))->addText(htmlspecialchars(''), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', "valign" => "center"))->addText(htmlspecialchars(''), $fontNorma9  );
        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Especialidad'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->especialidad2), $fontNorma9B);
        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Cargo '), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->empresa_cargo), $fontNorma9  );

        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Tipo de contrato'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Contrata Docente'), $fontNorma9  );
        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Curso'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->nombre_grupo), $fontNorma9  );

        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Asignatura'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->titulo), $fontNorma9  );
        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Vigencia'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($fecha_ini.' al '.$fecha_term), $fontNorma9B );
       
        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Trienios'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->trienios), $fontNorma9  );
        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Unidad'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->empresa_unidad), $fontNorma9  );
       
        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Sistema previsional'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->sistema_previsional), $fontNorma9  );
        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Sistema de salud'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->sistema_salud), $fontNorma9  );
        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Nº de Resolución'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars(''), $fontNorma9  );
        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart'))->addText(htmlspecialchars(''), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart'))->addText(htmlspecialchars(''), $fontNorma9  );


        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Alta '), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars(''), $fontNorma9  );
        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Prórroga'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('No'), $fontNorma9  );
        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Horas pedagógicas'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->horas), $fontNorma9  );
        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Ceda'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('2560'), $fontNorma9B );
        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Centro de costo'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('5034'), $fontNorma9  );
        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Asignación académica'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->asignacion_academica2), $fontNorma9  );
        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Pensionado'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->pensionado), $fontNorma9  );
        $row = $table->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Reliquidado'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars($informe_asuncion[0]->reliquidado), $fontNorma9  );
       
       $section->addText(htmlspecialchars('Forma de pago'), $fontNorma9B, $paraNormalCenter);
        $table2 = $section->addTable('datos');
        $row = $table2->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Cuenta corriente'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars(''), $fontNorma9  );
        $row = $table2->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Cheque'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars(''), $fontNorma9  );
        $row = $table2->addRow(250, array("exactHeight" => true));  
        $row->addCell(4000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars('Tarjeta cuentamática'), $fontNorma9 , $parrafo);
        $row->addCell(6000, array('vMerge' => 'restart', 'borderSize' => 1, 'borderColor' =>'000000', "valign" => "center"))->addText(htmlspecialchars(''), $fontNorma9  );

        $section->addTextBreak(4, $fontNormal, $parrafo);
        $section->addText(htmlspecialchars($firmante), $fontNorma9B, $paraNormalRight);
        $section->addText(htmlspecialchars(' DIRECTOR (E)'), $fontNorma9B, $paraNormalRight);   

        $section->addTextBreak(2, $fontNormal, $parrafo);
        $section->addText(htmlspecialchars('DISTRIBUCIÓN:'), $fontNorma9B_under, $parrafo);    
        $section->addText(htmlspecialchars('1.-     D.RR.HH. Ingresos y retiros'),$fontNorma9B, $parrafo);    
        $section->addText(htmlspecialchars('2.-     D.RR.HH. Sección Beneficios (Inf.)'), $fontNormal , $parrafo);    
        $section->addText(htmlspecialchars('3.- E.T.A. Docencia, Oficina Personal Docente (A)'), $fontNormal , $parrafo);    
        $section->addText(htmlspecialchars('MSV / nsl. 06102014 / Carpeta Oficina Personal Docente / 10 Informe Asunción Funciones / 2017 / '.$informe_asuncion[0]->apellidos.','.$informe_asuncion[0]->nombres.' / Aut. «Aut».doc PHP/FCO/anp '.$fecha_ini.' al '.$fecha_term ), $fontNormal8 , $parrafo); 


    }

    $filename = "Reporte_asuncion.docx"; // Nombre del archivo que se va a crear
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

<?php

//~ echo $ruta;
//~ echo "<br>";
//~ echo $document_root;
//~ exit();

require_once $document_root."/cvirtual/vendor/autoload.php";
use PhpOffice\PhpWord\Style\Language;
$documento = new \PhpOffice\PhpWord\PhpWord();
$propiedades = $documento->getDocInfo();
$propiedades->setCreator("Luis Cabrera Benito");
$propiedades->setCompany("Ninguna");
$propiedades->setTitle("Primer documento de Word creado con PHP");
$propiedades->setDescription("Este es un documento para mostrar cómo crear archivos de Word con PHP");
$propiedades->setCategory("Tutoriales");
$propiedades->setLastModifiedBy("Luis Cabrera Benito");
$propiedades->setCreated(time());
$propiedades->setModified(time());
$propiedades->setSubject("Asunto");
$propiedades->setKeywords("documento, php, word");
//~ # Para que no diga que se abre en modo de compatibilidad
//~ $documento->getCompatibility()->setOoxmlVersion(15);
# Idioma español de México
$documento->getSettings()->setThemeFontLang(new Language("ES-VE"));
# Enviar encabezados para indicar que vamos a enviar un documento de Word
$nombre = "libro.docx";
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $nombre . '"');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($documento, "Word2007");
# Y lo enviamos a php://output
$objWriter->save("php://output");
?>

<?php
//~ echo "<pre>";
//~ print_r($datos);
//~ echo "<pre>";
//~ print_r($archivo['gfile']);
//~ echo "<pre>";
//~ print_r($validate_file);
echo "<pre>";
print_r($result);

// DISTINTAS OPCIONES DE REDIRECCIÓN
//~ if($result == 'ok'){
	
	//~ echo "<script>
		//~ alert('Carga completada');
	//~ </script>";
	
//~ }else{
	
	//~ echo "<pre>";
    //~ print_r(json_decode($result, true));
	
//~ }

// Variable de declaración en segundos
$ActualizarDespuesDe = 5;

echo "<br>";
echo "<br>";
echo "Será redirigido en ".$ActualizarDespuesDe." segundos";

// Envíe un encabezado Refresh al navegador preferido.
header('Refresh: '.$ActualizarDespuesDe);

//~ echo "<script>
		//~ window.location.href = '".base_url('public/Comunidad/carga')."';
	//~ </script>";
?>
<!-- El siguiente script refrescara la pagina transcurridos los 5 segundos. -->
<!--<meta http-equiv="refresh" content="5" />-->

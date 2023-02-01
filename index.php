<?php
	header('Set-Cookie: cross-site-cookie=name; SameSite=None; Secure');
	require_once 'lib/config.php';
	$controlador = "Usuario";
	$accion = "login";

	session_start();



	if (isset($_SESSION["logueado"]) && ($_SESSION["logueado"] == 2020)){
		//Capturamos el controlador y la acción, si se especificó por el usuario.
		$c = filter_input(INPUT_GET,"c",FILTER_SANITIZE_STRING);
		if(!$c) $c = filter_input(INPUT_POST,"c",FILTER_SANITIZE_STRING);
		$a = filter_input(INPUT_GET,"a",FILTER_SANITIZE_STRING);
		if(!$a) $a = filter_input(INPUT_POST,"a",FILTER_SANITIZE_STRING);
		//Validamos si los parámetros son válidos.
		if(in_array($c,CONTROLADORES) && in_array($a,ACCIONES)){
			$controlador = $c;
			$accion = $a;
		}
		else{
			$controlador = CONTROLADOR_POR_DEFECTO;
			$accion = ACCION_POR_DEFECTO;
		}
	}

	require_once 'controlador/'.ucfirst($controlador).'Controlador.php';
	$controlador = ucfirst($controlador).'Controlador';
	$controlador = new $controlador;
	call_user_func_array(array($controlador, $accion), array());
	// call_user_func_array(array($controlador, $accion), array($accion, $modulo));
?>
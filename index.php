<?php
	session_start();
	
	$controller = 'alumno';
	
	if ( isset($_REQUEST['c']) ){
		$controller = $_REQUEST['c'];
	}	
	
	if( isset($_SESSION["sessionNumber"]) ){
		//$controller = 'alumno';
		//echo "SIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIU" . $_SESSION["sessionNumber"];
	}else{
		$controller = 'login';	
		//echo "NOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOU";	
	}	
	
	require_once 'model/database.php';

	// Todo esta lógica hara el papel de un FrontController
	if( !isset($_REQUEST['c']) )
	{
	    require_once "controller/$controller.controller.php";
	    $controller = ucwords($controller) . 'Controller';
	    $controller = new $controller;
	    $controller->Index();    
	}
	else
	{
	    // Obtenemos el controlador que queremos cargar
	    $controller = strtolower($controller);
	    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
	    
	    // Instanciamos el controlador
	    require_once "controller/$controller.controller.php";
	    $controller = ucwords($controller) . 'Controller';
	    $controller = new $controller;
	    
	    // Llama la accion
	    call_user_func( array( $controller, $accion ) );
	}  

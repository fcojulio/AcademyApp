<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Academy</title>
        
        <meta charset="utf-8" />
        
		<script src="assets/js/docxtemplater.js"></script>
    	<script src="assets/js/jszip-utils.js"></script>
    	
    	<script src="assets/js/jquery-2.2.4.js"></script>
		<script src="assets/js/FileSaver.js"></script>
		<script src="assets/js/tableexport.js"></script>    	
    	
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">        
	
	</head>
    <body>
    	<nav class="navbar navbar-inverse navbar-fixed-top" style='background-color: #5f5d5e' >
    		
    		<div class="navbar-header">
		        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		          <span class="sr-only">Toggle navigation</span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		          </button>
		        <a class="navbar-brand" ><b>Academy</b></a>
		      </div>
		      
		      <div class="navbar-collapse collapse">
      	
				<ul class="nav navbar-nav botonera" style="font-size: 20px;">
	        		<li>
	        			Academy
	        		</li>
	         		<li <?php if( isset($_GET['c']) && $_GET['c'] == 'Alumno' ) {echo ' class="active" '; } ?> >
	         			<a href="index.php?c=Alumno" ><span class="glyphicon glyphicon-user"></span> Alumnos</a>
	         		</li>
	         		<li <?php if( isset($_GET['c']) && $_GET['c'] == 'Grupo' ) {echo ' class="active" '; } ?> >
	         			<a href="index.php?c=Grupo" ><span class="glyphicon glyphicon-education"></span> Grupos</a>
	         		</li>
	         		<li <?php if( isset($_GET['c']) && $_GET['c'] == 'Pago' ) {echo ' class="active" '; } ?> >
	         			<a href="index.php?c=Pago" ><span class="glyphicon glyphicon-eur"></span> Pagos</a>
	         		</li>
	         		<li <?php if( isset($_GET['c']) && $_GET['c'] == 'Gasto' ) {echo ' class="active" '; } ?> >
	         			<a href="index.php?c=Gasto" ><span class="glyphicon glyphicon-fire"></span> Gastos</a>
	         		</li>
	         		<li <?php if( isset($_GET['c']) && $_GET['c'] == 'Cuenta' ) {echo ' class="active" '; } ?> >
	         			<a href="index.php?c=Cuenta" ><span class="glyphicon glyphicon-briefcase"></span> Cuentas</a>
	         		</li>
	         		
	         		<?php if( TRUE == TRUE ) { ?> 
			          <li role="presentation" class="dropdown">
			            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
			              <span class="glyphicon glyphicon-leaf"></span>
			              Administración
			            </a>
			            <ul class="dropdown-menu">
			              <li <?php if( isset($_GET['c']) and ($_GET['c'] == 'Usuario') ) {echo ' class="active" '; } ?> ><a href="?c=Usuario">Usuarios</a></li>
			              <li <?php if( isset($_GET['c']) and ($_GET['c'] == 'TipoGrupo') ) {echo ' class="active" '; } ?> ><a href="?c=TipoGrupo">Tipos de grupo</a></li>
			              <li <?php if( isset($_GET['c']) and ($_GET['c'] == 'TipoDurGrupo') ) {echo ' class="active" '; } ?> ><a href="?c=TipoDurGrupo">Tipos de duración de grupo</a></li>
			              <li <?php if( isset($_GET['c']) and ($_GET['c'] == 'CategoriaPago') ) {echo ' class="active" '; } ?> ><a href="?c=CategoriaPago">Categorías de Pago</a></li>
			              <li <?php if( isset($_GET['c']) and ($_GET['c'] == 'TipoPago') ) {echo ' class="active" '; } ?> ><a href="?c=TipoPago">Tipos de Pago</a></li>
			              <li> <a href="#" ><b>Ver. rel 1.0</b></a></li>
			            </ul>
			          </li>
			        <?php } ?>
	          		
	          		<li <?php if( isset($_GET['c']) && $_GET['c'] == 'Logout' ) {echo ' class="active" '; } ?> >
	         			<a href="index.php?c=Login&a=SalirLogin" ><span class="glyphicon glyphicon-off"></span> Cerrar Sesión</a>
	         		</li>
	         		
	        	</ul>
	       </div>
    	</nav>
    
    	<div class="container-fluid" style="margin-top: 55px;" >
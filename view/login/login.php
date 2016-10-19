

<!DOCTYPE html>
<html lang="es">

	<head>
			<title>Aprepol</title>
	        
	        <meta charset="utf-8" />	        
	        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
	        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
	        <link rel="stylesheet" href="assets/css/style.css" />
	        <link rel="stylesheet" href="assets/css/signin.css" />
	        
	        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
		</head>
		
	    <body>
	    	
			<div class="container" > 
	            <form class="form-signin" action="./index.php?c=Login&a=EnviarLogin" method="post" >
		        <h2 class="form-signin-heading" style="margin: 5px;" >App Aprepol</h2>
		        <label for="inputUser" class="sr-only" style="margin: 5px;" >Usuario</label>
		        <input type="user" id="Usuario" name="Usuario"  class="form-control" placeholder="Usuario" required autofocus style="margin: 5px;" >
		        <label for="inputPassword" class="sr-only" style="margin: 5px;" >Password</label>
		        <input type="password" id="Password" name="Password" class="form-control" placeholder="Password" required style="margin: 5px;" >
		
		        <button class="btn btn-lg btn-primary btn-block" type="submit" style="margin: 5px;"> Iniciar sesión</button>
		      </form>
		
		    </div> <!-- /container -->
    		
		</body>
</html>
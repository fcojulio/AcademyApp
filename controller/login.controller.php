<?php
require_once 'model/login.php';

class LoginController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Login();
    }
    
    public function Index(){
		
        //require_once 'view/header.php';
        require_once 'view/login/login.php';
        //require_once 'view/footer.php';
    }
        
    public function EnviarLogin(){
        $lgn = new Login();
        
        $Usuario = $_REQUEST['Usuario'];   
		$Password = $_REQUEST['Password'];     

		$lgn = $this->model->ComprobarUsuario($Usuario);
			
		if ( $Password == $lgn[0]->Password){
				
			$_SESSION["sessionNumber"] = rand(0, 10000) ;
			header('Location: index.php?c=Alumno');
		}else{			
			header('Location: index.php?c=Login');
		}
        
    }
	
	public function SalirLogin(){
        session_destroy();		  
		header('Location: index.php?c=Login');
	}
    
}
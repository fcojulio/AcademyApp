<?php
require_once 'model/usuario.php';

class UsuarioController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Usuario();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/usuario/usuario.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        $usu = new Usuario();
        
        if(isset($_REQUEST['id'])){
            $usu = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'view/header.php';
        require_once 'view/usuario/usuario-editar.php';
        require_once 'view/footer.php';
    }
    
    public function Guardar(){
        $usu = new Usuario();
        
        $usu->id = $_REQUEST['id'];
        $usu->Nombre = $_REQUEST['Nombre'];
        $usu->Apellido = $_REQUEST['Apellido'];
        $usu->Email = $_REQUEST['Email'];
        $usu->Password = $_REQUEST['Password'];
		$usu->Nivel = $_REQUEST['Nivel'];
		
        $usu->id > 0 
            ? $this->model->Actualizar($usu)
            : $this->model->Registrar($usu);
        
        header('Location: index.php?c=Usuario');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php?c=Usuario');
    }
}
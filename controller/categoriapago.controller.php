<?php
require_once 'model/categoriapago.php';

class CategoriaPagoController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new CategoriaPago();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/categoriapago/categoriapago.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        $cp = new CategoriaPago();
        
        if(isset($_REQUEST['id'])){
            $cp = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'view/header.php';
        require_once 'view/categoriapago/categoriapago-editar.php';
        require_once 'view/footer.php';
    }
    
    public function Guardar(){
        $cp = new CategoriaPago();
        
        $cp->id = $_REQUEST['id'];
        $cp->Nombre = $_REQUEST['Nombre'];   
		
        $cp->id > 0 
            ? $this->model->Actualizar($cp)
            : $this->model->Registrar($cp);
        
        header('Location: index.php?c=CategoriaPago');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php?c=CategoriaPago');
    }
}
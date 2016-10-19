<?php
require_once 'model/gasto.php';

class GastoController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Gasto();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/gasto/gasto.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        $gs = new Gasto();
        
        if(isset($_REQUEST['id'])){
            $gs = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'view/header.php';
        require_once 'view/gasto/gasto-editar.php';
        require_once 'view/footer.php';
    }
    
    public function Guardar(){
        $gs = new Gasto();
        
        $gs->id = $_REQUEST['id'];
        $gs->Concepto = $_REQUEST['Concepto']; 
		$gs->Fecha = $_REQUEST['Fecha']; 
		$gs->Valor = $_REQUEST['Valor'];   
		
        $gs->id > 0 
            ? $this->model->Actualizar($gs)
            : $this->model->Registrar($gs);
        
        header('Location: index.php?c=Gasto');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php?c=Gasto');
    }
}
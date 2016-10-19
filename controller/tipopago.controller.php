<?php
require_once 'model/tipopago.php';
require_once 'model/tipodurgrupo.php';
require_once 'model/categoriapago.php';

class TipoPagoController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new TipoPago();
    }
    
    public function Index(){
    	
		$tdg = new TipoDurGrupo();
        $cp = new CategoriaPago();
		
        require_once 'view/header.php';
        require_once 'view/tipopago/tipopago.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
    	
        $tpp = new TipoPago();
        $tdg = new TipoDurGrupo();
        $cp = new CategoriaPago();
		
        if(isset($_REQUEST['id'])){
            $tpp = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'view/header.php';
        require_once 'view/tipopago/tipopago-editar.php';
        require_once 'view/footer.php';
    }
    
    public function Guardar(){
        $tpp = new TipoPago();
        
        $tpp->id = $_REQUEST['id'];
        $tpp->Nombre = $_REQUEST['Nombre'];  
		$tpp->CategoriaPago = $_REQUEST['CategoriaPago'];  
		$tpp->TipoDurGrupo = $_REQUEST['TipoDurGrupo'];  
		$tpp->Valor = $_REQUEST['Valor'];
		$tpp->Dias = $_REQUEST['Dias'];   
		
        $tpp->id > 0 
            ? $this->model->Actualizar($tpp)
            : $this->model->Registrar($tpp);
        
        header('Location: index.php?c=TipoPago');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php?c=TipoPago');
    }
}
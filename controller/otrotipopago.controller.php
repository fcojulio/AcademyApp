<?php
require_once 'model/otrotipopago.php';
require_once 'model/tipodurgrupo.php';
require_once 'model/categoriapago.php';

class OtroTipoPagoController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new OtroTipoPago();
    }
    
    public function Index(){
    	
		$tdg = new TipoDurGrupo();
        $cp = new CategoriaPago();
		
        require_once 'view/header.php';
        require_once 'view/otrotipopago/otrotipopago.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
    	
        $tpp = new OtroTipoPago();
        $tdg = new TipoDurGrupo();
        $cp = new CategoriaPago();
		
        if(isset($_REQUEST['id'])){
            $tpp = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'view/header.php';
        require_once 'view/otrotipopago/otrotipopago-editar.php';
        require_once 'view/footer.php';
    }
    
    public function Guardar(){
        $tpp = new OtroTipoPago();
        
        $tpp->id = $_REQUEST['id'];
        $tpp->Nombre = $_REQUEST['Nombre'];  
		$tpp->Valor = $_REQUEST['Valor'];   
		
        $tpp->id > 0 
            ? $this->model->Actualizar($tpp)
            : $this->model->Registrar($tpp);
        
        header('Location: index.php?c=OtroTipoPago');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php?c=OtroTipoPago');
    }
}
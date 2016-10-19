<?php
require_once 'model/tipodurgrupo.php';

class TipoDurGrupoController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new TipoDurGrupo();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/tipodurgrupo/tipodurgrupo.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        $tpg = new TipoDurGrupo();
        
        if(isset($_REQUEST['id'])){
            $tpg = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'view/header.php';
        require_once 'view/tipodurgrupo/tipodurgrupo-editar.php';
        require_once 'view/footer.php';
    }
    
    public function Guardar(){
        $tpg = new TipoDurGrupo();
        
        $tpg->id = $_REQUEST['id'];
        $tpg->Nombre = $_REQUEST['Nombre'];   
		
        $tpg->id > 0 
            ? $this->model->Actualizar($tpg)
            : $this->model->Registrar($tpg);
        
        header('Location: index.php?c=TipoDurGrupo');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php?c=TipoDurGrupo');
    }
}
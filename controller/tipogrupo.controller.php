<?php
require_once 'model/tipogrupo.php';

class TipoGrupoController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new TipoGrupo();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/tipogrupo/tipogrupo.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        $tpg = new TipoGrupo();
        
        if(isset($_REQUEST['id'])){
            $tpg = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'view/header.php';
        require_once 'view/tipogrupo/tipogrupo-editar.php';
        require_once 'view/footer.php';
    }
    
    public function Guardar(){
        $tpg = new TipoGrupo();
        
        $tpg->id = $_REQUEST['id'];
        $tpg->Nombre = $_REQUEST['Nombre'];   
		
        $tpg->id > 0 
            ? $this->model->Actualizar($tpg)
            : $this->model->Registrar($tpg);
        
        header('Location: index.php?c=TipoGrupo');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php?c=TipoGrupo');
    }
}
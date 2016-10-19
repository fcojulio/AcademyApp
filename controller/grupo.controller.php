<?php
require_once 'model/grupo.php';
require_once 'model/tipogrupo.php';
require_once 'model/alumno.php';

class GrupoController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Grupo();
    }
    
    public function Index(){
    	$tpg = new TipoGrupo();
		
        require_once 'view/header.php';
        require_once 'view/grupo/grupo.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        $grp = new Grupo();
        $tpg = new TipoGrupo();
		
        if(isset($_REQUEST['id'])){
            $grp = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'view/header.php';
        require_once 'view/grupo/grupo-editar.php';
        require_once 'view/footer.php';
    }
    
	public function EmailGrupo(){
		$grp = new Grupo();
        $tpg = new TipoGrupo();
        $alu = new Alumno();
		
        if(isset($_REQUEST['idGrupoEmail'])){
            $listado = $alu->ListarPorGrupo($_REQUEST['idGrupoEmail']);
			$cuerpoMensaje = $_REQUEST['cuerpoMensajeEmail'];
			
			foreach($listado as $r): 
				$alu->EnviarEmail($r->id, $cuerpoMensaje);
			endforeach;
        }
        
        require_once 'view/header.php';
		require_once 'view/grupo/grupo-aviso-email.php';
        require_once 'view/grupo/grupo.php';
        require_once 'view/footer.php';
    }
	
	public function SMSGrupo(){
		$grp = new Grupo();
        $tpg = new TipoGrupo();
        $alu = new Alumno();
		
        if(isset($_REQUEST['idSMSEmail'])){
            $listado = $alu->ListarPorGrupo($_REQUEST['idSMSEmail']);
			$cuerpoMensaje = $_REQUEST['cuerpoMensajeSMS'];
			
			foreach($listado as $r): 
				$alu->EnviarEmail($r->id, $cuerpoMensaje);
			endforeach;
        }
        
        require_once 'view/header.php';
		require_once 'view/grupo/grupo-aviso-sms.php';
        require_once 'view/grupo/grupo.php';
        require_once 'view/footer.php';
    }
	
    public function Guardar(){
        $grp = new Grupo();
        
        $grp->id = $_REQUEST['id'];
        $grp->Nombre = $_REQUEST['Nombre'];   
		$grp->Tipo = $_REQUEST['Tipo'];     
		
        $grp->id > 0 
            ? $this->model->Actualizar($grp)
            : $this->model->Registrar($grp);
        
        header('Location: index.php?c=Grupo');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php?c=Grupo');
    }
}
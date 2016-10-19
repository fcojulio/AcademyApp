<?php
require_once 'model/alumno.php';
require_once 'model/grupo.php';
require_once 'model/tipopago.php';
require_once 'model/pago.php';
require_once 'model/categoriapago.php';

class AlumnoController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Alumno();
    }
    
    public function Index(){
    	$tp = new TipoPago();
		$pg = new Pago();
		$gp = new Grupo();
		$cp = new CategoriaPago();
		
        require_once 'view/header.php';
        require_once 'view/alumno/alumno.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        $alm = new Alumno();
        $grp = new Grupo();		
		
        if(isset($_REQUEST['id'])){
            $alm = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'view/header.php';
        require_once 'view/alumno/alumno-editar.php';
        require_once 'view/footer.php';
    }
    
    public function Guardar(){
        $alm = new Alumno();
        
        $alm->id = $_REQUEST['id'];
        $alm->Nombre = $_REQUEST['Nombre'];
        $alm->Apellido = $_REQUEST['Apellido'];
        $alm->Email = $_REQUEST['Email'];
        $alm->Sexo = $_REQUEST['Sexo'];
        $alm->FechaNacimiento = $_REQUEST['FechaNacimiento'];
		
		$DNI = $_REQUEST['DNI'];
		$alm->DNI = $DNI;
		$alm->FechaCamiseta = $_REQUEST['FechaCamiseta'];
		$alm->TelefonoFijo = $_REQUEST['TelefonoFijo'];
		$alm->TelefonoMovil = $_REQUEST['TelefonoMovil'];
		$alm->FechaRegistro = $_REQUEST['FechaRegistro'];
		$alm->GrupoTeoria = $_REQUEST['GrupoTeoria'];
		$alm->GrupoFisicas = $_REQUEST['GrupoFisicas'];
		$alm->GrupoAcceso = $_REQUEST['GrupoAcceso'];
		$alm->GrupoOnline = $_REQUEST['GrupoOnline'];
		$alm->Carnet = $_REQUEST['Carnet'];
		$alm->Camiseta = $_REQUEST['Camiseta'];		
		$alm->Estudios = $_REQUEST['Estudios'];		
		$alm->Baja = $_REQUEST['Baja'];
		
		//var_dump($_FILES['image']);		
		//die;
		
		if ( isset( $_FILES["image"] ) && !empty( $_FILES["image"]["name"] ) && $_FILES["image"]["size"] > 0 ) {
					
			$target_dir = "./images/alumnos/";
			$uploadOk = 1;
			$imageFileType = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
			$imageFileType = strtolower($imageFileType);
			$extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			$name_file = $DNI . "." . $extension;
			$target_file = $target_dir  . basename($name_file);
			// Check if image file is a actual image or fake image

		    $check = getimagesize($_FILES["image"]["tmp_name"]);
			if($check !== false) {
			    //echo "File is an image - " . $check["mime"] . ".";
			    $uploadOk = 1;
				$alm->Foto = $name_file;
			} else {
			    echo "File is not an image.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			        //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
		} else {
			$alm->Foto = $_REQUEST['imagename'];
		}
						
        $alm->id > 0 
            ? $this->model->Actualizar($alm)
           : $this->model->Registrar($alm);
        
        header('Location: index.php?c=Alumno');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php?c=Alumno');
    }
}
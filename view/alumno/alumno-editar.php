
<ol class="breadcrumb">
  <li><a href="?c=Alumno">Alumnos</a></li>
  <li class="active"><?php echo $alm->id != null ? $alm->Nombre : 'Nuevo Registro'; ?></li>
</ol>

<form id="frm-alumno" action="?c=Alumno&a=Guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $alm->id; ?>" />
    
    <div class="row">
    	<div class="col-md-6">
		    <div class="form-group">
		        <label>Nombre</label>
		        <input style="text-transform: uppercase" id="Nombre" type="text" name="Nombre" value="<?php echo $alm->Nombre; ?>" class="form-control" placeholder="Ingrese su nombre" data-validacion-tipo="requerido|min:3" />
		    </div>
		    
		    <div class="form-group">
		        <label>Apellido</label>
		        <input style="text-transform: uppercase" id="Apellido" type="text" name="Apellido" value="<?php echo $alm->Apellido; ?>" class="form-control" placeholder="Ingrese su apellido"  />
		    </div>
		    
		    <div class="form-group">
		        <label>DNI</label>
		        <input style="text-transform: uppercase" id="DNI" type="text" name="DNI" value="<?php echo $alm->DNI; ?>" class="form-control" placeholder="Ingrese su DNI" data-validacion-tipo="requerido|min:9" />
		    </div>
		    
		    <div class="form-group">
		        <label>E-mail</label>
		        <input type="text" name="Email" value="<?php echo $alm->Email; ?>" class="form-control" placeholder="Ingrese su correo electrónico" />
		    </div>
		    
		    <div class="form-group">
		        <label>Sexo</label>
		        <select name="Sexo" class="form-control">
		            <option <?php echo $alm->Sexo == 1 ? 'selected' : ''; ?> value="1">Masculino</option>
		            <option <?php echo $alm->Sexo == 2 ? 'selected' : ''; ?> value="2">Femenino</option>
		        </select>
		    </div>
		    
		    <div class="form-group">
		        <label>Fecha de nacimiento</label>
		        <input id="Nacimiento" type="text" name="FechaNacimiento" value="<?php echo $alm->FechaNacimiento; ?>" class="form-control datepicker" placeholder="AAAA-MM-DD" />
		    </div>
		    
		    <div class="form-group">
		        <label>Teléfono Móvil</label>
		        <input type="text" name="TelefonoMovil" value="<?php echo $alm->TelefonoMovil; ?>" class="form-control" placeholder="Ingrese su TelefonoMovil" />
		    </div>
		    
		    <div class="form-group">
		        <label>Teléfono Fijo</label>
		        <input type="text" name="TelefonoFijo" value="<?php echo $alm->TelefonoFijo; ?>" class="form-control" placeholder="Ingrese su TelefonoFijo" />
		    </div>
		    
		    <div class="form-group">
		        <label>Estudios</label>
		        <input style="text-transform: uppercase" type="text" name="Estudios" value="<?php echo $alm->Estudios; ?>" class="form-control" placeholder="Ingrese sus Estudios"  />
		    </div>
		    		 
		    <div class="form-group">
		        <label>¿Baja?</label>
		        <select name="Baja" class="form-control">
		            <option <?php echo $alm->Baja == 1 ? 'selected' : ''; ?> value="1">SI</option>
		            <option <?php echo $alm->Baja == 0 ? 'selected' : ''; ?> value="0">NO</option>
		        </select>
		    </div>
		       
		</div>
		
		<div class="col-md-6">
			<div class="form-group" style="text-align: center; " >

				<?php
					
					$fotoAlu = "null.png";
					
					if ( !empty($alm->Foto) ){
						$fotoAlu = $alm->Foto;
					} 
			
				?>

				<img src="./images/alumnos/<?php echo $alm->Foto ?>" style="height: 200px; margin: 20px;" />
				<input type="file" name="image" id="image" />
				<a class="btn btn-info form-control" style="width: 200px; float: right;" onclick="takePhoto()" >Tomar foto</a>
					
				<input style="visibility: hidden;" readonly type="text" name="imagename" id="imagename" value="<?php echo $alm->Foto ?>" />			
		    </div>			
		    
		    <div class="form-group">
		        <label>Fecha Matriculación</label>
		        <input readonly type="text" name="FechaRegistro" value="<?php echo $alm->FechaRegistro; ?>" class="form-control datepicker" placeholder="Ingrese su fecha de matrícula"  />
		    </div> 
		    
		    <div class="form-group">
		        <label>Grupo Teoría</label>
		        <select name="GrupoTeoria" class="form-control">
		        	<?php
		        		$tipos = $grp->ListarPorTipo(1); 
		        		foreach ($tipos as $tipo ) {						
					?>					
		            <option <?php echo $alm->GrupoTeoria == $tipo->id ? 'selected' : ''; ?> value="<?php echo $tipo->id ?>"><?php echo $tipo->Nombre ?></option>		            
		            <?php } ?>
		        </select>
		    </div>
		    
		    <div class="form-group">
		        <label>Grupo Físicas</label>
		        <select name="GrupoFisicas" class="form-control">
		        	<?php
		        		$tipos = $grp->ListarPorTipo(2); 
		        		foreach ($tipos as $tipo ) {						
					?>					
		            <option <?php echo $alm->GrupoFisicas == $tipo->id ? 'selected' : ''; ?> value="<?php echo $tipo->id ?>"><?php echo $tipo->Nombre ?></option>		            
		            <?php } ?>
		        </select>
		    </div>   
		    
		    <div class="form-group">
		        <label>Grupo Prueba de Acceso</label>
		        <select name="GrupoAcceso" class="form-control">
		        	<?php
		        		$tipos = $grp->ListarPorTipo(3); 
		        		foreach ($tipos as $tipo ) {						
					?>					
		            <option <?php echo $alm->GrupoAcceso == $tipo->id ? 'selected' : ''; ?> value="<?php echo $tipo->id ?>"><?php echo $tipo->Nombre ?></option>		            
		            <?php } ?>
		        </select>
		    </div>  
		    
		    <div class="form-group">
		        <label>Grupo Online</label>
		        <select name="GrupoOnline" class="form-control">
		        	<?php
		        		$tipos = $grp->ListarPorTipo(4); 
		        		foreach ($tipos as $tipo ) {						
					?>					
		            <option <?php echo $alm->GrupoOnline == $tipo->id ? 'selected' : ''; ?> value="<?php echo $tipo->id ?>"><?php echo $tipo->Nombre ?></option>		            
		            <?php } ?>
		        </select>
		    </div>  
		    
		    <div class="form-group">
		        <label>Tiene carnet</label>
		        <select name="Carnet" class="form-control" style="width: 120px;">
		            <option <?php echo $alm->Carnet == 1 ? 'selected' : ''; ?> value="1">SI</option>
		            <option <?php echo $alm->Carnet == 0 ? 'selected' : ''; ?> value="0">NO</option>
		        </select>
		        
		        <a class="btn btn-info form-control" onclick="printCard()" style="width: 200px; float: right;" >Imprimir carnet</a>
		    </div>
		     
		    <div class="form-group">        
		        <label>Tiene camiseta</label>
		        <select name="Camiseta" class="form-control">
		            <option <?php echo $alm->Camiseta == 1 ? 'selected' : ''; ?> value="1">SI</option>
		            <option <?php echo $alm->Camiseta == 0 ? 'selected' : ''; ?> value="0">NO</option>
		        </select>
		        
		        <label>Fecha Camiseta</label>
		        <input readonly type="text" name="FechaCamiseta" value="<?php echo $alm->FechaCamiseta; ?>" class="form-control datepicker" placeholder="Ingrese su fecha de camiseta"  />
		    </div>
		    
		</div>
	</div>
	<div class="text-right">
		<button class="btn btn-success">Guardar</button>
	</div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-alumno").submit(function(){
            return $(this).validate();
        });
    })
</script>

<script>

        function printCard() {
            var loadFile=function(url,callback){
                JSZipUtils.getBinaryContent(url,callback);
            }
            loadFile("assets/carnet/carnetfisica2017.docx",function(err,content){
                if (err) { throw e};
                doc=new Docxgen(content);
                doc.setData( {
                	"first_name":document.getElementById('Nombre').value,
                    "last_name":document.getElementById('Apellido').value,
                    "dni":document.getElementById('DNI').value,
                    "birthdate":document.getElementById('Nacimiento').value
                    }
                ) //set the templateVariables
                doc.render() //apply them (replace all occurences of {first_name} by Hipp, ...)
                out=doc.getZip().generate({type:"blob"}) //Output the document using Data-URI
                saveAs(out,"carnet.docx")
            })
        }
 					
</script>

<script>
	
	function takePhoto() {
		var dni = document.getElementById('DNI').value;
		document.getElementById("imagename").value = dni+".jpg";
		window.open('assets/takephoto/index.php?dni='+dni, 'newwindow', 'width=1050, height=600'); 
		return false;
	}
		
</script>
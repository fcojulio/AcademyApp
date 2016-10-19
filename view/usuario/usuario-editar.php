
<ol class="breadcrumb">
  <li><a href="?c=Usuario">Usuarios</a></li>
  <li class="active"><?php echo $usu->id != null ? $usu->Nombre : 'Nuevo Registro'; ?></li>
</ol>

<form id="frm-alumno" action="?c=Usuario&a=Guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $usu->id; ?>" />
    
    <div class="row">
    	<div class="col-md-6">
		    <div class="form-group">
		        <label>Nombre</label>
		        <input type="text" name="Nombre" value="<?php echo $usu->Nombre; ?>" class="form-control" placeholder="Ingrese su nombre" data-validacion-tipo="requerido|min:3" />
		    </div>
		    
		    <div class="form-group">
		        <label>Apellido</label>
		        <input type="text" name="Apellido" value="<?php echo $usu->Apellido; ?>" class="form-control" placeholder="Ingrese su apellido"  />
		    </div>

		    <div class="form-group">
		        <label>E-mail</label>
		        <input type="text" name="Email" value="<?php echo $usu->Email; ?>" class="form-control" placeholder="Ingrese su correo electrónico" data-validacion-tipo="requerido|email" />
		    </div>
		    
		    <div class="form-group">
		        <label>Password</label>
		        <input type="text" name="Password" value="<?php echo $usu->Password; ?>" class="form-control" placeholder="Ingrese su password" data-validacion-tipo="requerido" />
		    </div>
		    
		    <div class="form-group">
		        <label>Nivel de acceso</label>
		        <select name="Nivel" class="form-control">
		            <option <?php echo $usu->Nivel == 1 ? 'selected' : ''; ?> value="1">Admnistrador</option>
		            <option <?php echo $usu->Nivel == 2 ? 'selected' : ''; ?> value="2">Visor</option>
		        </select>
		    </div>
		    
		</div>
		
		<div class="col-md-6">
			
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
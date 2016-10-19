
<form id="frm-alumno" action="?c=Cuenta&a=VerCuenta" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Fecha de inicio</label>
		<input readonly type="text" name="FechaInicio" class="form-control datepicker" data-validacion-tipo="requerido"
			<?php if ( isset($fechaInicio) ) { ?> value="<?php echo $fechaInicio ?>" <?php } ?>
		/>
	</div>
	
	<div class="form-group">
		<label>Fecha de final</label>
		
		<input readonly type="text" name="FechaFinal" class="form-control datepicker" data-validacion-tipo="requerido" 
			<?php if ( isset($fechaFinal) ) { ?> value="<?php echo $fechaFinal ?>" <?php } ?>
		/>
	</div>
	
	<div class="text-right">
		<button class="btn btn-success">Ver Periodo</button>
	</div>
</form>
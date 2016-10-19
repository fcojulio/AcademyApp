
<ol class="breadcrumb">
  <li><a href="?c=OtroTipoPago">OtroTipoPagos</a></li>
  <li class="active"><?php echo $tpp->id != null ? $tpp->Nombre : 'Nuevo Registro'; ?></li>
</ol>

<form id="frm-alumno" action="?c=OtroTipoPago&a=Guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $tpp->id; ?>" />
    
    <div class="row">
    	<div class="col-md-6">
		    <div class="form-group">
		        <label>Nombre</label>
		        <input type="text" name="Nombre" value="<?php echo $tpp->Nombre; ?>" class="form-control" placeholder="Ingrese nombre" data-validacion-tipo="requerido|min:3" />
		    </div>
		    <div class="form-group">
		        <label>Valor</label>
		        <input type="text" name="Valor" value="<?php echo $tpp->Valor; ?>" class="form-control" placeholder="Ingrese precio" data-validacion-tipo="requerido|min:1" />
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
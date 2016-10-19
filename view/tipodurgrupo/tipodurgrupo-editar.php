
<ol class="breadcrumb">
  <li><a href="?c=TipoDurGrupo">TipoDurGrupos</a></li>
  <li class="active"><?php echo $tpg->id != null ? $tpg->Nombre : 'Nuevo Registro'; ?></li>
</ol>

<form id="frm-alumno" action="?c=TipoDurGrupo&a=Guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $tpg->id; ?>" />
    
    <div class="row">
    	<div class="col-md-6">
		    <div class="form-group">
		        <label>Nombre</label>
		        <input type="text" name="Nombre" value="<?php echo $tpg->Nombre; ?>" class="form-control" placeholder="Ingrese su nombre" data-validacion-tipo="requerido|min:3" />
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
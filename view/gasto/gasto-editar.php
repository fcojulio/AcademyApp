
<ol class="breadcrumb">
  <li><a href="?c=Gasto">Gastos</a></li>
  <li class="active"><?php echo $gs->id != null ? $gs->Concepto : 'Nuevo Registro'; ?></li>
</ol>

<form id="frm-alumno" action="?c=Gasto&a=Guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $gs->id; ?>" />
    
    <div class="row">
    	<div class="col-md-6">
		    <div class="form-group">
		        <label>Concepto</label>
		        <input type="text" name="Concepto" value="<?php echo $gs->Concepto; ?>" class="form-control" placeholder="Ingrese concepto" data-validacion-tipo="requerido" />
		    </div>	
		    
		    <div class="form-group">
		        <label>Fecha</label>
		        <input type="text" name="Fecha" value="<?php echo $gs->Fecha; ?>" class="form-control datepicker" placeholder="AAAA-MM-DD" data-validacion-tipo="requerido" />
		    </div>
		    
		    <div class="form-group">
		        <label>Valor(€)</label>
		        <input type="decimal" name="Valor" value="<?php echo $gs->Valor; ?>" class="form-control" placeholder="Ingrese valor" data-validacion-tipo="requerido" />
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
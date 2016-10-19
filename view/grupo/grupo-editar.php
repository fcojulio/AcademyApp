
<ol class="breadcrumb">
  <li><a href="?c=Grupo">Grupos</a></li>
  <li class="active"><?php echo $grp->id != null ? $grp->Nombre : 'Nuevo Registro'; ?></li>
</ol>

<form id="frm-alumno" action="?c=Grupo&a=Guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $grp->id; ?>" />
    
    <div class="row">
    	<div class="col-md-6">
		    <div class="form-group">
		        <label>Nombre</label>
		        <input type="text" name="Nombre" value="<?php echo $grp->Nombre; ?>" class="form-control" placeholder="Ingrese el nombre del grupo" data-validacion-tipo="requerido|min:3" />
		    </div>		    
		    <div class="form-group">
		        <label>Tipo</label>
		        <select name="Tipo" class="form-control">
		        	<?php
		        		$tipogrupos = $tpg->Listar(1); 
		        		foreach ($tipogrupos as $tipogrupo ) {						
					?>					
		            <option <?php echo $grp->Tipo == $tipogrupo->id ? 'selected' : ''; ?> value="<?php echo $tipogrupo->id ?>"><?php echo $tipogrupo->Nombre ?></option>		            
		            <?php } ?>
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
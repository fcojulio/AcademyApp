
<ol class="breadcrumb">
  <li><a href="?c=TipoPago">TipoPagos</a></li>
  <li class="active"><?php echo $tpp->id != null ? $tpp->Nombre : 'Nuevo Registro'; ?></li>
</ol>

<form id="frm-alumno" action="?c=TipoPago&a=Guardar" method="post" enctype="multipart/form-data">
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
		    <div class="form-group">
		        <label>Días de duración</label>
		        <input type="text" name="Dias" value="<?php echo $tpp->Dias; ?>" class="form-control" placeholder="Ingrese dias" data-validacion-tipo="requerido|min:1" />
		    </div>	    
		</div>
		
		<div class="col-md-6">
			<div class="form-group">
		        <label>Categoría Pago</label>
		        <select name="CategoriaPago" class="form-control">
		        	<?php
		        		$categoriaspagos = $cp->Listar(); 
		        		foreach ($categoriaspagos as $categoriapago ) {						
					?>					
		            <option <?php echo $tpp->CategoriaPago == $categoriapago->id ? 'selected' : ''; ?> value="<?php echo $categoriapago->id ?>"><?php echo $categoriapago->Nombre ?></option>		            
		            <?php } ?>
		        </select>
		    </div>
		    
		    <div class="form-group">
		        <label>Duración de Pago</label>
		        <select name="TipoDurGrupo" class="form-control">
		        	<?php
		        		$tipodurgrupos = $tdg->Listar(); 
		        		foreach ($tipodurgrupos as $tipodurgrupo ) {						
					?>					
		            <option <?php echo $tpp->TipoDurGrupo == $tipodurgrupo->id ? 'selected' : ''; ?> value="<?php echo $tipodurgrupo->id ?>"><?php echo $tipodurgrupo->Nombre ?></option>		            
		            <?php } ?>
		        </select>
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
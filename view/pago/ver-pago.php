
<div class="well well-sm text-right">
</div>

<form id="frm-alumno" action="?c=Pago&a=ImprimirPago" method="post" enctype="multipart/form-data">	
	<input style="visibility: hidden;" readonly type="text" name="Alumno" value="<?php echo $_POST['Alumno']; ?>"   />
	<input style="visibility: hidden;" readonly name="FechaValidez" value="<?php echo $_POST['FechaValidez']; ?>"   />
	<input style="visibility: hidden;" readonly name="Mes" value="<?php echo $_POST['Mes']; ?>"   />
	<input style="visibility: hidden;" readonly name="ModoPago" value="<?php echo $_POST['ModoPago']; ?>"   />
	<table class="table table-striped">
	    <thead>
	        <tr>
	            <th style="width:180px;">Tipo Pago</th>
	            <th style="width:180px;">Categoria Pago</th>
	            <th style="width:180px;">Desde</th>
	            <th style="width:180px;">Duración</th>
	            <th style="width:180px;">Precio</th>
	        </tr>
	    </thead>
	    <tbody>
	    <?php 
	    
			$total = 0;
			for($i=0; $i < count($listadoNuevosPagos); $i++){
				
				$pg->TipoPago = $listadoNuevosPagos[$i];
				
				$pg->CategoriaPago = $tp->Obtener($listadoNuevosPagos[$i])->CategoriaPago;
				$pg->TipoDurGrupo = $tp->Obtener($listadoNuevosPagos[$i])->TipoDurGrupo;
				$pg->Valor = $tp->Obtener($listadoNuevosPagos[$i])->Valor;
				$total = $total + $pg->Valor;
				$pg->Dias = $tp->Obtener($listadoNuevosPagos[$i])->Dias;		
				
		?>
				<tr>
					<th>
						<?php echo $tp->Obtener($pg->TipoPago)->Nombre; ?>
						<input style="visibility: hidden;" readonly name="TipoPago[]" value="<?php echo $listadoNuevosPagos[$i]; ?>" >
					</th>
					<th><?php echo $cp->Obtener($pg->CategoriaPago)->Nombre;  ?></th>
					<th><?php echo $_POST['FechaValidez']; ?></th>
					<th><?php echo $pg->Dias; ?> Días</th>
					<th><?php echo $pg->Valor; ?> €</th>
				</tr>
		<?php
			}		
		?>
		<tr>
			<th></th>
			<th></th>
			<th>Total</th>
			<th><?php echo $total ?> €</th>
		</tr>
	    </tbody>
	</table> 

	<div class="text-right">
		<button class="btn btn-success" onclick="setTimeout(redirect, 1500)" >Pagar e imprimir</button>
	</div>
	
</form>

<script type="text/javascript">

    function redirect(){
    	window.location.href = "index.php?c=Pago";
    }
    
</script>
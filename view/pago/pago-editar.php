
<ol class="breadcrumb">
  <li><a href="?c=Pago">Pagos</a></li>
  <li class="active"><?php echo $pg->id != null ? $alu->Obtener($pg->Alumno)->Nombre . " " . $alu->Obtener($pg->Alumno)->Apellido : 'Nuevo Registro'; ?></li>
</ol>

<form id="frm-alumno" action="?c=Pago&a=VerPago" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $pg->id; ?>" />
    
    <div class="text-right">
		<button class="btn btn-success">Ver Pago</button>
	</div>
	
    <div class="row">
    	<div class="col-md-6">
		    <div class="form-group">
		        <label>Nombre: <?php 
		        	if ( isset($_GET['idAlumno']) ){
		        		echo $alu->Obtener($_GET['idAlumno'])->Nombre . " " . $alu->Obtener($_GET['idAlumno'])->Apellido; 
					?>
					<input style="visibility: hidden;" readonly type="text" name="Alumno" value="<?php echo $_GET['idAlumno']; ?>"   />
					<?php
		        	}else{
		        		echo $alu->Obtener($pg->Alumno)->Nombre . " " . $alu->Obtener($pg->Alumno)->Apellido; 
		        	} ?>
		        </label>
		      	
		    </div>
		    
		    <div class="form-group">
		        <label>Fecha: <?php echo date('d/m/Y h:i:s A'); ?></label>
		    </div>		  

			<div class="form-group">
		        <label>Últimos pagos</label>
		        <table class="table table-striped">
				    <thead>
				        <tr>
				            <th style="width:180px;">Tipo Pago</th>
				            <th style="width:180px;">Fecha Pago</th>
				            <th style="width:180px;">Fecha Final</th>
				            <th style="width:180px;">Duración</th>
				        </tr>
				    </thead>
				    <tbody>
				    <?php 
				    
					$listado = $this->model->ListarUltimosPorAlumno( $_GET['idAlumno'] , 6);
					
					
					$colorRow = "";
				    $hoy = new DateTime("now");
				
				    foreach($listado as $r): 
				    	
						$fechaFinal = new DateTime($r->FechaFinal);
						$interval = date_diff($hoy, $fechaFinal);
						$diff = $interval->format('%R%a');
						
				    	if ( $diff > 0 ) {
				    		$colorRow = "rgb(136, 239, 91)";
				    	}else{
				    		$colorRow = "rgb(239, 91, 91)";
				    	}
				    ?>
				        <tr style="background-color: <?php echo $colorRow ?> ;" >
				      		<td><?php echo $tp->Obtener($r->TipoPago)->Nombre;	?></td>
				      		<td><?php echo $r->Fecha;	?></td>
				      		<td><?php echo $r->FechaFinal;	?></td>
				      		<td><?php echo $tdg->Obtener($r->TipoDurGrupo)->Nombre;	?></td>			
				        </tr>
				    <?php endforeach; ?>
				    </tbody>
				</table> 
		    </div>	
		    
		</div>
		
		<div class="col-md-6">
			<div class="form-group">
				<table>
					
					<tr>
						<td><label>Fecha de validez</label></td>
						<td style="width: 140px;" ><input type="text" name="FechaValidez" class="form-control datepicker" value="<?php echo date('Y-m-01'); ?>" data-validacion-tipo="requerido" /></td>
					</tr>
						
					<tr>	
						<td><label>Mes</label></td>
						<td>
							<select name="Mes" class="form-control" >
							  <option <?php if(date('m') == 1) echo "selected" ?> value="1">Enero</option>
							  <option <?php if(date('m') == 2) echo "selected" ?> value="2">Febrero</option>
							  <option <?php if(date('m') == 3) echo "selected" ?> value="3">Marzo</option>
							  <option <?php if(date('m') == 4) echo "selected" ?> value="4">Abril</option>
							  <option <?php if(date('m') == 5) echo "selected" ?> value="5">Mayo</option>
							  <option <?php if(date('m') == 6) echo "selected" ?> value="6">Junio</option>
							  <option <?php if(date('m') == 7) echo "selected" ?> value="7">Julio</option>
							  <option <?php if(date('m') == 8) echo "selected" ?> value="8">Agosto</option>
							  <option <?php if(date('m') == 9) echo "selected" ?> value="9">Septiembre</option>
							  <option <?php if(date('m') == 10) echo "selected" ?> value="10">Octubre</option>
							  <option <?php if(date('m') == 11) echo "selected" ?> value="11">Noviembre</option>
							  <option <?php if(date('m') == 12) echo "selected" ?> value="12">Diciembre</option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td><label>Modo de pago</label></td>
						<td>
							<select name="ModoPago" class="form-control" >
								<option value="1" selected >Efectivo</option>
								<option value="2" >Transferencia</option>
							</select>
						</td>
					</tr>
					
					<?php
		        		$categoriapagos = $cp->Listar(); 
		        		
		        		foreach ($categoriapagos as $categoriapago ) {
		        				
		        			echo "<tr><td colspan='2' ><h3> - " . $categoriapago->Nombre . "</h3></td></tr>";
							$tipopagos = $tp->ListarPorCategoria($categoriapago->id);		
							
							foreach ($tipopagos as $tipopago ) { ?>
								<tr>
									<td style="width:300px;" ><label><input type="checkbox" name="TipoPago[]" value="<?php echo $tipopago->id; ?>" > <?php echo $tipopago->Nombre; ?></label></td>
									<td style="width:80px;" ><?php echo $tipopago->Valor; ?> €</td>
								</tr>
							<?php
							}	
											 							 		
						}       
		            ?>
		    	</table>
		    </div>
		    
		</div>
	</div>
	<div class="text-right">
		<button class="btn btn-success">Ver Pago</button>
	</div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-alumno").submit(function(){
            return $(this).validate();
        });
    })
</script>
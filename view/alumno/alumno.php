
<div class="well well-sm text-right">
	 <form action=""  method="POST" >
	  <input class="form-control" type="text" name="buscarAlumno" value="" style="float: left; width: 140px; margin-right: 8px;" autofocus >
	  <input class="btn btn-primary" type="submit" value="Buscar" style="float: left;" >
	</form> 
	
    <a class="btn btn-primary" href="?c=Alumno&a=Crud">Nuevo alumno</a> 
    <a class="btn btn-primary" onClick ='$("table").tableExport( {filename: "listadoAlumnos", ignoreCols: [0,6,7,8,9,10,11] } )' >Exportar</a>
</div>

<?php
	if ( isset($_GET['dir']) ){
		
		if ( $_GET['dir'] == 1){
			$dir = 2;
		} else{
			$dir = 1;
		}
		
	} else{
		$dir = 1;
	}
?>

<table id="table2Excel" class="table table-striped">
   <thead>
        <tr>
        	<th></th>
        	<th></th>
            <th style="width:95px;"><a href="./index.php?c=Alumno&ord=2&dir=<?php echo $dir; ?>" >Nombre</a></th>
            <th style="width:50px;"><a href="./index.php?c=Alumno&ord=3&dir=<?php echo $dir; ?>" >Apellido</a></th>
            <th style="width:50px;"><a href="./index.php?c=Alumno&ord=10&dir=<?php echo $dir; ?>" >Teléfono</a></th>
            <th style="width:20px;"><a href="./index.php?c=Alumno&ord=18&dir=<?php echo $dir; ?>" >¿Baja?</a></th>
            <th style="width:50px;">Teoría</th>
            <th style="width:5px; max-width: 5px;">TR</th>
            <th style="width:50px;">Físicas</th>
            <th style="width:5px; max-width: 5px;">TR</th>
            <th style="width:100px;"></th>
            <th style="width:100px;"></th>
            <th style="width:40px;"></th>
            <th style="width:40px;"></th>
        </tr> 
    </thead>
    <tbody>
    <?php 
    	$listado;
		$totalAlumnos = 0;
		$validezPagoAlumno = 0;
		 
    	if ( isset($_GET['VerGrupo']) ) {    		
			$listado = $this->model->ListarPorGrupo($_GET['VerGrupo']);
			$tipoGrupo = $gp->Obtener($_GET['VerGrupo'])->Tipo;
			$validezPagoAlumno = 1;
						
		}else if ( isset($_GET['TipoPago']) ) {
		?>
		<h3>Periodo del <?php echo $_GET['FechaInicial']; ?> al <?php echo $_GET['FechaFinal']; ?> para <?php echo $tp->Obtener($_GET['TipoPago'])->Nombre; ?></h3>
		<?php
			$listado = $this->model->ListarPorTipoPago($_GET['TipoPago'], $_GET['FechaInicial'], $_GET['FechaFinal']);		
    	} else if ( isset($_POST['buscarAlumno']) ) {
    		 $listado = $this->model->BuscarAlumno($_POST['buscarAlumno']);
    	} else if ( isset($_GET['ord']) ) {
			$listado = $this->model->ListarPorOrden($_GET['ord'], $_GET['dir']);
		} else{
    		$listado = $this->model->Listar();
    	}
		
    	foreach($listado as $r): 
    		$totalAlumnos = $totalAlumnos +1;						
			
			if ( $validezPagoAlumno == 1 ){
				$ultimoPago = $pg->ObtenerUltimoPagoAlumnoMesTipo($r->id, $tipoGrupo, 2,6,7);			
				$colorRow = "rgb(239, 169, 91)";
				$hoy = new DateTime("now");
				
				if ($ultimoPago != False){
					
					$fechaFinal = new DateTime($ultimoPago->FechaFinal);
					$interval = date_diff($hoy, $fechaFinal);
					$diff = $interval->format('%R%a');
							
					if ( $diff > 0 ) {
						$colorRow = "rgb(136, 239, 91)";
					}else{
						$colorRow = "rgb(239, 91, 91)";
					}				
				}
			}
			
			if ( !empty($r->Foto) ){
				$fotoAlu = $r->Foto;
			} else {
				$fotoAlu = "null.png";
			}
    	    	
	    	if ( $r->Baja == 0 ) {
	    		$colorField = "rgb(65, 161, 213)";
	    	}else{
	    		$colorField = "rgb(249, 184, 30)";
	    	}
    	
    	?>
    	
    	<?php      
    		$ultimoPago = "";    
			$ultimoPagoPrintTeoria = "";
			$ultimoPagoPrintFisicas = "";
			$colorFieldTeoria = "";
			$colorFieldFisicas = "";
			
			$colorTrasnferenciaTeoria = "white";
			$colorTrasnferenciaFisica = "white";
			
			$esTransferenciaTeoria = 1;
			$esTransferenciaFisica = 1;
			
			if ( null != $pg->ListarUltimoPorAlumnoTipo($r->id,1) ){
				$ultimoPago = $pg->ListarUltimoPorAlumnoTipo($r->id,1);
				$esTransferenciaTeoria = $ultimoPago[0]->Valor;
				$ultimoPagoPrintTeoria = date('d-m-Y', strtotime($ultimoPago[0]->Fecha)); 
				$ultimoPago = date('d-m-Y', strtotime($ultimoPago[0]->FechaValidez)); 
				
				$ultimoPago = new DateTime($ultimoPago);
				$colorRow = "white";
				
					$hoy = new DateTime('first day of this month');
					$interval = date_diff($hoy,$ultimoPago);
					$diff = $interval->format('%R%a');
							
					if ( $diff >= 0 ) {
						$colorFieldTeoria = "rgb(136, 239, 91)";
					}else{
						$colorFieldTeoria = "rgb(239, 91, 91)";
					}
				
				
				
			} else {
				$colorFieldTeoria = "white";
			}
			
			if ( null != $pg->ListarUltimoPorAlumnoTipo($r->id,2) ){
				$ultimoPago = $pg->ListarUltimoPorAlumnoTipo($r->id,2);
				$ultimoPagoPrintFisicas = date('d-m-Y', strtotime($ultimoPago[0]->Fecha));
				$esTransferenciaFisica = $ultimoPago[0]->Valor;
				$ultimoPago = date('d-m-Y', strtotime($ultimoPago[0]->FechaValidez)); 
				  				
				$ultimoPago = new DateTime($ultimoPago);
				$colorRow = "white";
				
					$hoy = new DateTime('first day of this month');
					$interval = date_diff($hoy,$ultimoPago);
					$diff = $interval->format('%R%a');
							
					if ( $diff >= 0 ) {
						$colorFieldFisicas = "rgb(136, 239, 91)";
					}else{
						$colorFieldFisicas = "rgb(239, 91, 91)";
					}
			} else {
				$colorFieldFisicas = "white";
			}
				
			if ($esTransferenciaTeoria == 0){
				$colorTrasnferenciaTeoria = "rgb(65, 161, 213)";
			}
				
			if ($esTransferenciaFisica == 0){
				$colorTrasnferenciaFisica = "rgb(65, 161, 213)";
			}
			
        ?>
            	
        <tr style="background-color: <?php if (isset($colorRow)) {echo $colorRow ;} ?>" >
        	<th><?php echo $totalAlumnos ?></th>
        	<td><img src="./images/alumnos/<?php echo $fotoAlu ?>" style="height: 50px; " /></td>
            <td><?php echo $r->Nombre; ?></td>
            <td><?php echo $r->Apellido; ?></td>
            <td><?php echo $r->TelefonoMovil; ?></td>
            <td style="background-color: <?php echo $colorField ?> ;" ><?php if ($r->Baja == 0) {echo "NO";}else{ echo "SI"; } ?></td>
            <td style="background-color: <?php echo $colorFieldTeoria ?> ;"><?php echo $ultimoPagoPrintTeoria ?></td>
            <td style="background-color: <?php echo $colorTrasnferenciaTeoria ?> ;"></td>
            <td style="background-color: <?php echo $colorFieldFisicas ?> ;"><?php echo $ultimoPagoPrintFisicas ?></td>
            <td style="background-color: <?php echo $colorTrasnferenciaFisica ?> ;"></td>
            <td>
                <a href="?c=Pago&ListarPorAlumno=<?php echo $r->id; ?>">Ver Pagos</a>
            </td>
            <td>
                <a href="?c=Pago&a=Crud&idAlumno=<?php echo $r->id; ?>">Añadir pago</a>
            </td>
            <td>
                <a href="?c=Alumno&a=Crud&id=<?php echo $r->id; ?>">Editar</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Alumno&a=Eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    	<tr>
    		<td></td>
        	<td style="width:100px;"></td>
            <td style="width:180px;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="width:100px;"></td>
            <td style="width:100px;">Total Alumnos</td>
            <td style="width:40px;"></td>
            <td style="width:40px;"><?php echo $totalAlumnos; ?></td>
        </tr>
	</body>
</table> 

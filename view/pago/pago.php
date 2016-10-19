
<form id="frm-alumno" action="?c=Pago&a=ImprimirPago" method="post" enctype="multipart/form-data">
	<!--<div class="text-right">
		<button class="btn btn-success">Imprimir seleccionados</button>
	</div>-->
	
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
<table class="table table-striped">
    <thead>
        <tr>
        	<th></th>
        	<th style="width:180px;">Alumno</th>
            <th style="width:160px;"><a href="./index.php?c=Pago&ord=2&dir=<?php echo $dir; ?>" >Tipo Pago</a></th>
            <th style="width:160px;"><a href="./index.php?c=Pago&ord=5&dir=<?php echo $dir; ?>" >Fecha Pago</a></th>
            <th style="width:160px;"><a href="./index.php?c=Pago&ord=6&dir=<?php echo $dir; ?>" >Fecha Validez</a></th>
            <th style="width:160px;"><a href="./index.php?c=Pago&ord=7&dir=<?php echo $dir; ?>" >Fecha Final</a></th>
            <th style="width:160px;"><a href="./index.php?c=Pago&ord=3&dir=<?php echo $dir; ?>" >Categoria Pago</a></th>
            <th style="width:100px;"><a href="./index.php?c=Pago&ord=4&dir=<?php echo $dir; ?>" >Duración</a></th>
            <th style="width:100px;">Precio</th>
            <th style="width:60px;"></th>
            <th style="width:60px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php 
    
    if ( isset($_GET['ListarPorAlumno']) ) {    		
		$listado = $this->model->ListarPorAlumno($_GET['ListarPorAlumno']);
	} else if ( isset($_GET['ord']) ) {
		$listado = $this->model->ListarPorOrden($_GET['ord'], $_GET['dir']);
	} else {
		$listado = $this->model->Listar();
	}
	
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
		
		$mesPrint = "Null";
		$mesCheck = date('m', strtotime($r->FechaValidez));
		
		switch ($mesCheck) {
			case '01':
				$mesPrint = "Enero";
				break;
			case '02':
				$mesPrint = "Febrero";
				break;
			case '03':
				$mesPrint = "Marzo";
				break;
			case '04':
				$mesPrint = "Abril";
				break;
			case '05':
				$mesPrint = "Mayo";
				break;
			case '06':
				$mesPrint = "Junio";
				break;
			case '07':
				$mesPrint = "Julio";
				break;
			case '08':
				$mesPrint = "Agosto";
				break;
			case '09':
				$mesPrint = "Septiembre";
				break;
			case '10':
				$mesPrint = "Octubre";
				break;
			case '11':
				$mesPrint = "Noviembre";
				break;
			case '12':
				$mesPrint = "Diciembre";
				break;
			default:				
				break;
		}
		
    ?>
        <tr style="background-color: <?php echo $colorRow ?> ;" >
        	
        	<td>
        		<?php  ?><input type="checkbox" name="TipoPago[]" value="<?php echo $r->TipoPago ?>"   />        	
	       		<input style="visibility: hidden; width: 0px; height: 0px;" readonly type="text" name="Alumno" value="<?php echo $r->Alumno; ?>"   />
				<input style="visibility: hidden; width: 0px; height: 0px;" readonly type="text" name="FechaValidez" value="<?php echo $r->FechaValidez; ?>"   />
        	</td>
        	<td><?php echo $alu->Obtener($r->Alumno)->Nombre . " " . $alu->Obtener($r->Alumno)->Apellido; ?></td>      
      		<td><?php echo $tp->Obtener($r->TipoPago)->Nombre . " " . $mesPrint; ?></td>
      		<td><?php echo date('d-m-y', strtotime($r->Fecha));	?></td>
      		<td><?php echo date('d-m-y', strtotime($r->FechaValidez)); ?></td>
      		<td><?php echo date('d-m-y', strtotime($r->FechaFinal));	?></td>
      		<td><?php echo $cp->Obtener($r->CategoriaPago)->Nombre;	?></td>
      		<td><?php echo $tdg->Obtener($r->TipoDurGrupo)->Nombre;	?></td>			
			<td><?php echo $r->Valor;	 ?> €</td>
            <td>
                <a href="?c=Pago&a=Crud&id=<?php echo $r->id; ?>">Editar</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Pago&a=Eliminar&id=<?php echo $r->id; if (isset($_GET['ListarPorAlumno']) ) { echo "&idAlumno=".$_GET['ListarPorAlumno']; } ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 
</form>
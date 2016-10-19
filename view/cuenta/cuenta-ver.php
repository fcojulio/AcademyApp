
<h3>Periodo del <?php echo $fechaInicio; ?> al <?php echo $fechaFinal; ?> </h3>

<h2>Ingresos</h2>

<table class="table table-striped">

	<tr>
		<th style="width: 220px;" >Nombre</th>
		<th style="width: 220px;" >Listado</th>
		<th style="width: 220px;" >Cantidad</th>
		<th style="width: 220px;" >Total</th>
	</tr>
	<?php
		$total = 0;		
		foreach ($cuentas as $cuenta) {
	?>
		<tr>
			<td style="width: 220px;" ><?php echo $tp->Obtener($cuenta->TipoPago)->Nombre ?></td>
			<td style="width: 220px;" ><a href="?c=Alumno&TipoPago=<?php echo $cuenta->TipoPago ?>
									&FechaInicial=<?php echo $fechaInicio; ?>
									&FechaFinal=<?php echo $fechaFinal; ?>" >Ver alumnos</a>
			</td>
			<td style="width: 220px;" >x <?php echo $cuenta->con ?></td>
			<td style="width: 220px;" ><?php echo $cuenta->sum ?> €</td>
		</tr>
	<?php
			$total = $total + $cuenta->sum;
		}
		
		echo "";
	?>
	<tr>
		<td style="width: 220px;" ></td>
		<td style="width: 220px;" ></td>
		<td style="width: 220px;" ><h4>Total ingresos</h4></td>
		<td style="width: 220px;" ><h4><?php echo $totalIngresos = $total ?> €</h4></td>		
	</tr>
</table>

<h2>Gastos</h2>

<table class="table table-striped">

	<tr>
		<th style="width: 220px;" >Concepto</th>
		<th style="width: 220px;" ></th>
		<th style="width: 220px;" >Fecha</th>
		<th style="width: 220px;" >Valor</th>
	</tr>
	<?php
		$total = 0;
		
		foreach ($gastos as $gasto) {
	?>
		<tr>			
			<td style="width: 220px;" ><?php echo $gasto->Concepto ?></td>
			<td style="width: 220px;" ></td>
			<td style="width: 220px;" ><?php echo $gasto->Fecha ?></td>
			<td style="width: 220px;" >- <?php echo $gasto->Valor ?> €</td>
		</tr>
	<?php
			$total = $total + $gasto->Valor;
		}
		
		echo "";
	?>
	<tr>
		<td style="width: 220px;" ></td>
		<td style="width: 220px;" ></td>
		<td style="width: 220px;" ><h4>Total gastos</h4></td>
		<td style="width: 220px;" ><h4>- <?php echo $totalGastos = $total ?> €</h4></td>
	</tr>
	
	<tr>
		<td style="width: 220px;" ></td>
		<td style="width: 220px;" ></td>
		<td style="width: 220px;" ><h3>Total</h3></td>
		<td style="width: 220px;" ><h3><?php echo $totalIngresos - $totalGastos ?> €</h3></td>
	</tr>
</table>
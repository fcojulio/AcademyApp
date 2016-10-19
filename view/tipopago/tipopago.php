
<div class="well well-sm text-right">
	 <form action=""  method="POST" >
	  <input class="form-control" type="text" name="buscarTipoPago" value="" style="float: left; width: 140px; margin-right: 8px;" >
	  <input class="btn btn-primary" type="submit" value="Buscar" style="float: left;" >
	</form> 
	
    <a class="btn btn-primary" href="?c=TipoPago&a=Crud">Nuevo tipo pago</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:260px;">Nombre</th>
            <th style="width:180px;">Categoría</th>
            <th style="width:180px;">Duración (Días)</th>
            <th style="width:180px;">Valor</th>
            <th style="width:60px;"></th>
            <th style="width:60px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php 
    	$listado;
		
    	if ( isset($_POST['buscarTipoPago']) ) {
    		 $listado = $this->model->BuscarTipoPago($_POST['buscarTipoPago']);
    	}else{
    		$listado = $this->model->Listar();
    	}
		
    	foreach($listado as $r): ?>
        <tr>
            <td><?php echo $r->Nombre; ?></td>
            <td><?php echo $cp->Obtener($r->CategoriaPago)->Nombre;	?></td>  
           	<td><?php echo $tdg->Obtener($r->TipoDurGrupo)->Nombre . " (" . $r->Dias . ")";	?></td> 
            <td><?php echo $r->Valor; ?> €</td>
            <td>
                <a href="?c=TipoPago&a=Crud&id=<?php echo $r->id; ?>">Editar</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=TipoPago&a=Eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 

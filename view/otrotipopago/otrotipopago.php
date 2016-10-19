
<div class="well well-sm text-right">
	 <form action=""  method="POST" >
	  <input class="form-control" type="text" name="buscarOtroTipoPago" value="" style="float: left; width: 140px; margin-right: 8px;" >
	  <input class="btn btn-primary" type="submit" value="Buscar" style="float: left;" >
	</form> 
	
    <a class="btn btn-primary" href="?c=OtroTipoPago&a=Crud">Nuevo otro tipo pago</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:180px;">Nombre</th>
            <th style="width:180px;">Valor</th>
            <th style="width:60px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php 
    	$listado;
		
    	if ( isset($_POST['buscarOtroTipoPago']) ) {
    		 $listado = $this->model->BuscarOtroTipoPago($_POST['buscarOtroTipoPago']);
    	}else{
    		$listado = $this->model->Listar();
    	}
		
    	foreach($listado as $r): ?>
        <tr>
            <td><?php echo $r->Nombre; ?></td>
            <td><?php echo $r->Valor; ?> €</td>
            <td>
                <a href="?c=OtroTipoPago&a=Crud&id=<?php echo $r->id; ?>">Editar</a>
            </td>
            
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 

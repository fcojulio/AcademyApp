
<div class="well well-sm text-right">
	 <form action=""  method="POST" >
	  <input class="form-control" type="text" name="buscarUsuario" value="" style="float: left; width: 140px; margin-right: 8px;" >
	  <input class="btn btn-primary" type="submit" value="Buscar" style="float: left;" >
	</form> 
	
    <a class="btn btn-primary" href="?c=Usuario&a=Crud">Nuevo usuario</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:180px;">Nombre</th>
            <th style="width:180px;">Apellido</th>
            <th>E-Correo</th>
            <th>Nivel</th>
            <th style="width:60px;"></th>
            <th style="width:60px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php 
    	$listado;
		
    	if ( isset($_POST['buscarUsuario']) ) {
    		 $listado = $this->model->BuscarUsuario($_POST['buscarUsuario']);
    	}else{
    		$listado = $this->model->Listar();
    	}
		
    	foreach($listado as $r): ?>
        <tr>
            <td><?php echo $r->Nombre; ?></td>
            <td><?php echo $r->Apellido; ?></td>
            <td><?php echo $r->Email; ?></td>
            <td><?php echo $r->Nivel; ?></td>
            <td>
                <a href="?c=Usuario&a=Crud&id=<?php echo $r->id; ?>">Editar</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Usuario&a=Eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 


<div class="well well-sm text-right">
	 <form action=""  method="POST" >
	  <input class="form-control" type="text" name="buscarTipoGrupo" value="" style="float: left; width: 140px; margin-right: 8px;" >
	  <input class="btn btn-primary" type="submit" value="Buscar" style="float: left;" >
	</form> 
	
    <a class="btn btn-primary" href="?c=TipoGrupo&a=Crud">Nuevo tipo grupo</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:180px;">Nombre</th>
            <th style="width:60px;"></th>
            <th style="width:60px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php 
    	$listado;
		
    	if ( isset($_POST['buscarTipoGrupo']) ) {
    		 $listado = $this->model->BuscarTipoGrupo($_POST['buscarTipoGrupo']);
    	}else{
    		$listado = $this->model->Listar();
    	}
		
    	foreach($listado as $r): ?>
        <tr>
            <td><?php echo $r->Nombre; ?></td>
            <td>
                <a href="?c=TipoGrupo&a=Crud&id=<?php echo $r->id; ?>">Editar</a>
            </td>
            <td>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 

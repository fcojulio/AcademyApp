
<div class="well well-sm text-right">	
    <a class="btn btn-primary" href="?c=Gasto&a=Crud">Nuevo gasto</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:180px;">Concepto</th>
            <th style="width:100px;">Fecha</th>
            <th style="width:100px;">Valor</th>
            <th style="width:100px;"></th>
            <th style="width:100px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php 
    	
    	$listado = $this->model->Listar();    	
		
    	foreach($listado as $r): ?>
        <tr>
            <td><?php echo $r->Concepto; ?></td>
            <td><?php echo $r->Fecha; ?></td>
            <td><?php echo $r->Valor; ?> €</td>
            <td>
                <a href="?c=Gasto&a=Crud&id=<?php echo $r->id; ?>">Editar</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Gasto&a=Eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 

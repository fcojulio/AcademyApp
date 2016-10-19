
<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=Grupo&a=Crud">Nuevo grupo</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
        	<th style="width:60px;">Alumnos</th>
        	<th style="width:90px;">Tipo</th>
            <th style="width:90px;">Nombre</th>
            <th style="width:170px;"></th>
            <th style="width:100px;"></th>
            <!-- <th style="width:100px;"></th> -->
            <th style="width:40px;"></th>
            <th style="width:40px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->ListarGrupos() as $r): 
    	$totalAlumnos = $this->model->TotalAlumnosPorGrupo($r->id)->TotalAlumnos;
    ?>
        <tr> 
           <td>
           	<b><?php echo $totalAlumnos; ?> </b>
           </td>          
           <td><?php 
           			echo $tpg->Obtener($r->Tipo)->Nombre;
           		?>
           </td>
           <td>
           	<?php echo $r->Nombre; ?>
           </td>
           <td>
                <a href="?c=Alumno&VerGrupo=<?php echo $r->id; ?>">Ver Alumnos del grupo [<?php echo $totalAlumnos; ?>]</a>
            </td>
            <td>
                <a onclick="enviarEmailGrupal(<?php echo $r->id; ?>)" >Enviar mail grupal</a>
            </td>
            <!--<td>
                <a onclick="enviarSMSGrupal(<?php echo $r->id; ?>)" >Enviar sms grupal</a>
            </td>-->
            <td>
                <a href="?c=Grupo&a=Crud&id=<?php echo $r->id; ?>">Editar</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Grupo&a=Eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 

<div id='enviarEmailGrupal' class='modal fade bs-example-modal-sm' role='dialog'>
	<form id="frm-alumno" action="?c=Grupo&a=EmailGrupo" method="post" enctype="multipart/form-data">
	<div class='modal-dialog modal-sm'>
    	<div class='modal-content'>
        	<div class='modal-header'>
            	<button type='button' class='close' data-dismiss='modal' >&times;</button>
            	<h4 class='modal-title'>Enviar mail grupal</h4>
          	</div>
			<div class='modal-body'>
				<input type="hidden" name="idGrupoEmail" id="idGrupoEmail" value="" />
				<textarea style="width: 267px; height: 128px;" name="cuerpoMensajeEmail" ></textarea>
			</div>
			<div class='modal-footer'>
				<button class="btn btn-success">Enviar email</button>
				<button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
			</div>
		</div>
	</div>
	</form>
</div>

<div id='enviarSMSGrupal' class='modal fade bs-example-modal-sm' role='dialog'>
	<form id="frm-alumno" action="?c=Grupo&a=SMSGrupo" method="post" enctype="multipart/form-data">
	<div class='modal-dialog modal-sm'>
    	<div class='modal-content'>
        	<div class='modal-header'>
            	<button type='button' class='close' data-dismiss='modal' >&times;</button>
            	<h4 class='modal-title'>Enviar SMS grupal</h4>
          	</div>
			<div class='modal-body'>
				<input type="hidden" name="idGrupoEmail" id="idGrupoSMS" value="" />
				<textarea style="width: 267px; height: 128px;" name="cuerpoMensajeSMS" ></textarea>
			</div>
			<div class='modal-footer'>
				<button class="btn btn-success">Enviar SMS</button>
				<button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
			</div>
		</div>
	</div>
	</form>
</div>

<script type='text/javascript'>

	function enviarEmailGrupal(idGrupo) {      
		document.getElementById("idGrupoEmail").value = idGrupo;
		$('#enviarEmailGrupal').modal('show');
	}
	
	function enviarSMSGrupal(idGrupo) {      
		document.getElementById("idGrupoSMS").value = idGrupo;
		$('#enviarSMSGrupal').modal('show');
	}
	
</script>

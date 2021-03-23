<?php
$domiciliario = new Domiciliario($_SESSION['id']);
$domiciliario -> select();
?>
<div class="container">
	<div>
		<div class="card-header">
			<h3>Perfil</h3>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-3">
					<img src="<?php echo ($domiciliario -> getFoto()!="")?$domiciliario -> getFoto():"http://icons.iconarchive.com/icons/custom-icon-design/silky-line-user/512/user2-2-icon.png"; ?>" width="100%" class="rounded">
				</div>
				<div class="col-md-9">
					<div class="table-responsive-sm">
						<table class="table table-striped table-hover">
							<tr>
								<th>Nombre</th>
								<td><?php echo $domiciliario -> getNombre() ?></td>
							</tr>
							<tr>
								<th>Apellido</th>
								<td><?php echo $domiciliario -> getApellido() ?></td>
							</tr>
							<tr>
								<th>Correo</th>
								<td><?php echo $domiciliario -> getCorreo() ?></td>
							</tr>
							<tr>
								<th>Telefono</th>
								<td><?php echo $domiciliario -> getTelefono() ?></td>
							</tr>
							<tr>
								<th>Salario</th>
								<td><?php echo $domiciliario -> getSalario() ?></td>
							</tr>
						
							<tr>
								<th>State</th>
								<td><?php echo ($domiciliario -> getState()==1)?"Habilitado":"Deshabilitado"; ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
		<p><?php echo "Su rol es: Domiciliario"; ?></p>
		</div>
	</div>
</div>

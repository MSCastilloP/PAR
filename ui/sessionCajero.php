<?php
$cajero = new Cajero($_SESSION['id']);
$cajero -> select();
?>
<div class="container">
	<div>
		<div class="card-header">
			<h3>Perfil</h3>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-3">
					<img src="<?php echo ($cajero -> getFoto()!="")?$cajero -> getFoto():"http://icons.iconarchive.com/icons/custom-icon-design/silky-line-user/512/user2-2-icon.png"; ?>" width="100%" class="rounded">
				</div>
				<div class="col-md-9">
					<div class="table-responsive-sm">
						<table class="table table-striped table-hover">
							<tr>
								<th>Nombre</th>
								<td><?php echo $cajero -> getNombre() ?></td>
							</tr>
							<tr>
								<th>Apellido</th>
								<td><?php echo $cajero -> getApellido() ?></td>
							</tr>
							<tr>
								<th>Correo</th>
								<td><?php echo $cajero -> getCorreo() ?></td>
							</tr>
							<tr>
								<th>Salario</th>
								<td><?php echo $cajero -> getSalario() ?></td>
							</tr>
							<tr>
								<th>Telefono</th>
								<td><?php echo $cajero -> getTelefono() ?></td>
							</tr>
							<tr>
								<th>Rol</th>
								<td><?php echo $cajero -> getRol() ?></td>
							</tr>
							<tr>
								<th>State</th>
								<td><?php echo ($cajero -> getState()==1)?"Habilitado":"Deshabilitado"; ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
		<p><?php echo "Su rol es: Cajero"; ?></p>
		</div>
	</div>
</div>

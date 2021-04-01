<?php
$administrador = new Administrador($_SESSION['id']);
$administrador -> select();
$btn=0;
if(isset($_GET['cerrar'])){
	$administrador->cerrar(date("Y-m-d"),date("H:i:s"));
	$btn=2;
}
	$asis= $administrador->consultAsis(date("Y-m-d"),date("H:i:s"));
	if($asis==1){
		$btn=1;
	}
?>
<div class="container">
	<div>
		<div class="card-header">
			<h3>Perfil</h3>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-3">
					<img src="<?php echo ($administrador -> getFoto()!="")?$administrador -> getFoto():"http://icons.iconarchive.com/icons/custom-icon-design/silky-line-user/512/user2-2-icon.png"; ?>" width="100%" class="rounded">
				</div>
				<div class="col-md-9">
					<div class="table-responsive-sm">
						<table class="table table-striped table-hover">
							<tr>
								<th>Nombre</th>
								<td><?php echo $administrador -> getNombre() ?></td>
							</tr>
							<tr>
								<th>Apellido</th>
								<td><?php echo $administrador -> getApellido() ?></td>
							</tr>
							<tr>
								<th>Correo</th>
								<td><?php echo $administrador -> getCorreo() ?></td>
							</tr>
							<tr>
								<th>Telefono</th>
								<td><?php echo $administrador -> getTelefono() ?></td>
							</tr>
							<tr>
								<th>Celular</th>
								<td><?php echo $administrador -> getCelular() ?></td>
							</tr>
							<tr>
								<th>Estado</th>
								<td><?php echo ($administrador -> getEstado()==1)?"Habilitado":"Deshabilitado"; ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
		<p><?php echo "Su rol es: Administrador"; ?></p>
		</div>
		<div class="card-footer">
		<?php if($btn==1){
			echo "<a type='button' href='index.php?pid=". base64_encode("ui/sessionAdministrador.php")."&cerrar=0' onclick='return confirm(\"Esta seguro de cerrar el local?\")'>Cerrar local</a>";

			?>
			
			<?php } else if($btn == 2){ ?>
				<div class="alert alert-success" >El negocio a cerrado por el dia de hoy
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php } ?>
		</div>
	</div>
</div>

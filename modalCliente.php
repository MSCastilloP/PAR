<?php
require("business/Administrador.php");
require("business/LogAdministrador.php");
require("business/Inventario.php");
require("business/Ingrediente.php");
require("business/IngrePro.php");
require("business/Producto.php");
require("business/ProDom.php");
require("business/LogDomiciliario.php");
require("business/Domiciliario.php");
require("business/LogCliente.php");
require("business/Cliente.php");
require("business/Domicilio.php");
require("business/LogCajero.php");
require("business/Cajero.php");
require("business/Pedido.php");
require("business/PedidoPro.php");
require("business/Cocinero.php");
require_once("persistence/Connection.php");
$idCliente = $_GET ['idCliente'];
$cliente = new Cliente($idCliente);
$cliente -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Cliente</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Nombre</th>
			<td><?php echo $cliente -> getNombre() ?></td>
		</tr>
		<tr>
			<th>Apellido</th>
			<td><?php echo $cliente -> getApellido() ?></td>
		</tr>
		<tr>
			<th>Correo</th>
			<td><?php echo $cliente -> getCorreo() ?></td>
		</tr>
		<tr>
			<th>Foto</th>
				<td><img class="rounded" src="<?php echo $cliente -> getFoto() ?>" height="300px" /></td>
		</tr>
		<tr>
			<th>Telefono</th>
			<td><?php echo $cliente -> getTelefono() ?></td>
		</tr>
		<tr>
			<th>Direccion</th>
			<td><?php echo $cliente -> getDireccion() ?></td>
		</tr>
		
	</table>
</div>

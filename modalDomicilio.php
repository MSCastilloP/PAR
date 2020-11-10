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
$idDomicilio = $_GET ['idDomicilio'];
$domicilio = new Domicilio($idDomicilio);
$domicilio -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Domicilio</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Direccion</th>
			<td><?php echo $domicilio -> getDireccion() ?></td>
		</tr>
		<tr>
			<th>Fecha</th>
			<td><?php echo $domicilio -> getFecha() ?></td>
		</tr>
		<tr>
			<th>Hora</th>
			<td><?php echo $domicilio -> getHora() ?></td>
		</tr>
		<tr>
			<th>Precio</th>
			<td><?php echo $domicilio -> getPrecio() ?></td>
		</tr>
		<tr>
			<th>Descripcion</th>
			<td><?php echo $domicilio -> getDescripcion() ?></td>
		</tr>
		<tr>
			<th>Cocinando</th>
			<td><?php echo $domicilio -> getCocinando() ?></td>
		</tr>
		<tr>
			<th>Domiciliario</th>
			<td><?php echo $domicilio -> getDomiciliario() -> getNombre() . " " . $domicilio -> getDomiciliario() -> getApellido() . " " . $domicilio -> getDomiciliario() -> getTelefono() . " " . $domicilio -> getDomiciliario() -> getSalario() . " " . $domicilio -> getDomiciliario() -> getRol() ?></td>
		</tr>
		<tr>
			<th>Cliente</th>
			<td><?php echo $domicilio -> getCliente() -> getNombre() . " " . $domicilio -> getCliente() -> getApellido() . " " . $domicilio -> getCliente() -> getTelefono() . " " . $domicilio -> getCliente() -> getDireccion() ?></td>
		</tr>
	</table>
</div>

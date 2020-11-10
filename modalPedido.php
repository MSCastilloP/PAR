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
$idPedido = $_GET ['idPedido'];
$pedido = new Pedido($idPedido);
$pedido -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Pedido</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Fecha</th>
			<td><?php echo $pedido -> getFecha() ?></td>
		</tr>
		<tr>
			<th>Hora</th>
			<td><?php echo $pedido -> getHora() ?></td>
		</tr>
		<tr>
			<th>Descripcion</th>
			<td><?php echo $pedido -> getDescripcion() ?></td>
		</tr>
		<tr>
			<th>Precio</th>
			<td><?php echo $pedido -> getPrecio() ?></td>
		</tr>
		<tr>
			<th>Cocinando</th>
			<td><?php echo $pedido -> getCocinando() ?></td>
		</tr>
		<tr>
			<th>Cajero</th>
			<td><?php echo $pedido -> getCajero() -> getNombre() . " " . $pedido -> getCajero() -> getApellido() ?></td>
		</tr>
	</table>
</div>

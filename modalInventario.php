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
$idInventario = $_GET ['idInventario'];
$inventario = new Inventario($idInventario);
$inventario -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Inventario</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Fecha</th>
			<td><?php echo $inventario -> getFecha() ?></td>
		</tr>
		<tr>
			<th>Cantidad Inicial</th>
			<td><?php echo $inventario -> getCantidadInicial() ?></td>
		</tr>
		<tr>
			<th>Unidades</th>
			<td><?php echo $inventario -> getUnidades() ?></td>
		</tr>
		<tr>
			<th>Cantidad Final</th>
			<td><?php echo $inventario -> getCantidadFinal() ?></td>
		</tr>
		<tr>
			<th>Ingrediente</th>
			<td><?php echo $inventario -> getIngrediente() -> getNombre() . " " . $inventario -> getIngrediente() -> getPrecio() ?></td>
		</tr>
	</table>
</div>

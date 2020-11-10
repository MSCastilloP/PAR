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
$idProducto = $_GET ['idProducto'];
$producto = new Producto($idProducto);
$producto -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Producto</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Nombre</th>
			<td><?php echo $producto -> getNombre() ?></td>
		</tr>
		<tr>
			<th>Precio</th>
			<td><?php echo $producto -> getPrecio() ?></td>
		</tr>
		<tr>
			<th>Descripcion</th>
			<td><?php echo $producto -> getDescripcion() ?></td>
		</tr>
		<tr>
			<th>Foto</th>
			<td><?php echo $producto -> getFoto() ?></td>
		</tr>
	</table>
</div>

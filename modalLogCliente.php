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
$idLogCliente = $_GET ['idLogCliente'];
$logCliente = new LogCliente($idLogCliente);
$logCliente -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Log Cliente</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Accion</th>
			<td><?php echo str_replace(";; ", "<br>", $logCliente -> getAccion()) ?></td>
		</tr>
		<tr>
			<th>Informacion</th>
			<td><?php echo str_replace(";; ", "<br>", $logCliente -> getInformacion()) ?></td>
		</tr>
		<tr>
			<th>Fecha</th>
			<td><?php echo str_replace(";; ", "<br>", $logCliente -> getFecha()) ?></td>
		</tr>
		<tr>
			<th>Hora</th>
			<td><?php echo str_replace(";; ", "<br>", $logCliente -> getHora()) ?></td>
		</tr>
		<tr>
			<th>Ip</th>
			<td><?php echo str_replace(";; ", "<br>", $logCliente -> getIp()) ?></td>
		</tr>
		<tr>
			<th>So</th>
			<td><?php echo str_replace(";; ", "<br>", $logCliente -> getSo()) ?></td>
		</tr>
		<tr>
			<th>Explorador</th>
			<td><?php echo str_replace(";; ", "<br>", $logCliente -> getExplorador()) ?></td>
		</tr>
	</table>
</div>

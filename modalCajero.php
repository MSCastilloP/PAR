<?php
//actualmente se usa
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
$idCajero = $_GET ['idCajero'];
$cajero = new Cajero($idCajero);
$cajero -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Cajero</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
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
			<th>Foto</th>
				<td><img class="rounded" src="<?php echo $cajero -> getFoto() ?>" height="300px" /></td>
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
			<th>Estado</th>
			<td><?php echo ($cajero -> getState()==1?"Habilitado":"Deshabilitado") ?> </td>
		</tr>
	</table>
</div>

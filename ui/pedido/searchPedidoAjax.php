<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Fecha</th>
			<th nowrap>Hora</th>
			<th nowrap>Descripcion</th>
			<th nowrap>Precio</th>
			<th nowrap>Cocinando</th>
			<th>Cajero</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$pedido = new Pedido();
		$pedidos = $pedido -> search($_GET['search']);
		$counter = 1;
		foreach ($pedidos as $currentPedido) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentPedido -> getFecha()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentPedido -> getHora()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentPedido -> getDescripcion()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentPedido -> getPrecio()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentPedido -> getCocinando()) . "</td>";
			echo "<td>" . $currentPedido -> getCajero() -> getNombre() . " " . $currentPedido -> getCajero() -> getApellido() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrador' || $_GET['entity'] == 'Cajero') {
							echo "<a href='index.php?pid=" . base64_encode("ui/pedido/updatePedido.php") . "&idPedido=" . $currentPedido -> getIdPedido() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Pedido' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrador' || $_GET['entity'] == 'Cajero') {
							echo "<a href='index.php?pid=" . base64_encode("ui/pedido/selectAllPedido.php") . "&idPedido=" . $currentPedido -> getIdPedido() . "&action=delete' onclick='return confirm(\"Confirm to delete Pedido: " . $currentPedido -> getDescripcion() . " " . $currentPedido -> getPrecio() . " " . $currentPedido -> getCocinando() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Pedido' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/pedidoPro/selectAllPedidoProByPedido.php") . "&idPedido=" . $currentPedido -> getIdPedido() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Consultar Pedido Pro' ></span></a> ";
						if($_GET['entity'] == 'Administrador' || $_GET['entity'] == 'Cajero') {
							echo "<a href='index.php?pid=" . base64_encode("ui/pedidoPro/insertPedidoPro.php") . "&idPedido=" . $currentPedido -> getIdPedido() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Pedido Pro' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>

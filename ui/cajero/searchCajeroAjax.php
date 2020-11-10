<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Nombre</th>
			<th nowrap>Apellido</th>
			<th nowrap>Correo</th>
			<th nowrap>Salario</th>
			<th nowrap>Telefono</th>
			<th nowrap>Rol</th>
			<th nowrap>State</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$cajero = new Cajero();
		$cajeros = $cajero -> search($_GET['search']);
		$counter = 1;
		foreach ($cajeros as $currentCajero) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCajero -> getNombre()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCajero -> getApellido()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCajero -> getCorreo()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCajero -> getSalario()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCajero -> getTelefono()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCajero -> getRol()) . "</td>";
						echo "<td>" . ($currentCajero -> getState()==1?"Habilitado":"Deshabilitado") . "</td>";
						echo "<td class='text-right' nowrap>";
						echo "<a href='modalCajero.php?idCajero=" . $currentCajero -> getIdCajero() . "'  data-toggle='modal' data-target='#modalCajero' ><span class='fas fa-eye' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Ver mas información' ></span></a> ";
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/cajero/updateCajero.php") . "&idCajero=" . $currentCajero -> getIdCajero() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Cajero' ></span></a> ";
							echo "<a href='index.php?pid=" . base64_encode("ui/cajero/updateFotoCajero.php") . "&idCajero=" . $currentCajero -> getIdCajero() . "&attribute=foto'><span class='fas fa-camera' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar foto'></span></a> ";
						}
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/cajero/selectAllCajero.php") . "&idCajero=" . $currentCajero -> getIdCajero() . "&action=delete' onclick='return confirm(\"Confirm to delete Cajero: " . $currentCajero -> getNombre() . " " . $currentCajero -> getApellido() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Cajero' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/pedido/selectAllPedidoByCajero.php") . "&idCajero=" . $currentCajero -> getIdCajero() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Consultar Pedido' ></span></a> ";
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/pedido/insertPedido.php") . "&idCajero=" . $currentCajero -> getIdCajero() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Pedido' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
<div class="modal fade" id="modalCajero" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content" id="modalContent">
		</div>
	</div>
</div>
<script>
	$('body').on('show.bs.modal', '.modal', function (e) {
		var link = $(e.relatedTarget);
		$(this).find(".modal-content").load(link.attr("href"));
	});
</script>

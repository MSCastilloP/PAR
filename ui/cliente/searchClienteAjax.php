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
			<th nowrap>Telefono</th>
			<th nowrap>Direccion</th>
			<th nowrap>State</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$cliente = new Cliente();
		$clientes = $cliente -> search($_GET['search']);
		$counter = 1;
		foreach ($clientes as $currentCliente) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCliente -> getNombre()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCliente -> getApellido()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCliente -> getCorreo()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCliente -> getTelefono()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCliente -> getDireccion()) . "</td>";
						echo "<td>" . ($currentCliente -> getState()==1?"Habilitado":"Deshabilitado") . "</td>";
						echo "<td class='text-right' nowrap>";
						echo "<a href='modalCliente.php?idCliente=" . $currentCliente -> getIdCliente() . "'  data-toggle='modal' data-target='#modalCliente' ><span class='fas fa-eye' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Ver mas información' ></span></a> ";
						
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
<div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

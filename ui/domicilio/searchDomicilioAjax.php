<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Direccion</th>
			<th nowrap>Fecha</th>
			<th nowrap>Hora</th>
			<th nowrap>Precio</th>
			<th nowrap>Descripcion</th>
			<th nowrap>Cocinando</th>
			<th>Domiciliario</th>
			<th>Cliente</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$domicilio = new Domicilio();
		$domicilios = $domicilio -> search($_GET['search']);
		$counter = 1;
		foreach ($domicilios as $currentDomicilio) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentDomicilio -> getDireccion()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentDomicilio -> getFecha()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentDomicilio -> getHora()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentDomicilio -> getPrecio()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentDomicilio -> getDescripcion()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentDomicilio -> getCocinando()) . "</td>";
			echo "<td>" . $currentDomicilio -> getDomiciliario() -> getNombre() . " " . $currentDomicilio -> getDomiciliario() -> getApellido() . " " . $currentDomicilio -> getDomiciliario() -> getTelefono() . " " . $currentDomicilio -> getDomiciliario() -> getSalario() . " " . $currentDomicilio -> getDomiciliario() -> getRol() . "</td>";
			echo "<td>" . $currentDomicilio -> getCliente() -> getNombre() . " " . $currentDomicilio -> getCliente() -> getApellido() . " " . $currentDomicilio -> getCliente() -> getTelefono() . " " . $currentDomicilio -> getCliente() -> getDireccion() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrador' || $_GET['entity'] == 'Cliente') {
							echo "<a href='index.php?pid=" . base64_encode("ui/domicilio/updateDomicilio.php") . "&idDomicilio=" . $currentDomicilio -> getIdDomicilio() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Domicilio' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrador' || $_GET['entity'] == 'Cliente') {
							echo "<a href='index.php?pid=" . base64_encode("ui/domicilio/selectAllDomicilio.php") . "&idDomicilio=" . $currentDomicilio -> getIdDomicilio() . "&action=delete' onclick='return confirm(\"Confirm to delete Domicilio: " . $currentDomicilio -> getDireccion() . " " . $currentDomicilio -> getCocinando() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Domicilio' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/proDom/selectAllProDomByDomicilio.php") . "&idDomicilio=" . $currentDomicilio -> getIdDomicilio() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Consultar Pro Dom' ></span></a> ";
						if($_GET['entity'] == 'Administrador' || $_GET['entity'] == 'Cliente') {
							echo "<a href='index.php?pid=" . base64_encode("ui/proDom/insertProDom.php") . "&idDomicilio=" . $currentDomicilio -> getIdDomicilio() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Pro Dom' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>

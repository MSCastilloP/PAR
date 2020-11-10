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
			<th nowrap>Salario</th>
			<th nowrap>Rol</th>
			<th nowrap>State</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$domiciliario = new Domiciliario();
		$domiciliarios = $domiciliario -> search($_GET['search']);
		$counter = 1;
		foreach ($domiciliarios as $currentDomiciliario) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentDomiciliario -> getNombre()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentDomiciliario -> getApellido()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentDomiciliario -> getCorreo()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentDomiciliario -> getTelefono()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentDomiciliario -> getSalario()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentDomiciliario -> getRol()) . "</td>";
						echo "<td>" . ($currentDomiciliario -> getState()==1?"Habilitado":"Deshabilitado") . "</td>";
						echo "<td class='text-right' nowrap>";
						echo "<a href='modalDomiciliario.php?idDomiciliario=" . $currentDomiciliario -> getIdDomiciliario() . "'  data-toggle='modal' data-target='#modalDomiciliario' ><span class='fas fa-eye' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Ver mas información' ></span></a> ";
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/domiciliario/updateDomiciliario.php") . "&idDomiciliario=" . $currentDomiciliario -> getIdDomiciliario() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Domiciliario' ></span></a> ";
							echo "<a href='index.php?pid=" . base64_encode("ui/domiciliario/updateFotoDomiciliario.php") . "&idDomiciliario=" . $currentDomiciliario -> getIdDomiciliario() . "&attribute=foto'><span class='fas fa-camera' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar foto'></span></a> ";
						}
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/domiciliario/selectAllDomiciliario.php") . "&idDomiciliario=" . $currentDomiciliario -> getIdDomiciliario() . "&action=delete' onclick='return confirm(\"Confirm to delete Domiciliario: " . $currentDomiciliario -> getNombre() . " " . $currentDomiciliario -> getApellido() . " " . $currentDomiciliario -> getTelefono() . " " . $currentDomiciliario -> getSalario() . " " . $currentDomiciliario -> getRol() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Domiciliario' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/domicilio/selectAllDomicilioByDomiciliario.php") . "&idDomiciliario=" . $currentDomiciliario -> getIdDomiciliario() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Consultar Domicilio' ></span></a> ";
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/domicilio/insertDomicilio.php") . "&idDomiciliario=" . $currentDomiciliario -> getIdDomiciliario() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Domicilio' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
<div class="modal fade" id="modalDomiciliario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

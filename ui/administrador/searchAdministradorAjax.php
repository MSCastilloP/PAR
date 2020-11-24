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
			<th nowrap>Celular</th>
			<th nowrap>Estado</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$administrador = new Administrador();
		$administradors = $administrador -> search($_GET['search']);
		$counter = 1;
		foreach ($administradors as $currentAdministrador) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentAdministrador -> getNombre()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentAdministrador -> getApellido()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentAdministrador -> getCorreo()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentAdministrador -> getTelefono()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentAdministrador -> getCelular()) . "</td>";
						echo "<td>" . ($currentAdministrador -> getEstado()==1?"Habilitado":"Deshabilitado") . "</td>";
						echo "<td class='text-right' nowrap>";
						echo "<a href='modalAdministrador.php?idAdministrador=" . $currentAdministrador -> getIdAdministrador() . "'  data-toggle='modal' data-target='#modalAdministrador' ><span class='fas fa-eye' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Ver mas información' ></span></a> ";
					
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
<div class="modal fade" id="modalAdministrador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

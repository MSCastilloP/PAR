<!-- se usa -->
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Nombre Empresa</th>
			<th nowrap>Telefono</th>
			<th nowrap>Descripcion</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$proveedor = new Proveedor();
		$proveedors = $proveedor -> search($_GET['search']);
		$counter = 1;
		foreach ($proveedors as $currentProveedor) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentProveedor -> getNombreEmpresa()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentProveedor -> getTelefono()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentProveedor -> getDescripcion()) . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/proveedor/updateProveedor.php") . "&idProveedor=" . $currentProveedor -> getIdProveedor() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Proveedor' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/proveedor/selectAllProveedor.php") . "&idProveedor=" . $currentProveedor -> getIdProveedor() . "&action=delete' onclick='return confirm(\"Confirm to delete Proveedor: " . $currentProveedor -> getNombreEmpresa() . " " . $currentProveedor -> getTelefono() . " " . $currentProveedor -> getDescripcion() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Proveedor' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>

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
			<th nowrap>Cantidad Inicial</th>
			<th nowrap>Unidades</th>
			<th nowrap>Cantidad Final</th>
			<th>Ingrediente</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$inventario = new Inventario();
		$inventarios = $inventario -> search($_GET['search']);
		$counter = 1;
		foreach ($inventarios as $currentInventario) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentInventario -> getFecha()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentInventario -> getCantidadInicial()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentInventario -> getUnidades()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentInventario -> getCantidadFinal()) . "</td>";
			echo "<td>" . $currentInventario -> getIngrediente() -> getNombre() . " " . $currentInventario -> getIngrediente() -> getPrecio() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/inventario/updateInventario.php") . "&idInventario=" . $currentInventario -> getIdInventario() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Inventario' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/inventario/selectAllInventario.php") . "&idInventario=" . $currentInventario -> getIdInventario() . "&action=delete' onclick='return confirm(\"Confirm to delete Inventario: " . $currentInventario -> getFecha() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Inventario' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>

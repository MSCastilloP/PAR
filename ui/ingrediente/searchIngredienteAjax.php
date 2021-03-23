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
			<th nowrap>Nombre</th>
			<th nowrap>Estado</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$ingrediente = new Ingrediente();
		$ingredientes = $ingrediente -> search($_GET['search']);
		$counter = 1;
		foreach ($ingredientes as $currentIngrediente) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentIngrediente -> getNombre()) . "</td>";
			if($currentIngrediente -> getEstado() == 1){
				echo "<td> Habilitado </td>";
			}else{
				echo "<td> Deshabilitado </td>";
			}
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/ingrediente/updateIngrediente.php") . "&idIngrediente=" . $currentIngrediente -> getIdIngrediente() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Ingrediente' ></span></a> ";
						}
						
						
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>

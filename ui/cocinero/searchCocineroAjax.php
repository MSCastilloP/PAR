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
			<th nowrap>Apellido</th>
			<th nowrap>Telefono</th>
			<th nowrap>Salario</th>
			<th nowrap>Estado</th>
		</tr>
	</thead>
	</tbody>
		<?php
		$cocinero = new Cocinero();
		$cocineros = $cocinero -> search($_GET['search']);
		$counter = 1;
		foreach ($cocineros as $currentCocinero) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCocinero -> getNombre()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCocinero -> getApellido()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCocinero -> getTelefono()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCocinero -> getSalario()) . "</td>";
			if($currentCocinero -> getEstado()==1){
				echo "<td> Habilitado </td>";
			}else{
				echo "<td> Deshabilitado </td>";
			}
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/cocinero/updateCocinero.php") . "&idCocinero=" . $currentCocinero -> getIdCocinero() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Cocinero' ></span></a> ";
						}
						
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>

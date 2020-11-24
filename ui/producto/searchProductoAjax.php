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
			<th nowrap>Precio</th>
			<th nowrap>Descripcion</th>
			<th nowrap>Foto</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$producto = new Producto();
		$productos = $producto -> search($_GET['search']);
		$counter = 1;
		foreach ($productos as $currentProducto) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentProducto -> getNombre()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentProducto -> getPrecio()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentProducto -> getDescripcion()) . "</td>";
			echo "<td> <img  src=".$currentProducto -> getFoto()." height='80px' /> </td>";
			
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/producto/updateProducto.php") . "&idProducto=" . $currentProducto -> getIdProducto() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Producto' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/producto/selectAllProducto.php") . "&idProducto=" . $currentProducto -> getIdProducto() . "&action=delete' onclick='return confirm(\"Confirm to delete Producto: " . $currentProducto -> getNombre() . " " . $currentProducto -> getPrecio() . " " . $currentProducto -> getDescripcion() . " " . $currentProducto -> getFoto() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Producto' ></span></a> ";
						}
						
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>

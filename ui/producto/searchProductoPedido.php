<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
	<link href="CSS/fuentes.css" rel="stylesheet" type="text/css">
<table class="table ">

	</tbody>
		<?php
		$producto = new Producto();
		$productos = $producto -> search($_GET['search']);
		$counter = 1;
		foreach ($productos as $currentProducto) {

			echo " ";
			
		echo "<th><span class='border border-primary'> ".$counter."</th>";
			echo "<td class='padre'>  " ;
			echo "<br>";	
			echo   str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentProducto -> getNombre()) ;
			echo "<br>";
			echo "<a href='https://www.youtube.com/watch?v=dBwlYtdFOW8'>";
			echo " <img   src=".$currentProducto -> getFoto()." height='100px' /> ";
			echo "</a>";
			echo "<br>";
			echo  str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentProducto -> getDescripcion());
			echo "<br>";
			echo  str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentProducto -> getPrecio()) ;
			echo "<br>";
			//echo "<input type= 'text'>";
			
			
		
			
				echo "</td>";

				echo "</span>";
				if($counter%4==0){
echo "<tr>";
			}
	
			$counter++;
		}
		?>
	</tbody>
</table>
</div>

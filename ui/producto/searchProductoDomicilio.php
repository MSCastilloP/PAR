<!-- Se usa -->
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<script charset="utf-8">
	function cantidad( id_input, operacion){
  var numero=$('#'+id_input).val();

  if(operacion=='1'){
    numero++;
  } else if(operacion=='0'&& numero!=0){
    numero--;
  }
  $('#'+id_input).val(numero);
  }
</script>
<script type="text/javascript">
	
	function obtenerCantidad(id){
		var variable=document.getElementById(id).value;
		alert(variable);
		return	variable;
	}

</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>






<div class="table-responsive">
	<link href="CSS/fuentes.css" rel="stylesheet" >
<table class="table ">
	
	</tbody>
		<?php

		

		$producto = new Producto();
		$productos = $producto -> search($_GET['search']);
		$counter = 1;

		foreach ($productos as $currentProducto) {

			echo " ";
			
				echo "<th><span class='border border-primary'> ".$counter."</th>";
				echo "<td class=''>  " ;
				echo "<br>";	
				echo "<div class='dad row justify-content-center h-100'  >" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentProducto -> getNombre()). "</div>";
				echo "<br>";
				echo "<a href='modalCrearDomicilio.php?id=".$currentProducto->getIdProducto()."&idc=".$_GET['idc']."'";
				echo "data-toggle='modal'";
				echo "data-target='#modalCrearDomicilio'>";
				echo " <img   src=".$currentProducto -> getFoto()." height='100px' /> ";
				echo "</a>";
				echo "<br>";
				echo  str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentProducto -> getDescripcion());
				echo "<br>";
				echo  str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentProducto -> getPrecio()) ;
				echo "<br>";
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

<div class="modal fade" id="modalCrearDomicilio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

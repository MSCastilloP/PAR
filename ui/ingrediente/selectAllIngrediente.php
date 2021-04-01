<?php
//actualmente se usa
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$error = 0;

if(isset($_GET['estado'])){
	$estado = $_GET['estado'];
	$idIngre = $_GET['idIngrediente'];
	$ingrediente= new Ingrediente($idIngre,"",$estado);
	$ingrediente->updateEstado();
}

?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Consultar Ingrediente</h4>
		</div>
		
	
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th nowrap>Nombre 
						<?php if($order=="nombre" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/ingrediente/selectAllIngrediente.php") ?>&order=nombre&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="nombre" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/ingrediente/selectAllIngrediente.php") ?>&order=nombre&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Estado </th>
						<th nowrap>Accion</th>
					</tr>
				</thead>
				</tbody>
					<?php
					$ingrediente = new Ingrediente();
					if($order != "" && $dir != "") {
						$ingredientes = $ingrediente -> selectAllOrder($order, $dir);
					} else {
						$ingredientes = $ingrediente -> selectAll();
					}
					$counter = 1;
					foreach ($ingredientes as $currentIngrediente) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentIngrediente -> getNombre() . "</td>";
						if($currentIngrediente -> getEstado() == 1){
							echo "<td> Habilitado </td>";
							echo "<td nowrap>";
							if($_SESSION['entity'] == 'Cajero') {
								echo "<a href='index.php?pid=" . base64_encode("ui/ingrediente/selectAllIngrediente.php") . "&idIngrediente=" . $currentIngrediente -> getIdIngrediente() . "&estado=0'><span class='fas fa-minus-circle' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Deshabilitar' ></span></a> ";
							}
						}else{
							echo "<td> Deshabilitado </td>";
							echo "<td nowrap>";
							if($_SESSION['entity'] == 'Cajero') {
								echo "<a href='index.php?pid=" . base64_encode("ui/ingrediente/selectAllIngrediente.php") . "&idIngrediente=" . $currentIngrediente -> getIdIngrediente() . "&estado=1'><span class='fas fa-plus-circle' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Habilitar ' ></span></a> ";
							}
						}

						if($_SESSION['entity'] == 'Administrador') {
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
		</div>
	</div>
</div>
<div class="modal fade" id="modalIngrediente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

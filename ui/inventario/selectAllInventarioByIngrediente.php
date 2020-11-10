<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$ingrediente = new Ingrediente($_GET['idIngrediente']); 
$ingrediente -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteInventario = new Inventario($_GET['idInventario']);
	$deleteInventario -> select();
	if($deleteInventario -> delete()){
		$nameIngrediente = $deleteInventario -> getIngrediente() -> getNombre() . " " . $deleteInventario -> getIngrediente() -> getPrecio();
		$user_ip = getenv('REMOTE_ADDR');
		$agent = $_SERVER["HTTP_USER_AGENT"];
		$browser = "-";
		if( preg_match('/MSIE (\d+\.\d+);/', $agent) ) {
			$browser = "Internet Explorer";
		} else if (preg_match('/Chrome[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Chrome";
		} else if (preg_match('/Edge\/\d+/', $agent) ) {
			$browser = "Edge";
		} else if ( preg_match('/Firefox[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Firefox";
		} else if ( preg_match('/OPR[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Opera";
		} else if (preg_match('/Safari[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Safari";
		}
		if($_SESSION['entity'] == 'Administrador'){
			$logAdministrador = new LogAdministrador("","Delete Inventario", "Fecha: " . $deleteInventario -> getFecha() . ";; Cantidad Inicial: " . $deleteInventario -> getCantidadInicial() . ";; Unidades: " . $deleteInventario -> getUnidades() . ";; Cantidad Final: " . $deleteInventario -> getCantidadFinal() . ";; Ingrediente: " . $nameIngrediente, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrador -> insert();
		}
		else if($_SESSION['entity'] == 'Domiciliario'){
			$logDomiciliario = new LogDomiciliario("","Delete Inventario", "Fecha: " . $deleteInventario -> getFecha() . ";; Cantidad Inicial: " . $deleteInventario -> getCantidadInicial() . ";; Unidades: " . $deleteInventario -> getUnidades() . ";; Cantidad Final: " . $deleteInventario -> getCantidadFinal() . ";; Ingrediente: " . $nameIngrediente, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logDomiciliario -> insert();
		}
		else if($_SESSION['entity'] == 'Cliente'){
			$logCliente = new LogCliente("","Delete Inventario", "Fecha: " . $deleteInventario -> getFecha() . ";; Cantidad Inicial: " . $deleteInventario -> getCantidadInicial() . ";; Unidades: " . $deleteInventario -> getUnidades() . ";; Cantidad Final: " . $deleteInventario -> getCantidadFinal() . ";; Ingrediente: " . $nameIngrediente, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logCliente -> insert();
		}
		else if($_SESSION['entity'] == 'Cajero'){
			$logCajero = new LogCajero("","Delete Inventario", "Fecha: " . $deleteInventario -> getFecha() . ";; Cantidad Inicial: " . $deleteInventario -> getCantidadInicial() . ";; Unidades: " . $deleteInventario -> getUnidades() . ";; Cantidad Final: " . $deleteInventario -> getCantidadFinal() . ";; Ingrediente: " . $nameIngrediente, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logCajero -> insert();
		}
	}else{
		$error = 1;
	}
}
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Consultar Inventario de Ingrediente: <em><?php echo $ingrediente -> getNombre() . " " . $ingrediente -> getPrecio() ?></em></h4>
		</div>
		<div class="card-body">
		<?php if(isset($_GET['action']) && $_GET['action']=="delete"){ ?>
			<?php if($error == 0){ ?>
				<div class="alert alert-success" >The registry was succesfully deleted.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php } else { ?>
				<div class="alert alert-danger" >The registry was not deleted. Check it does not have related information
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php }
			} ?>
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th nowrap>Fecha 
						<?php if($order=="fecha" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/inventario/selectAllInventarioByIngrediente.php") ?>&idIngrediente=<?php echo $_GET['idIngrediente'] ?>&order=fecha&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="fecha" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/inventario/selectAllInventarioByIngrediente.php") ?>&idIngrediente=<?php echo $_GET['idIngrediente'] ?>&order=fecha&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Cantidad Inicial 
						<?php if($order=="cantidadInicial" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/inventario/selectAllInventarioByIngrediente.php") ?>&idIngrediente=<?php echo $_GET['idIngrediente'] ?>&order=cantidadInicial&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="cantidadInicial" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/inventario/selectAllInventarioByIngrediente.php") ?>&idIngrediente=<?php echo $_GET['idIngrediente'] ?>&order=cantidadInicial&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Unidades 
						<?php if($order=="unidades" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/inventario/selectAllInventarioByIngrediente.php") ?>&idIngrediente=<?php echo $_GET['idIngrediente'] ?>&order=unidades&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="unidades" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/inventario/selectAllInventarioByIngrediente.php") ?>&idIngrediente=<?php echo $_GET['idIngrediente'] ?>&order=unidades&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Cantidad Final 
						<?php if($order=="cantidadFinal" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/inventario/selectAllInventarioByIngrediente.php") ?>&idIngrediente=<?php echo $_GET['idIngrediente'] ?>&order=cantidadFinal&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="cantidadFinal" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/inventario/selectAllInventarioByIngrediente.php") ?>&idIngrediente=<?php echo $_GET['idIngrediente'] ?>&order=cantidadFinal&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th>Ingrediente</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$inventario = new Inventario("", "", "", "", "", $_GET['idIngrediente']);
					if($order!="" && $dir!="") {
						$inventarios = $inventario -> selectAllByIngredienteOrder($order, $dir);
					} else {
						$inventarios = $inventario -> selectAllByIngrediente();
					}
					$counter = 1;
					foreach ($inventarios as $currentInventario) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentInventario -> getFecha() . "</td>";
						echo "<td>" . $currentInventario -> getCantidadInicial() . "</td>";
						echo "<td>" . $currentInventario -> getUnidades() . "</td>";
						echo "<td>" . $currentInventario -> getCantidadFinal() . "</td>";
						echo "<td><a href='modalIngrediente.php?idIngrediente=" . $currentInventario -> getIngrediente() -> getIdIngrediente() . "' data-toggle='modal' data-target='#modalInventario' >" . $currentInventario -> getIngrediente() -> getNombre() . " " . $currentInventario -> getIngrediente() -> getPrecio() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/inventario/updateInventario.php") . "&idInventario=" . $currentInventario -> getIdInventario() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Inventario' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/inventario/selectAllInventarioByIngrediente.php") . "&idIngrediente=" . $_GET['idIngrediente'] . "&idInventario=" . $currentInventario -> getIdInventario() . "&action=delete' onclick='return confirm(\"Confirm to delete Inventario: " . $currentInventario -> getFecha() . "\")'> <span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Inventario' ></span></a> ";
						}
						echo "</td>";
						echo "</tr>";
						$counter++;
					};
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalInventario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

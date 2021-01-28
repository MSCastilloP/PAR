<?php
$caje= new Cajero();

$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$error = 0;
if(isset($_GET['action']) && $_GET['action']=="delete" ){
	
	$deleteCocinero = new Cocinero($_GET['idCocinero']);
	$deleteCocinero -> select();
	if($deleteCocinero -> delete()){
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
			$logAdministrador = new LogAdministrador("","Delete Cocinero", "Nombre: " . $deleteCocinero -> getNombre() . ";; Apellido: " . $deleteCocinero -> getApellido() . ";; Telefono: " . $deleteCocinero -> getTelefono() . ";; Salario: " . $deleteCocinero -> getSalario(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrador -> insert();
		}
		else if($_SESSION['entity'] == 'Domiciliario'){
			$logDomiciliario = new LogDomiciliario("","Delete Cocinero", "Nombre: " . $deleteCocinero -> getNombre() . ";; Apellido: " . $deleteCocinero -> getApellido() . ";; Telefono: " . $deleteCocinero -> getTelefono() . ";; Salario: " . $deleteCocinero -> getSalario(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logDomiciliario -> insert();
		}
		else if($_SESSION['entity'] == 'Cliente'){
			$logCliente = new LogCliente("","Delete Cocinero", "Nombre: " . $deleteCocinero -> getNombre() . ";; Apellido: " . $deleteCocinero -> getApellido() . ";; Telefono: " . $deleteCocinero -> getTelefono() . ";; Salario: " . $deleteCocinero -> getSalario(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logCliente -> insert();
		}
		else if($_SESSION['entity'] == 'Cajero'){
			$logCajero = new LogCajero("","Delete Cocinero", "Nombre: " . $deleteCocinero -> getNombre() . ";; Apellido: " . $deleteCocinero -> getApellido() . ";; Telefono: " . $deleteCocinero -> getTelefono() . ";; Salario: " . $deleteCocinero -> getSalario(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logCajero -> insert();
		}
	}
}else if(isset($_GET['action']) && $_GET['action']=="check"){
	$id=$_GET['id'];
	$nombre=$_GET['nombre'];
	
	$fecha =  date("Y-m-d");
	$caj= new Cajero();
	$caj->asistencia($id,$nombre,$fecha);

}else{
		$error = 1;
	}
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Consultar Cocinero</h4>
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


			<?php if($_SESSION['entity'] == 'Administrador') { ?>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th nowrap>Nombre 
						<?php if($order=="nombre" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cocinero/selectAllCocinero.php") ?>&order=nombre&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="nombre" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cocinero/selectAllCocinero.php") ?>&order=nombre&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Apellido 
						<?php if($order=="apellido" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cocinero/selectAllCocinero.php") ?>&order=apellido&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="apellido" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cocinero/selectAllCocinero.php") ?>&order=apellido&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Telefono 
						<?php if($order=="telefono" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cocinero/selectAllCocinero.php") ?>&order=telefono&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="telefono" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cocinero/selectAllCocinero.php") ?>&order=telefono&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Salario 
						<?php if($order=="salario" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cocinero/selectAllCocinero.php") ?>&order=salario&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="salario" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cocinero/selectAllCocinero.php") ?>&order=salario&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
			<?php } else if($_SESSION['entity'] == 'Cajero')  {?>
			<div class="table-responsive">
			<table class="table table-striped table-hover">
			<thead>
				<th> </th>
				<th>Nombre</th>
				<th>Rol</th>
				<th>Servicio</th>

			</thead>
			</tbody>	
			</div>	



			<?php } ?>	
					<?php
					$cocinero = new Cocinero();
					$domiciliario= new Domiciliario();

					if($order != "" && $dir != "") {
						$cocineros = $cocinero -> selectAllOrder($order, $dir);
						$domiciliario = $domiciliario ->selectAllOrder($order, $dir);
					} else {
						$cocineros = $cocinero -> selectAll();
						$domiciliario = $domiciliario ->selectAll();
			}
					$counter = 1;
					if($_SESSION['entity'] == 'Administrador') {
					foreach ($cocineros as $currentCocinero) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentCocinero -> getNombre() . "</td>";
						echo "<td>" . $currentCocinero -> getApellido() . "</td>";
						echo "<td>" . $currentCocinero -> getTelefono() . "</td>";
						echo "<td>" . $currentCocinero -> getSalario() . "</td>";
						echo "<td class='text-right' nowrap>";

							echo "<a href='index.php?pid=" . base64_encode("ui/cocinero/updateCocinero.php") . "&idCocinero=" . $currentCocinero -> getIdCocinero() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Cocinero' ></span></a> ";
						
					
							echo "<a href='index.php?pid=" . base64_encode("ui/cocinero/selectAllCocinero.php") . "&idCocinero=" . $currentCocinero -> getIdCocinero() . "&action=delete' onclick='return confirm(\"Confirma eliminar Cocinero: " . $currentCocinero -> getNombre() . " " . $currentCocinero -> getApellido() . " " . $currentCocinero -> getTelefono() . " " . $currentCocinero -> getSalario() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Cocinero' ></span></a> ";
						
						echo "</td>";
						echo "</tr>";
						$counter++;

						 }

						
					}else if($_SESSION['entity'] == 'Cajero'){
						foreach ($cocineros as $currentCocinero) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentCocinero -> getNombre()." ". $currentCocinero -> getApellido() . "</td>";
						echo "<td>Cocinero</td>";
						if($caje->verificarAsist($currentCocinero->getIdCocinero(),date("Y-m-d"))==0){
							echo "<td ><a href='index.php?pid=" . base64_encode("ui/cocinero/selectAllCocinero.php") . "&id=" . $currentCocinero -> getIdCocinero() . "&action=check&nombre=".$currentCocinero -> getNombre().$currentCocinero -> getApellido()."' onclick='return confirm(\"Confirma que esta Trabajando " . $currentCocinero -> getNombre() . " " . $currentCocinero -> getApellido() . "\")'><span class='fas fa-check' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='check'></span></a> </td>";
						}else{
							echo "<td ><a ><span  class='fas fa-times'></span></a> </td>";
						}
						
						
						echo "<td class='text-right' nowrap>";

							echo "</td>";
							echo "</tr>";
							$counter++;
						 }
						 foreach ($domiciliario as $currentDomiciliario) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentDomiciliario -> getNombre() ." ". $currentDomiciliario -> getApellido(). "</td>";
						echo "<td> Domiciliario </td>";

						$fecha=date("Y-m-d");
						if($caje->verificarAsist($currentDomiciliario->getIdDomiciliario(),$fecha)==0){
						echo "<td ><a href='index.php?pid=" . base64_encode("ui/cocinero/selectAllCocinero.php") . "&id=" . $currentDomiciliario -> getIdDomiciliario() . "&action=check&nombre=".$currentDomiciliario -> getNombre()."&apellido=".$currentDomiciliario -> getApellido()."' onclick='return confirm(\"Confirma que esta Trabajando " . $currentDomiciliario -> getNombre() . " " . $currentDomiciliario -> getApellido() . "\")'><span class='fas fa-check' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='check'></span></a> </td>";
						 }else{
						 	echo "<td ><a ><span  class='fas fa-times'></span></a> </td>";
						 }
					
						echo "<td class='text-right' nowrap>";

							echo "</td>";
							echo "</tr>";
							$counter++;
						 }


					}
					?>

				</tbody>
			</table>
			</div>
		</div>
	</div>

</div>
<div class="modal fade" id="modalCocinero" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

	function verificar(){


	}
</script>

<?php
$order = "apellido";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "asc";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$error = 0;
if(isset($_GET['action']) && $_GET['action']=="delete"){
	$deleteCajero = new Cajero($_GET['idCajero']);
	$deleteCajero -> select();
	if($deleteCajero -> delete()){
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
			$logAdministrador = new LogAdministrador("","Delete Cajero", "Nombre: " . $deleteCajero -> getNombre() . ";; Apellido: " . $deleteCajero -> getApellido() . ";; Correo: " . $deleteCajero -> getCorreo() . ";; Clave: " . $deleteCajero -> getClave() . ";; Salario: " . $deleteCajero -> getSalario() . ";; Telefono: " . $deleteCajero -> getTelefono() . ";; Rol: " . $deleteCajero -> getRol() . ";; State: " . $deleteCajero -> getState(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrador -> insert();
		}
		else if($_SESSION['entity'] == 'Domiciliario'){
			$logDomiciliario = new LogDomiciliario("","Delete Cajero", "Nombre: " . $deleteCajero -> getNombre() . ";; Apellido: " . $deleteCajero -> getApellido() . ";; Correo: " . $deleteCajero -> getCorreo() . ";; Clave: " . $deleteCajero -> getClave() . ";; Salario: " . $deleteCajero -> getSalario() . ";; Telefono: " . $deleteCajero -> getTelefono() . ";; Rol: " . $deleteCajero -> getRol() . ";; State: " . $deleteCajero -> getState(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logDomiciliario -> insert();
		}
		else if($_SESSION['entity'] == 'Cliente'){
			$logCliente = new LogCliente("","Delete Cajero", "Nombre: " . $deleteCajero -> getNombre() . ";; Apellido: " . $deleteCajero -> getApellido() . ";; Correo: " . $deleteCajero -> getCorreo() . ";; Clave: " . $deleteCajero -> getClave() . ";; Salario: " . $deleteCajero -> getSalario() . ";; Telefono: " . $deleteCajero -> getTelefono() . ";; Rol: " . $deleteCajero -> getRol() . ";; State: " . $deleteCajero -> getState(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logCliente -> insert();
		}
		else if($_SESSION['entity'] == 'Cajero'){
			$logCajero = new LogCajero("","Delete Cajero", "Nombre: " . $deleteCajero -> getNombre() . ";; Apellido: " . $deleteCajero -> getApellido() . ";; Correo: " . $deleteCajero -> getCorreo() . ";; Clave: " . $deleteCajero -> getClave() . ";; Salario: " . $deleteCajero -> getSalario() . ";; Telefono: " . $deleteCajero -> getTelefono() . ";; Rol: " . $deleteCajero -> getRol() . ";; State: " . $deleteCajero -> getState(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
			<h4 class="card-title">Consultar Cajero</h4>
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
						<th nowrap>Nombre 
						<?php if($order=="nombre" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cajero/selectAllCajero.php") ?>&order=nombre&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="nombre" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cajero/selectAllCajero.php") ?>&order=nombre&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Apellido 
						<?php if($order=="apellido" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cajero/selectAllCajero.php") ?>&order=apellido&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="apellido" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cajero/selectAllCajero.php") ?>&order=apellido&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Correo 
						<?php if($order=="correo" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cajero/selectAllCajero.php") ?>&order=correo&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="correo" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cajero/selectAllCajero.php") ?>&order=correo&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Salario 
						<?php if($order=="salario" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cajero/selectAllCajero.php") ?>&order=salario&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="salario" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cajero/selectAllCajero.php") ?>&order=salario&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Telefono 
						<?php if($order=="telefono" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cajero/selectAllCajero.php") ?>&order=telefono&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="telefono" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cajero/selectAllCajero.php") ?>&order=telefono&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Rol 
						<?php if($order=="rol" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cajero/selectAllCajero.php") ?>&order=rol&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="rol" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cajero/selectAllCajero.php") ?>&order=rol&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>State 
						<?php if($order=="state" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cajero/selectAllCajero.php") ?>&order=state&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="state" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/cajero/selectAllCajero.php") ?>&order=state&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$cajero = new Cajero();
					if($order != "" && $dir != "") {
						$cajeros = $cajero -> selectAllOrder($order, $dir);
					} else {
						$cajeros = $cajero -> selectAll();
					}
					$counter = 1;
					foreach ($cajeros as $currentCajero) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentCajero -> getNombre() . "</td>";
						echo "<td>" . $currentCajero -> getApellido() . "</td>";
						echo "<td>" . $currentCajero -> getCorreo() . "</td>";
						echo "<td>" . $currentCajero -> getSalario() . "</td>";
						echo "<td>" . $currentCajero -> getTelefono() . "</td>";
						echo "<td>" . $currentCajero -> getRol() . "</td>";
						echo "<td>" . ($currentCajero -> getState()==1?"Habilitado":"Deshabilitado") . "</td>";
						echo "<td class='text-right' nowrap>";
						echo "<a href='modalCajero.php?idCajero=" . $currentCajero -> getIdCajero() . "'  data-toggle='modal' data-target='#modalCajero' ><span class='fas fa-eye' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Ver mas información' ></span></a> ";
						if($_SESSION['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/cajero/updateCajero.php") . "&idCajero=" . $currentCajero -> getIdCajero() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Cajero' ></span></a> ";
							echo "<a href='index.php?pid=" . base64_encode("ui/cajero/updateFotoCajero.php") . "&idCajero=" . $currentCajero -> getIdCajero() . "&attribute=foto'><span class='fas fa-camera' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar foto'></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/cajero/selectAllCajero.php") . "&idCajero=" . $currentCajero -> getIdCajero() . "&action=delete' onclick='return confirm(\"Confirma eliminar Cajero: " . $currentCajero -> getNombre() . " " . $currentCajero -> getApellido() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Cajero' ></span></a> ";
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
<div class="modal fade" id="modalCajero" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

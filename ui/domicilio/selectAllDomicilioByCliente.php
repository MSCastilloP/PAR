<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$cliente = new Cliente($_GET['idCliente']); 
$cliente -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteDomicilio = new Domicilio($_GET['idDomicilio']);
	$deleteDomicilio -> select();
	if($deleteDomicilio -> delete()){
		$nameDomiciliario = $deleteDomicilio -> getDomiciliario() -> getNombre() . " " . $deleteDomicilio -> getDomiciliario() -> getApellido() . " " . $deleteDomicilio -> getDomiciliario() -> getTelefono() . " " . $deleteDomicilio -> getDomiciliario() -> getSalario() . " " . $deleteDomicilio -> getDomiciliario() -> getRol();
		$nameCliente = $deleteDomicilio -> getCliente() -> getNombre() . " " . $deleteDomicilio -> getCliente() -> getApellido() . " " . $deleteDomicilio -> getCliente() -> getTelefono() . " " . $deleteDomicilio -> getCliente() -> getDireccion();
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
			$logAdministrador = new LogAdministrador("","Delete Domicilio", "Direccion: " . $deleteDomicilio -> getDireccion() . ";; Fecha: " . $deleteDomicilio -> getFecha() . ";; Hora: " . $deleteDomicilio -> getHora() . ";; Precio: " . $deleteDomicilio -> getPrecio() . ";; Descripcion: " . $deleteDomicilio -> getDescripcion() . ";; Cocinando: " . $deleteDomicilio -> getCocinando() . ";; Domiciliario: " . $nameDomiciliario . ";; Cliente: " . $nameCliente, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrador -> insert();
		}
		else if($_SESSION['entity'] == 'Domiciliario'){
			$logDomiciliario = new LogDomiciliario("","Delete Domicilio", "Direccion: " . $deleteDomicilio -> getDireccion() . ";; Fecha: " . $deleteDomicilio -> getFecha() . ";; Hora: " . $deleteDomicilio -> getHora() . ";; Precio: " . $deleteDomicilio -> getPrecio() . ";; Descripcion: " . $deleteDomicilio -> getDescripcion() . ";; Cocinando: " . $deleteDomicilio -> getCocinando() . ";; Domiciliario: " . $nameDomiciliario . ";; Cliente: " . $nameCliente, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logDomiciliario -> insert();
		}
		else if($_SESSION['entity'] == 'Cliente'){
			$logCliente = new LogCliente("","Delete Domicilio", "Direccion: " . $deleteDomicilio -> getDireccion() . ";; Fecha: " . $deleteDomicilio -> getFecha() . ";; Hora: " . $deleteDomicilio -> getHora() . ";; Precio: " . $deleteDomicilio -> getPrecio() . ";; Descripcion: " . $deleteDomicilio -> getDescripcion() . ";; Cocinando: " . $deleteDomicilio -> getCocinando() . ";; Domiciliario: " . $nameDomiciliario . ";; Cliente: " . $nameCliente, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logCliente -> insert();
		}
		else if($_SESSION['entity'] == 'Cajero'){
			$logCajero = new LogCajero("","Delete Domicilio", "Direccion: " . $deleteDomicilio -> getDireccion() . ";; Fecha: " . $deleteDomicilio -> getFecha() . ";; Hora: " . $deleteDomicilio -> getHora() . ";; Precio: " . $deleteDomicilio -> getPrecio() . ";; Descripcion: " . $deleteDomicilio -> getDescripcion() . ";; Cocinando: " . $deleteDomicilio -> getCocinando() . ";; Domiciliario: " . $nameDomiciliario . ";; Cliente: " . $nameCliente, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
			<h4 class="card-title">Consultar Domicilio de Cliente: <em><?php echo $cliente -> getNombre() . " " . $cliente -> getApellido() . " " . $cliente -> getTelefono() . " " . $cliente -> getDireccion() ?></em></h4>
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
						<th nowrap>Direccion 
						<?php if($order=="direccion" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilioByCliente.php") ?>&idCliente=<?php echo $_GET['idCliente'] ?>&order=direccion&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="direccion" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilioByCliente.php") ?>&idCliente=<?php echo $_GET['idCliente'] ?>&order=direccion&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Fecha 
						<?php if($order=="fecha" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilioByCliente.php") ?>&idCliente=<?php echo $_GET['idCliente'] ?>&order=fecha&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="fecha" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilioByCliente.php") ?>&idCliente=<?php echo $_GET['idCliente'] ?>&order=fecha&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Hora 
						<?php if($order=="hora" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilioByCliente.php") ?>&idCliente=<?php echo $_GET['idCliente'] ?>&order=hora&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="hora" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilioByCliente.php") ?>&idCliente=<?php echo $_GET['idCliente'] ?>&order=hora&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Precio 
						<?php if($order=="precio" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilioByCliente.php") ?>&idCliente=<?php echo $_GET['idCliente'] ?>&order=precio&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="precio" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilioByCliente.php") ?>&idCliente=<?php echo $_GET['idCliente'] ?>&order=precio&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Descripcion 
						<?php if($order=="descripcion" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilioByCliente.php") ?>&idCliente=<?php echo $_GET['idCliente'] ?>&order=descripcion&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="descripcion" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilioByCliente.php") ?>&idCliente=<?php echo $_GET['idCliente'] ?>&order=descripcion&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Cocinando 
						<?php if($order=="cocinando" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilioByCliente.php") ?>&idCliente=<?php echo $_GET['idCliente'] ?>&order=cocinando&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="cocinando" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilioByCliente.php") ?>&idCliente=<?php echo $_GET['idCliente'] ?>&order=cocinando&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th>Domiciliario</th>
						<th>Cliente</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$domicilio = new Domicilio("", "", "", "", "", "", "", "", $_GET['idCliente']);
					if($order!="" && $dir!="") {
						$domicilios = $domicilio -> selectAllByClienteOrder($order, $dir);
					} else {
						$domicilios = $domicilio -> selectAllByCliente();
					}
					$counter = 1;
					foreach ($domicilios as $currentDomicilio) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentDomicilio -> getDireccion() . "</td>";
						echo "<td>" . $currentDomicilio -> getFecha() . "</td>";
						echo "<td>" . $currentDomicilio -> getHora() . "</td>";
						echo "<td>" . $currentDomicilio -> getPrecio() . "</td>";
						echo "<td>" . $currentDomicilio -> getDescripcion() . "</td>";
						echo "<td>" . $currentDomicilio -> getCocinando() . "</td>";
						echo "<td><a href='modalDomiciliario.php?idDomiciliario=" . $currentDomicilio -> getDomiciliario() -> getIdDomiciliario() . "' data-toggle='modal' data-target='#modalDomicilio' >" . $currentDomicilio -> getDomiciliario() -> getNombre() . " " . $currentDomicilio -> getDomiciliario() -> getApellido() . " " . $currentDomicilio -> getDomiciliario() -> getTelefono() . " " . $currentDomicilio -> getDomiciliario() -> getSalario() . " " . $currentDomicilio -> getDomiciliario() -> getRol() . "</a></td>";
						echo "<td><a href='modalCliente.php?idCliente=" . $currentDomicilio -> getCliente() -> getIdCliente() . "' data-toggle='modal' data-target='#modalDomicilio' >" . $currentDomicilio -> getCliente() -> getNombre() . " " . $currentDomicilio -> getCliente() -> getApellido() . " " . $currentDomicilio -> getCliente() -> getTelefono() . " " . $currentDomicilio -> getCliente() -> getDireccion() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrador' || $_SESSION['entity'] == 'Cliente') {
							echo "<a href='index.php?pid=" . base64_encode("ui/domicilio/updateDomicilio.php") . "&idDomicilio=" . $currentDomicilio -> getIdDomicilio() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Domicilio' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrador' || $_SESSION['entity'] == 'Cliente') {
							echo "<a href='index.php?pid=" . base64_encode("ui/domicilio/selectAllDomicilioByCliente.php") . "&idCliente=" . $_GET['idCliente'] . "&idDomicilio=" . $currentDomicilio -> getIdDomicilio() . "&action=delete' onclick='return confirm(\"Confirm to delete Domicilio: " . $currentDomicilio -> getDireccion() . " " . $currentDomicilio -> getCocinando() . "\")'> <span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Domicilio' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/proDom/selectAllProDomByDomicilio.php") . "&idDomicilio=" . $currentDomicilio -> getIdDomicilio() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Consultar Pro Dom' ></span></a> ";
						if($_SESSION['entity'] == 'Administrador' || $_SESSION['entity'] == 'Cliente') {
							echo "<a href='index.php?pid=" . base64_encode("ui/proDom/insertProDom.php") . "&idDomicilio=" . $currentDomicilio -> getIdDomicilio() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Pro Dom' ></span></a> ";
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
<div class="modal fade" id="modalDomicilio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

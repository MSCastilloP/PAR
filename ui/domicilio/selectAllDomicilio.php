<!-- Se usa -->
<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$error = 0;

if(isset($_GET['idpro']) && isset($_GET['idDomicilio'])){
	$objDom = new Domicilio($_GET['idDomicilio']);
	$objDom->select();

	echo "<script type='text/javascript'>
	function eliminar(hora){
	const database = firebase.database();
	const rootRef = database.ref('Pedidos');
	rootRef.child(hora).remove();
}
eliminar('".$objDom->getHora()."');

				
</script>";


}
if(isset($_GET['action']) && $_GET['action']=="delete"){

	$deleteDomicilio = new Domicilio($_GET['idDomicilio']);
	$deleteDomicilio -> select();
	$pedo= new ProDom("",$_GET['idDomicilio']);
	$var=$pedo-> traerProductos();
	
	$objDom = new Domicilio($_GET['idDomicilio']);
	$objDom->select();

	echo "<script type='text/javascript'>
	function eliminar(hora){
	const database = firebase.database();
	const rootRef = database.ref('Pedidos');
	rootRef.child(hora).remove();
	}
	eliminar('".$objDom->getHora()."');

				
</script>";
		# code...	
	
	$pedo->deletePedo();








	
$c=$deleteDomicilio -> getCocinando();
	if($deleteDomicilio -> delete($c)){
		$nameDomiciliario = $deleteDomicilio -> getDomiciliario() -> getNombre() . " " . $deleteDomicilio -> getDomiciliario() -> getApellido() . " " . $deleteDomicilio -> getDomiciliario() -> getTelefono() . " " . $deleteDomicilio -> getDomiciliario() -> getSalario() ;

		$nameCliente = $deleteDomicilio -> getCliente() -> getNombre() . " " . $deleteDomicilio -> getCliente() -> getApellido().  " " . $deleteDomicilio -> getCliente() -> getTelefono() . " " . $deleteDomicilio -> getCliente() -> getDireccion();
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
			<h4 class="card-title">Consultar Domicilio</h4>
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
							<a href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilio.php") ?>&order=direccion&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="direccion" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilio.php") ?>&order=direccion&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Fecha 
						<?php if($order=="fecha" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilio.php") ?>&order=fecha&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="fecha" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilio.php") ?>&order=fecha&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Hora 
						<?php if($order=="hora" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilio.php") ?>&order=hora&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="hora" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilio.php") ?>&order=hora&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Precio 
						<?php if($order=="precio" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilio.php") ?>&order=precio&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="precio" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilio.php") ?>&order=precio&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Descripcion 
						<?php if($order=="descripcion" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilio.php") ?>&order=descripcion&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="descripcion" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilio.php") ?>&order=descripcion&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Cocinando 
						<?php if($order=="cocinando" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilio.php") ?>&order=cocinando&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="cocinando" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilio.php") ?>&order=cocinando&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th>Domiciliario</th>
						
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$domicilio = new Domicilio();
					if($order != "" && $dir != "") {
						$domicilios = $domicilio -> selectAllOrder($order, $dir);
					} else {
						$domicilios = $domicilio -> selectAll();
					}
					$counter = 1;
					foreach ($domicilios as $currentDomicilio) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentDomicilio -> getDireccion() . "</td>";
						echo "<td>" . $currentDomicilio -> getFecha() . "</td>";
						echo "<td>" . $currentDomicilio -> getHora() . "</td>";
						echo "<td>" . $currentDomicilio -> getPrecio() . "</td>";
						echo "<td>" . $currentDomicilio -> getDescripcion() . "</td>";
						if($currentDomicilio -> getCocinando()==1){
							echo "<td>En cola </td>";


						}else if($currentDomicilio -> getCocinando()==2){
							echo "<td>Cocinando...</td>";

						}else if($currentDomicilio -> getCocinando()==3){
							echo "<td>Domicilio preparado!</td>";
						}
						else if($currentDomicilio -> getCocinando()==4){
							echo "<td>Domiciliario en camino </td>";
						}
						
						if($currentDomicilio -> getDomiciliario() -> getIdDomiciliario()!=0){
							echo "<td><a href='modalDomiciliario.php?idDomiciliario=" . $currentDomicilio -> getDomiciliario() -> getIdDomiciliario() . "' data-toggle='modal' data-target='#modalDomicilio' >" . $currentDomicilio -> getDomiciliario() -> getNombre() . " " . $currentDomicilio -> getDomiciliario() -> getApellido() . " " . $currentDomicilio -> getDomiciliario() -> getTelefono() . " " . $currentDomicilio -> getDomiciliario() -> getSalario() . "</a></td>";
						
						}else{
							echo "<td>Domiciliario por asignar</td>";
						}
						echo "<td class='text-right' nowrap>";
						if(  $currentDomicilio -> getCocinando()==1) {
							echo "<a href='index.php?pid=" . base64_encode("ui/domicilio/updateDomicilio.php") . "&idDomicilio=" . $currentDomicilio -> getIdDomicilio() . "&idp=0'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Domicilio' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrador' || $_SESSION['entity'] == 'Cliente') {
							echo "<a href='index.php?pid=" . base64_encode("ui/domicilio/selectAllDomicilio.php") . "&idDomicilio=" . $currentDomicilio -> getIdDomicilio() . "&action=delete' onclick='return confirm(\"Confirma eliminar Domicilio: " . $currentDomicilio -> getDireccion() . " " . $currentDomicilio -> getCocinando() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Domicilio' ></span></a> ";
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

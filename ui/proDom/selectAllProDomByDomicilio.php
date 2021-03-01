
<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$domicilio = new Domicilio($_GET['idDomicilio']); 
$domicilio -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteProDom = new ProDom($_GET['idProDom']);
	$deleteProDom -> select();
	if($deleteProDom -> delete()){
		$nameDomicilio = $deleteProDom -> getDomicilio() -> getDireccion() . " " . $deleteProDom -> getDomicilio() -> getCocinando();
		$nameProducto = $deleteProDom -> getProducto() -> getNombre() . " " . $deleteProDom -> getProducto() -> getPrecio() . " " . $deleteProDom -> getProducto() -> getDescripcion() . " " . $deleteProDom -> getProducto() -> getFoto();
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
			$logAdministrador = new LogAdministrador("","Delete Pro Dom", "Domicilio: " . $nameDomicilio . ";; Producto: " . $nameProducto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrador -> insert();
		}
		else if($_SESSION['entity'] == 'Domiciliario'){
			$logDomiciliario = new LogDomiciliario("","Delete Pro Dom", "Domicilio: " . $nameDomicilio . ";; Producto: " . $nameProducto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logDomiciliario -> insert();
		}
		else if($_SESSION['entity'] == 'Cliente'){
			$logCliente = new LogCliente("","Delete Pro Dom", "Domicilio: " . $nameDomicilio . ";; Producto: " . $nameProducto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logCliente -> insert();
		}
		else if($_SESSION['entity'] == 'Cajero'){
			$logCajero = new LogCajero("","Delete Pro Dom", "Domicilio: " . $nameDomicilio . ";; Producto: " . $nameProducto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
			<h4 class="card-title">Consultar Pro Dom de Domicilio: <em><?php echo $domicilio -> getDireccion() . " " . $domicilio -> getCocinando() ?></em></h4>
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
						<th>Domicilio</th>
						<th>Producto</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$proDom = new ProDom("", $_GET['idDomicilio'], "");
					if($order!="" && $dir!="") {
						$proDoms = $proDom -> selectAllByDomicilioOrder($order, $dir);
					} else {
						$proDoms = $proDom -> selectAllByDomicilio();
					}
					$counter = 1;
					foreach ($proDoms as $currentProDom) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td><a href='modalDomicilio.php?idDomicilio=" . $currentProDom -> getDomicilio() -> getIdDomicilio() . "' data-toggle='modal' data-target='#modalProDom' >" . $currentProDom -> getDomicilio() -> getDireccion() . " " . $currentProDom -> getDomicilio() -> getCocinando() . "</a></td>";
						echo "<td><a href='modalProducto.php?idProducto=" . $currentProDom -> getProducto() -> getIdProducto() . "' data-toggle='modal' data-target='#modalProDom' >" . $currentProDom -> getProducto() -> getNombre() . " " . $currentProDom -> getProducto() -> getPrecio() . " " . $currentProDom -> getProducto() -> getDescripcion() . " " . $currentProDom -> getProducto() -> getFoto() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/proDom/updateProDom.php") . "&idProDom=" . $currentProDom -> getIdProDom() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Pro Dom' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/proDom/selectAllProDomByDomicilio.php") . "&idDomicilio=" . $_GET['idDomicilio'] . "&idProDom=" . $currentProDom -> getIdProDom() . "&action=delete' onclick='return confirm(\"Confirm to delete Pro Dom\")'> <span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Pro Dom' ></span></a> ";
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
<div class="modal fade" id="modalProDom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

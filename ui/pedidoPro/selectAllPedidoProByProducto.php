<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$producto = new Producto($_GET['idProducto']); 
$producto -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deletePedidoPro = new PedidoPro($_GET['idPedidoPro']);
	$deletePedidoPro -> select();
	if($deletePedidoPro -> delete()){
		$namePedido = $deletePedidoPro -> getPedido() -> getDescripcion() . " " . $deletePedidoPro -> getPedido() -> getPrecio() . " " . $deletePedidoPro -> getPedido() -> getCocinando();
		$nameProducto = $deletePedidoPro -> getProducto() -> getNombre() . " " . $deletePedidoPro -> getProducto() -> getPrecio() . " " . $deletePedidoPro -> getProducto() -> getDescripcion() . " " . $deletePedidoPro -> getProducto() -> getFoto();
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
			$logAdministrador = new LogAdministrador("","Delete Pedido Pro", "Pedido: " . $namePedido . ";; Producto: " . $nameProducto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrador -> insert();
		}
		else if($_SESSION['entity'] == 'Domiciliario'){
			$logDomiciliario = new LogDomiciliario("","Delete Pedido Pro", "Pedido: " . $namePedido . ";; Producto: " . $nameProducto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logDomiciliario -> insert();
		}
		else if($_SESSION['entity'] == 'Cliente'){
			$logCliente = new LogCliente("","Delete Pedido Pro", "Pedido: " . $namePedido . ";; Producto: " . $nameProducto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logCliente -> insert();
		}
		else if($_SESSION['entity'] == 'Cajero'){
			$logCajero = new LogCajero("","Delete Pedido Pro", "Pedido: " . $namePedido . ";; Producto: " . $nameProducto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
			<h4 class="card-title">Consultar Pedido Pro de Producto: <em><?php echo $producto -> getNombre() . " " . $producto -> getPrecio() . " " . $producto -> getDescripcion() . " " . $producto -> getFoto() ?></em></h4>
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
						<th>Pedido</th>
						<th>Producto</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$pedidoPro = new PedidoPro("", "", $_GET['idProducto']);
					if($order!="" && $dir!="") {
						$pedidoPros = $pedidoPro -> selectAllByProductoOrder($order, $dir);
					} else {
						$pedidoPros = $pedidoPro -> selectAllByProducto();
					}
					$counter = 1;
					foreach ($pedidoPros as $currentPedidoPro) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td><a href='modalPedido.php?idPedido=" . $currentPedidoPro -> getPedido() -> getIdPedido() . "' data-toggle='modal' data-target='#modalPedidoPro' >" . $currentPedidoPro -> getPedido() -> getDescripcion() . " " . $currentPedidoPro -> getPedido() -> getPrecio() . " " . $currentPedidoPro -> getPedido() -> getCocinando() . "</a></td>";
						echo "<td><a href='modalProducto.php?idProducto=" . $currentPedidoPro -> getProducto() -> getIdProducto() . "' data-toggle='modal' data-target='#modalPedidoPro' >" . $currentPedidoPro -> getProducto() -> getNombre() . " " . $currentPedidoPro -> getProducto() -> getPrecio() . " " . $currentPedidoPro -> getProducto() -> getDescripcion() . " " . $currentPedidoPro -> getProducto() -> getFoto() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/pedidoPro/updatePedidoPro.php") . "&idPedidoPro=" . $currentPedidoPro -> getIdPedidoPro() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Pedido Pro' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/pedidoPro/selectAllPedidoProByProducto.php") . "&idProducto=" . $_GET['idProducto'] . "&idPedidoPro=" . $currentPedidoPro -> getIdPedidoPro() . "&action=delete' onclick='return confirm(\"Confirm to delete Pedido Pro\")'> <span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Pedido Pro' ></span></a> ";
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
<div class="modal fade" id="modalPedidoPro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

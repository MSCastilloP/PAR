<?php
$processed=false;
$pedido="";
if(isset($_POST['pedido'])){
	$pedido=$_POST['pedido'];
}
if(isset($_GET['idPedido'])){
	$pedido=$_GET['idPedido'];
}
$producto="";
if(isset($_POST['producto'])){
	$producto=$_POST['producto'];
}
if(isset($_GET['idProducto'])){
	$producto=$_GET['idProducto'];
}
if(isset($_POST['insert'])){
	$newPedidoPro = new PedidoPro("", $pedido, $producto);
	$newPedidoPro -> insert();
	$objPedido = new Pedido($pedido);
	$objPedido -> select();
	$namePedido = $objPedido -> getDescripcion() . " " . $objPedido -> getPrecio() . " " . $objPedido -> getCocinando() ;
	$objProducto = new Producto($producto);
	$objProducto -> select();
	$nameProducto = $objProducto -> getNombre() . " " . $objProducto -> getPrecio() . " " . $objProducto -> getDescripcion() . " " . $objProducto -> getFoto() ;
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
		$logAdministrador = new LogAdministrador("","Crear Pedido Pro", "Pedido: " . $namePedido . ";; Producto: " . $nameProducto , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrador -> insert();
	}
	else if($_SESSION['entity'] == 'Domiciliario'){
		$logDomiciliario = new LogDomiciliario("","Crear Pedido Pro", "Pedido: " . $namePedido . ";; Producto: " . $nameProducto , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logDomiciliario -> insert();
	}
	else if($_SESSION['entity'] == 'Cliente'){
		$logCliente = new LogCliente("","Crear Pedido Pro", "Pedido: " . $namePedido . ";; Producto: " . $nameProducto , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logCliente -> insert();
	}
	else if($_SESSION['entity'] == 'Cajero'){
		$logCajero = new LogCajero("","Crear Pedido Pro", "Pedido: " . $namePedido . ";; Producto: " . $nameProducto , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logCajero -> insert();
	}
	$processed=true;
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Crear Pedido Pro</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Ingresados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/pedidoPro/insertPedidoPro.php") ?>" class="bootstrap-form needs-validation"   >
					<div class="form-group">
						<label>Pedido*</label>
						<select class="form-control" name="pedido">
							<?php
							$objPedido = new Pedido();
							$pedidos = $objPedido -> selectAllOrder("descripcion", "asc");
							foreach($pedidos as $currentPedido){
								echo "<option value='" . $currentPedido -> getIdPedido() . "'";
								if($currentPedido -> getIdPedido() == $pedido){
									echo " selected";
								}
								echo ">" . $currentPedido -> getDescripcion() . " " . $currentPedido -> getPrecio() . " " . $currentPedido -> getCocinando() . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Producto*</label>
						<select class="form-control" name="producto">
							<?php
							$objProducto = new Producto();
							$productos = $objProducto -> selectAllOrder("nombre", "asc");
							foreach($productos as $currentProducto){
								echo "<option value='" . $currentProducto -> getIdProducto() . "'";
								if($currentProducto -> getIdProducto() == $producto){
									echo " selected";
								}
								echo ">" . $currentProducto -> getNombre() . " " . $currentProducto -> getPrecio() . " " . $currentProducto -> getDescripcion() . " " . $currentProducto -> getFoto() . "</option>";
							}
							?>
						</select>
					</div>
						<button type="submit" class="btn btn-info" name="insert">Crear</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

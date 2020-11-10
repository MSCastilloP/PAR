<?php
$processed=false;
$fecha=date("d/m/Y");
if(isset($_POST['fecha'])){
	$fecha=$_POST['fecha'];
}
$hora=date("d/m/Y");
if(isset($_POST['hora'])){
	$hora=$_POST['hora'];
}
$descripcion="";
if(isset($_POST['descripcion'])){
	$descripcion=$_POST['descripcion'];
}
$precio="";
if(isset($_POST['precio'])){
	$precio=$_POST['precio'];
}
$cocinando="";
if(isset($_POST['cocinando'])){
	$cocinando=$_POST['cocinando'];
}
$cajero="";
if(isset($_POST['cajero'])){
	$cajero=$_POST['cajero'];
}
if(isset($_GET['idCajero'])){
	$cajero=$_GET['idCajero'];
}
if(isset($_POST['insert'])){
	$newPedido = new Pedido("", $fecha, $hora, $descripcion, $precio, $cocinando, $cajero);
	$newPedido -> insert();
	$objCajero = new Cajero($cajero);
	$objCajero -> select();
	$nameCajero = $objCajero -> getNombre() . " " . $objCajero -> getApellido() ;
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
		$logAdministrador = new LogAdministrador("","Crear Pedido", "Fecha: " . $fecha . "; Hora: " . $hora . "; Descripcion: " . $descripcion . "; Precio: " . $precio . "; Cocinando: " . $cocinando . "; Cajero: " . $nameCajero , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrador -> insert();
	}
	else if($_SESSION['entity'] == 'Domiciliario'){
		$logDomiciliario = new LogDomiciliario("","Crear Pedido", "Fecha: " . $fecha . "; Hora: " . $hora . "; Descripcion: " . $descripcion . "; Precio: " . $precio . "; Cocinando: " . $cocinando . "; Cajero: " . $nameCajero , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logDomiciliario -> insert();
	}
	else if($_SESSION['entity'] == 'Cliente'){
		$logCliente = new LogCliente("","Crear Pedido", "Fecha: " . $fecha . "; Hora: " . $hora . "; Descripcion: " . $descripcion . "; Precio: " . $precio . "; Cocinando: " . $cocinando . "; Cajero: " . $nameCajero , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logCliente -> insert();
	}
	else if($_SESSION['entity'] == 'Cajero'){
		$logCajero = new LogCajero("","Crear Pedido", "Fecha: " . $fecha . "; Hora: " . $hora . "; Descripcion: " . $descripcion . "; Precio: " . $precio . "; Cocinando: " . $cocinando . "; Cajero: " . $nameCajero , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Crear Pedido</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Ingresados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/pedido/insertPedido.php") ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Fecha*</label>
							<input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $fecha ?>" autocomplete="off" />
						</div>
						<div class="form-group">
							<label>Hora*</label>
							<input type="date" class="form-control" name="hora" id="hora" value="<?php echo $hora ?>" autocomplete="off" />
						</div>
						<div class="form-group">
							<label>Descripcion*</label>
							<input type="text" class="form-control" name="descripcion" value="<?php echo $descripcion ?>" required />
						</div>
						<div class="form-group">
							<label>Precio*</label>
							<input type="text" class="form-control" name="precio" value="<?php echo $precio ?>" required />
						</div>
						<div class="form-group">
							<label>Cocinando*</label>
							<input type="text" class="form-control" name="cocinando" value="<?php echo $cocinando ?>" required />
						</div>
					<div class="form-group">
						<label>Cajero*</label>
						<select class="form-control" name="cajero">
							<?php
							$objCajero = new Cajero();
							$cajeros = $objCajero -> selectAllOrder("nombre", "asc");
							foreach($cajeros as $currentCajero){
								echo "<option value='" . $currentCajero -> getIdCajero() . "'";
								if($currentCajero -> getIdCajero() == $cajero){
									echo " selected";
								}
								echo ">" . $currentCajero -> getNombre() . " " . $currentCajero -> getApellido() . "</option>";
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

<?php
$processed=false;
$idDomicilio = $_GET['idDomicilio'];
$updateDomicilio = new Domicilio($idDomicilio);
$updateDomicilio -> select();
$direccion="";
if(isset($_POST['direccion'])){
	$direccion=$_POST['direccion'];
}
$fecha=date("d/m/Y");
if(isset($_POST['fecha'])){
	$fecha=$_POST['fecha'];
}
$hora=date("d/m/Y");
if(isset($_POST['hora'])){
	$hora=$_POST['hora'];
}
$precio="";
if(isset($_POST['precio'])){
	$precio=$_POST['precio'];
}
$descripcion="";
if(isset($_POST['descripcion'])){
	$descripcion=$_POST['descripcion'];
}
$cocinando="";
if(isset($_POST['cocinando'])){
	$cocinando=$_POST['cocinando'];
}
$domiciliario="";
if(isset($_POST['domiciliario'])){
	$domiciliario=$_POST['domiciliario'];
}
$cliente="";
if(isset($_POST['cliente'])){
	$cliente=$_POST['cliente'];
}
if(isset($_POST['update'])){
	$updateDomicilio = new Domicilio($idDomicilio, $direccion, $fecha, $hora, $precio, $descripcion, $cocinando, $domiciliario, $cliente);
	$updateDomicilio -> update();
	$updateDomicilio -> select();
	$objDomiciliario = new Domiciliario($domiciliario);
	$objDomiciliario -> select();
	$nameDomiciliario = $objDomiciliario -> getNombre() . " " . $objDomiciliario -> getApellido() . " " . $objDomiciliario -> getTelefono() . " " . $objDomiciliario -> getSalario() . " " . $objDomiciliario -> getRol() ;
	$objCliente = new Cliente($cliente);
	$objCliente -> select();
	$nameCliente = $objCliente -> getNombre() . " " . $objCliente -> getApellido() . " " . $objCliente -> getTelefono() . " " . $objCliente -> getDireccion() ;
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
		$logAdministrador = new LogAdministrador("","Editar Domicilio", "Direccion: " . $direccion . "; Fecha: " . $fecha . "; Hora: " . $hora . "; Precio: " . $precio . "; Descripcion: " . $descripcion . "; Cocinando: " . $cocinando . "; Domiciliario: " . $nameDomiciliario . ";; Cliente: " . $nameCliente , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrador -> insert();
	}
	else if($_SESSION['entity'] == 'Domiciliario'){
		$logDomiciliario = new LogDomiciliario("","Editar Domicilio", "Direccion: " . $direccion . "; Fecha: " . $fecha . "; Hora: " . $hora . "; Precio: " . $precio . "; Descripcion: " . $descripcion . "; Cocinando: " . $cocinando . "; Domiciliario: " . $nameDomiciliario . ";; Cliente: " . $nameCliente , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logDomiciliario -> insert();
	}
	else if($_SESSION['entity'] == 'Cliente'){
		$logCliente = new LogCliente("","Editar Domicilio", "Direccion: " . $direccion . "; Fecha: " . $fecha . "; Hora: " . $hora . "; Precio: " . $precio . "; Descripcion: " . $descripcion . "; Cocinando: " . $cocinando . "; Domiciliario: " . $nameDomiciliario . ";; Cliente: " . $nameCliente , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logCliente -> insert();
	}
	else if($_SESSION['entity'] == 'Cajero'){
		$logCajero = new LogCajero("","Editar Domicilio", "Direccion: " . $direccion . "; Fecha: " . $fecha . "; Hora: " . $hora . "; Precio: " . $precio . "; Descripcion: " . $descripcion . "; Cocinando: " . $cocinando . "; Domiciliario: " . $nameDomiciliario . ";; Cliente: " . $nameCliente , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Editar Domicilio</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Editados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/domicilio/updateDomicilio.php") . "&idDomicilio=" . $idDomicilio ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Direccion*</label>
							<input type="text" class="form-control" name="direccion" value="<?php echo $updateDomicilio -> getDireccion() ?>" required />
						</div>
						<div class="form-group">
							<label>Fecha*</label>
							<input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $updateDomicilio -> getFecha() ?>" autocomplete="off" />
						</div>
						<div class="form-group">
							<label>Hora*</label>
							<input type="date" class="form-control" name="hora" id="hora" value="<?php echo $updateDomicilio -> getHora() ?>" autocomplete="off" />
						</div>
						<div class="form-group">
							<label>Precio*</label>
							<input type="text" class="form-control" name="precio" value="<?php echo $updateDomicilio -> getPrecio() ?>" required />
						</div>
						<div class="form-group">
							<label>Descripcion*</label>
							<input type="text" class="form-control" name="descripcion" value="<?php echo $updateDomicilio -> getDescripcion() ?>" required />
						</div>
						<div class="form-group">
							<label>Cocinando*</label>
							<input type="text" class="form-control" name="cocinando" value="<?php echo $updateDomicilio -> getCocinando() ?>" required />
						</div>
					<div class="form-group">
						<label>Domiciliario*</label>
						<select class="form-control" name="domiciliario">
							<?php
							$objDomiciliario = new Domiciliario();
							$domiciliarios = $objDomiciliario -> selectAllOrder("nombre", "asc");
							foreach($domiciliarios as $currentDomiciliario){
								echo "<option value='" . $currentDomiciliario -> getIdDomiciliario() . "'";
								if($currentDomiciliario -> getIdDomiciliario() == $updateDomicilio -> getDomiciliario() -> getIdDomiciliario()){
									echo " selected";
								}
								echo ">" . $currentDomiciliario -> getNombre() . " " . $currentDomiciliario -> getApellido() . " " . $currentDomiciliario -> getTelefono() . " " . $currentDomiciliario -> getSalario() . " " . $currentDomiciliario -> getRol() . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Cliente*</label>
						<select class="form-control" name="cliente">
							<?php
							$objCliente = new Cliente();
							$clientes = $objCliente -> selectAllOrder("nombre", "asc");
							foreach($clientes as $currentCliente){
								echo "<option value='" . $currentCliente -> getIdCliente() . "'";
								if($currentCliente -> getIdCliente() == $updateDomicilio -> getCliente() -> getIdCliente()){
									echo " selected";
								}
								echo ">" . $currentCliente -> getNombre() . " " . $currentCliente -> getApellido() . " " . $currentCliente -> getTelefono() . " " . $currentCliente -> getDireccion() . "</option>";
							}
							?>
						</select>
					</div>
						<button type="submit" class="btn btn-info" name="update">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

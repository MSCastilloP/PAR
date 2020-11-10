<?php
$processed=false;
$updateDomiciliario = new Domiciliario($_SESSION['id']);
$updateDomiciliario -> select();
$nombre="";
if(isset($_POST['nombre'])){
	$nombre=$_POST['nombre'];
}
$apellido="";
if(isset($_POST['apellido'])){
	$apellido=$_POST['apellido'];
}
$correo="";
if(isset($_POST['correo'])){
	$correo=$_POST['correo'];
}
$telefono="";
if(isset($_POST['telefono'])){
	$telefono=$_POST['telefono'];
}
$salario="";
if(isset($_POST['salario'])){
	$salario=$_POST['salario'];
}
$rol="";
if(isset($_POST['rol'])){
	$rol=$_POST['rol'];
}
if(isset($_POST['update'])){
	$updateDomiciliario = new Domiciliario($_SESSION['id'], $nombre, $apellido, $correo, "", "", $telefono, $salario, $rol, "1");
	$updateDomiciliario -> update();
	$updateDomiciliario -> select();
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
	$logDomiciliario = new LogDomiciliario("","Editar Profile Domiciliario", "Nombre: " . $nombre . "; Apellido: " . $apellido . "; Correo: " . $correo . "; Telefono: " . $telefono . "; Salario: " . $salario . "; Rol: " . $rol, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
	$logDomiciliario -> insert();
	$processed=true;
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Editar Profile Domiciliario</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Editados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/domiciliario/updateProfileDomiciliario.php") ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $updateDomiciliario -> getNombre() ?>" required />
						</div>
						<div class="form-group">
							<label>Apellido*</label>
							<input type="text" class="form-control" name="apellido" value="<?php echo $updateDomiciliario -> getApellido() ?>" required />
						</div>
						<div class="form-group">
							<label>Correo*</label>
							<input type="email" class="form-control" name="correo" value="<?php echo $updateDomiciliario -> getCorreo() ?>"  required />
						</div>
						<div class="form-group">
							<label>Telefono*</label>
							<input type="text" class="form-control" name="telefono" value="<?php echo $updateDomiciliario -> getTelefono() ?>" required />
						</div>
						<div class="form-group">
							<label>Salario*</label>
							<input type="text" class="form-control" name="salario" value="<?php echo $updateDomiciliario -> getSalario() ?>" required />
						</div>
						<div class="form-group">
							<label>Rol*</label>
							<input type="text" class="form-control" name="rol" value="<?php echo $updateDomiciliario -> getRol() ?>" required />
						</div>
						<button type="submit" class="btn btn-info" name="update">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

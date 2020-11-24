<?php
$processed=false;
$idProveedor = $_GET['idProveedor'];
$updateProveedor = new Proveedor($idProveedor);
$updateProveedor -> select();
$nombreEmpresa="";
if(isset($_POST['nombreEmpresa'])){
	$nombreEmpresa=$_POST['nombreEmpresa'];
}
$telefono="";
if(isset($_POST['telefono'])){
	$telefono=$_POST['telefono'];
}
$descripcion="";
if(isset($_POST['descripcion'])){
	$descripcion=$_POST['descripcion'];
}
if(isset($_POST['update'])){
	$updateProveedor = new Proveedor($idProveedor, $nombreEmpresa, $telefono, $descripcion);
	$updateProveedor -> update();
	$updateProveedor -> select();
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
		$logAdministrador = new LogAdministrador("","Editar Proveedor", "Nombre Empresa: " . $nombreEmpresa . "; Telefono: " . $telefono . "; Descripcion: " . $descripcion, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrador -> insert();
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
					<h4 class="card-title">Editar Proveedor</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Editados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/proveedor/updateProveedor.php") . "&idProveedor=" . $idProveedor ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nombre Empresa*</label>
							<input type="text" class="form-control" name="nombreEmpresa" value="<?php echo $updateProveedor -> getNombreEmpresa() ?>" required />
						</div>
						<div class="form-group">
							<label>Telefono*</label>
							<input type="text" class="form-control" name="telefono" value="<?php echo $updateProveedor -> getTelefono() ?>" required />
						</div>
						<div class="form-group">
							<label>Descripcion*</label>
							<input type="text" class="form-control" name="descripcion" value="<?php echo $updateProveedor -> getDescripcion() ?>" required />
						</div>
						<button type="submit" class="btn btn-info" name="update">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

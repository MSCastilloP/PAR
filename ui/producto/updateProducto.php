<?php
$processed=false;
$idProducto = $_GET['idProducto'];
$updateProducto = new Producto($idProducto);
$updateProducto -> select();
$nombre="";
if(isset($_POST['nombre'])){
	$nombre=$_POST['nombre'];
}
$precio="";
if(isset($_POST['precio'])){
	$precio=$_POST['precio'];
}
$descripcion="";
if(isset($_POST['descripcion'])){
	$descripcion=$_POST['descripcion'];
}
$foto="";
if(isset($_POST['foto'])){
	$foto=$_POST['foto'];
}
if(isset($_POST['update'])){
	$updateProducto = new Producto($idProducto, $nombre, $precio, $descripcion, $foto);
	$updateProducto -> update();
	$updateProducto -> select();
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
		$logAdministrador = new LogAdministrador("","Editar Producto", "Nombre: " . $nombre . "; Precio: " . $precio . "; Descripcion: " . $descripcion . "; Foto: " . $foto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrador -> insert();
	}
	else if($_SESSION['entity'] == 'Domiciliario'){
		$logDomiciliario = new LogDomiciliario("","Editar Producto", "Nombre: " . $nombre . "; Precio: " . $precio . "; Descripcion: " . $descripcion . "; Foto: " . $foto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logDomiciliario -> insert();
	}
	else if($_SESSION['entity'] == 'Cliente'){
		$logCliente = new LogCliente("","Editar Producto", "Nombre: " . $nombre . "; Precio: " . $precio . "; Descripcion: " . $descripcion . "; Foto: " . $foto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logCliente -> insert();
	}
	else if($_SESSION['entity'] == 'Cajero'){
		$logCajero = new LogCajero("","Editar Producto", "Nombre: " . $nombre . "; Precio: " . $precio . "; Descripcion: " . $descripcion . "; Foto: " . $foto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Editar Producto</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Editados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/producto/updateProducto.php") . "&idProducto=" . $idProducto ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $updateProducto -> getNombre() ?>" required />
						</div>
						<div class="form-group">
							<label>Precio*</label>
							<input type="text" class="form-control" name="precio" value="<?php echo $updateProducto -> getPrecio() ?>" required />
						</div>
						<div class="form-group">
							<label>Descripcion*</label>
							<input type="text" class="form-control" name="descripcion" value="<?php echo $updateProducto -> getDescripcion() ?>" required />
						</div>
						<div class="form-group">
							<label>Foto*</label>
							<input type="text" class="form-control" name="foto" value="<?php echo $updateProducto -> getFoto() ?>" required />
						</div>
						<button type="submit" class="btn btn-info" name="update">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

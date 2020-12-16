<?php
echo $_POST['var_1'];
$processed = false;
$nombre = "";
if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
}
$precio = "";
if (isset($_POST['precio'])) {
    $precio = $_POST['precio'];
}
$descripcion = "";
if (isset($_POST['descripcion'])) {
    $descripcion = $_POST['descripcion'];
}





$error = 0;
$foto = "";
if (isset($_POST['image'])) {
    
    $foto = $_POST['image'];
    
}
if (isset($_POST['insert'])) {
    $localPath=$_FILES['image']['tmp_name'];
    $type=$_FILES['image']['type'];
    if($type!="image/png" && $type!="image/jpg" && $type!="image/jpeg"){
        $error=1;
    } else {

        $serverPath = "image/" . time() . ".png";

        copy($localPath, $serverPath);
        $newProducto = new Producto("", $nombre, $precio, $descripcion, $serverPath);
        $newProducto->insert();
        $user_ip = getenv('REMOTE_ADDR');
        $agent = $_SERVER["HTTP_USER_AGENT"];
        $browser = "-";

        if (preg_match('/MSIE (\d+\.\d+);/', $agent)) {
            $browser = "Internet Explorer";
        } else if (preg_match('/Chrome[\/\s](\d+\.\d+)/', $agent)) {
            $browser = "Chrome";
        } else if (preg_match('/Edge\/\d+/', $agent)) {
            $browser = "Edge";
        } else if (preg_match('/Firefox[\/\s](\d+\.\d+)/', $agent)) {
            $browser = "Firefox";
        } else if (preg_match('/OPR[\/\s](\d+\.\d+)/', $agent)) {
            $browser = "Opera";
        } else if (preg_match('/Safari[\/\s](\d+\.\d+)/', $agent)) {
            $browser = "Safari";
        }
        if ($_SESSION['entity'] == 'Administrador') {
            $logAdministrador = new LogAdministrador("", "Crear Producto", "Nombre: " . $nombre . "; Precio: " . $precio . "; Descripcion: " . $descripcion . "; Foto: " . $foto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
            $logAdministrador->insert();
        } else if ($_SESSION['entity'] == 'Domiciliario') {
            $logDomiciliario = new LogDomiciliario("", "Crear Producto", "Nombre: " . $nombre . "; Precio: " . $precio . "; Descripcion: " . $descripcion . "; Foto: " . $foto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
            $logDomiciliario->insert();
        } else if ($_SESSION['entity'] == 'Cliente') {
            $logCliente = new LogCliente("", "Crear Producto", "Nombre: " . $nombre . "; Precio: " . $precio . "; Descripcion: " . $descripcion . "; Foto: " . $foto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
            $logCliente->insert();
        } else if ($_SESSION['entity'] == 'Cajero') {
            $logCajero = new LogCajero("", "Crear Producto", "Nombre: " . $nombre . "; Precio: " . $precio . "; Descripcion: " . $descripcion . "; Foto: " . $foto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
            $logCajero->insert();
        }

         $newProducto->encontrar();
			        if(!empty($_POST['ingredient'])){

			// Ciclo para mostrar las casillas checked checkbox.
			foreach($_POST['ingredient'] as $selected){
				$newIngrePro= new IngrePro ("",$selected,$newProducto->getIdProducto());
				$newIngrePro->insert();
			//echo $selected."</br>";// Imprime resultados
			}
			}
        $processed = true;
    }
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Crear Producto</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
						<div class="alert alert-success">
						Datos Ingresados
						<button type="button" class="close" data-dismiss="alert"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } else if($error == 1) { ?>
						<div class="alert alert-danger">
						Error. The image must be png
						<button type="button" class="close" data-dismiss="alert"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/producto/insertProducto.php") ?>"
						class="bootstrap-form needs-validation" enctype="multipart/form-data">
						<div class="form-group">
							<label>Nombre*</label> <input type="text" class="form-control"
								name="nombre" value="<?php echo $nombre ?>" required />
						</div>
						<div class="form-group">
							<label>Precio*</label> <input type="text" class="form-control"
								name="precio" value="<?php echo $precio ?>" required />
						</div>
						<div class="form-group">


							<label>Ingredientes*</label>
							<div style="width: 700px; height: 180px; overflow-y: scroll;">
								<?php
        $ingrediente = new Ingrediente();
        $ingredientes = $ingrediente->nombre();

        foreach ($ingredientes as $currentIngrediente) {
            echo "<input type= checkbox name= ingredient[] value=" . $currentIngrediente->getIdIngrediente() . ">  " .$currentIngrediente->getNombre() . "<br>";
        }

        ?>
								<br>

							</div>
							<label>Descripcion*</label> <input type="text"
								class="form-control" name="descripcion"
								value="<?php echo $descripcion ?>" required />
						</div>
						<div class="form-group">
							<label>Foto*</label> <input type="file" class="form-control-file" 
								name="image"  required />
						</div>
						<button type="submit" class="btn btn-info" name="insert">Crear</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
</script>
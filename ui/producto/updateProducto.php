<?php
//actualmente se usa
$processed=false;
$idProducto = $_GET['idProducto'];
$updateProducto = new Producto($idProducto);
$updateProducto -> select();
$nombre="";
$error = 0;
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
$estado="";
if(isset($_POST['estado'])){
	$estado=$_POST['estado'];
}
if(isset($_POST['update'])){
	if(isset($_FILES['image'])){
		
	$localPath=$_FILES['image']['tmp_name'];
	$type=$_FILES['image']['type'];
	if(strlen($type)==0){
		$error=2;
	}else{
	 if($type!="image/png" && $type!="image/jpg" && $type!="image/jpeg"){
		$error=1;
	}
	else  {
		if (file_exists($updateProducto -> getFoto())) {
			unlink($updateProducto -> getFoto());
		}
		$serverPath = "image/" . time() . ".png";
		copy($localPath,$serverPath);
		$updateProducto -> updateImage("Foto", $serverPath);
	}}}
	if($error!=1){
	$updateProducto = new Producto($idProducto, $nombre, $precio, $descripcion,"",$estado);
	$updateProducto -> update();
//	$updateProducto -> select();
	if(!empty($_POST['ingredient'])){
	echo "entro";
	$ingredienteProducto= new IngrePro("","",$idProducto);
	$ingredienteProducto -> deleteUpdate();
	// Ciclo para mostrar las casillas checked checkbox.
	foreach($_POST['ingredient'] as $selected){
		$newIngrePro= new IngrePro ("",$selected,$idProducto);
		$newIngrePro->insert();
	//echo $selected."</br>";// Imprime resultados
	}
	}
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
		$logAdministrador = new LogAdministrador("","Editar Producto", "Nombre: " . $nombre . "; Precio: " . $precio . "; Descripcion: " . $descripcion, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrador -> insert();
	}
	else if($_SESSION['entity'] == 'Cajero'){
		$logCajero = new LogCajero("","Editar Producto", "Nombre: " . $nombre . "; Precio: " . $precio . "; Descripcion: " . $descripcion, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logCajero -> insert();
	}


	$processed=true;
	}
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
					<?php } else if($error == 1) { ?>
						<div class="alert alert-danger">
						Error. The image must be png
						<button type="button" class="close" data-dismiss="alert"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/producto/updateProducto.php") . "&idProducto=" . $idProducto ?>" enctype="multipart/form-data" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $updateProducto -> getNombre() ?>" required />
						</div>
						<div class="form-group">
							<label>Precio*</label>
							<input type="text" class="form-control" name="precio" value="<?php echo $updateProducto -> getPrecio() ?>" required />
						</div>
						<label>Ingredientes*</label>
							<div style="width: 700px; height: 180px; overflow-y: scroll;">
								<?php
								$ingrediente = new Ingrediente();
								$ingrePro = new IngrePro();
								$cont=0;
								$ingres = $ingrePro-> ingretra($_GET['idProducto']);
						
								$ingredientes = $ingrediente->nombre();
								foreach ($ingredientes as $currentIngrediente) {
									if($cont < sizeof($ingres)){
										if($currentIngrediente->getIdIngrediente() == $ingres[$cont]){
											echo "<input type= checkbox checked name= ingredient[] value=" . $currentIngrediente->getIdIngrediente() . ">  " .$currentIngrediente->getNombre() . "<br>";
										
												$cont++;
											
										
										}else{
											echo "<input type= checkbox  name= ingredient[] value=" . $currentIngrediente->getIdIngrediente() . ">  " .$currentIngrediente->getNombre() . "<br>";
										}
									}else{
										echo "<input type= checkbox  name= ingredient[] value=" . $currentIngrediente->getIdIngrediente() . ">  " .$currentIngrediente->getNombre() . "<br>";
									}
									
									
								}

       							 ?>
								<br>
							</div>
							<div>
								<label>Descripcion*</label> <input type="text"
								class="form-control" name="descripcion"
								value="<?php echo $updateProducto->getDescripcion() ?>" required />
							</div>
							<label>estado*</label>
						<div class="form-group">
							
							<select class="form-select form-select-lg mb-3" name="estado" >
							<?php if($updateProducto -> getEstado()== 1) { ?>
								<option  selected value="1">Habilitado</option>
								<option value="0">Deshabilitado</option>
							<?php } else{ ?>
								<option   value="1">Habilitado</option>
								<option selected value="0">Deshabilitado</option>
								<?php }
							?>
								
							</select>

	
						</div>
						<div class="form-group">
							<label>Foto*</label>
							<input type="file" class="form-control-file" name="image"   />
						</div>
						<button type="submit" class="btn btn-info" name="update">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

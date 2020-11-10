<?php
$processed=false;
$ingrediente="";
if(isset($_POST['ingrediente'])){
	$ingrediente=$_POST['ingrediente'];
}
if(isset($_GET['idIngrediente'])){
	$ingrediente=$_GET['idIngrediente'];
}
$producto="";
if(isset($_POST['producto'])){
	$producto=$_POST['producto'];
}
if(isset($_GET['idProducto'])){
	$producto=$_GET['idProducto'];
}
if(isset($_POST['insert'])){
	$newIngrePro = new IngrePro("", $ingrediente, $producto);
	$newIngrePro -> insert();
	$objIngrediente = new Ingrediente($ingrediente);
	$objIngrediente -> select();
	$nameIngrediente = $objIngrediente -> getNombre() . " " . $objIngrediente -> getPrecio() ;
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
		$logAdministrador = new LogAdministrador("","Crear Ingre Pro", "Ingrediente: " . $nameIngrediente . ";; Producto: " . $nameProducto , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrador -> insert();
	}
	else if($_SESSION['entity'] == 'Domiciliario'){
		$logDomiciliario = new LogDomiciliario("","Crear Ingre Pro", "Ingrediente: " . $nameIngrediente . ";; Producto: " . $nameProducto , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logDomiciliario -> insert();
	}
	else if($_SESSION['entity'] == 'Cliente'){
		$logCliente = new LogCliente("","Crear Ingre Pro", "Ingrediente: " . $nameIngrediente . ";; Producto: " . $nameProducto , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logCliente -> insert();
	}
	else if($_SESSION['entity'] == 'Cajero'){
		$logCajero = new LogCajero("","Crear Ingre Pro", "Ingrediente: " . $nameIngrediente . ";; Producto: " . $nameProducto , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Crear Ingre Pro</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Ingresados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/ingrePro/insertIngrePro.php") ?>" class="bootstrap-form needs-validation"   >
					<div class="form-group">
						<label>Ingrediente*</label>
						<select class="form-control" name="ingrediente">
							<?php
							$objIngrediente = new Ingrediente();
							$ingredientes = $objIngrediente -> selectAllOrder("nombre", "asc");
							foreach($ingredientes as $currentIngrediente){
								echo "<option value='" . $currentIngrediente -> getIdIngrediente() . "'";
								if($currentIngrediente -> getIdIngrediente() == $ingrediente){
									echo " selected";
								}
								echo ">" . $currentIngrediente -> getNombre() . " " . $currentIngrediente -> getPrecio() . "</option>";
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

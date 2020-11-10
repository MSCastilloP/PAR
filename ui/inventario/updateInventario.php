<?php
$processed=false;
$idInventario = $_GET['idInventario'];
$updateInventario = new Inventario($idInventario);
$updateInventario -> select();
$fecha=date("d/m/Y");
if(isset($_POST['fecha'])){
	$fecha=$_POST['fecha'];
}
$cantidadInicial="";
if(isset($_POST['cantidadInicial'])){
	$cantidadInicial=$_POST['cantidadInicial'];
}
$unidades="";
if(isset($_POST['unidades'])){
	$unidades=$_POST['unidades'];
}
$cantidadFinal="";
if(isset($_POST['cantidadFinal'])){
	$cantidadFinal=$_POST['cantidadFinal'];
}
$ingrediente="";
if(isset($_POST['ingrediente'])){
	$ingrediente=$_POST['ingrediente'];
}
if(isset($_POST['update'])){
	$updateInventario = new Inventario($idInventario, $fecha, $cantidadInicial, $unidades, $cantidadFinal, $ingrediente);
	$updateInventario -> update();
	$updateInventario -> select();
	$objIngrediente = new Ingrediente($ingrediente);
	$objIngrediente -> select();
	$nameIngrediente = $objIngrediente -> getNombre() . " " . $objIngrediente -> getPrecio() ;
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
		$logAdministrador = new LogAdministrador("","Editar Inventario", "Fecha: " . $fecha . "; Cantidad Inicial: " . $cantidadInicial . "; Unidades: " . $unidades . "; Cantidad Final: " . $cantidadFinal . "; Ingrediente: " . $nameIngrediente , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrador -> insert();
	}
	else if($_SESSION['entity'] == 'Domiciliario'){
		$logDomiciliario = new LogDomiciliario("","Editar Inventario", "Fecha: " . $fecha . "; Cantidad Inicial: " . $cantidadInicial . "; Unidades: " . $unidades . "; Cantidad Final: " . $cantidadFinal . "; Ingrediente: " . $nameIngrediente , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logDomiciliario -> insert();
	}
	else if($_SESSION['entity'] == 'Cliente'){
		$logCliente = new LogCliente("","Editar Inventario", "Fecha: " . $fecha . "; Cantidad Inicial: " . $cantidadInicial . "; Unidades: " . $unidades . "; Cantidad Final: " . $cantidadFinal . "; Ingrediente: " . $nameIngrediente , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logCliente -> insert();
	}
	else if($_SESSION['entity'] == 'Cajero'){
		$logCajero = new LogCajero("","Editar Inventario", "Fecha: " . $fecha . "; Cantidad Inicial: " . $cantidadInicial . "; Unidades: " . $unidades . "; Cantidad Final: " . $cantidadFinal . "; Ingrediente: " . $nameIngrediente , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Editar Inventario</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Editados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/inventario/updateInventario.php") . "&idInventario=" . $idInventario ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Fecha*</label>
							<input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $updateInventario -> getFecha() ?>" autocomplete="off" />
						</div>
						<div class="form-group">
							<label>Cantidad Inicial*</label>
							<input type="text" class="form-control" name="cantidadInicial" value="<?php echo $updateInventario -> getCantidadInicial() ?>" required />
						</div>
						<div class="form-group">
							<label>Unidades*</label>
							<input type="text" class="form-control" name="unidades" value="<?php echo $updateInventario -> getUnidades() ?>" required />
						</div>
						<div class="form-group">
							<label>Cantidad Final*</label>
							<input type="text" class="form-control" name="cantidadFinal" value="<?php echo $updateInventario -> getCantidadFinal() ?>" required />
						</div>
					<div class="form-group">
						<label>Ingrediente*</label>
						<select class="form-control" name="ingrediente">
							<?php
							$objIngrediente = new Ingrediente();
							$ingredientes = $objIngrediente -> selectAllOrder("nombre", "asc");
							foreach($ingredientes as $currentIngrediente){
								echo "<option value='" . $currentIngrediente -> getIdIngrediente() . "'";
								if($currentIngrediente -> getIdIngrediente() == $updateInventario -> getIngrediente() -> getIdIngrediente()){
									echo " selected";
								}
								echo ">" . $currentIngrediente -> getNombre() . " " . $currentIngrediente -> getPrecio() . "</option>";
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

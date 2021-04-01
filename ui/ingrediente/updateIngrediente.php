<?php
//actualmente se usa
$processed=false;
$idIngrediente = $_GET['idIngrediente'];
$updateIngrediente = new Ingrediente($idIngrediente);
$updateIngrediente -> select();
$nombre="";
if(isset($_POST['nombre'])){
	$nombre=$_POST['nombre'];
}
$estado="";
if(isset($_POST['estado'])){
	$estado=$_POST['estado'];
}

if(isset($_POST['esencial'])){
	$esencial=$_POST['esencial'];
}
if(isset($_POST['update'])){
	$updateIngrediente = new Ingrediente($idIngrediente, $nombre, $estado,$esencial);
	$updateIngrediente -> update();
	$updateIngrediente -> select();
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
		$logAdministrador = new LogAdministrador("","Editar Ingrediente", "Nombre: " . $nombre . "; estado: " . $estado, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrador -> insert();
	}
	else if($_SESSION['entity'] == 'Domiciliario'){
		$logDomiciliario = new LogDomiciliario("","Editar Ingrediente", "Nombre: " . $nombre . "; estado: " . $estado, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logDomiciliario -> insert();
	}
	else if($_SESSION['entity'] == 'Cliente'){
		$logCliente = new LogCliente("","Editar Ingrediente", "Nombre: " . $nombre . "; estado: " . $estado, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logCliente -> insert();
	}
	else if($_SESSION['entity'] == 'Cajero'){
		$logCajero = new LogCajero("","Editar Ingrediente", "Nombre: " . $nombre . "; estado: " . $estado, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Editar Ingrediente</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Editados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/ingrediente/updateIngrediente.php") . "&idIngrediente=" . $idIngrediente ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $updateIngrediente -> getNombre() ?>" required />
						</div>
						<label>estado*</label>
						<div class="form-group">
							
							<select class="form-select form-select-lg mb-3" name="estado" >
							<?php if($updateIngrediente -> getEstado()== 1) { ?>
								<option  selected value="1">Habilitado</option>
								<option value="0">Deshabilitado</option>
							<?php } else{ ?>
								<option   value="1">Habilitado</option>
								<option selected value="0">Deshabilitado</option>
								<?php }
							?>
								
							</select>
							<br>
							<label>Escencial</label>
							<label>Se le coloca escencial a todo ingrediente que el cliente a la hora de hacer un domicilio
							no podra retirarlo del producto</label>
							<?php if($updateIngrediente->getEsencial()==1){?>
								<div class="form-check">
							<input type="radio" class="form-check-input" name="esencial" value="0" />
							<label class="form-check-label">No Escencial</label>
							</div>
							<div class="form-check form-check-inline">
							<input type="radio" class="form-check-input" name="esencial" value="1"checked />
							<label class="form-check-label" >Escencial</label>
								<?php } else{?>
									<div class="form-check">
							<input type="radio" class="form-check-input" name="esencial" value="0" checked />
							<label class="form-check-label">No Escencial</label>
							</div>
							<div class="form-check form-check-inline">
							<input type="radio" class="form-check-input" name="esencial" value="1" />
							<label class="form-check-label" >Escencial</label>
									<?php } ?>
						
						</div>
							
						</div>
						<button type="submit" class="btn btn-info" name="update">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

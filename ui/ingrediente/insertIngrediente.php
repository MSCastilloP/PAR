<?php

//actualmente se usa
$processed=0;
$nombre="";
if(isset($_POST['nombre'])){
	$nombre=$_POST['nombre'];
}

if(isset($_POST['insert'])){

	$newIngrediente = new Ingrediente("", $nombre, 1);
	
	if($newIngrediente->checkIngrediente()<1){
		$newIngrediente -> insert();
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
		$logAdministrador = new LogAdministrador("","Crear Ingrediente", "Nombre: " . $nombre . "; estado: " . 1, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrador -> insert();
	}
	else if($_SESSION['entity'] == 'Cajero'){
		$logCajero = new LogCajero("","Crear Ingrediente", "Nombre: " . $nombre . "; Precio: " . $precio, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logCajero -> insert();
	}
	$processed=1;
	}else{
		$processed=2;
	}
	
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Crear Ingrediente</h4>
				</div>
				<div class="card-body">
					<?php if($processed==1){ ?>
					<div class="alert alert-success" >Datos Ingresados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<?php  }else if($processed==2) { ?>
						<div class="alert alert-danger" >Ingrediente Repetido.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div> <?php }?>

					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/ingrediente/insertIngrediente.php") ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $nombre ?>" required />
						</div>
						<div class="form-group">
							<label>Escencial</label>
							<label>Se le coloca escencial a todo ingrediente que el cliente a la hora de hacer un domicilio
							no podra retirarlo del producto</label>
						<div class="form-check">
							<input type="radio" class="form-check-input" name="estado" value="0" checked />
							<label class="form-check-label">No Escencial</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" class="form-check-input" name="estado" value="1" />
							<label class="form-check-label" >Escencial</label>
						</div>
						</div>

						<button type="submit" class="btn btn-info" name="insert">Crear</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

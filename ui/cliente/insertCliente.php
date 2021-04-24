<!-- Se usa -->



<?php
$processed=false;
$email=false;
$nombre="";
if(isset($_GET['email'])){
	$emailgoogle=$_GET['email'];
	$c= new Cliente("", "", "", $emailgoogle);
	if($c->consultarCorreo()>0){
		echo "algo";
		header("Location: index.php?error=1");

	}
	
}
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
$clave="";
if(isset($_POST['clave'])){
	$clave=$_POST['clave'];
}
$telefono="";
if(isset($_POST['telefono'])){
	$telefono=$_POST['telefono'];
}
$direccion="";
if(isset($_POST['direccion'])){
	$direccion=$_POST['direccion'];
}
$state="";
if(isset($_POST['state'])){
	$state=$_POST['state'];
}

if(isset($_POST['insert'])){

	$newCliente = new Cliente("", $nombre, $apellido, $correo, $clave, "", $telefono, $direccion);
	
	if($newCliente->consultarCorreo()==0){

		$newCliente -> insert();

	
	
	$processed=true;
	
	header("Location: index.php?error=2");

	}else{
		$email=true;
	}
	
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Crear Cliente</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Ingresados
						<button  type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<?php if($email){ ?>
					<div class="alert alert-danger" > Correo ya existente.
						<button  type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/cliente/insertCliente.php") ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $nombre ?>" required />
						</div>
						<div class="form-group">
							<label>Apellido*</label>
							<input type="text" class="form-control" name="apellido" value="<?php echo $apellido ?>" required />
						</div>	
						<?php if(isset($_GET['email'])){ ?>
							<div class="form-group">
							<label>Correo*</label>
							<input  class="form-control"  readonly value="<?php echo $emailgoogle ?>"  required />
							<input type="email" class="form-control" name="correo" style ="visibility: hidden" value="<?php echo $emailgoogle ?>"  required />
						</div>
					<?php } else {?>
						<div class="form-group">
							<label>Correo*</label>
							<h1> <?php echo $correo ?></h1>
							<input type="email" class="form-control" name="correo" style ="visibility: hidden" value="<?php echo $correo ?>"  required />
						</div>
						<?php } ?>
						<div class="form-group">
							<label>Clave*</label>
							<input type="password" class="form-control" name="clave" value="<?php echo $clave ?>" required />
						</div>
						<div class="form-group">
							<label>Telefono*</label>
							<input type="text" class="form-control" name="telefono" value="<?php echo $telefono ?>" required />
						</div>
						<div class="form-group">
							<label>Direccion*</label>
							<input type="text" class="form-control" name="direccion" value="<?php echo $direccion ?>" required />
						</div>
						
						<button  type="submit" class="btn btn-info" name="insert">Crear</button>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function salir(){
		window.location.replace("index.php");
	}
</script>

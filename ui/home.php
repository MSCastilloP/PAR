

<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
<script>
function google (){
	

	const googleButton = document.querySelector('#googleLogin')
	googleButton.addEventListener('click', e=>{
		const provider = new firebase.auth.GoogleAuthProvider();
		firebase.auth().signInWithPopup(provider)
		.then(result => {			
			const email= result.user.email;
			window.location.replace("index.php?pid=<?php echo base64_encode("ui/cliente/insertCliente.php")?>&email="+email);
			

	})
		
		.catch(err => {
			console.log(err)	
		})
	})

}



</script>
<?php
$logInError=false;
$enabledError=false;
$error=0;
if(isset($_GET['error'])){
	$error=$_GET['error'];
}
if(isset($_POST['logIn'])){
	if(isset($_POST['email']) && isset($_POST['password'])){
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
		$email=$_POST['email'];
		$password=$_POST['password'];
		$administrador = new Administrador();
		if($administrador -> logIn($email, $password)){
			if($administrador -> getEstado()==1){
				$_SESSION['id']=$administrador -> getIdAdministrador();
				$_SESSION['entity']="Administrador";
				$logAdministrador = new LogAdministrador("", "Log In", "", date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $administrador -> getIdAdministrador());
				$logAdministrador -> insert();
				echo "<script>location.href = 'index.php?pid=" . base64_encode("ui/sessionAdministrador.php") . "'</script>"; 
			} else { 
				$enabledError=true; 
			}
		}
		$domiciliario = new Domiciliario();
		if($domiciliario -> logIn($email, $password)){
			if($domiciliario -> getState()==1){
				$_SESSION['id']=$domiciliario -> getIdDomiciliario();
				$_SESSION['entity']="Domiciliario";
				$logDomiciliario = new LogDomiciliario("", "Log In", "", date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $domiciliario -> getIdDomiciliario());
				$logDomiciliario -> insert();
				echo "<script>location.href = 'index.php?pid=" . base64_encode("ui/sessionDomiciliario.php") . "'</script>"; 
			} else { 
				$enabledError=true; 
			}
		}
		$cliente = new Cliente();
		if($cliente -> logIn($email, $password)){
				if($cliente-> getState() == 1){
					
					$_SESSION['id']=$cliente -> getIdCliente();
					$_SESSION['entity']="Cliente";
					$logCliente = new LogCliente("", "Log In", "", date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $cliente -> getIdCliente());
					$logCliente -> insert();
					echo "<script>location.href = 'index.php?pid=" . base64_encode("ui/sessionCliente.php") . "'</script>"; 
				}else{
				
				
					$enabledError=true; 	
				}
				
			
		}
		$cajero = new Cajero();
		if($cajero -> logIn($email, $password)){
			
			if($cajero -> getState()==1){

				if(strcmp($email, "cocinero@gmail.com") !=0){
					$_SESSION['id']=$cajero -> getIdCajero();
					$_SESSION['entity']="Cajero";
					$logCajero = new LogCajero("", "Log In", "", date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $cajero -> getIdCajero());
					$logCajero -> insert();
					echo "<script>location.href = 'index.php?pid=" . base64_encode("ui/sessionCajero.php") . "'</script>"; 
				}else{
					$_SESSION['id']=$cajero -> getIdCajero();
					$_SESSION['entity']="Cocinero";
					$logCajero = new LogCajero("", "Log In", "", date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $cajero -> getIdCajero());
					$logCajero -> insert();
					echo "<script>location.href = 'index.php?pid=" . base64_encode("ui/verPedidos.php") . "'</script>"; 
				}
			
			} else { 
				$enabledError=true; 
			}
		}
		$logInError=true;
	}
}
?>
<div align="center">
	<?php include("ui/header.php"); ?>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">
					<h4><strong>PAR</strong></h4>
				</div>
				<?php if($error==1){ ?>
					<div class="alert alert-danger" >Correo ya registrado
						<button  type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } else if($error==2){ ?>
						<div class="alert alert-success" >Usuario registrado
						<button  type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

						<?php } ?>
				<div class="card-body">
					<p>Aplicaci�n para la gesti�n de restaurantes de comida rapida</p>
				</div>
				
			</div>
		</div>
		
		<div class="col-md-3">
			<div class="card">
				<div class="card-header">
					<h4><strong>Autenticar</strong></h4>
				</div>
				<div class="card-body">
					<form id="form" method="post" action="index.php" class="bootstrap-form needs-validation"  >
						<div class="form-group">
							<div class="input-group" >
								<input type="email" class="form-control" name="email" placeholder="Correo" autocomplete="off" required />
							</div>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="Clave" required />
						</div>
						<?php if($enabledError){
							echo "<div class='alert alert-danger' >Usuario Deshabilitado</div>";
						} else if ($logInError){
							echo "<div class='alert alert-danger' >Error de correo o clave</div>";
						} ?>
						<div class="form-group">
							<button type="submit" class="btn btn-info" name="logIn">Autenticar</button>
							
						</div>
						<div class="form-group">
				<!-- <a href="index.php?pid= <?php //echo base64_encode("ui/recoverPassword.php") ?>">Recuperar Clave</a> -->		
							<br>
							

							<button id="googleLogin" onClick=google() class="btn btn-outline-dark" href="/users/googleauth" role="button" style="text-transform:none">
							<img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
							Registrate con  Google
							</button>

						</div>
						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

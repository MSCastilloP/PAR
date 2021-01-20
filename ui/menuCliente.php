 <?php
$cliente = new Cliente($_SESSION['id']);
$cliente -> select();
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark" >
	<a class="navbar-brand" href="index.php?pid=<?php echo base64_encode("ui/sessionCliente.php") ?>"><span class="fas fa-home" aria-hidden="true"></span></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"> <span class="navbar-toggler-icon"></span></button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Crear</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/domicilio/insertDomicilio.php")?>&idp=0">Domicilio</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Consultar</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/producto/selectAllProducto.php") ?>">Producto</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilio.php") ?>">Domicilio</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Buscar</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/producto/searchProducto.php") ?>">Producto</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/domicilio/searchDomicilio.php") ?>">Domicilio</a>
				</div>
			</li>
		</ul>
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown">Cliente: <?php echo $cliente -> getNombre() . " " . $cliente -> getApellido() . " " . $cliente -> getTelefono() . " " . $cliente -> getDireccion() ?><span class="caret"></span></a>
				<div class="dropdown-menu" >
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/cliente/updateProfileCliente.php") ?>">Editar Perfil</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/cliente/updatePasswordCliente.php") ?>">Editar Clave</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/cliente/updateProfilePictureCliente.php") ?>">Editar Foto</a>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?logOut=1">Salir</a>
			</li>
		</ul>
	</div>
</nav>

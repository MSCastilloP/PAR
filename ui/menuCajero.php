<?php
$cajero = new Cajero($_SESSION['id']);
$cajero -> select();
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark" >
	<a class="navbar-brand" href="index.php?pid=<?php echo base64_encode("ui/sessionCajero.php") ?>"><span class="fas fa-home" aria-hidden="true"></span></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"> <span class="navbar-toggler-icon"></span></button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Crear</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/pedido/insertPedido.php") ?>">Pedido</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Consultar</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/producto/selectAllProducto.php") ?>">Producto</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/pedido/selectAllPedido.php") ?>">Pedido</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/cocinero/selectAllCocinero.php") ?>">Cocinero</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Buscar</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/producto/searchProducto.php") ?>">Producto</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/pedido/searchPedido.php") ?>">Pedido</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/cocinero/searchCocinero.php") ?>">Cocinero</a>
				</div>
			</li>
		</ul>
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown">Cajero: <?php echo $cajero -> getNombre() . " " . $cajero -> getApellido() ?><span class="caret"></span></a>
				<div class="dropdown-menu" >
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/cajero/updateProfileCajero.php") ?>">Editar Perfil</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/cajero/updatePasswordCajero.php") ?>">Editar Clave</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/cajero/updateProfilePictureCajero.php") ?>">Editar Foto</a>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?logOut=1">Salir</a>
			</li>
		</ul>
	</div>
</nav>

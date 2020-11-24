<?php
$administrador = new Administrador($_SESSION['id']);
$administrador -> select();
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark" >
	<a class="navbar-brand" href="index.php?pid=<?php echo base64_encode("ui/sessionAdministrador.php") ?>"><span class="fas fa-home" aria-hidden="true"></span></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"> <span class="navbar-toggler-icon"></span></button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Crear</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrador/insertAdministrador.php") ?>">Administrador</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/inventario/insertInventario.php") ?>">Inventario</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/ingrediente/insertIngrediente.php") ?>">Ingrediente</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/producto/insertProducto.php") ?>">Producto</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/domiciliario/insertDomiciliario.php") ?>">Domiciliario</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/cajero/insertCajero.php") ?>">Cajero</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/cocinero/insertCocinero.php") ?>">Cocinero</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/proveedor/insertProveedor.php") ?>">Proveedor</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Consultar</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrador/selectAllAdministrador.php") ?>">Administrador</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/inventario/selectAllInventario.php") ?>">Inventario</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/ingrediente/selectAllIngrediente.php") ?>">Ingrediente</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/producto/selectAllProducto.php") ?>">Producto</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/domiciliario/selectAllDomiciliario.php") ?>">Domiciliario</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/cliente/selectAllCliente.php") ?>">Cliente</a>
					
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/cajero/selectAllCajero.php") ?>">Cajero</a>
					
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/cocinero/selectAllCocinero.php") ?>">Cocinero</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/proveedor/selectAllProveedor.php") ?>">Proveedor</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Buscar</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrador/searchAdministrador.php") ?>">Administrador</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/inventario/searchInventario.php") ?>">Inventario</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/ingrediente/searchIngrediente.php") ?>">Ingrediente</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/producto/searchProducto.php") ?>">Producto</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/domiciliario/searchDomiciliario.php") ?>">Domiciliario</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/cliente/searchCliente.php") ?>">Cliente</a>
					
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/cajero/searchCajero.php") ?>">Cajero</a>
					
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/cocinero/searchCocinero.php") ?>">Cocinero</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/proveedor/searchProveedor.php") ?>">Proveedor</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Log</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/logAdministrador/searchLogAdministrador.php") ?>">Log Administrador</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/logDomiciliario/searchLogDomiciliario.php") ?>">Log Domiciliario</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/logCliente/searchLogCliente.php") ?>">Log Cliente</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/logCajero/searchLogCajero.php") ?>">Log Cajero</a>
				</div>
			</li>
		</ul>
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown">Administrador: <?php echo $administrador -> getNombre() . " " . $administrador -> getApellido() ?><span class="caret"></span></a>
				<div class="dropdown-menu" >
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrador/updateProfileAdministrador.php") ?>">Editar Perfil</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrador/updatePasswordAdministrador.php") ?>">Editar Clave</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrador/updateProfilePictureAdministrador.php") ?>">Editar Foto</a>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?logOut=1">Salir</a>
			</li>
		</ul>
	</div>
</nav>

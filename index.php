<?php 
session_start();
require("business/Administrador.php");
require("business/LogAdministrador.php");
require("business/Inventario.php");
require("business/Ingrediente.php");
require("business/IngrePro.php");
require("business/Producto.php");
require("business/ProDom.php");
require("business/LogDomiciliario.php");
require("business/Domiciliario.php");
require("business/LogCliente.php");
require("business/Cliente.php");
require("business/Domicilio.php");
require("business/LogCajero.php");
require("business/Cajero.php");
require("business/Pedido.php");
require("business/PedidoPro.php");
require("business/Cocinero.php");
require("business/Proveedor.php");
ini_set("display_errors","1");
date_default_timezone_set("America/Bogota");
$webPagesNoAuthentication = array(
	'ui/recoverPassword.php',
	'ui/cliente/insertCliente.php',
);
$webPages = array(
	'ui/sessionAdministrador.php',
	'ui/administrador/insertAdministrador.php',
	'ui/administrador/updateAdministrador.php',
	'ui/administrador/selectAllAdministrador.php',
	'ui/administrador/searchAdministrador.php',
	'ui/administrador/updateProfileAdministrador.php',
	'ui/administrador/updatePasswordAdministrador.php',
	'ui/administrador/updateProfilePictureAdministrador.php',
	'ui/administrador/updateFotoAdministrador.php',
	'ui/logAdministrador/searchLogAdministrador.php',
	'ui/inventario/insertInventario.php',
	'ui/inventario/updateInventario.php',
	'ui/inventario/selectAllInventario.php',
	'ui/inventario/searchInventario.php',
	'ui/ingrediente/insertIngrediente.php',
	'ui/ingrediente/updateIngrediente.php',
	'ui/ingrediente/selectAllIngrediente.php',
	'ui/ingrediente/searchIngrediente.php',
	'ui/ingrePro/selectAllIngreProByIngrediente.php',
	'ui/inventario/selectAllInventarioByIngrediente.php',
	'ui/ingrePro/insertIngrePro.php',
	'ui/ingrePro/updateIngrePro.php',
	'ui/ingrePro/selectAllIngrePro.php',
	'ui/ingrePro/searchIngrePro.php',
	'ui/producto/insertProducto.php',
	'ui/producto/updateProducto.php',
	'ui/producto/selectAllProducto.php',
	'ui/producto/searchProducto.php',
	'ui/ingrePro/selectAllIngreProByProducto.php',
	'ui/proDom/selectAllProDomByProducto.php',
	'ui/pedidoPro/selectAllPedidoProByProducto.php',
	'ui/proDom/insertProDom.php',
	'ui/proDom/updateProDom.php',
	'ui/proDom/selectAllProDom.php',
	'ui/proDom/searchProDom.php',
	'ui/logDomiciliario/searchLogDomiciliario.php',
	'ui/sessionDomiciliario.php',
	'ui/domiciliario/insertDomiciliario.php',
	'ui/domiciliario/updateDomiciliario.php',
	'ui/domiciliario/selectAllDomiciliario.php',
	'ui/domiciliario/searchDomiciliario.php',
	'ui/domiciliario/updateProfileDomiciliario.php',
	'ui/domiciliario/updatePasswordDomiciliario.php',
	'ui/domiciliario/updateProfilePictureDomiciliario.php',
	'ui/domicilio/selectAllDomicilioByDomiciliario.php',
	'ui/domiciliario/updateFotoDomiciliario.php',
	'ui/logCliente/searchLogCliente.php',
	'ui/sessionCliente.php',
	
	'ui/cliente/updateCliente.php',
	'ui/cliente/selectAllCliente.php',
	'ui/cliente/searchCliente.php',
	'ui/cliente/updateProfileCliente.php',
	'ui/cliente/updatePasswordCliente.php',
	'ui/cliente/updateProfilePictureCliente.php',
	'ui/domicilio/selectAllDomicilioByCliente.php',
	'ui/cliente/updateFotoCliente.php',
	'ui/domicilio/insertDomicilio.php',
	'ui/domicilio/updateDomicilio.php',
	'ui/domicilio/selectAllDomicilio.php',
	'ui/domicilio/searchDomicilio.php',
	'ui/proDom/selectAllProDomByDomicilio.php',
	'ui/logCajero/searchLogCajero.php',
	'ui/sessionCajero.php',
	'ui/cajero/insertCajero.php',
	'ui/cajero/updateCajero.php',
	'ui/cajero/selectAllCajero.php',
	'ui/cajero/searchCajero.php',
	'ui/cajero/updateProfileCajero.php',
	'ui/cajero/updatePasswordCajero.php',
	'ui/cajero/updateProfilePictureCajero.php',
	'ui/pedido/selectAllPedidoByCajero.php',
	'ui/cajero/updateFotoCajero.php',
	'ui/pedido/insertPedido.php',
	'ui/pedido/updatePedido.php',
	'ui/pedido/selectAllPedido.php',
	'ui/pedido/searchPedido.php',
	'ui/pedidoPro/selectAllPedidoProByPedido.php',
	'ui/pedidoPro/insertPedidoPro.php',
	'ui/pedidoPro/updatePedidoPro.php',
	'ui/pedidoPro/selectAllPedidoPro.php',
	'ui/pedidoPro/searchPedidoPro.php',
	'ui/cocinero/insertCocinero.php',
	'ui/cocinero/updateCocinero.php',
	'ui/cocinero/selectAllCocinero.php',
	'ui/cocinero/searchCocinero.php',
	'ui/proveedor/insertProveedor.php',
	'ui/proveedor/updateProveedor.php',
	'ui/proveedor/selectAllProveedor.php',
	'ui/proveedor/searchProveedor.php',
	'modalCrearProducto.php',
	'modalEditarPedido.php',
	'modalCrearDomicilio.php',
);
if(isset($_GET['logOut'])){
	$_SESSION['id']="";
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		
		<title>PAR</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" type="image/png" href="img/logo.png" />
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">

		<link href="styles.css"  rel="stylesheet" >
		


		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.1/css/all.css" />
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>

		<script charset="utf-8">
			$(function () { 
				$("[data-toggle='tooltip']").tooltip(); 
			});
		</script>
	</head>
	<body>
		<?php
		if(empty($_GET['pid'])){
			include('ui/home.php' );
		}else{
			$pid=base64_decode($_GET['pid']);
			if(in_array($pid, $webPagesNoAuthentication)){
				include($pid);
			}else{
				if($_SESSION['id']==""){
					header("Location: index.php");
					die();
				}
				if($_SESSION['entity']=="Administrador"){
					include('ui/menuAdministrador.php');
				}
				if($_SESSION['entity']=="Domiciliario"){
					include('ui/menuDomiciliario.php');
				}
				if($_SESSION['entity']=="Cliente"){
					include('ui/menuCliente.php');
				}
				if($_SESSION['entity']=="Cajero"){
					include('ui/menuCajero.php');
				}
				if (in_array($pid, $webPages)){
					include($pid);
				}else{
					include('ui/error.php');
				}
			}
		}
		?>
		<div class="text-center text-muted">ITI &copy; <?php echo date("Y")?></div>
	</body>
</html>

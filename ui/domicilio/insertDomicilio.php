<!-- Se usa -->
<script type="">
	function agregar(id, descripcion,fecha,hora, direccion,precio){



		const database = firebase.database();

			database.ref('/Pedidos/'+(hora)).set({
				id:id,
				descripcion:descripcion,
				fecha:fecha,
				hora:hora,
				estado:"1",
				tipo:"Domicilio",
				direccion:direccion,
				precio:precio
			});			
		}
		function salir(){
			window.location.replace("index.php?pid=<?php echo base64_encode("ui/domicilio/insertDomicilio.php") ?>&idp=0");
									
								}
							

								</script>	

	<?php

	$cliente = new Cliente($_SESSION['id']);
	$cliente -> select();
	$array = array();
	$arrays = array();
	$precioTotal=0;
	$nuevoPedido= new pedido();
	$nuevoDomicilio= new Domicilio();
	$variableGlobal=0;
	$primerID=array();
	if( $_GET["idp"]!=0){

		$idp = $_GET["idp"];
		$idn = $_GET["idn"];
		$total = $_GET["total"];
		$cantidad = $_GET["cantidad"];
		if($cantidad>0){
			if($nuevoDomicilio->verificarTemporal($idp,$_SESSION['id'])==0){

			$nuevoDomicilio->insertTemporal($idp,$idn,$total,$cantidad,$_SESSION['id']);
		}else{
			
			$nuevoDomicilio->updateTemporal($idp,$total,$cantidad,$_SESSION['id']);

		}
		}

		




	}else{

		if(isset($_GET['eliminar'])){

			$eliminar=$_GET['eliminar'];
			$nuevoDomicilio->eliminar($eliminar,$_SESSION['id']);

		}
		if(isset($_GET['limpiar'])){
			$direccion = $_GET["direccion"];
			$fecha= date("Y-m-d ");
			$hora = date("H:i:s");	
			$precio=$_GET['limpiar'];
			$descripcion="";			
			$arrays=$nuevoDomicilio->imprimirTemporal($_SESSION['id']);
			$nuevoDomicilio->eliminarTemporal($_SESSION['id']);
			foreach ($arrays as $facturas) {
				$descripcion= $descripcion." ".$facturas[3]." ".$facturas[1].".";
			}	
			if($descripcion!=""){
			$crearDomicilio = new domicilio("",$direccion,$fecha,$hora,$precio,$descripcion,1,"",$_SESSION['id']);



			$crearDomicilio->insert();	
			$crearDomicilio->buscarDomicilio();

			$firebase = "";
			foreach ($arrays as $facturas) {
				$ProDom = new ProDom("",$crearDomicilio->getIdDomicilio(),$facturas[0],$facturas[3],$facturas[2]);
				$firebase = $firebase." ".$facturas[3]."x ".$facturas[1].":   ".$facturas[2]."-";
				$ProDom->insert();
				$bandera=true;
									# code...
			}
			echo "<script type='text/javascript'>
			agregar('".$crearDomicilio->getIdDomicilio()."','".$firebase."','".$fecha."','".$hora."','".$direccion."','".$precio."');	


			</script>";

			if($bandera){
			echo "<script type='text/javascript'>
			
			window.setTimeout(salir,2000);
										
				</script>";
			}

			//echo $crearDomicilio->getIdDomicilio();
			}		  			

			
			
		}

	}
	if($nuevoDomicilio->imprimirTemporal($_SESSION['id'])!=null ){
		$array=$nuevoDomicilio->imprimirTemporal($_SESSION['id']);
	}






	$processed=false;
	$fecha=date("d/m/Y");
	if(isset($_POST['fecha'])){
		$fecha=$_POST['fecha'];
	}
	$hora=date("d/m/Y");
	if(isset($_POST['hora'])){
		$hora=$_POST['hora'];
	}
	$descripcion="";
	if(isset($_POST['descripcion'])){
		$descripcion=$_POST['descripcion'];
	}
	$precio="";
	if(isset($_POST['precio'])){
		$precio=$_POST['precio'];
	}
	$cocinando="";
	if(isset($_POST['cocinando'])){
		$cocinando=$_POST['cocinando'];
	}
	$cajero="";
	if(isset($_POST['cajero'])){
		$cajero=$_POST['cajero'];
	}
	if(isset($_GET['idCajero'])){
		$cajero=$_GET['idCajero'];
	}
	if(isset($_POST['insert'])){
		$newPedido = new Pedido("", $fecha, $hora, $descripcion, $precio, $cocinando, $cajero);
		$newPedido -> insert();
		$objCajero = new Cajero($cajero);
		$objCajero -> select();
		$nameCajero = $objCajero -> getNombre() . " " . $objCajero -> getApellido() ;
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
			$logAdministrador = new LogAdministrador("","Crear Pedido", "Fecha: " . $fecha . "; Hora: " . $hora . "; Descripcion: " . $descripcion . "; Precio: " . $precio . "; Cocinando: " . $cocinando . "; Cajero: " . $nameCajero , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrador -> insert();
		}
		else if($_SESSION['entity'] == 'Domiciliario'){
			$logDomiciliario = new LogDomiciliario("","Crear Pedido", "Fecha: " . $fecha . "; Hora: " . $hora . "; Descripcion: " . $descripcion . "; Precio: " . $precio . "; Cocinando: " . $cocinando . "; Cajero: " . $nameCajero , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logDomiciliario -> insert();
		}
		else if($_SESSION['entity'] == 'Cliente'){
			$logCliente = new LogCliente("","Crear Pedido", "Fecha: " . $fecha . "; Hora: " . $hora . "; Descripcion: " . $descripcion . "; Precio: " . $precio . "; Cocinando: " . $cocinando . "; Cajero: " . $nameCajero , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logCliente -> insert();
		}
		else if($_SESSION['entity'] == 'Cajero'){
			$logCajero = new LogCajero("","Crear Pedido", "Fecha: " . $fecha . "; Hora: " . $hora . "; Descripcion: " . $descripcion . "; Precio: " . $precio . "; Cocinando: " . $cocinando . "; Cajero: " . $nameCajero , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logCajero -> insert();
		}
		$processed=true;
	}
	?>

	<div>
		<div class="row ">
			<div class="col-md-8" name="Crear Pedido">
				<div class="card">
					<div class="col-md-4 container">
						<h4 class="card-title">Crear Domicilio</h4>
					</div>
					<div class="card-body">
						<div class="container">
							<div class="row">
								<div class="col-md-2"></div>
								<div class="col-md-8">
									<input type="text" class="form-control" id="search" placeholder="Buscar Producto" autocomplete="off" />
								</div>

							</div>
						</div>
						<div id="searchResult"></div>
					</div>

				</div>
				
			</div>




			<div class="col-md-4" name="Crear Factura">

				<div class="col-md-4 container ">
					<h4 class="card-title">Crear Factura</h4>
				</div>

				<div class="scroll-container">

					<table class="table table-striped table-hover">

						<tr>
							<td>IDP</td>
							<td>Nombre</td>
							<td>Descripción</td>
							<td>Cantidad</td>
							<td>Precio</td>
							<td>Eliminar</td>
							<td>Editar</td>
						</tr>
						<tr>	

							<?php 

							foreach ($array as $facturas) {		
								echo "<td>" . $facturas[0] . "</td>";
								echo "<td>" . $facturas[1] . "</td>";
								echo "<td>" . $facturas[2] . "</td>";
								echo "<td>" . $facturas[3] . "</td>";
								echo "<td>" . $facturas[4]*$facturas[3] . "</td>";
								$precioTotal+=$facturas[4]*$facturas[3];


								echo "<td> <a class='btn btn-outline-danger' href='index.php?pid=" . base64_encode("ui/domicilio/insertDomicilio.php") . "&eliminar=" . $facturas[0] . "&idp=0' onclick='return confirm(\"Confirma eliminar Pedido: " . $facturas[2] . " " . $facturas[4]*$facturas[3] . "\")'> x</a> </td>";
								echo "<td> <a class='btn btn-outline-warning' href='modalCrearDomicilio.php?id=".$facturas[0]."&idc=".$_SESSION['id']."'
								data-toggle='modal'
								data-target='#modalCrearProducto'
								>Editar </a> </td>";

							
								echo "</tr>";
							
											  			# code...
							}
							?>


						</table>

					</div>

					<table class="table"> 

						<td>
							<h4>Direccion</h4><br>

							<h6> Precio Total</h6>
						</td>
						<td>
							<input id="direccion" class="form-control" value="<?php echo $cliente -> getDireccion()?>"><br>

							<h6 id="precio"><?php echo $precioTotal; ?></h6>
						</td>
						<td>

							<?php 
							if($nuevoDomicilio->verificar($_SESSION['id'])==1){
								

								echo "<a   class='btn btn-outline-success' onclick=enviar(); >Enviar pedido </a> <br>"; 
								

							}
							


							?>

						</td>


					</table>	

				</div>



			</div>
		</div>
	</div>
	<div class="modal fade" id="modalCrearProducto" data-keyboard="false" data-backdrop="static"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content" id="modalContent">
		</div>
	</div>
</div>

<script>
	$('body').on('show.bs.modal', '.modal', function (e) {
		var link = $(e.relatedTarget);
		$(this).find(".modal-content").load(link.attr("href"));
	});
</script>


	<script>
		$(document).ready(function(){
			$("#search").keyup(function(){
				if($("#search").val().length > 2){
					var search = $("#search").val().replace(" ", "%20");
					var path = "indexAjax.php?pid=<?php echo base64_encode("ui/producto/searchProductoDomicilio.php"); ?>&search="+search+"&entity=<?php echo $_SESSION['entity'] ?>&idc=<?php echo $_SESSION['id'] ?>";
					$("#searchResult").load(path);
				}
			});
		});

		function enviar(){
//href='index.php?pid=" . base64_encode("ui/domicilio/insertDomicilio.php") ."&limpiar=". $precioTotal."&idp=0'
			var precio = <?php echo $precioTotal; ?>;
			var direccion= document.getElementById("direccion").value;
			
			window.location.replace("index.php?pid=<?php echo base64_encode("ui/domicilio/insertDomicilio.php")?>&limpiar="+precio+"&idp=0&direccion="+direccion);
			alert("Tu pedido fue enviado");
		}





	</script>


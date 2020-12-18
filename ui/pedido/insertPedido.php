		<?php
		$array = array();
		$precioTotal=0;
		if( $_GET["idp"]!=0){
		$idp = $_GET["idp"];
		$idn = $_GET["idn"];
		$total = $_GET["total"];
		$cantidad = $_GET["cantidad"];
			
			$nuevoPedido= new pedido();
			$nuevoPedido->insertTemporal($idp,$idn,$total,$cantidad);
			$array=$nuevoPedido->imprimirTemporal();
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
							<h4 class="card-title">Crear Pedido</h4>
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
					<div  class="overflow-auto">
						<div class="col-md-4 container ">
							<h4 class="card-title">Crear Factura</h4>
						</div>
							<div class="table-responsive overflow-auto"> 
							<table class="table table-striped table-hover">
								
							  <tr>
							    <td>IDP</td>

							    <td>Nombre</td>

							    <td>Descripción</td>

							    <td>Cantidad</td>

							    <td>Precio</td>

							  </tr>

							  <tr>
							  	
							  	<?php 

							  		foreach ($array as $facturas) {
							  			
							  			echo "<td>" . $facturas[1] . "</td>";
							  			echo "<td>" . $facturas[2] . "</td>";
							  			echo "<td>" . $facturas[3] . "</td>";
							  			echo "<td>" . $facturas[4] . "</td>";
							  			echo "<td>" . $facturas[5]*$facturas[4] . "</td>";
							  			$precioTotal+=$facturas[5]*$facturas[4];
							  			echo "</tr>";
							  			# code...
							  		}




							  	 ?>
							 
							   
							</table>
							</div> 
							<table class="table"> 

								<td>
									<h6> Precio Total</h6>
								</td>
								<td>
									<h6><?php echo $precioTotal; ?></h6>
								</td>
							</table>
							
						</div>
					</div>
						





						
					</div>
				</div>
			</div>

		</div>
		<script>
		$(document).ready(function(){
			$("#search").keyup(function(){
				if($("#search").val().length > 2){
					var search = $("#search").val().replace(" ", "%20");
					var path = "indexAjax.php?pid=<?php echo base64_encode("ui/producto/searchProductoPedido.php"); ?>&search="+search+"&entity=<?php echo $_SESSION['entity'] ?>";
					$("#searchResult").load(path);
				}
			});
		});
		</script>
			

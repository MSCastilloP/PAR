<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$error = 0;
if(isset($_GET['action']) && $_GET['action']=="delete"){
	$deleteProducto = new Producto($_GET['idProducto']);
	$deleteProducto -> select();
	if($deleteProducto -> delete()){
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
			$logAdministrador = new LogAdministrador("","Delete Producto", "Nombre: " . $deleteProducto -> getNombre() . ";; Precio: " . $deleteProducto -> getPrecio() . ";; Descripcion: " . $deleteProducto -> getDescripcion() . ";; Foto: " . $deleteProducto -> getFoto(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrador -> insert();
		}
		else if($_SESSION['entity'] == 'Domiciliario'){
			$logDomiciliario = new LogDomiciliario("","Delete Producto", "Nombre: " . $deleteProducto -> getNombre() . ";; Precio: " . $deleteProducto -> getPrecio() . ";; Descripcion: " . $deleteProducto -> getDescripcion() . ";; Foto: " . $deleteProducto -> getFoto(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logDomiciliario -> insert();
		}
		else if($_SESSION['entity'] == 'Cliente'){
			$logCliente = new LogCliente("","Delete Producto", "Nombre: " . $deleteProducto -> getNombre() . ";; Precio: " . $deleteProducto -> getPrecio() . ";; Descripcion: " . $deleteProducto -> getDescripcion() . ";; Foto: " . $deleteProducto -> getFoto(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logCliente -> insert();
		}
		else if($_SESSION['entity'] == 'Cajero'){
			$logCajero = new LogCajero("","Delete Producto", "Nombre: " . $deleteProducto -> getNombre() . ";; Precio: " . $deleteProducto -> getPrecio() . ";; Descripcion: " . $deleteProducto -> getDescripcion() . ";; Foto: " . $deleteProducto -> getFoto(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logCajero -> insert();
		}
	}else{
		$error = 1;
	}
}
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Consultar Producto</h4>
		</div>
		<div class="card-body">
	
		<div class="table-responsive">
			<table class="table ">
				<thead>
					<tr>
						<th >ID 					
						</th>
						<th nowrap>Hora</th>
						<th nowrap>Descripcion 			
						</th>
						<th nowrap>Estado 
						
						</th>
						
						<th>
							boton
						</th>
					</tr>
				</thead>
				</tbody>
					<?php
					$domicilio = new Domicilio();
					$pedo= new ProDom();
					$pedido = new Pedido();
					$pepo= new PedidoPro();
					$dom =	$domicilio -> selectAllCocinero(); 
					$ped =	$pedido -> selectAllCocinero(); 
					$banderaP=true;
					$banderaD=true;
					$countP=0;
					$countD=0;


if(count($dom)==0){
$banderaD=false;
}
if(count($ped)==0){
	$banderaP=false;

}
					while($banderaD==true || $banderaP==true){

						if($banderaD==false ){
							$var=$pepo->selectDescripcionCocinero($ped[$countP]->getIdPedido());
							echo "<tr class='bg-warning'><td> P".$ped[$countP]->getIdPedido()."</td>";
							echo "<td> ".$ped[$countP]->getHora()."</td>";
							echo "<td>";
							foreach ($var as $a) {
							echo $a[0]." x ";
								echo $a[1].": ";
								echo $a[2]."<br> ";
							}
								echo "</td>";
								if($ped[$countP]->getCocinando()==1){
							echo "<td> Cola </td></tr>";
								}else if($ped[$countP]->getCocinando()==2){
									echo "<td> Cocinando </td></tr>";
								}
							
						
							
							$countP++;
						}else if($banderaP==false){
							$var=$pedo->selectDescripcionCocinero($dom[$countD]->getIdDomicilio());
							echo "<tr  class='bg-danger'><td> D".$dom[$countD]->getIdDomicilio()."</td>";
							echo "<td> ".$dom[$countD]->getHora()."</td>";
							echo "<td>";
							foreach ($var as $a) {
								echo $a[0]." x ";
								echo $a[1].": ";
								echo $a[2]."<br> ";
							}
								echo "</td>";

								if($dom[$countD]->getCocinando()==1){
							echo "<td> Cola </td></tr>";
								}else if($dom[$countD]->getCocinando()==2){
									echo "<td> Cocinando </td></tr>";
								}else if($dom[$countD]->getCocinando()==3){
									echo "<td> Hecho </td></tr>";
								}
							
							
							$countD++;
						}
						else if(strtotime($dom[$countD]->getHora())<strtotime($ped[$countP]->getHora())){
							$var=$pedo->selectDescripcionCocinero($dom[$countD]->getIdDomicilio());
							echo "<tr class='bg-danger><td> D".$dom[$countD]->getIdDomicilio()."</td>";
							echo "<td> ".$dom[$countD]->getHora()."</td>";
							echo "<td>";
							foreach ($var as $a) {
								echo $a[0]." x ";
								echo $a[1].": ";
								echo $a[2]."<br> ";
							}
								echo "</td>";
								
							if($dom[$countD]->getCocinando()==1){
							echo "<td> Cola </td></tr>";
								}else if($dom[$countD]->getCocinando()==2){
									echo "<td> Cocinando </td></tr>";
								}else if($dom[$countD]->getCocinando()==3){
									echo "<td> Hecho </td></tr>";
								}
							
							$countD++;
		            		
		            }else{
		            		$var=$pepo->selectDescripcionCocinero($ped[$countP]->getIdPedido());
							echo "<tr class='bg-warning'><td> P".$ped[$countP]->getIdPedido()."</td>";
							echo "<td> ".$ped[$countP]->getHora()."</td>";
							echo "<td>";
							foreach ($var as $a) {
								echo $a[0]." x ";
								echo $a[1].": ";
								echo $a[2]."<br> ";
							}
								echo "</td>";
							if($ped[$countP]->getCocinando()==1){
							echo "<td> Cola </td></tr>";
								}else if($ped[$countP]->getCocinando()==2){
									echo "<td> Cocinando </td></tr>";
								}
							
							
							$countP++;
		            	
		            }


		            if($countD==count($dom)){
		            	$banderaD=false;
		            }
		             if($countP==count($ped)){
		            	$banderaP=false;
		            }

					}





					//echo $dom[0]->getDescripcion() ." ".$ped[0]->getDescripcion() ;

					/*$hora1 =  strtotime($dom[0]->getHora());
		            $hora2 =  strtotime($ped[0]->getHora());
		            if(strtotime($dom[0]->getHora())>strtotime($ped[0]->getHora())){
		            		echo "Domicilio";
		            }else{
		            	echo "Pedidos";
		            }
		            echo count($dom)." ----- ".count($ped);
					$counter = 1;*/
				  
					?>
				</tbody>
			</table>
			</div>
		</div>
		
	</div>
</div>
<div class="modal fade" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

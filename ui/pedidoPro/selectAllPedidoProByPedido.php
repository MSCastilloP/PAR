<script type="text/javascript">

	function salir(idpro,idpedido){

		window.location.replace("index.php?pid=<?php echo base64_encode("ui/pedido/selectAllPedido.php")?>&idpro="+idpro+"&idpedido="+idpedido);
		
	}
	
</script>
<?php
$order = "";
if($_GET['idp']!=0){
$idp=$_GET['idp'];
$idn=$_GET['idn'];
$total =$_GET['total'];
$cantidad=$_GET['cantidad'];
$prod=new Producto($idp);
$prod->select();
$pepo=new PedidoPro('',$_GET['idPedido']);
$variable=$pepo->selectAllByPedido();
$desc="";
$precioP=0;
$pepo->updatePEPO($_GET['idPedido'],$idp,$total,$cantidad);
$aux=$pepo->traerCantidades($_GET['idPedido']);
$count=0;
foreach ($variable as $v) {
	if($idp!=$v->getProducto()->getIdProducto()){
		$desc=$desc." ".$v->getCantidad()." ".$v->getProducto()->getNombre();
	}else{
		$desc=$desc." ".$cantidad." ".$idn;
	}

	$precioP+=$v->getProducto()->getPrecio()*$aux[$count]	;
	$count++;
}
echo "\n".$desc;


$ped= new Pedido($_GET['idPedido'],"","",$desc,$precioP);
$ped->updateP();

echo "<script type=''>
function editar(id,cantidad,total,idPedido){

var ped = db.collection('Pedidos').doc(idPedido+id);


return ped.update({
	cantidad: cantidad,
	descripcion:total

})
.then(() => {
    console.log('Document successfully updated!' );
})
.catch((error) => {
    // The document probably doesn't exist.
    console.error('Error updating document: ', error);
});


}
editar('".$idp."','".$cantidad."','".$total."','".$_GET['idPedido']."');






</script>";



}



if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}



$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete" && $_GET['idp']==0){
	
	$deletePedidoPro = new PedidoPro($_GET['idPedidoPro']);

	if($deletePedidoPro -> existe() == 1 ){
	$deletePedidoPro -> select();
	$pedidoPro=new PedidoPro("",$deletePedidoPro->getPedido()->getidPedido());
	if($deletePedidoPro -> delete()){

		
		if($pedidoPro ->validar()==0){
			$ped= new Pedido($deletePedidoPro->getPedido()->getidPedido());
			$ped->delete();
			
echo "<script type='text/javascript'>
		salir('".$_GET['idpro']."','".$_GET['idPedido']."');
</script>";
			
		}else{
			echo "<script type='text/javascript'>
						function eliminar(id,idPedido){
						db.collection('Pedidos').doc(idPedido+id).delete().then(function() {	
				    console.log('Document successfully deleted!');
				}).catch(function(error) {
				    console.error('Error removing document: ', error);
				});
				}
				eliminar('".$_GET['idpro']."','".$_GET['idPedido']."');
		
										
				</script>";
		$array=$pedidoPro->selectAllByPedido();
		$descripcion="";
		$precio=0;
		

		foreach($array as $a){
			$descripcion=$descripcion." ".$a->getCantidad()." ".$a->getProducto()->getNombre();
			$precio+=$a->getCantidad()*$a->getProducto()->getPrecio();		
		}

		$ped= new Pedido($pedidoPro->getPedido(),"","",$descripcion,$precio);
		$ped->updateP();


		echo $descripcion." precio".$precio;



		}
		$namePedido = $deletePedidoPro -> getPedido() -> getDescripcion() . " " . $deletePedidoPro -> getPedido() -> getPrecio() . " " . $deletePedidoPro -> getPedido() -> getCocinando();


		$nameProducto = $deletePedidoPro -> getProducto() -> getNombre() . " " . $deletePedidoPro -> getProducto() -> getPrecio() . " " . $deletePedidoPro -> getProducto() -> getDescripcion() . " " . $deletePedidoPro -> getProducto() -> getFoto();



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
			$logAdministrador = new LogAdministrador("","Delete Pedido Pro", "Pedido: " . $namePedido . ";; Producto: " . $nameProducto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrador -> insert();
		}
		else if($_SESSION['entity'] == 'Domiciliario'){
			$logDomiciliario = new LogDomiciliario("","Delete Pedido Pro", "Pedido: " . $namePedido . ";; Producto: " . $nameProducto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logDomiciliario -> insert();
		}
		else if($_SESSION['entity'] == 'Cliente'){
			$logCliente = new LogCliente("","Delete Pedido Pro", "Pedido: " . $namePedido . ";; Producto: " . $nameProducto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logCliente -> insert();
		}
		else if($_SESSION['entity'] == 'Cajero'){
			$logCajero = new LogCajero("","Delete Pedido Pro", "Pedido: " . $namePedido . ";; Producto: " . $nameProducto, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logCajero -> insert();
		}
	}else{
		$error = 1;
	}

	}

	
	
}
$pedido = new Pedido($_GET['idPedido']); 
$pedido -> select();
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Consultar Pedido Pro de Pedido: <em><?php echo $pedido -> getDescripcion() . " " . $pedido -> getPrecio() . " " . $pedido -> getCocinando() ?></em></h4>
		</div>
		<div class="card-body">
		<?php if(isset($_GET['action']) && $_GET['action']=="delete"){ ?>
			<?php if($error == 0){ ?>
				<div class="alert alert-success" >The registry was succesfully deleted.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php } else { ?>
				<div class="alert alert-danger" >The registry was not deleted. Check it does not have related information
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php }
			} ?>
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th>Pedido</th>
						<th>Producto</th>
						<th>Servicios</th>

						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$pedidoPro = new PedidoPro("", $_GET['idPedido'], "");
					if($order!="" && $dir!="") {
						$pedidoPros = $pedidoPro -> selectAllByPedidoOrder($order, $dir);
					} else {
						$pedidoPros = $pedidoPro -> selectAllByPedido();
					}
					$counter = 1;
					foreach ($pedidoPros as $currentPedidoPro) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>".$currentPedidoPro->getProducto()->getNombre()."</td>";
						echo "<td>".$currentPedidoPro->getDescripcion()."</td>";
						
						if($_SESSION['entity'] == 'Cajero') {
							echo "<td><a href='modalEditarPedido.php?id=".$currentPedidoPro->getProducto()->getIdProducto()."&idp=".$_GET['idPedido']. "'
								data-toggle='modal'
								data-target='#modalEditarPedido' ><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Pedido ' ></span></a> ";




							echo "<a href='index.php?pid=" . base64_encode("ui/pedidoPro/selectAllPedidoProByPedido.php") . "&idPedido=" . $_GET['idPedido'] . "&idPedidoPro=" . $currentPedidoPro -> getIdPedidoPro() . "&action=delete&idp=0&idpro=".$currentPedidoPro->getProducto()->getIdProducto()."'  onclick='return confirm(\"Confirm to delete Pedido Pro\")'> <span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Pedido Pro' ></span></a> </td>";
						}
						echo "</td>";
						echo "</tr>";
						$counter++;
					};
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalEditarPedido" data-keyboard="false" data-backdrop="static"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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




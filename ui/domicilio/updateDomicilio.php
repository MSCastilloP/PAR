<script type="text/javascript">

	function salir(idpro,idDomicilio){

		window.location.replace("index.php?pid=<?php echo base64_encode("ui/domicilio/selectAllDomicilio.php")?>&idpro="+idpro+"&idDomicilio="+idDomicilio);
		
	}
	
</script>
<?php
$order = "";
if($_GET['idp']!=0){
//Es la id de producto
$idp=$_GET['idp'];
//idn es el nombre del producto
$idn=$_GET['idn'];
//total la descripcion de la orden del producto
$total =$_GET['total'];
//cantidad ª
$cantidad=$_GET['cantidad'];
$objDom = new Domicilio($_GET['idDomicilio']);
$prod=new Producto($idp);
$prod->select();
$pedo=new ProDom('',$_GET['idDomicilio']);
$variable=$pedo->selectAllByDomicilio();
$desc="";
$precioP=0;
$pedo->updatePEDO($_GET['idDomicilio'],$idp,$total,$cantidad);
$aux=$pedo->traerCantidades($_GET['idDomicilio']);
$count=0;
$firebase = "";
$objDom->select();

foreach ($variable as $v) {
	if($idp!=$v->getProducto()->getIdProducto()){
		$desc=$desc." ".$v->getCantidad()." ".$v->getProducto()->getNombre();
		$firebase=$firebase." ".$v->getCantidad()."x ".$v->getProducto()->getNombre().": ".$v->getDescripcion()."-";
	}else{
		
		$desc=$desc." ".$cantidad." ".$idn;
		$firebase=$firebase." ".$cantidad."x ".$idn.": ".$total."-";
	}

	$precioP+=$v->getProducto()->getPrecio()*$aux[$count]	;
	$count++;
}
echo "\n".$desc;


$dom= new Domicilio($_GET['idDomicilio'],"","","",$precioP,$desc);
$dom->updateP();

echo "<script type=''>
function editar(total,idDomicilio,fecha,hora,direccion,precio){

	const database = firebase.database();
	const newData ={
		descripcion:total,
		id:idDomicilio,
		tipo:'Domicilio',
		fecha:fecha,
		hora:hora,
		estado:'1',
		direccion:direccion,
		precio:precio
	}
const updates ={};
updates ['/Pedidos/'+(hora)]=newData;
database.ref().update(updates);
}
editar('".$firebase."','".$_GET['idDomicilio']."','".$objDom->getFecha()."','".$objDom->getHora()."','".$objDom->getDireccion()."','".$precioP."');






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
	
	$deletePedo = new ProDom($_GET['idProDom']);
	$deletePedo -> select();
	$pedo=new ProDom("",$deletePedo->getDomicilio()->getidDomicilio());

	$dom= new Domicilio($deletePedo->getDomicilio()->getidDomicilio());
	$dom->select();
	if($deletePedo -> delete()){
		if($pedo ->validar()==0){

			$c= $dom ->getCocinando();
		
			$dom->delete($c);
			echo "<script type='text/javascript'>
			salir('".$_GET['idPro']."','".$_GET['idDomicilio']."');
			</script>";
			
		}else{
			
			$traerProDom=$pedo -> selectAllByDomicilio();
			$firebase = "";
			foreach($traerProDom as $t){
				$firebase = $firebase." ".$t->getCantidad(). "x ".$t->getProducto()->getNombre(). ": ".$t->getDescripcion()."-"; 

			}
				
		$array=$pedo->selectAllByDomicilio();
		$descripcion="";
		$precio=0;
		

		foreach($array as $a){
			$descripcion=$descripcion." ".$a->getCantidad()." ".$a->getProducto()->getNombre();
			$precio+=$a->getCantidad()*$a->getProducto()->getPrecio();		
		}
		
		echo "va a entrar";
		echo "<script type=''>
				function editar(total,idDomicilio,fecha,hora,direccion,precio){

					const database = firebase.database();
					const newData ={
						descripcion:total,
						id:idDomicilio,
						tipo:'Domicilio',
						fecha:fecha,
						hora:hora,
						estado:'1',
						direccion:direccion,
						precio:precio
					}
				const updates ={};
				updates ['/Pedidos/'+(hora)]=newData;
				database.ref().update(updates);
				console.log('entrar');
				}
				editar('".$firebase."','".$_GET['idDomicilio']."','".$dom->getFecha()."','".$dom->getHora()."','".$dom->getDireccion()."','".$precio."');
				</script>";
				$dome= new Domicilio($deletePedo->getDomicilio()->getidDomicilio(),"","","",$precio,$descripcion);
		$dome->updateP();
		
		}
		$namePedido = $deletePedo -> getDomicilio() -> getDescripcion() . " " . $deletePedo -> getDomicilio() -> getPrecio() . " " . $deletePedo -> getDomicilio() -> getCocinando();


		$nameProducto = $deletePedo -> getProducto() -> getNombre() . " " . $deletePedo -> getProducto() -> getPrecio() . " " . $deletePedo -> getProducto() -> getDescripcion() . " " . $deletePedo -> getProducto() -> getFoto();



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

$domicilio = new Domicilio($_GET['idDomicilio']); 
$domicilio -> select();


?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Consultar Domicilio </h4>
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
						<th>Cantidad</th>
						<th>Descripcion</th>
						<th>Servicios</th>

						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$prodom = new proDom("", $_GET['idDomicilio'], "");
					if($order!="" && $dir!="") {
						$prodoms = $prodom -> selectAllByDomicilioOrder($order, $dir);
					} else {
						$prodoms = $prodom -> selectAllByDomicilio();
					}
					$counter = 1;
					foreach ($prodoms as $currentProDom) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>".$currentProDom->getProducto()->getNombre()."</td>";
						echo "<td>".$currentProDom->getCantidad()."</td>";
						echo "<td>".$currentProDom->getDescripcion()."</td>";
						
						
							echo "<td><a href='modalEditarDomicilio.php?id=".$currentProDom->getProducto()->getIdProducto()."&idp=".$_GET['idDomicilio']. "'
								data-toggle='modal'
								data-target='#modalEditarDomicilio' ><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Producto ' ></span></a> ";




						echo "<a href='index.php?pid=" . base64_encode("ui/domicilio/updateDomicilio.php") . "&idDomicilio=" . $_GET['idDomicilio'] . "&idProDom=" . $currentProDom -> getIdProDom() . "&action=delete&idp=0&idPro=".$currentProDom->getProducto()->getIdProducto()."' onclick='return confirm(\"Confirm to delete Pedido Pro\")'> <span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Eliminar producto' ></span></a> </td>";
						
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
<div class="modal fade" id="modalEditarDomicilio" data-keyboard="false" data-backdrop="static"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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




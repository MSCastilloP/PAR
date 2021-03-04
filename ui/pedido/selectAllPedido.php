<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
if(isset($_GET['idpro']) && isset($_GET['idpedido'])){
echo "<script type='text/javascript'>


		
		function eliminar(id,idPedido){

	const database = firebase.database();
							const rootRef = database.ref('Pedidos');
							rootRef.child(idPedido+id).remove();


}

		

		
				eliminar('".$_GET['idpro']."','".$_GET['idpedido']."');
		
										
				</script>";
}




$error = 0;
if(isset($_GET['action']) && $_GET['action']=="delete"){
	$deletePedido = new Pedido($_GET['idPedido']);
	$deletePedido -> select();
	$pepo= new PedidoPro("",$_GET['idPedido']);
	$pedos = $pepo -> traerProductos();
	foreach ($pedos as $p) {

		echo "<script type='text/javascript'>	
				function eliminar(id,idPedido){
					
							const database = firebase.database();
							const rootRef = database.ref('Pedidos');
							rootRef.child(idPedido+id).remove();

			}	
							eliminar('".$p[0]."','".$_GET['idPedido']."');						
				</script>";
		# code...	
	}
	$pepo->deletePedido();
	if($deletePedido -> delete()){
		$nameCajero = $deletePedido -> getCajero() -> getNombre() . " " . $deletePedido -> getCajero() -> getApellido();
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
			$logAdministrador = new LogAdministrador("","Delete Pedido", "Fecha: " . $deletePedido -> getFecha() . ";; Hora: " . $deletePedido -> getHora() . ";; Descripcion: " . $deletePedido -> getDescripcion() . ";; Precio: " . $deletePedido -> getPrecio() . ";; Cocinando: " . $deletePedido -> getCocinando() . ";; Cajero: " . $nameCajero, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrador -> insert();
		}
		else if($_SESSION['entity'] == 'Domiciliario'){
			$logDomiciliario = new LogDomiciliario("","Delete Pedido", "Fecha: " . $deletePedido -> getFecha() . ";; Hora: " . $deletePedido -> getHora() . ";; Descripcion: " . $deletePedido -> getDescripcion() . ";; Precio: " . $deletePedido -> getPrecio() . ";; Cocinando: " . $deletePedido -> getCocinando() . ";; Cajero: " . $nameCajero, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logDomiciliario -> insert();
		}
		else if($_SESSION['entity'] == 'Cliente'){
			$logCliente = new LogCliente("","Delete Pedido", "Fecha: " . $deletePedido -> getFecha() . ";; Hora: " . $deletePedido -> getHora() . ";; Descripcion: " . $deletePedido -> getDescripcion() . ";; Precio: " . $deletePedido -> getPrecio() . ";; Cocinando: " . $deletePedido -> getCocinando() . ";; Cajero: " . $nameCajero, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logCliente -> insert();
		}
		else if($_SESSION['entity'] == 'Cajero'){
			$logCajero = new LogCajero("","Delete Pedido", "Fecha: " . $deletePedido -> getFecha() . ";; Hora: " . $deletePedido -> getHora() . ";; Descripcion: " . $deletePedido -> getDescripcion() . ";; Precio: " . $deletePedido -> getPrecio() . ";; Cocinando: " . $deletePedido -> getCocinando() . ";; Cajero: " . $nameCajero, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
			<h4 class="card-title">Consultar Pedido</h4>
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
						<th nowrap>Fecha 
						<?php if($order=="fecha" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/pedido/selectAllPedido.php") ?>&order=fecha&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="fecha" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/pedido/selectAllPedido.php") ?>&order=fecha&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Hora 
						<?php if($order=="hora" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/pedido/selectAllPedido.php") ?>&order=hora&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="hora" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/pedido/selectAllPedido.php") ?>&order=hora&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Descripcion 
						<?php if($order=="descripcion" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/pedido/selectAllPedido.php") ?>&order=descripcion&dir=asc'>	
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="descripcion" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/pedido/selectAllPedido.php") ?>&order=descripcion&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Precio 
						<?php if($order=="precio" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/pedido/selectAllPedido.php") ?>&order=precio&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="precio" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/pedido/selectAllPedido.php") ?>&order=precio&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Cocinando 
						<?php if($order=="cocinando" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/pedido/selectAllPedido.php") ?>&order=cocinando&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="cocinando" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/pedido/selectAllPedido.php") ?>&order=cocinando&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						
					</tr>
				</thead>
				</tbody>
					<?php
					$pedido = new Pedido();
					if($order != "" && $dir != "") {
						$pedidos = $pedido -> selectAllOrder($order, $dir);
					} else {
						$pedidos = $pedido -> selectAll();
					}
					$counter = 1;
					foreach ($pedidos as $currentPedido) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentPedido -> getFecha() . "</td>";
						echo "<td>" . $currentPedido -> getHora() . "</td>";
						echo "<td>" . $currentPedido -> getDescripcion() . "</td>";
						echo "<td>" . $currentPedido -> getPrecio() . "</td>";
						echo "<td>" . $currentPedido -> getCocinando() . "</td>";
						
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrador' || $_SESSION['entity'] == 'Cajero' 
							&& $currentPedido -> getCocinando()==1) {
							echo "<a href='index.php?pid=" . base64_encode("ui/pedidoPro/selectAllPedidoProByPedido.php") . "&idPedido=" . $currentPedido -> getIdPedido() . "&idp=0'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Pedido' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrador' || $_SESSION['entity'] == 'Cajero') {
							echo "<a href='index.php?pid=" . base64_encode("ui/pedido/selectAllPedido.php") . "&idPedido=" . $currentPedido -> getIdPedido() . "&action=delete' onclick='return confirm(\"Confirma eliminar Pedido: " . $currentPedido -> getDescripcion() . " " . $currentPedido -> getPrecio() . " " . $currentPedido -> getCocinando() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Pedido' ></span></a> ";
						}
						
						echo "</td>";
						echo "</tr>";
						$counter++;
					}
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalPedido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

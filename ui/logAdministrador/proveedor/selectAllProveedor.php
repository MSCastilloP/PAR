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
	$deleteProveedor = new Proveedor($_GET['idProveedor']);
	$deleteProveedor -> select();
	if($deleteProveedor -> delete()){
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
			$logAdministrador = new LogAdministrador("","Delete Proveedor", "Nombre Empresa: " . $deleteProveedor -> getNombreEmpresa() . ";; Telefono: " . $deleteProveedor -> getTelefono() . ";; Descripcion: " . $deleteProveedor -> getDescripcion(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrador -> insert();
		}
	}else{
		$error = 1;
	}
}
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Consultar Proveedor</h4>
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
						<th nowrap>Nombre Empresa 
						<?php if($order=="nombreEmpresa" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/proveedor/selectAllProveedor.php") ?>&order=nombreEmpresa&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="nombreEmpresa" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/proveedor/selectAllProveedor.php") ?>&order=nombreEmpresa&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Telefono 
						<?php if($order=="telefono" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/proveedor/selectAllProveedor.php") ?>&order=telefono&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="telefono" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/proveedor/selectAllProveedor.php") ?>&order=telefono&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Descripcion 
						<?php if($order=="descripcion" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/proveedor/selectAllProveedor.php") ?>&order=descripcion&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if($order=="descripcion" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/proveedor/selectAllProveedor.php") ?>&order=descripcion&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$proveedor = new Proveedor();
					if($order != "" && $dir != "") {
						$proveedors = $proveedor -> selectAllOrder($order, $dir);
					} else {
						$proveedors = $proveedor -> selectAll();
					}
					$counter = 1;
					foreach ($proveedors as $currentProveedor) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentProveedor -> getNombreEmpresa() . "</td>";
						echo "<td>" . $currentProveedor -> getTelefono() . "</td>";
						echo "<td>" . $currentProveedor -> getDescripcion() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/proveedor/updateProveedor.php") . "&idProveedor=" . $currentProveedor -> getIdProveedor() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Proveedor' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/proveedor/selectAllProveedor.php") . "&idProveedor=" . $currentProveedor -> getIdProveedor() . "&action=delete' onclick='return confirm(\"Confirma eliminar Proveedor: " . $currentProveedor -> getNombreEmpresa() . " " . $currentProveedor -> getTelefono() . " " . $currentProveedor -> getDescripcion() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Proveedor' ></span></a> ";
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
<div class="modal fade" id="modalProveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

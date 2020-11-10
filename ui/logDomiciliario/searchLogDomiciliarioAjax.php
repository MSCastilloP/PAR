<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Accion</th>
			<th nowrap>Fecha</th>
			<th nowrap>Hora</th>
			<th nowrap>Ip</th>
			<th nowrap>So</th>
			<th nowrap>Explorador</th>
			<th>Domiciliario</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$logDomiciliario = new LogDomiciliario();
		$logDomiciliarios = $logDomiciliario -> search($_GET['search']);
		$counter = 1;
		foreach ($logDomiciliarios as $currentLogDomiciliario) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogDomiciliario -> getAccion()) . "</td>";
			echo "<td nowrap>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogDomiciliario -> getFecha()) . "</td>";
			echo "<td nowrap>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogDomiciliario -> getHora()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogDomiciliario -> getIp()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogDomiciliario -> getSo()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogDomiciliario -> getExplorador()) . "</td>";
			echo "<td>" . $currentLogDomiciliario -> getDomiciliario() -> getNombre() . " " . $currentLogDomiciliario -> getDomiciliario() -> getApellido() . " " . $currentLogDomiciliario -> getDomiciliario() -> getTelefono() . " " . $currentLogDomiciliario -> getDomiciliario() -> getSalario() . " " . $currentLogDomiciliario -> getDomiciliario() -> getRol() . "</td>";
			echo "<td class='text-right' nowrap>
				<a href='modalLogDomiciliario.php?idLogDomiciliario=" . $currentLogDomiciliario -> getIdLogDomiciliario() . "'  data-toggle='modal' data-target='#modalLogDomiciliario' >
					<span class='fas fa-eye' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Ver mas información' ></span>
				</a>
				</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
<div class="modal fade" id="modalLogDomiciliario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

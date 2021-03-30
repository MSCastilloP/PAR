<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title text-center">Buscar Log Domiciliario</h4>
		</div>
		<div >
		<h3 class="text-center">Palabras Clave</h3>
			<table class="table table-dark">
				<tr scope="row">
					<td class="text-center">
					Crear
					</td class="text-center">	
					<td class="text-center">
					Eliminar
					</td>	
					<td class="text-center">
					Editar
					</td>	

				</tr>
				
			</table>
		</div>
		<div class="card-body">
			<div class="container">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<input type="text" class="form-control" id="search" placeholder="Buscar Log Domiciliario" autocomplete="off" />
					</div>
				</div>
			</div>
			<div id="searchResult"></div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$("#search").keyup(function(){
		if($("#search").val().length > 0){
			var search = $("#search").val().replace(" ", "%20");
			var path = "indexAjax.php?pid=<?php echo base64_encode("ui/logDomiciliario/searchLogDomiciliarioAjax.php"); ?>&search="+search;
			$("#searchResult").load(path);
		}
	});
});
</script>

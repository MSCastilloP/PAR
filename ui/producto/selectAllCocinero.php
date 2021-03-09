<script>
	let num = 0;
const db = firebase.database().ref('Pedidos');

db.on("child_added", function(snapshot){

	var data = snapshot.val();
	var pedido = document.createElement("tr");
	pedido.setAttribute("class", 'bg-warning');
		pedido.setAttribute("id", snapshot.key);
		
		pedido.innerHTML = HTMLJuego(data,1,snapshot.key);
		document.getElementById("table").appendChild(pedido);
	
});


db.on("child_changed", function(snapshot){
	let variable = snapshot.val();
	var el= document.getElementById(snapshot.key);
	el.innerHTML = HTMLJuego(variable,2,snapshot.key);

});

db.on("child_removed",function(snapshot){
	let variable = snapshot.val();
	var el= document.getElementById(snapshot.key);
	document.getElementById("table").removeChild(el);
});



function HTMLJuego(data, otro,id){

	if(otro==1){
		var contenido ="<td class='bg-warning'>" + id+ "</td>";
	contenido+= "<td>" + data.hora + "</td>";

	let palabra = data.descripcion.split("-");
	contenido+="<td>";
	for(var i = 0 ; i < palabra.length ; i++){
		contenido+=palabra[i];
		if(i!=palabra.length-1){
			contenido+="<br>";
		}
	}
	contenido+="</td>";
	console.log(typeof data.estado );
	if(data.estado == '1'){
		contenido+="<td> En cola</td>";
	}
	return contenido;

	}else if (otro==2){
		var contenido ="<td class='bg-danger'>" + id + "</td>";
	contenido+= "<td>" + data.hora + "</td>";

	let palabra = data.descripcion.split("-");
	contenido+="<td>";
	for(var i = 0 ; i < palabra.length ; i++){
		
		contenido+=palabra[i];
		if(i!=palabra.length-1){
			contenido+="<br>";
		}
	
	}

	contenido+="</td>";
	console.log(typeof data.estado );
	if(data.estado == '1'){
		contenido+="<td> En cola</td>";
	}

	
		
	
	
	return contenido;

	}else{
		var contenido ="<td  class='bg-info'>" + id + "</td>";
	contenido+= "<td>" + data.hora + "</td>";

	let palabra = data.descripcion.split("-");
	contenido+="<td>";
	for(var i = 0 ; i < palabra.length ; i++){
		
		contenido+=palabra[i];
		if(i!=palabra.length-1){
			contenido+="<br>";
		}
	
	}

	contenido+="</td>";
	console.log(typeof data.estado );
	if(data.estado == '1'){
		contenido+="<td> En cola</td>";
	}

	
		
	
	
	return contenido;
	}
	
}


// 


</script>
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
	
		<div class="table-responsive" id="table-responsive">
			<table class="table " id="table">
				<thead>
					<tr>
						<th >ID 					
						</th>
						<th nowrap>Hora</th>
						<th nowrap>Descripcion 			
						</th>
						<th nowrap>Estado 
						
						</th>
					</tr>
				</thead>
				</tbody>
				
					
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

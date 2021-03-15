<?php
if(isset($_GET["string"])){
	$object = $_GET["string"];
	$splitt = explode("_",$object);
	$integer = intval($splitt[2])+1;
	if($splitt[1] == "Pedido"){
		$ped = new Pedido( $splitt[0]);	

		$ped -> updateEstado($integer);
	}else{
		$dom= new Domicilio( $splitt[0]);
		$dom->updateEstado($integer);
	}
	
		if($integer==4 && $splitt[1] == "Pedido"){
		
			echo "<script type=''>
				const database = firebase.database();
				const rootRef = database.ref('Pedidos');
				rootRef.child('".$splitt[3]."').remove();
				</script>";
		
		}else{
			echo "<script type=''>
			const database = firebase.database();
			ref=database.ref('Pedidos').child('". $splitt[3]."');
			ref.child('estado').set('".$integer."');
			let a =document.getElementById(".$splitt[0].");
			</script>";	
		}
		

			
}	

?>


<script>
	let num = 0;
const db = firebase.database().ref('Pedidos');

db.on("child_added", function(snapshot){

		var data = snapshot.val();
		if(data.estado < 4 ){
			var pedido = document.createElement("tr");
		pedido.setAttribute("class", 'bg-warning');
		pedido.setAttribute("id", snapshot.key);
		pedido.innerHTML = HTMLJuego(data,snapshot.key);
		document.getElementById("table").appendChild(pedido);	
		}
		
	
});


db.on("child_changed", function(snapshot){
	let variable = snapshot.val();
	if(variable.estado > 3){
		var el= document.getElementById(snapshot.key);
		document.getElementById("table").removeChild(el);

	}else{
		var el= document.getElementById(snapshot.key);
	el.innerHTML = HTMLJuego(variable,snapshot.key);
	if(variable.tipo == "Pedido"){		
	alert("El pedido P"+ variable.id +  " fue cambiado");
	}else{
		alert("El pedido D"+ variable.id +  " fue cambiado");
	}
	
	}
		
	
	

});

db.on("child_removed",function(snapshot){
	let variable = snapshot.val();
	var el= document.getElementById(snapshot.key);
	document.getElementById("table").removeChild(el);
	if(variable.tipo == "Pedido"){		
	alert("El pedido P"+ variable.id +  " fue cancelado");
	}else{
		alert("El pedido D"+ variable.id +  " fue cancelado");
	};
});





function botones(data,id){
	let string = "";
	 string += data.id+"_";
	 string+= data.tipo+"_" ;
	 string+= data.estado+"_";
	 string+= data.hora ;

	let estado = "";
	 if(data.estado=="1"){
		estado = "Cocinar Productos";
	
		var contenido = "<a href='index.php?pid=<?php echo base64_encode("ui/verPedidos.php")?>&string="+string+"' class='btn btn-dark' id ="+ data.id +"> "+estado+"  </a>";
		
		
	 }else if(data.estado=="2"){
		estado = "Pedido Hecho";

		var contenido = "<a href='index.php?pid=<?php echo base64_encode("ui/verPedidos.php")?>&string="+string+"' class='btn btn-dark' id ="+ data.id +"> "+estado+"  </a>";
	 }else if(data.estado=="3"){
		estado = "Pedido por entregar";
		if(data.tipo == "Pedido"){
			var contenido = "<a href='index.php?pid=<?php echo base64_encode("ui/verPedidos.php")?>&string="+string+"' class='btn btn-dark' id ="+ data.id +"> "+estado+"  </a>";
		}else{
			var contenido ="esperando domiciliario";
		}
		
	 }

	
	





return contenido;
}

function HTMLJuego(data,id){
	if(data.tipo=="Pedido"){
		var contenido ="<td class='bg-warning'>P" + data.id+ "</td>";
	}else{
		var contenido ="<td class='bg-warning'>D" + data.id+ "</td>";
	}
	contenido+= "<td>" + data.hora + "</td>";
	if(data.estado == '1'){
		
		contenido+="<td> En cola</td>";
	}
	else if(data.estado == '2'){

		contenido+="<td class='table-info'> En cocinando</td>";
	}
	else if(data.tipo=="Pedido" && data.estado == '3'){
		contenido+="<td class='bg-success'> Hecho</td>";
	}else if(data.tipo=="Domicilio" && data.estado=="3"){
		contenido+="<td> Listo Para entregar</td>";

	}
	contenido+="<td> ";
	contenido+=botones(data,id);
	contenido+="</td>";
	return contenido;
	
}
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
			<h4 class="card-title">Ordenes</h4>
		</div>
		<div class="card-body">
	
		<div class="table-responsive" id="table-responsive">
			<table class="table " id="table">
				<thead>
					<tr>
						<th >ID 					
						</th>
						<th nowrap>Hora</th>
						<th nowrap>Estado 
						</th>
						<th nowrap>botones 			
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

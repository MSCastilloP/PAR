<!-- Se usa -->
<?php
if(isset($_GET["string"])){
	$object = $_GET["string"];
	$splitt = explode("_",$object);
	$integer = intval($splitt[2])+1;
		$dom= new Domicilio($splitt[0]);
		$dom->updateEstado($integer,$_SESSION['id']);
	
		if($integer==5){
		
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
			ref.child('Domiciliario').set('".$_SESSION['id']."');
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
		if(data.estado == 3 && data.tipo == "Domicilio"){
			var pedido = document.createElement("tr");
		pedido.setAttribute("class", 'bg-warning');
		pedido.setAttribute("id", snapshot.key);
		pedido.innerHTML = HTMLJuego(data,snapshot.key);
		document.getElementById("table").appendChild(pedido);	
		}else if(data.estado == 4 && data.tipo == "Domicilio" && data.Domiciliario == "<?php echo $_SESSION['id'] ?>" ){
			var pedido = document.createElement("tr");
		pedido.setAttribute("class", 'bg-warning');
		pedido.setAttribute("id", snapshot.key);
		pedido.innerHTML = HTMLJuego(data,snapshot.key);
		document.getElementById("table").appendChild(pedido);
		}
		
	
});


db.on("child_changed", function(snapshot){
	let variable = snapshot.val();
    if(variable.estado == 3 && variable.tipo == "Domicilio"){
		var pedido = document.createElement("tr");
		pedido.setAttribute("class", 'bg-warning');
		pedido.setAttribute("id", snapshot.key);
		pedido.innerHTML = HTMLJuego(variable);
		document.getElementById("table").appendChild(pedido);	
    }else if(variable.estado == 4 &&  variable.tipo == "Domicilio" && variable.Domiciliario  != "<?php echo $_SESSION['id'] ?>"){
		var el= document.getElementById(snapshot.key);
	document.getElementById("table").removeChild(el);
	}
	
	
		
	
	

});

db.on("child_removed",function(snapshot){
	let variable = snapshot.val();
    if(variable.tipo == "Domicilio"){
	var el= document.getElementById(snapshot.key);
	document.getElementById("table").removeChild(el);
		alert("El pedido D"+ variable.id +  " fue cancelado");}
	
});





function botones(data){
	let string = "";
	 string += data.id+"_";
	 string+= data.tipo+"_" ;
	 string+= data.estado+"_";
	 string+= data.hora ;

	let estado = "";
     if(data.estado=="3"){
		estado = "Recoger domicilio";
			var contenido = "<a href='index.php?pid=<?php echo base64_encode("ui/domicilio/consultaDomiciliario.php")?>&string="+string+"' class='btn btn-dark' id ="+ data.id +"> "+estado+"  </a>";
		
		
	 }else if(data.estado=="4"){
        estado = "Domicilio entregado";
			var contenido = "<a href='index.php?pid=<?php echo base64_encode("ui/domicilio/consultaDomiciliario.php")?>&string="+string+"' class='btn btn-dark' id ="+ data.id +"> "+estado+"  </a>";
     }

	
	





return contenido;
}

function HTMLJuego(data){
		var contenido ="<td class='bg-warning'>D" + data.id+ "</td>";
		contenido+= "<td>" + data.descripcion + "</td>";
		contenido+= "<td>" + data.direccion + "</td>";
		contenido+= "<td>" + data.precio + "</td>";
		contenido+= "<td>" + data.numero + "</td>";
	contenido+="<td> ";
	contenido+=botones(data);
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
						<th >ID </th>
						<th >Descripcion</th>
						<th >Direccion</th>
						<th >Precio </th>
						<th >Telefono </th>
						<th >Estado</th>
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

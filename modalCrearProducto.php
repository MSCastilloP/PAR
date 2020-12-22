<?php
require("business/Administrador.php");
require("business/LogAdministrador.php");
require("business/Inventario.php");
require("business/Ingrediente.php");
require("business/IngrePro.php");
require("business/Producto.php");
require("business/ProDom.php");
require("business/LogDomiciliario.php");
require("business/Domiciliario.php");
require("business/LogCliente.php");
require("business/Cliente.php");
require("business/Domicilio.php");
require("business/LogCajero.php");
require("business/Cajero.php");
require("business/Pedido.php");
require("business/PedidoPro.php");
require("business/Cocinero.php");
require_once("persistence/Connection.php");


$id=$_GET['id'];
$producto = new Producto();
$ingrediente = new IngrePro();
$vector=$ingrediente->traerIngre($id);
$producto->traer($id);

?>
<script type="text/javascript">
	var contador=1;
	var variableGlobal="";
	var variableTotal=0;
	var variableNumero=1;

</script>
<script charset="utf-8">
	function cantidad( id_input, operacion){
  var numero=$('#'+id_input).val();

  if(operacion=='1'){
    numero++;
  } else if(operacion=='0'&& numero!=0){
    numero--;
  }
  $('#'+id_input).val(numero);
  }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="modal-header">
	<h4 class="modal-title">Cajero</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table  class="table">
		
	<tr>
		<td>
	<h1 id="idp"><?php echo $id ?></h1>

	<?php
			
				echo "<h1 id='idn'>".$producto->getNombre()."</h1>";

				echo "<div class='container'>";	
					echo "<div class='row' >";

						echo "<div class='col-sm-1'>";	
							
							
							echo"<button class='btn btn-danger'style='text-align: center; width: 40px;' onclick= cantidad(0,0)>-</button>";
							echo "</div>";

							echo "<div class='col-sm-1'>";
							echo "<input class='input-group-text'  name='hola' id='0' type='text' style='text-align: center; width: 40px;' value='1'>";
							echo "</div>";
								echo "<div class='col-sm-1'>";

							echo"<button style='text-align: center; width: 40px;' class='btn btn-success' onclick='cantidad(0,1)'>+</button>";
							echo "</div>";

           					echo "<div class='col-sm'>";
           				
							echo "<button type='submit' onclick='traerN()'  class=' btn btn-primary'>Listo </button>";
							//echo $id.getValue();
							echo "</div>";
        
							echo "</div>";
							
						
						

							
					echo "</div>";
				echo "</div>";
				echo "<br>";
				echo "<h2> Ingredientes </h2>";
					echo "<div class='form-check' id='Ingre'>";
				 	foreach ($vector as $currentIngrediente) {
				 
	            		echo "<input type='checkbox'  name= '".$currentIngrediente->getNombre()."' value=" . $currentIngrediente->getIdIngrediente() . "> Sin " . $currentIngrediente->getNombre() . " <br>";
	            	
             }
             		
	?>

			
</td>	
<td>	
			
				
			
			<div id="productos">

    	</div>
    		<input type="submit" onclick="enviarGET()" id="btn_save"  value="Submit"  class="btn btn-primary">
    	
    	
		

		
    		
    </td>
			

</tr>
</table>

<script type="text/javascript">
		function traerN (){
			var valor = document.getElementById(0).value;
			if(valor!=0){
			var todo=0;
			var aux="";
			var divCont = document.getElementById('Ingre'); 
			var checks  = divCont.getElementsByTagName('input');
			variableGlobal=valor+" x / ";
			for(i=0;i<checks.length; i++){
   				 if(checks[i].checked == true){
   				 	todo=1;
   				 
    				variableGlobal+="Sin "+checks[i].name+"   . ";

    			}
			}

			if(todo==0){
				variableGlobal+=" Todo .";
			}
			
			var r=variableGlobal.split("/");

			if(evaluar(r[1])==0){
				var string ="habilitar("+variableNumero+")";
			

			if(variableNumero%2==0){
				var h6 = document.createElement("button");
  			var br = document.createElement("br");
			h6.setAttribute("id",variableNumero);
			h6.setAttribute("class","btn btn-danger");
			h6.setAttribute("onclick",string);
			h6.innerHTML = variableGlobal;
			productos.appendChild(h6);
			productos.appendChild(br);
			productos.appendChild(br);
			variableNumero++;
			document.productos.appendChild(x);
			}else{ 
			var h6 = document.createElement("button");
  			var br = document.createElement("br");
			h6.setAttribute("id",variableNumero);
			h6.setAttribute("class","btn btn-warning");
			h6.setAttribute("onclick",string);
			h6.innerHTML = variableGlobal;
			productos.appendChild(h6);
			productos.appendChild(br);
			productos.appendChild(br);
			variableNumero++;
			document.productos.appendChild(x);
		}
  			
			}else{
				alert("La especificación del porducto ya existe, si desea ingresar mas unidades con la misma especificación, elimine el anterior e ingreselo nuevamente con las unidades solicitadas");
			}
			

			

}
if(valor!=0){
	variableGlobal+=" ) ";
}

document.productos.value=variableGlobal+"\n";
variableTotal+=valor;
}





function habilitar(variableNumero){
			var r=document.getElementById(variableNumero);
			productos.removeChild(r);
		}



function enviarGET(){
	var elementos = document.getElementById("productos");
	var boton  = elementos.getElementsByTagName("button");
	var idp = document.getElementById("idp");
	var idn = document.getElementById("idn");

			var total="";
			for(i=0;i<boton.length;i++){
				total+=boton[i].innerHTML+"\n";
				
			}

function getNumbersInString(string) {

  var tmp = string.split("");

  var map = tmp.map(function(current) {
    if (!isNaN(parseInt(current))) {
      return current;
    }
  });

  var numbers = map.filter(function(value) {
    return value != undefined;
  });

  return numbers.join("");
}



var r=getNumbersInString(total);
var aux=0;

for(i=0;i<r.length;i++){
aux+=parseInt(r[i]);

}
			window.location.replace("index.php?pid=<?php echo base64_encode("ui/pedido/insertPedido.php") ?>&idp="+idp.innerHTML+"&idn="+idn.innerHTML+"&total="+total+"&cantidad="+aux);


}




function evaluar(aux){

	var validar =0;
	var traerDiv = document.getElementById('productos'); 
	var traerBotones  = traerDiv.getElementsByTagName('button');

	for(i=0;i<traerBotones.length;i++){
		var r=traerBotones[i].innerHTML;
		var tmp=r.split("/");

		for(j=1;j<tmp.length;j++){
			
			
			if(tmp[j]==aux){
				validar=1;

				return validar;

			}
		}
		
	}
	return validar;

}

	/*$(function() {

      $('#btn_save').on('click', function() {
      	
			var idp = document.getElementById("idp");
			var idn = document.getElementById("idn");
			
			

          $.post('index.php?pid=<?php echo base64_encode("ui/pedido/insertPedido.php") ?>', {
              "var_1": total,

            },function(data) {
              console.log('procesamiento finalizado', total);

          });
      })

})*/
</script>

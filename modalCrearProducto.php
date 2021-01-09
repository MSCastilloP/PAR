<script type="text/javascript">
	
</script>
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
$pedido= new Pedido();
$ingrediente = new IngrePro();
$vector=$ingrediente->traerIngre($id);
$producto->traer($id);
$listo=$pedido->verificarTemporal($id);
$global="";




?>

<script type="text/javascript">
	var contador=0;
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
			?>
				<div class='container'>	
					<div class='row' >


							<div class='col-sm-1'>	
							<button class='btn btn-danger'style='text-align: center; width: 40px;' onclick= cantidad(0,0)>-</button>
							</div>

							<div class='col-sm-1'>
							<input class='input-group-text'  name='hola' id='0' type='text' style='text-align: center; width: 40px;' value='1'>
							</div>
							
							<div class='col-sm-1'>
							<button style='text-align: center; width: 40px;' class='btn btn-success' onclick='cantidad(0,1)'>+</button>
							</div>

           					<div class='col-sm-1'>
							<button type='submit' 

							onclick=<?php 
							//solamente porcion de pizza
							if($id!=21){
								echo "traerN()";
							}else{
								echo "porcionPizza()";
							} ?>  class=' btn btn-primary'>Listo </button>
							</div>	
						</div>
				</div>

				<br>
				<h2> Ingredientes </h2>
					<div class='form-check' id='Ingre'>
						<?php  
						if($id!=21 ){

				 	foreach ($vector as $currentIngrediente) {

				 			if($id!=22){
				 				echo "<input type='checkbox'  name= '".$currentIngrediente->getNombre()."' value=" . $currentIngrediente->getIdIngrediente() . "> Sin " . $currentIngrediente->getNombre() . " <br>";

				 			}else{
				 				echo "<input type='checkbox'  name= '".$currentIngrediente->getNombre()."' value=" . $currentIngrediente->getIdIngrediente() . "> Con " . $currentIngrediente->getNombre() . " <br>";

				 			}

				 			
				 		}
				 		if($id==22){
				 			echo "<h4>Sin algo mi rey</h4>";
				 			echo " <input type='button' value='Clear' onclick='javascript:eraseText();' > ";
echo "<textarea id='descripcionAdicional' name='w3review' rows='4' cols='50'></textarea>";
				 		}
				 		
				 		}else{
				 			echo "<select id='pizza' class='form-select' aria-label='Default select example'>";
				 			foreach ($vector as $currentIngrediente) {
				 		
				 		
				 				echo "<option   name= '".$currentIngrediente->getNombre()."' value=" . $currentIngrediente->getIdIngrediente() . "> Con " . $currentIngrediente->getNombre() . " </option> <br>";
				 		}
				 		echo "</select>";
				 		}

				 		
				 	
				 	
				 
	            		
	            	
             
	             	?>	
	

			
</td>	
<td>	
			
			<div class='row'>	
				<div class='col-sm-4'> 	
					<div id="productos">
    		
    				</div>
    		<input type="submit" onclick="enviarGET()" id="btn_save"  value="Submit"  class="btn btn-primary">
    	
    			</div>
			</div>
</td>
			

</tr>
</table>
</div>
<?php 
if($listo!=0){
	
$nombres = explode(".", $listo);

$pedidoEx=array();
$j=0;

///	1 x / Sin Cebolla Cruda   Sin Carne Sin Salsa Rosada    1 x / Todo    1 x / Sin Cebolla Cruda.Sin Carne.
for( $i=0;$i<sizeof($nombres);$i++){
	if($i<sizeof($nombres)-1){
		if(strpos($nombres[$i], '/')==true){
		$pedidoEx[$j]=$nombres[$i].".";
		$j++;
		}else{
			$pedidoEx[$j-1]=$pedidoEx[$j-1].$nombres[$i].".";
		}

	}else{
		if(strpos($nombres[$i], '/')==true){
		$pedidoEx[$j]=$nombres[$i];
		$j++;
		}else{
			$pedidoEx[$j-1]=$pedidoEx[$j-1].$nombres[$i];
		}
	}
	
}
for( $i=0;$i<sizeof($pedidoEx);$i++){

	$string=$pedidoEx[$i];

	if(strpos($string, '(')!==false){
		
		echo '<script type="text/javascript">
			var textArea = document.getElementById("descripcionAdicional");
			textArea.innerHTML="'.substr($string , 4,-2).'";
		 </script>';
	}else{
		echo '<script type="text/javascript">
				var string ="habilitar("+variableNumero+")";
				var h6 = document.createElement("button");
	  			var br = document.createElement("br");
	  			br.setAttribute("name",variableNumero);
				h6.setAttribute("id",variableNumero);
				h6.setAttribute("class","btn btn-outline-danger");
				h6.setAttribute("onclick",string);
				h6.innerHTML ="'.$pedidoEx[$i]. '" ;
				
				productos.appendChild(h6);
			

				variableNumero++;
				contador++;
				document.productos.appendChild(x);</script>' 


				;

	}

	

		
	 } 
	 


}


 ?>
<script type="text/javascript">
	
	function eraseText() {
    document.getElementById("descripcionAdicional").value = "";
}

	function porcionPizza(){
		var valor = document.getElementById(0).value;
			if(valor!=0){
		var select= document.getElementById('pizza'); 
		var escogidoNombre = select.options[select.selectedIndex].text;
		var escogidoID = select.options[select.selectedIndex].value;
			
				variableGlobal=valor+" x / "+escogidoNombre;
				var r=variableGlobal.split("/");
				if(evaluar(r[1])==0){
					var string ="habilitar("+variableNumero+")";
				var h6 = document.createElement("button");
	  			var br = document.createElement("br");
	  			br.setAttribute("name",variableNumero);
				h6.setAttribute("id",variableNumero);
				h6.setAttribute("class","btn btn-outline-danger");
				h6.setAttribute("onclick",string);
				h6.innerHTML = variableGlobal;
				
				productos.appendChild(h6);
			

				variableNumero++;
				contador++;
				
				document.productos.appendChild(x);
				}else{
				alert("La especificación del porducto ya existe, si desea ingresar mas unidades con la misma especificación, elimine el anterior e ingreselo nuevamente con las unidades solicitadas");
			}
				
	}
}
	
	
		function traerN (){
			var valor = document.getElementById(0).value;
			if(valor!=0){
			var todo=0;
			var aux="";
			var x=document.getElementById('idp').innerHTML;
		
			var divCont = document.getElementById('Ingre'); 

			var checks  = divCont.getElementsByTagName('input');
			var cantidadp=0;
			if(x==22){
				//Cantidadp es la cantidad de sabores de una pizza
				
				for(i=0;i<checks.length; i++){
					 if(checks[i].checked == true ){
					 	cantidadp++;
					 }
				}

			}
			if(cantidadp<=4 && cantidadp>0){
			variableGlobal=valor+" x / ";
			for(i=0;i<checks.length; i++){
				//Cambiar id por el nombre
   				 if(checks[i].checked == true && x!=22 ){

   				 	todo=1;
   				 
    				variableGlobal+="Sin "+checks[i].name+".";

				
    			}else if(checks[i].checked == true){
    				todo=1;
   				 
    				variableGlobal+="Con "+checks[i].name+".";
    			}
    			
			}
			
			


			if(todo==0  && x!=22 ){
				variableGlobal+=" Todo .";
			}
			
		
			var r=variableGlobal.split("/");
			
			if(evaluar(r[1])==0){
		
				var string ="habilitar("+variableNumero+")";
				var h6 = document.createElement("button");
	  			var br = document.createElement("br");
	  			br.setAttribute("name",variableNumero);
				h6.setAttribute("id",variableNumero);
				h6.setAttribute("class","btn btn-outline-danger");
				h6.setAttribute("onclick",string);
				h6.innerHTML = variableGlobal;
				
				productos.appendChild(h6);
			

				variableNumero++;
				contador++;
				
				document.productos.appendChild(x);
				
  			
			}else{
				alert("La especificación del porducto ya existe, si desea ingresar mas unidades con la misma especificación, elimine el anterior e ingreselo nuevamente con las unidades solicitadas");
			}
			}else{
				alert("No ha escogido o sobrepasado el número de sabores posibles. Porfavor Ingrese almenos un sabor o menos de cinco sabores");
			}
			
			

			

}


document.productos.value=variableGlobal+"\n";
variableTotal+=valor;

}





function habilitar(variableNumero){
			var r=document.getElementById(variableNumero);
		
			productos.removeChild(r);
			contador--;	
			
			


		}



function enviarGET(){
	if(contador>0){
		var elementos = document.getElementById("productos");

	var boton  = elementos.getElementsByTagName("button");
	var idp = document.getElementById("idp");
	var idn = document.getElementById("idn");
	alert(idp.innerHTML);
	if(idp.innerHTML==22){
		var descripcion=document.getElementById("descripcionAdicional").value;


		
	}
			var total="";
			for(i=0;i<boton.length;i++){
				total+=boton[i].innerHTML+"\n";
				
			}
	if(descripcion!=""){
		total+=" / ( "+descripcion+" ) ";
	}
			//

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

		}else{
			alert("No ha ingresado ningun producto");
		}
	

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

<!-- Se usa -->

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
		$idc=$_GET['idc'];
		$producto = new Producto();
		$pedido= new Pedido();
		$ingrediente = new IngrePro();
		$domicilio= new Domicilio();
		$vector=$ingrediente->traerIngre($id);
		$producto->traer($id);
		echo "er";
		$listo=$domicilio->verificarTemporal($id,$idc);
		$global="";
		?>

		<script type="text/javascript">
			// Variables globales utilizadas para los javascript, en especial para los botones.
			var contador=0;
			var variableGlobal="";
			var variableTotal=0;
			var variableNumero=1;
		</script>
		<script charset="utf-8">

			//Funcion cantidad, la funcion cantidad es utilizada para los botones  Mas y menos de la cantidad del producto

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
	

		<div class="modal-header" id="modal" data-backdrop="static" data-keyboard="false" >
			<h4 class="modal-title">Cliente</h4>
			<button type="button" class="close"  onclick="salir()" data-dismiss="modal" aria-hidden="true">&times;</button>
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
									if($id!=5){

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
								if($id!=5 ){
									// Se utiliza para crear los check box de los productos y de la pizza familiar 
						 		foreach ($vector as $currentIngrediente) {

						 			if($id!=6){
										 if($currentIngrediente->getEsencial()=='0'){

										 if($currentIngrediente->getEstado()=='1'){
						 				echo "<input type='checkbox'  name= '".$currentIngrediente->getNombre()."' value=" . $currentIngrediente->getIdIngrediente() . "> Sin " . $currentIngrediente->getNombre() . " <br>";
									
									}else{
											echo "<input type='checkbox' checked='checked' disabled name= '".$currentIngrediente->getNombre()."' value=" . $currentIngrediente->getIdIngrediente() . "> No hay " . $currentIngrediente->getNombre() . " <br>";
				
										 }}
						 			}else{
										if($currentIngrediente->getEstado()=='1'){
											echo "<input type='checkbox'  name= '".$currentIngrediente->getNombre()."' value=" . $currentIngrediente->getIdIngrediente() . "> Con " . $currentIngrediente->getNombre() . " <br>";


										}else{
											echo "<input type='checkbox' disabled  name= '".$currentIngrediente->getNombre()."' value=" . $currentIngrediente->getIdIngrediente() . "> No hay " . $currentIngrediente->getNombre() . " <br>";
										}

						 			}
//
						 			
						 		}
								 // descripcion de la pizza familiar
						 		if($id==6){
						 			echo "<h4>Descripcion Adicional</h4>";
						 			echo " <input type='button' value='Clear' onclick='javascript:eraseText();' > ";
									echo "<textarea id='descripcionAdicional' name='w3review' rows='4' cols='50'></textarea>";
						 		}
						 		
						 		}else{
						 			//Se crea la lista despegable de la porcion de pizza para que solo se pueda escoger uno.
						 			echo "<select id='pizza' class='form-select' aria-label='Default select example'>";
						 			foreach ($vector as $currentIngrediente) {
										if($currentIngrediente->getEstado()=='1'){
											echo "<option   name= '".$currentIngrediente->getNombre()."' value=" . $currentIngrediente->getIdIngrediente() . ">  " . $currentIngrediente->getNombre() . " </option> <br>";

										}else{
											echo "<option disabled  name= '".$currentIngrediente->getNombre()."' value=" . $currentIngrediente->getIdIngrediente() . "> No hay " . $currentIngrediente->getNombre() . " </option> <br>";

										}
						 		
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
		    		<input type="submit" onclick="enviarGET()" id="btn_save"  value="Enviar productos"  class="btn btn-primary">
		    	
		    			</div>
					</div>
		</td>
		</tr>
		</table>
		</div>
	
		<?php 
		if($listo!=0){
		//hacemos explote para separar el texto 	
		$nombres = explode(".", $listo);


		$pedidoEx=array();
		$j=0;

		// Este for se utiliza para organizar un array el cual mostrará los botones cuando se clickea editar un producto.

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
		// este for se utiliza para crear los botones de producto a darle editar desde la factura.
		for( $i=0;$i<sizeof($pedidoEx);$i++){

			$string=$pedidoEx[$i];
			// este if se utiliza para verificar si existe alguna descrippcion adicional de la pizza Completa
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
			function salir(){
				window.location.replace("index.php?pid=<?php echo base64_encode("ui/domicilio/insertDomicilio.php") ?>&idp=0");
			}
			


			function eraseText() {
				//Boton eliminar descipcion adicional
		    document.getElementById("descripcionAdicional").value = "";
		}
			//Esta funcion se utiliza para crear los botones del producto porcion de pizza.

			function porcionPizza(){

				var valor = document.getElementById(0).value;
					if(valor!=0){
				var select= document.getElementById('pizza'); 
				var escogidoNombre = select.options[select.selectedIndex].text;
				var escogidoID = select.options[select.selectedIndex].value;
					
						variableGlobal=" "+valor+" x / "+escogidoNombre+".";
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
			
			//Funcion trarN esta funcion es para crear todos los botones de los productos excepto porcion de pizza
				function traerN (){
					//Valor es la cantidad de productos ordenados con una descripcion especifica.
					var valor = document.getElementById(0).value;
					// Si no se pide nada, no hace nada.
					if(valor!=0){
					var todo=0;
					var aux="";
					var x=document.getElementById('idp').innerHTML;		
					var divCont = document.getElementById('Ingre'); 
					var checks  = divCont.getElementsByTagName('input');
					var cantidadp=0;
					// Se utiliza solo en el caso de la pizza completa.
					if(x==6){	
						//Cantidadp es la cantidad de sabores de una pizza
						for(i=0;i<checks.length; i++){
							 if(checks[i].checked == true ){
							 	cantidadp++;
							 }
						}
					}	


					variableGlobal=valor+" x / ";			
					for(i=0;i<checks.length; i++){
						//ha este if entra todo lo que no sea pizza completa.
		   				 if(checks[i].checked == true && x!=6 ){
		   				 	todo=1; 
		    				variableGlobal+="Sin "+checks[i].name+".";
		    					//entra solo para la pizza completa si la cantidad de sabores es valida.
		    			}else if(checks[i].checked == true && cantidadp<=4 && cantidadp>0){
		    				todo=1;
		    				variableGlobal+="Con "+checks[i].name+".";
		    			}    			
					}
					// Solo entra si se desea el producto con todo lo que trae.
					if(todo==0  && x!=6){
						variableGlobal+=" Todo .";
					}					

					var r=variableGlobal.split("/");
					//Se utiliza para saber si ya existe el producto con las mismas especificaciones 			
					if(evaluar(r[1])==0){
					if(x!=6){
						
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
						

					}else if(x==6 && cantidadp>0 && cantidadp<5){
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
					}
						
		  			
					}else{
						alert("La especificación del porducto ya existe, si desea ingresar mas unidades con la misma especificación, elimine el anterior e ingreselo nuevamente con las unidades solicitadas");
					}
					if(x==6 && (cantidadp>4 || cantidadp<1)){
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
			
			if(idp.innerHTML==6){
				var descripcion=document.getElementById("descripcionAdicional").value;		
			}
					var total="";
					for(i=0;i<boton.length;i++){
						total+=boton[i].innerHTML+"\n";
						
					}
			if(descripcion!="" && idp.innerHTML==6){
				total+=" / (  " +descripcion+" ) ";
			}
					//

		function getNumbersInString(string) {
			 var regex = /(\d+)/g;
			 if(idp.innerHTML==6 && string.indexOf("(")>-1	){
			 	alert("entra");

			 	var temp=string.split("(");
			 	var otra=0;
			 	for(i=0;i<temp.length-1;i++){
			 		otra+=temp[i].match(regex);
			 	}
			 	 return (otra.match(regex));
			 }else{
			 	alert("no entra");

			 	return (string.match(regex));
			 }  
		  

		}


		
		var r=getNumbersInString(total);		
		var aux=0;
		for(i=0;i<r.length;i++){			
		aux+=parseInt(r[i]);

		}
					window.location.replace("index.php?pid=<?php echo base64_encode("ui/domicilio/insertDomicilio.php") ?>&idp="+idp.innerHTML+"&idn="+idn.innerHTML+"&total="+total+"&cantidad="+aux);

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

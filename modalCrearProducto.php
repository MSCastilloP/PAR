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
	var variableGlobal="";
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

	<h1><?php echo $id ?></h1>

	<?php
			
				echo "<h1>".$producto->getNombre()."</h1>";
				echo "<div class='container'>";	
					echo "<div class='row' >";
						echo "<div class='col-sm-1'>";	
							
							
							echo"<button class='btn btn-danger'style='text-align: center; width: 40px;' onclick= cantidad(0,0)>-</button>";
							echo "</div>";

							echo "<div class='col-sm-1'>";
							echo "<input class='input-group-text'  name='hola' id='0' type='text' style='text-align: center; width: 40px;' value='0'>";
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

			 <div class="form-group">
    <form name="f1" id="f1">
    	<textarea class="form-control input-lg" type="text" name="f1t1" id="f1t1">     </textarea>
  
  </form>


    
			<button type="submit" class="btn btn-primary">Listo </button>
</div>


<script type="text/javascript">
		function traerN (){
			var valor = document.getElementById(0).value;
			
			var divCont = document.getElementById('Ingre'); 
			var checks  = divCont.getElementsByTagName('input');
			//document.f1.f1t1.value=valor+" ";
			variableGlobal+=valor+"x Sin (";
for(i=0;i<checks.length; i++){
    if(checks[i].checked == true){
    	variableGlobal+=checks[i].name+", ";
    	//document.f1.f1t1.value+=checks[i].name+" ";
        //alert('este es'+checks[i].name);
    }

}
variableGlobal+=" ) ";
document.f1.f1t1.value=variableGlobal+"\n";
		}


</script>
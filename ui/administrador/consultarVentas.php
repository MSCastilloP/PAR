<?php
 $error=0;// Esto va en el html
$total3=0;//Esto va en el html
    if(isset($_GET['fecha1'])){
        $fecha1=$_GET['fecha1'];

        if(isset($_GET['fecha2'])){
            $fecha2=$_GET['fecha2'];
        }else{
            $fecha2=$_GET['fecha1'];
        }

            if($fecha1 > $fecha2){
            $error=1;
            echo $error;
            }else{
            $producto = new Producto();
            $productoP = $producto -> consultarVentasP($fecha1,$fecha2);
            $productoD=$producto -> consultarVentasD($fecha1,$fecha2);
            $tamano=sizeof($productoP)+sizeof($productoD);
            $i=0;
            $j=0;
            $x=0;
  
           if($tamano==0){
                $error=2;
                echo $error;
            }else{
                $total= array();
                for($y=1;$y<=$tamano;$y++){
                     if($i<sizeof($productoP) && $j <sizeof($productoD)){
                    if($productoP[$i][1]<$productoD[$j][1]){
                         
                         array_push($total, array($productoP[$i][2],$productoP[$i][0],$productoP[$i][3]));
                         $i++;
                       
                         
                    }else if($productoP[$i][1]>$productoD[$j][1]){
                     array_push($total, array($productoD[$j][2],$productoD[$j][0],$productoD[$j][3]));
                     $j++;
                   
                    }else{
                     array_push($total, array($productoD[$j][2],$productoD[$j][0]+$productoP[$i][0],$productoD[$j][3]));
                     $j++;
                     $i++;
                     $y++;
                    }
                 }else{
                     if($i<sizeof($productoP)){
                         array_push($total, array($productoP[$i][2],$productoP[$i][0],$productoP[$i][3]));
                         $i++;
                     }else{
                         array_push($total, array($productoD[$j][2],$productoD[$j][0],$productoD[$j][3]));
                     $j++;
                     }
                 }
                 } 
                 print_r($total);
                 $total1 = "['Producto', 'Cantidad'], ";
                 $total2 = "['Producto', 'Valor'], ";
                
                 foreach ($total as $pp){
                    $total1 .= "['".$pp[0]."', ".$pp[1]."], ";
                    $total2 .= "['".$pp[0]."', ".$pp[1]*$pp[2]."], ";
                    $total3+=$pp[1]*$pp[2];
                }
                echo '<script type="text/javascript"  >
                google.charts.load("current", {"packages":["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
          
                    var data = google.visualization.arrayToDataTable([
                      '.$total1.'
                    ]);
            
                    var options = {
                        title : "Cantidad de productos"
                    };
                    var chart = new google.visualization.ColumnChart(document.getElementById("columnchartCantidad"));
                    chart.draw(data, options);
                }
    
            </script>';

            echo '<script type="text/javascript"  >
                google.charts.load("current", {"packages":["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
          
                    var data = google.visualization.arrayToDataTable([
                      '.$total2.'
                    ]);
            
                    var options = {
                        title : "Cantidad vendida por producto"
                    };
                    var chart = new google.visualization.PieChart(document.getElementById("piechart"));
                    chart.draw(data, options);
                }
    
            </script>';
                 
            }
            echo $total3;
           
        }
      
    }
    
    
?>

<div class="container">
    <div class="row mt-3">
        
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Estadisticas producto</h3>
                </div>
                <div class="card-body">
               
                    <div id="fechas">
                         <button type="button" id="btnfecha"  onclick="dia()"> Entre dos fechas </button>
                         <br></br>
                         <input type="date" id="fecha1" name="fecha1" required>
                         <br></br>
                        </div>
                        <button type="button" name="Consultar" onclick="enviar()"> Consultar </button>

                        <div class="text-center" id="columnchartCantidad" style="width: 900px; height:800px;"></div>

                        <div class="text-center" id="piechart" style="width: 900px; height: 800px;"></div>

                        
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
 function dia(){
        var fecha2 = document.getElementById("fecha2");
        var btn = document.getElementById("btnfecha");
        if(!fecha2){
            var fecha =document.createElement("INPUT");
        var br = document.createElement("br");
        fecha.setAttribute("type","date");
        fecha.setAttribute("id","fecha2");
        fecha.setAttribute("name","fecha2");
        fechas.appendChild(fecha);
        btn.innerHTML="Solo una fecha";
        }else{  
            fechas.removeChild(fecha2);
            
            btn.innerHTML="Entre dos fechas";

        }
       
    }

    function enviar(){
        var x = document.getElementById("fecha1");
        var y = document.getElementById("fecha2");
        if(!y){
            window.location.replace("index.php?pid=<?php echo base64_encode("ui/administrador/consultarVentas.php") ?>&fecha1="+x.value);        
        }
        else{
            window.location.replace("index.php?pid=<?php echo base64_encode("ui/administrador/consultarVentas.php") ?>&fecha1="+x.value+"&fecha2="+y.value); 
        }

    }
</script>

<?php
$error=0;
$sal=0;
$rol=0;
if(isset($_POST['insert'])){
	$adm= new Administrador();
    $empleado=$_POST['empleado'];
	$fechaIn=$_POST['fechain'];
	$fechaFi=$_POST['fechafi'];
	if($fechaFi> $fechaIn){
		if(substr($empleado,-1)=="C"){
			$rol=1;
			$caje= new Cajero(substr($empleado,0,-1));
			$caje->select();
			$sal=$adm->salario(substr($empleado,0,-1),$fechaIn,$fechaFi,"Cajero");

		}else if(substr($empleado,-1)=="K"){
			$rol=2;
			$cocine= new Cocinero(substr($empleado,0,-1));
			$cocine->select();
			$sal=$adm->salario(substr($empleado,0,-1),$fechaIn,$fechaFi,"Cocinero");

		}else{
			$rol=3;
			$domicilia=new Domiciliario(substr($empleado,0,-1));
			$domicilia->select();
			$sal=$adm->salario(substr($empleado,0,-1),$fechaIn,$fechaFi,"Domiciliario");

		}
		
		if($sal==0){
			$error=2;
		}

	}else{
		$error=1;
	}
	
	
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Calcular Salario</h4>
				</div>
				</div>
						<div>
						<?php 
						if($error==0){
						if($rol==1){ 
							echo $caje->getNombre()." ".$caje->getApellido();
							echo "Salario=".$caje->getSalario()*$sal;
							?>
								
						<?php } else if($rol==2){ 
							echo $cocine->getNombre()." ".$cocine->getApellido();
							echo "Salario=".$cocine->getSalario()*$sal;
							?>

						<?php } else if($rol==3){ 
							
							echo $domicilia->getNombre()." ".$domicilia->getApellido();
							echo "Salario=".$domicilia->getSalario()*$sal;
							?>

							<?php } } else if ($error==1){?>
								<div class="alert alert-danger" >Fecha mal ingresadas
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } else if($error==2){
						echo "El empleado seleccionado no a trabajado en las fechas establecidas"
						?>
					
					<?php } ?>
						</div>
				<div class="card-body">
					
					<form id="form" method="post"  class="bootstrap-form needs-validation"  action="index.php?pid=<?php echo base64_encode("ui/administrador/calcularSalario.php") ?>" >
                    <div class="dropdown">
                    <label>Nombre</label>
					<?php
					$cajero = new Cajero();
					
					$caj = $cajero->selectAll();
					$cocinero = new Cocinero();
					$coc = $cocinero->selectAll();
					$domiciliario = new Domiciliario();
					$dom = $domiciliario->selectAll();
					?>
                    <br>
                        <select name="empleado" class="card-title text-center">
						<?php
						foreach($caj as $c ){ ?>
								<?php if($c->getNombre()!= "Cocinero") {?>
							<option value="<?php echo $c->getIdCajero();?>C"><?php echo $c->getNombre()." ".$c->getApellido()." ----- Cajero" ?>  </option>

					<?php	}}
						?>
						<?php
						foreach($coc as $c ){ ?>
								
							<option value="<?php echo $c->getIdCocinero();?>K"><?php echo $c->getNombre()." ".$c->getApellido()." ----- Cocinero" ?>  </option>

					<?php	}
						?>
						<?php
						foreach($dom as $d ){ ?>
								
							<option value="<?php echo $d->getIdDomiciliario();?>D"><?php echo $d->getNombre()." ".$d->getApellido()." ----- Domiciliario" ?>  </option>

					<?php	}
						?>
                     </select>
                    </div>
						
						<div class="form-group">
							<label>Dia De inicio</label>
							<input type="date" class="form-control" name="fechain" required/>
						</div>
                        <div class="form-group">
							<label>Dia Final</label>
							<input type="date" class="form-control" name="fechafi" required/>

						<button type="submit" class="btn btn-info" name="insert">Calcular Salario</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
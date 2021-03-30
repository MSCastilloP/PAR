<?php
if(isset($_POST['insert'])){
    echo "entra al post";
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
				<div class="card-body">
					
					<form id="form" method="post"  class="bootstrap-form needs-validation"  action="index.php?pid=<?php echo base64_encode("ui/administrador/calcularSalario.php") ?>" >
                    <div class="dropdown">
                    <label>Nombre</label>
                    <br>
                        <select name="my_html_select_box" class="card-title text-center">
                            <option>New York </option>
                            <option selected="yes">Bucharest</option>
                            <option>Madrid</option>
                        </select>
                    </div>
						
						<div class="form-group">
							<label>Dia De inicio</label>
							<input type="date" class="form-control" name="celular" required/>
						</div>
                        <div class="form-group">
							<label>Dia Final</label>
							<input type="date" class="form-control" name="celular" required/>
						</div>
						<button type="submit" class="btn btn-info" name="insert">Calcular Salario</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
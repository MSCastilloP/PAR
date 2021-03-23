<?php
class CocineroDAO{
	private $idCocinero;
	private $nombre;
	private $apellido;
	private $telefono;
	private $salario;
	private $estado;

	function CocineroDAO($pIdCocinero = "", $pNombre = "", $pApellido = "", $pTelefono = "", $pSalario = "", $pEstado = ""){
		$this -> idCocinero = $pIdCocinero;
		$this -> nombre = $pNombre;
		$this -> apellido = $pApellido;
		$this -> telefono = $pTelefono;
		$this -> salario = $pSalario;
		$this -> estado = $pEstado;
	}

	function insert(){
		return "insert into Cocinero(nombre, apellido, telefono, salario)
				values('" . $this -> nombre . "', '" . $this -> apellido . "', '" . $this -> telefono . "', '" . $this -> salario . "')";
	}

	function update(){
		return "update Cocinero set 
				nombre = '" . $this -> nombre . "',
				apellido = '" . $this -> apellido . "',
				telefono = '" . $this -> telefono . "',
				salario = '" . $this -> salario . "',	
				estado = '" . $this -> estado . "'
				where idCocinero = '" . $this -> idCocinero . "'";
	}

	function select() {
		return "select idCocinero, nombre, apellido, telefono, salario, estado
				from Cocinero
				where idCocinero = '" . $this -> idCocinero . "'";
	}

	function selectAll() {
		return "select idCocinero, nombre, apellido, telefono, salario, estado
				from Cocinero";
	}

	function selectAllOrder($orden, $dir){
		return "select idCocinero, nombre, apellido, telefono, salario, estado
				from Cocinero
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idCocinero, nombre, apellido, telefono, salario, estado
				from Cocinero
				where nombre like '%" . $search . "%' or apellido like '%" . $search . "%' or telefono like '%" . $search . "%' or salario like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Cocinero
				where idCocinero = '" . $this -> idCocinero . "'";
	}
}
?>

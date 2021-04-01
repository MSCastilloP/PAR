<?php
class IngredienteDAO{
	private $idIngrediente;
	private $nombre;
	private $estado;
	private $esencial;

	function IngredienteDAO($pIdIngrediente = "", $pNombre = "", $pestado = "", $esencial = ""){
		$this -> idIngrediente = $pIdIngrediente;
		$this -> nombre = $pNombre;
		$this -> estado = $pestado;
		$this -> esencial = $esencial;

	}

	function insert(){
		return "insert into Ingrediente(nombre, estado,esencial)
				values('" . $this -> nombre . "', '" . $this -> estado . "', '" . $this -> esencial . "')";
	}

	function update(){
		return "update Ingrediente set 
				nombre = '" . $this -> nombre . "',
				estado = '" . $this -> estado . "',
				esencial= '". $this -> esencial . "'
				where idIngrediente = '" . $this -> idIngrediente . "'";
	}

	function updateEstado(){
		return "update Ingrediente set 
				estado = '" . $this -> estado . "'	
				where idIngrediente = '" . $this -> idIngrediente . "'";
	}

	function select() {
		return "select idIngrediente, nombre, estado,esencial
				from Ingrediente
				where idIngrediente = '" . $this -> idIngrediente . "'";
	}

	function selectAll() {
		return "select idIngrediente, nombre, estado,esencial
				from Ingrediente";
	}

	function selectAllOrder($orden, $dir){
		return "select idIngrediente, nombre, estado,esencial
				from Ingrediente
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idIngrediente, nombre, estado
				from Ingrediente
				where nombre like '%" . $search . "%' or estado like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Ingrediente
				where idIngrediente = '" . $this -> idIngrediente . "'";
	}
	function checkIngrediente(){
		return "select count(*) from Ingrediente where nombre= '".$this->nombre."'";
	}
	function nombre(){
		return "select idIngrediente, nombre, estado
				from Ingrediente";
	}
}
?>

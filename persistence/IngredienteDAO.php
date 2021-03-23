<?php
class IngredienteDAO{
	private $idIngrediente;
	private $nombre;
	private $estado;

	function IngredienteDAO($pIdIngrediente = "", $pNombre = "", $pestado = ""){
		$this -> idIngrediente = $pIdIngrediente;
		$this -> nombre = $pNombre;
		$this -> estado = $pestado;
	}

	function insert(){
		return "insert into Ingrediente(nombre, estado)
				values('" . $this -> nombre . "', '" . $this -> estado . "')";
	}

	function update(){
		return "update Ingrediente set 
				nombre = '" . $this -> nombre . "',
				estado = '" . $this -> estado . "'	
				where idIngrediente = '" . $this -> idIngrediente . "'";
	}

	function select() {
		return "select idIngrediente, nombre, estado
				from Ingrediente
				where idIngrediente = '" . $this -> idIngrediente . "'";
	}

	function selectAll() {
		return "select idIngrediente, nombre, estado
				from Ingrediente";
	}

	function selectAllOrder($orden, $dir){
		return "select idIngrediente, nombre, estado
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

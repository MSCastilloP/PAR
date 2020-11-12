<?php
class IngredienteDAO{
	private $idIngrediente;
	private $nombre;
	private $precio;

	function IngredienteDAO($pIdIngrediente = "", $pNombre = "", $pPrecio = ""){
		$this -> idIngrediente = $pIdIngrediente;
		$this -> nombre = $pNombre;
		$this -> precio = $pPrecio;
	}

	function insert(){
		return "insert into Ingrediente(nombre, precio)
				values('" . $this -> nombre . "', '" . $this -> precio . "')";
	}

	function update(){
		return "update Ingrediente set 
				nombre = '" . $this -> nombre . "',
				precio = '" . $this -> precio . "'	
				where idIngrediente = '" . $this -> idIngrediente . "'";
	}

	function select() {
		return "select idIngrediente, nombre, precio
				from Ingrediente
				where idIngrediente = '" . $this -> idIngrediente . "'";
	}

	function selectAll() {
		return "select idIngrediente, nombre, precio
				from Ingrediente";
	}

	function selectAllOrder($orden, $dir){
		return "select idIngrediente, nombre, precio
				from Ingrediente
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idIngrediente, nombre, precio
				from Ingrediente
				where nombre like '%" . $search . "%' or precio like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Ingrediente
				where idIngrediente = '" . $this -> idIngrediente . "'";
	}
	function checkIngrediente(){
		return "select count(*) from Ingrediente where nombre= '".$this->nombre."'";
	}
	function nombre(){
		return "select idIngrediente, nombre, precio
				from Ingrediente";
	}
}
?>

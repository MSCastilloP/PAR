<?php
class IngreProDAO{
	private $idIngrePro;
	private $ingrediente;
	private $producto;

	function IngreProDAO($pIdIngrePro = "", $pIngrediente = "", $pProducto = ""){
		$this -> idIngrePro = $pIdIngrePro;
		$this -> ingrediente = $pIngrediente;
		$this -> producto = $pProducto;
	}

	function insert(){
		return "insert into IngrePro(ingrediente_idIngrediente, producto_idProducto)
				values('" . $this -> ingrediente . "', '" . $this -> producto . "')";
	}

	function update(){
		return "update IngrePro set 
				ingrediente_idIngrediente = '" . $this -> ingrediente . "',
				producto_idProducto = '" . $this -> producto . "'	
				where idIngrePro = '" . $this -> idIngrePro . "'";
	}

	function select() {
		return "select idIngrePro, ingrediente_idIngrediente, producto_idProducto
				from IngrePro
				where idIngrePro = '" . $this -> idIngrePro . "'";
	}

	function selectAll() {
		return "select idIngrePro, ingrediente_idIngrediente, producto_idProducto
				from IngrePro";
	}

	function selectAllByIngrediente() {
		return "select idIngrePro, ingrediente_idIngrediente, producto_idProducto
				from IngrePro
				where ingrediente_idIngrediente = '" . $this -> ingrediente . "'";
	}

	function selectAllByProducto() {
		return "select idIngrePro, ingrediente_idIngrediente, producto_idProducto
				from IngrePro
				where producto_idProducto = '" . $this -> producto . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idIngrePro, ingrediente_idIngrediente, producto_idProducto
				from IngrePro
				order by " . $orden . " " . $dir;
	}

	function selectAllByIngredienteOrder($orden, $dir) {
		return "select idIngrePro, ingrediente_idIngrediente, producto_idProducto
				from IngrePro
				where ingrediente_idIngrediente = '" . $this -> ingrediente . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByProductoOrder($orden, $dir) {
		return "select idIngrePro, ingrediente_idIngrediente, producto_idProducto
				from IngrePro
				where producto_idProducto = '" . $this -> producto . "'
				order by " . $orden . " " . $dir;
	}

	function delete(){
		return "delete from IngrePro
				where idIngrePro = '" . $this -> idIngrePro . "'";
	}
	function traerIngre($id){
		return "select idIngrediente,nombre,estado
		from ingrediente, ingrepro where producto_idProducto= '".$id."' and ingrediente_idIngrediente=idIngrediente
		";
	}	
	function ingretra($id){
		return "select ingrediente_idIngrediente
		from ingrediente, ingrepro where producto_idProducto=".$id." and ingrediente_idIngrediente=idIngrediente";
	}


	function deleteUpdate(){
		return "delete from IngrePro
				where producto_idProducto = '" . $this -> producto . "'";
	}
}
?>

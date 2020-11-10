<?php
class InventarioDAO{
	private $idInventario;
	private $fecha;
	private $cantidadInicial;
	private $unidades;
	private $cantidadFinal;
	private $ingrediente;

	function InventarioDAO($pIdInventario = "", $pFecha = "", $pCantidadInicial = "", $pUnidades = "", $pCantidadFinal = "", $pIngrediente = ""){
		$this -> idInventario = $pIdInventario;
		$this -> fecha = $pFecha;
		$this -> cantidadInicial = $pCantidadInicial;
		$this -> unidades = $pUnidades;
		$this -> cantidadFinal = $pCantidadFinal;
		$this -> ingrediente = $pIngrediente;
	}

	function insert(){
		return "insert into Inventario(fecha, cantidadInicial, unidades, cantidadFinal, ingrediente_idIngrediente)
				values('" . $this -> fecha . "', '" . $this -> cantidadInicial . "', '" . $this -> unidades . "', '" . $this -> cantidadFinal . "', '" . $this -> ingrediente . "')";
	}

	function update(){
		return "update Inventario set 
				fecha = '" . $this -> fecha . "',
				cantidadInicial = '" . $this -> cantidadInicial . "',
				unidades = '" . $this -> unidades . "',
				cantidadFinal = '" . $this -> cantidadFinal . "',
				ingrediente_idIngrediente = '" . $this -> ingrediente . "'	
				where idInventario = '" . $this -> idInventario . "'";
	}

	function select() {
		return "select idInventario, fecha, cantidadInicial, unidades, cantidadFinal, ingrediente_idIngrediente
				from Inventario
				where idInventario = '" . $this -> idInventario . "'";
	}

	function selectAll() {
		return "select idInventario, fecha, cantidadInicial, unidades, cantidadFinal, ingrediente_idIngrediente
				from Inventario";
	}

	function selectAllByIngrediente() {
		return "select idInventario, fecha, cantidadInicial, unidades, cantidadFinal, ingrediente_idIngrediente
				from Inventario
				where ingrediente_idIngrediente = '" . $this -> ingrediente . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idInventario, fecha, cantidadInicial, unidades, cantidadFinal, ingrediente_idIngrediente
				from Inventario
				order by " . $orden . " " . $dir;
	}

	function selectAllByIngredienteOrder($orden, $dir) {
		return "select idInventario, fecha, cantidadInicial, unidades, cantidadFinal, ingrediente_idIngrediente
				from Inventario
				where ingrediente_idIngrediente = '" . $this -> ingrediente . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idInventario, fecha, cantidadInicial, unidades, cantidadFinal, ingrediente_idIngrediente
				from Inventario
				where fecha like '%" . $search . "%' or cantidadInicial like '%" . $search . "%' or unidades like '%" . $search . "%' or cantidadFinal like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Inventario
				where idInventario = '" . $this -> idInventario . "'";
	}
}
?>

<?php
require_once ("persistence/IngredienteDAO.php");
require_once ("persistence/Connection.php");

class Ingrediente {
	private $idIngrediente;
	private $nombre;
	private $precio;
	private $ingredienteDAO;
	private $connection;

	function getIdIngrediente() {
		return $this -> idIngrediente;
	}

	function setIdIngrediente($pIdIngrediente) {
		$this -> idIngrediente = $pIdIngrediente;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function getPrecio() {
		return $this -> precio;
	}

	function setPrecio($pPrecio) {
		$this -> precio = $pPrecio;
	}

	function Ingrediente($pIdIngrediente = "", $pNombre = "", $pPrecio = ""){
		$this -> idIngrediente = $pIdIngrediente;
		$this -> nombre = $pNombre;
		$this -> precio = $pPrecio;
		$this -> ingredienteDAO = new IngredienteDAO($this -> idIngrediente, $this -> nombre, $this -> precio);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingredienteDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingredienteDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingredienteDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idIngrediente = $result[0];
		$this -> nombre = $result[1];
		$this -> precio = $result[2];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingredienteDAO -> selectAll());
		$ingredientes = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($ingredientes, new Ingrediente($result[0], $result[1], $result[2]));
		}
		$this -> connection -> close();
		return $ingredientes;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingredienteDAO -> selectAllOrder($order, $dir));
		$ingredientes = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($ingredientes, new Ingrediente($result[0], $result[1], $result[2]));
		}
		$this -> connection -> close();
		return $ingredientes;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingredienteDAO -> search($search));
		$ingredientes = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($ingredientes, new Ingrediente($result[0], $result[1], $result[2]));
		}
		$this -> connection -> close();
		return $ingredientes;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingredienteDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
	function checkIngrediente(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingredienteDAO -> checkIngrediente());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		return $result[0];
	}
	function nombre(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingredienteDAO -> selectAll());
		$ingredientes = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($ingredientes, new Ingrediente($result[0], $result[1], $result[2]));
		}
		$this -> connection -> close();
		return $ingredientes;

	}
	
}
?>

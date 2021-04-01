<?php
require_once ("persistence/IngredienteDAO.php");
require_once ("persistence/Connection.php");

class Ingrediente {
	private $idIngrediente;
	private $nombre;
	private $estado;
	private $esencial;
	private $ingredienteDAO;
	private $connection;

	function getIdIngrediente() {
		return $this -> idIngrediente;
	}

	function setIdIngrediente($pIdIngrediente) {
		$this -> idIngrediente = $pIdIngrediente;
	}
	function getEsencial() {
		return $this -> esencial;
	}

	function setEsencial($pEsencial) {
		$this -> esencial = $pEsencial;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function getEstado() {
		return $this -> estado;
	}

	function setEstado($pEstado) {
		$this -> estado = $pEstado;
	}

	function Ingrediente($pIdIngrediente = "", $pNombre = "", $pEstado = "",$pEsencial = ""){
		$this -> idIngrediente = $pIdIngrediente;
		$this -> nombre = $pNombre;
		$this -> estado = $pEstado;
		$this -> esencial = $pEsencial;
		$this -> ingredienteDAO = new IngredienteDAO($this -> idIngrediente, $this -> nombre, $this -> estado, $this -> esencial);
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
	function updateEstado(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingredienteDAO -> updateEstado());
		$this -> connection -> close();
	}
	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingredienteDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idIngrediente = $result[0];
		$this -> nombre = $result[1];
		$this -> estado = $result[2];
		$this -> esencial = $result[3];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingredienteDAO -> selectAll());
		$ingredientes = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($ingredientes, new Ingrediente($result[0], $result[1], $result[2], $result[3]));
		}
		$this -> connection -> close();
		return $ingredientes;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingredienteDAO -> selectAllOrder($order, $dir));
		$ingredientes = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($ingredientes, new Ingrediente($result[0], $result[1], $result[2],$result[3]));
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

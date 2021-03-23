<?php
require_once ("persistence/CocineroDAO.php");
require_once ("persistence/Connection.php");

class Cocinero {
	private $idCocinero;
	private $nombre;
	private $apellido;
	private $telefono;
	private $salario;
	private $estado;
	private $cocineroDAO;
	private $connection;

	function getIdCocinero() {
		return $this -> idCocinero;
	}

	function setIdCocinero($pIdCocinero) {
		$this -> idCocinero = $pIdCocinero;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function getApellido() {
		return $this -> apellido;
	}

	function setApellido($pApellido) {
		$this -> apellido = $pApellido;
	}

	function getTelefono() {
		return $this -> telefono;
	}

	function setTelefono($pTelefono) {
		$this -> telefono = $pTelefono;
	}

	function getSalario() {
		return $this -> salario;
	}

	function setSalario($pSalario) {
		$this -> salario = $pSalario;
	}
	function getEstado() {
		return $this -> estado;
	}

	function setEstado($pEstado) {
		$this -> estado = $pEstado;
	}

	function Cocinero($pIdCocinero = "", $pNombre = "", $pApellido = "", $pTelefono = "", $pSalario = "", $pEstado = ""){
		$this -> idCocinero = $pIdCocinero;
		$this -> nombre = $pNombre;
		$this -> apellido = $pApellido;
		$this -> telefono = $pTelefono;
		$this -> salario = $pSalario;
		$this -> estado = $pEstado;
		$this -> cocineroDAO = new CocineroDAO($this -> idCocinero, $this -> nombre, $this -> apellido, $this -> telefono, $this -> salario, $this -> estado);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cocineroDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cocineroDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cocineroDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idCocinero = $result[0];
		$this -> nombre = $result[1];
		$this -> apellido = $result[2];
		$this -> telefono = $result[3];
		$this -> salario = $result[4];
		$this -> estado = $result[5];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cocineroDAO -> selectAll());
		$cocineros = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($cocineros, new Cocinero($result[0], $result[1], $result[2], $result[3], $result[4], $result[5]));
		}
		$this -> connection -> close();
		return $cocineros;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> cocineroDAO -> selectAllOrder($order, $dir));
		$cocineros = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($cocineros, new Cocinero($result[0], $result[1], $result[2], $result[3], $result[4], $result[5]));
		}
		$this -> connection -> close();
		return $cocineros;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> cocineroDAO -> search($search));
		$cocineros = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($cocineros, new Cocinero($result[0], $result[1], $result[2], $result[3], $result[4], $result[5]));
		}
		$this -> connection -> close();
		return $cocineros;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cocineroDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>

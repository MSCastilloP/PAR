<?php
require_once ("persistence/DomicilioDAO.php");
require_once ("persistence/Connection.php");

class Domicilio {
	private $idDomicilio;
	private $direccion;
	private $fecha;
	private $hora;
	private $precio;
	private $descripcion;
	private $cocinando;
	private $domiciliario;
	private $cliente;
	private $domicilioDAO;
	private $connection;

	function getIdDomicilio() {
		return $this -> idDomicilio;
	}

	function setIdDomicilio($pIdDomicilio) {
		$this -> idDomicilio = $pIdDomicilio;
	}

	function getDireccion() {
		return $this -> direccion;
	}

	function setDireccion($pDireccion) {
		$this -> direccion = $pDireccion;
	}

	function getFecha() {
		return $this -> fecha;
	}

	function setFecha($pFecha) {
		$this -> fecha = $pFecha;
	}

	function getHora() {
		return $this -> hora;
	}

	function setHora($pHora) {
		$this -> hora = $pHora;
	}

	function getPrecio() {
		return $this -> precio;
	}

	function setPrecio($pPrecio) {
		$this -> precio = $pPrecio;
	}

	function getDescripcion() {
		return $this -> descripcion;
	}

	function setDescripcion($pDescripcion) {
		$this -> descripcion = $pDescripcion;
	}

	function getCocinando() {
		return $this -> cocinando;
	}

	function setCocinando($pCocinando) {
		$this -> cocinando = $pCocinando;
	}

	function getDomiciliario() {
		return $this -> domiciliario;
	}

	function setDomiciliario($pDomiciliario) {
		$this -> domiciliario = $pDomiciliario;
	}

	function getCliente() {
		return $this -> cliente;
	}

	function setCliente($pCliente) {
		$this -> cliente = $pCliente;
	}

	function Domicilio($pIdDomicilio = "", $pDireccion = "", $pFecha = "", $pHora = "", $pPrecio = "", $pDescripcion = "", $pCocinando = "", $pDomiciliario = "", $pCliente = ""){
		$this -> idDomicilio = $pIdDomicilio;
		$this -> direccion = $pDireccion;
		$this -> fecha = $pFecha;
		$this -> hora = $pHora;
		$this -> precio = $pPrecio;
		$this -> descripcion = $pDescripcion;
		$this -> cocinando = $pCocinando;
		$this -> domiciliario = $pDomiciliario;
		$this -> cliente = $pCliente;
		$this -> domicilioDAO = new DomicilioDAO($this -> idDomicilio, $this -> direccion, $this -> fecha, $this -> hora, $this -> precio, $this -> descripcion, $this -> cocinando, $this -> domiciliario, $this -> cliente);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> domicilioDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> domicilioDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> domicilioDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idDomicilio = $result[0];
		$this -> direccion = $result[1];
		$this -> fecha = $result[2];
		$this -> hora = $result[3];
		$this -> precio = $result[4];
		$this -> descripcion = $result[5];
		$this -> cocinando = $result[6];
		$domiciliario = new Domiciliario($result[7]);
		$domiciliario -> select();
		$this -> domiciliario = $domiciliario;
		$cliente = new Cliente($result[8]);
		$cliente -> select();
		$this -> cliente = $cliente;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> domicilioDAO -> selectAll());
		$domicilios = array();
		while ($result = $this -> connection -> fetchRow()){
			$domiciliario = new Domiciliario($result[7]);
			$domiciliario -> select();
			$cliente = new Cliente($result[8]);
			$cliente -> select();
			array_push($domicilios, new Domicilio($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $domiciliario, $cliente));
		}
		$this -> connection -> close();
		return $domicilios;
	}

	function selectAllByDomiciliario(){
		$this -> connection -> open();
		$this -> connection -> run($this -> domicilioDAO -> selectAllByDomiciliario());
		$domicilios = array();
		while ($result = $this -> connection -> fetchRow()){
			$domiciliario = new Domiciliario($result[7]);
			$domiciliario -> select();
			$cliente = new Cliente($result[8]);
			$cliente -> select();
			array_push($domicilios, new Domicilio($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $domiciliario, $cliente));
		}
		$this -> connection -> close();
		return $domicilios;
	}

	function selectAllByCliente(){
		$this -> connection -> open();
		$this -> connection -> run($this -> domicilioDAO -> selectAllByCliente());
		$domicilios = array();
		while ($result = $this -> connection -> fetchRow()){
			$domiciliario = new Domiciliario($result[7]);
			$domiciliario -> select();
			$cliente = new Cliente($result[8]);
			$cliente -> select();
			array_push($domicilios, new Domicilio($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $domiciliario, $cliente));
		}
		$this -> connection -> close();
		return $domicilios;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> domicilioDAO -> selectAllOrder($order, $dir));
		$domicilios = array();
		while ($result = $this -> connection -> fetchRow()){
			$domiciliario = new Domiciliario($result[7]);
			$domiciliario -> select();
			$cliente = new Cliente($result[8]);
			$cliente -> select();
			array_push($domicilios, new Domicilio($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $domiciliario, $cliente));
		}
		$this -> connection -> close();
		return $domicilios;
	}

	function selectAllByDomiciliarioOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> domicilioDAO -> selectAllByDomiciliarioOrder($order, $dir));
		$domicilios = array();
		while ($result = $this -> connection -> fetchRow()){
			$domiciliario = new Domiciliario($result[7]);
			$domiciliario -> select();
			$cliente = new Cliente($result[8]);
			$cliente -> select();
			array_push($domicilios, new Domicilio($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $domiciliario, $cliente));
		}
		$this -> connection -> close();
		return $domicilios;
	}

	function selectAllByClienteOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> domicilioDAO -> selectAllByClienteOrder($order, $dir));
		$domicilios = array();
		while ($result = $this -> connection -> fetchRow()){
			$domiciliario = new Domiciliario($result[7]);
			$domiciliario -> select();
			$cliente = new Cliente($result[8]);
			$cliente -> select();
			array_push($domicilios, new Domicilio($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $domiciliario, $cliente));
		}
		$this -> connection -> close();
		return $domicilios;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> domicilioDAO -> search($search));
		$domicilios = array();
		while ($result = $this -> connection -> fetchRow()){
			$domiciliario = new Domiciliario($result[7]);
			$domiciliario -> select();
			$cliente = new Cliente($result[8]);
			$cliente -> select();
			array_push($domicilios, new Domicilio($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $domiciliario, $cliente));
		}
		$this -> connection -> close();
		return $domicilios;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> domicilioDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>

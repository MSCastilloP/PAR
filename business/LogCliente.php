<?php
require_once ("persistence/LogClienteDAO.php");
require_once ("persistence/Connection.php");

class LogCliente {
	private $idLogCliente;
	private $accion;
	private $informacion;
	private $fecha;
	private $hora;
	private $ip;
	private $so;
	private $explorador;
	private $cliente;
	private $logClienteDAO;
	private $connection;

	function getIdLogCliente() {
		return $this -> idLogCliente;
	}

	function setIdLogCliente($pIdLogCliente) {
		$this -> idLogCliente = $pIdLogCliente;
	}

	function getAccion() {
		return $this -> accion;
	}

	function setAccion($pAccion) {
		$this -> accion = $pAccion;
	}

	function getInformacion() {
		return $this -> informacion;
	}

	function setInformacion($pInformacion) {
		$this -> informacion = $pInformacion;
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

	function getIp() {
		return $this -> ip;
	}

	function setIp($pIp) {
		$this -> ip = $pIp;
	}

	function getSo() {
		return $this -> so;
	}

	function setSo($pSo) {
		$this -> so = $pSo;
	}

	function getExplorador() {
		return $this -> explorador;
	}

	function setExplorador($pExplorador) {
		$this -> explorador = $pExplorador;
	}

	function getCliente() {
		return $this -> cliente;
	}

	function setCliente($pCliente) {
		$this -> cliente = $pCliente;
	}

	function LogCliente($pIdLogCliente = "", $pAccion = "", $pInformacion = "", $pFecha = "", $pHora = "", $pIp = "", $pSo = "", $pExplorador = "", $pCliente = ""){
		$this -> idLogCliente = $pIdLogCliente;
		$this -> accion = $pAccion;
		$this -> informacion = $pInformacion;
		$this -> fecha = $pFecha;
		$this -> hora = $pHora;
		$this -> ip = $pIp;
		$this -> so = $pSo;
		$this -> explorador = $pExplorador;
		$this -> cliente = $pCliente;
		$this -> logClienteDAO = new LogClienteDAO($this -> idLogCliente, $this -> accion, $this -> informacion, $this -> fecha, $this -> hora, $this -> ip, $this -> so, $this -> explorador, $this -> cliente);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logClienteDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logClienteDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logClienteDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idLogCliente = $result[0];
		$this -> accion = $result[1];
		$this -> informacion = $result[2];
		$this -> fecha = $result[3];
		$this -> hora = $result[4];
		$this -> ip = $result[5];
		$this -> so = $result[6];
		$this -> explorador = $result[7];
		$cliente = new Cliente($result[8]);
		$cliente -> select();
		$this -> cliente = $cliente;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logClienteDAO -> selectAll());
		$logClientes = array();
		while ($result = $this -> connection -> fetchRow()){
			$cliente = new Cliente($result[8]);
			$cliente -> select();
			array_push($logClientes, new LogCliente($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $cliente));
		}
		$this -> connection -> close();
		return $logClientes;
	}

	function selectAllByCliente(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logClienteDAO -> selectAllByCliente());
		$logClientes = array();
		while ($result = $this -> connection -> fetchRow()){
			$cliente = new Cliente($result[8]);
			$cliente -> select();
			array_push($logClientes, new LogCliente($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $cliente));
		}
		$this -> connection -> close();
		return $logClientes;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logClienteDAO -> selectAllOrder($order, $dir));
		$logClientes = array();
		while ($result = $this -> connection -> fetchRow()){
			$cliente = new Cliente($result[8]);
			$cliente -> select();
			array_push($logClientes, new LogCliente($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $cliente));
		}
		$this -> connection -> close();
		return $logClientes;
	}

	function selectAllByClienteOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logClienteDAO -> selectAllByClienteOrder($order, $dir));
		$logClientes = array();
		while ($result = $this -> connection -> fetchRow()){
			$cliente = new Cliente($result[8]);
			$cliente -> select();
			array_push($logClientes, new LogCliente($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $cliente));
		}
		$this -> connection -> close();
		return $logClientes;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> logClienteDAO -> search($search));
		$logClientes = array();
		while ($result = $this -> connection -> fetchRow()){
			$cliente = new Cliente($result[8]);
			$cliente -> select();
			array_push($logClientes, new LogCliente($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $cliente));
		}
		$this -> connection -> close();
		return $logClientes;
	}
}
?>

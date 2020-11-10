<?php
require_once ("persistence/LogDomiciliarioDAO.php");
require_once ("persistence/Connection.php");

class LogDomiciliario {
	private $idLogDomiciliario;
	private $accion;
	private $informacion;
	private $fecha;
	private $hora;
	private $ip;
	private $so;
	private $explorador;
	private $domiciliario;
	private $logDomiciliarioDAO;
	private $connection;

	function getIdLogDomiciliario() {
		return $this -> idLogDomiciliario;
	}

	function setIdLogDomiciliario($pIdLogDomiciliario) {
		$this -> idLogDomiciliario = $pIdLogDomiciliario;
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

	function getDomiciliario() {
		return $this -> domiciliario;
	}

	function setDomiciliario($pDomiciliario) {
		$this -> domiciliario = $pDomiciliario;
	}

	function LogDomiciliario($pIdLogDomiciliario = "", $pAccion = "", $pInformacion = "", $pFecha = "", $pHora = "", $pIp = "", $pSo = "", $pExplorador = "", $pDomiciliario = ""){
		$this -> idLogDomiciliario = $pIdLogDomiciliario;
		$this -> accion = $pAccion;
		$this -> informacion = $pInformacion;
		$this -> fecha = $pFecha;
		$this -> hora = $pHora;
		$this -> ip = $pIp;
		$this -> so = $pSo;
		$this -> explorador = $pExplorador;
		$this -> domiciliario = $pDomiciliario;
		$this -> logDomiciliarioDAO = new LogDomiciliarioDAO($this -> idLogDomiciliario, $this -> accion, $this -> informacion, $this -> fecha, $this -> hora, $this -> ip, $this -> so, $this -> explorador, $this -> domiciliario);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logDomiciliarioDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logDomiciliarioDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logDomiciliarioDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idLogDomiciliario = $result[0];
		$this -> accion = $result[1];
		$this -> informacion = $result[2];
		$this -> fecha = $result[3];
		$this -> hora = $result[4];
		$this -> ip = $result[5];
		$this -> so = $result[6];
		$this -> explorador = $result[7];
		$domiciliario = new Domiciliario($result[8]);
		$domiciliario -> select();
		$this -> domiciliario = $domiciliario;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logDomiciliarioDAO -> selectAll());
		$logDomiciliarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$domiciliario = new Domiciliario($result[8]);
			$domiciliario -> select();
			array_push($logDomiciliarios, new LogDomiciliario($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $domiciliario));
		}
		$this -> connection -> close();
		return $logDomiciliarios;
	}

	function selectAllByDomiciliario(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logDomiciliarioDAO -> selectAllByDomiciliario());
		$logDomiciliarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$domiciliario = new Domiciliario($result[8]);
			$domiciliario -> select();
			array_push($logDomiciliarios, new LogDomiciliario($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $domiciliario));
		}
		$this -> connection -> close();
		return $logDomiciliarios;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logDomiciliarioDAO -> selectAllOrder($order, $dir));
		$logDomiciliarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$domiciliario = new Domiciliario($result[8]);
			$domiciliario -> select();
			array_push($logDomiciliarios, new LogDomiciliario($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $domiciliario));
		}
		$this -> connection -> close();
		return $logDomiciliarios;
	}

	function selectAllByDomiciliarioOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logDomiciliarioDAO -> selectAllByDomiciliarioOrder($order, $dir));
		$logDomiciliarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$domiciliario = new Domiciliario($result[8]);
			$domiciliario -> select();
			array_push($logDomiciliarios, new LogDomiciliario($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $domiciliario));
		}
		$this -> connection -> close();
		return $logDomiciliarios;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> logDomiciliarioDAO -> search($search));
		$logDomiciliarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$domiciliario = new Domiciliario($result[8]);
			$domiciliario -> select();
			array_push($logDomiciliarios, new LogDomiciliario($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $domiciliario));
		}
		$this -> connection -> close();
		return $logDomiciliarios;
	}
}
?>

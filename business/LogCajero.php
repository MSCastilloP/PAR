<?php
require_once ("persistence/LogCajeroDAO.php");
require_once ("persistence/Connection.php");

class LogCajero {
	private $idLogCajero;
	private $accion;
	private $informacion;
	private $fecha;
	private $hora;
	private $ip;
	private $so;
	private $explorador;
	private $cajero;
	private $logCajeroDAO;
	private $connection;

	function getIdLogCajero() {
		return $this -> idLogCajero;
	}

	function setIdLogCajero($pIdLogCajero) {
		$this -> idLogCajero = $pIdLogCajero;
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

	function getCajero() {
		return $this -> cajero;
	}

	function setCajero($pCajero) {
		$this -> cajero = $pCajero;
	}

	function LogCajero($pIdLogCajero = "", $pAccion = "", $pInformacion = "", $pFecha = "", $pHora = "", $pIp = "", $pSo = "", $pExplorador = "", $pCajero = ""){
		$this -> idLogCajero = $pIdLogCajero;
		$this -> accion = $pAccion;
		$this -> informacion = $pInformacion;
		$this -> fecha = $pFecha;
		$this -> hora = $pHora;
		$this -> ip = $pIp;
		$this -> so = $pSo;
		$this -> explorador = $pExplorador;
		$this -> cajero = $pCajero;
		$this -> logCajeroDAO = new LogCajeroDAO($this -> idLogCajero, $this -> accion, $this -> informacion, $this -> fecha, $this -> hora, $this -> ip, $this -> so, $this -> explorador, $this -> cajero);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logCajeroDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logCajeroDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logCajeroDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idLogCajero = $result[0];
		$this -> accion = $result[1];
		$this -> informacion = $result[2];
		$this -> fecha = $result[3];
		$this -> hora = $result[4];
		$this -> ip = $result[5];
		$this -> so = $result[6];
		$this -> explorador = $result[7];
		$cajero = new Cajero($result[8]);
		$cajero -> select();
		$this -> cajero = $cajero;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logCajeroDAO -> selectAll());
		$logCajeros = array();
		while ($result = $this -> connection -> fetchRow()){
			$cajero = new Cajero($result[8]);
			$cajero -> select();
			array_push($logCajeros, new LogCajero($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $cajero));
		}
		$this -> connection -> close();
		return $logCajeros;
	}

	function selectAllByCajero(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logCajeroDAO -> selectAllByCajero());
		$logCajeros = array();
		while ($result = $this -> connection -> fetchRow()){
			$cajero = new Cajero($result[8]);
			$cajero -> select();
			array_push($logCajeros, new LogCajero($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $cajero));
		}
		$this -> connection -> close();
		return $logCajeros;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logCajeroDAO -> selectAllOrder($order, $dir));
		$logCajeros = array();
		while ($result = $this -> connection -> fetchRow()){
			$cajero = new Cajero($result[8]);
			$cajero -> select();
			array_push($logCajeros, new LogCajero($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $cajero));
		}
		$this -> connection -> close();
		return $logCajeros;
	}

	function selectAllByCajeroOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logCajeroDAO -> selectAllByCajeroOrder($order, $dir));
		$logCajeros = array();
		while ($result = $this -> connection -> fetchRow()){
			$cajero = new Cajero($result[8]);
			$cajero -> select();
			array_push($logCajeros, new LogCajero($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $cajero));
		}
		$this -> connection -> close();
		return $logCajeros;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> logCajeroDAO -> search($search));
		$logCajeros = array();
		while ($result = $this -> connection -> fetchRow()){
			$cajero = new Cajero($result[8]);
			$cajero -> select();
			array_push($logCajeros, new LogCajero($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $cajero));
		}
		$this -> connection -> close();
		return $logCajeros;
	}
}
?>

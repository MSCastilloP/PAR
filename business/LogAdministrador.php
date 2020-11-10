<?php
require_once ("persistence/LogAdministradorDAO.php");
require_once ("persistence/Connection.php");

class LogAdministrador {
	private $idLogAdministrador;
	private $accion;
	private $informacion;
	private $fecha;
	private $hora;
	private $ip;
	private $so;
	private $explorador;
	private $administrador;
	private $logAdministradorDAO;
	private $connection;

	function getIdLogAdministrador() {
		return $this -> idLogAdministrador;
	}

	function setIdLogAdministrador($pIdLogAdministrador) {
		$this -> idLogAdministrador = $pIdLogAdministrador;
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

	function getAdministrador() {
		return $this -> administrador;
	}

	function setAdministrador($pAdministrador) {
		$this -> administrador = $pAdministrador;
	}

	function LogAdministrador($pIdLogAdministrador = "", $pAccion = "", $pInformacion = "", $pFecha = "", $pHora = "", $pIp = "", $pSo = "", $pExplorador = "", $pAdministrador = ""){
		$this -> idLogAdministrador = $pIdLogAdministrador;
		$this -> accion = $pAccion;
		$this -> informacion = $pInformacion;
		$this -> fecha = $pFecha;
		$this -> hora = $pHora;
		$this -> ip = $pIp;
		$this -> so = $pSo;
		$this -> explorador = $pExplorador;
		$this -> administrador = $pAdministrador;
		$this -> logAdministradorDAO = new LogAdministradorDAO($this -> idLogAdministrador, $this -> accion, $this -> informacion, $this -> fecha, $this -> hora, $this -> ip, $this -> so, $this -> explorador, $this -> administrador);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministradorDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministradorDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministradorDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idLogAdministrador = $result[0];
		$this -> accion = $result[1];
		$this -> informacion = $result[2];
		$this -> fecha = $result[3];
		$this -> hora = $result[4];
		$this -> ip = $result[5];
		$this -> so = $result[6];
		$this -> explorador = $result[7];
		$administrador = new Administrador($result[8]);
		$administrador -> select();
		$this -> administrador = $administrador;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministradorDAO -> selectAll());
		$logAdministradors = array();
		while ($result = $this -> connection -> fetchRow()){
			$administrador = new Administrador($result[8]);
			$administrador -> select();
			array_push($logAdministradors, new LogAdministrador($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $administrador));
		}
		$this -> connection -> close();
		return $logAdministradors;
	}

	function selectAllByAdministrador(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministradorDAO -> selectAllByAdministrador());
		$logAdministradors = array();
		while ($result = $this -> connection -> fetchRow()){
			$administrador = new Administrador($result[8]);
			$administrador -> select();
			array_push($logAdministradors, new LogAdministrador($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $administrador));
		}
		$this -> connection -> close();
		return $logAdministradors;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministradorDAO -> selectAllOrder($order, $dir));
		$logAdministradors = array();
		while ($result = $this -> connection -> fetchRow()){
			$administrador = new Administrador($result[8]);
			$administrador -> select();
			array_push($logAdministradors, new LogAdministrador($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $administrador));
		}
		$this -> connection -> close();
		return $logAdministradors;
	}

	function selectAllByAdministradorOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministradorDAO -> selectAllByAdministradorOrder($order, $dir));
		$logAdministradors = array();
		while ($result = $this -> connection -> fetchRow()){
			$administrador = new Administrador($result[8]);
			$administrador -> select();
			array_push($logAdministradors, new LogAdministrador($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $administrador));
		}
		$this -> connection -> close();
		return $logAdministradors;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministradorDAO -> search($search));
		$logAdministradors = array();
		while ($result = $this -> connection -> fetchRow()){
			$administrador = new Administrador($result[8]);
			$administrador -> select();
			array_push($logAdministradors, new LogAdministrador($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $administrador));
		}
		$this -> connection -> close();
		return $logAdministradors;
	}
}
?>

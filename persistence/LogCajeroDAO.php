<?php
class LogCajeroDAO{
	private $idLogCajero;
	private $accion;
	private $informacion;
	private $fecha;
	private $hora;
	private $ip;
	private $so;
	private $explorador;
	private $cajero;

	function LogCajeroDAO($pIdLogCajero = "", $pAccion = "", $pInformacion = "", $pFecha = "", $pHora = "", $pIp = "", $pSo = "", $pExplorador = "", $pCajero = ""){
		$this -> idLogCajero = $pIdLogCajero;
		$this -> accion = $pAccion;
		$this -> informacion = $pInformacion;
		$this -> fecha = $pFecha;
		$this -> hora = $pHora;
		$this -> ip = $pIp;
		$this -> so = $pSo;
		$this -> explorador = $pExplorador;
		$this -> cajero = $pCajero;
	}

	function insert(){
		return "insert into LogCajero(accion, informacion, fecha, hora, ip, so, explorador, cajero_idCajero)
				values('" . $this -> accion . "', '" . $this -> informacion . "', '" . $this -> fecha . "', '" . $this -> hora . "', '" . $this -> ip . "', '" . $this -> so . "', '" . $this -> explorador . "', '" . $this -> cajero . "')";
	}

	function update(){
		return "update LogCajero set 
				accion = '" . $this -> accion . "',
				informacion = '" . $this -> informacion . "',
				fecha = '" . $this -> fecha . "',
				hora = '" . $this -> hora . "',
				ip = '" . $this -> ip . "',
				so = '" . $this -> so . "',
				explorador = '" . $this -> explorador . "',
				cajero_idCajero = '" . $this -> cajero . "'	
				where idLogCajero = '" . $this -> idLogCajero . "'";
	}

	function select() {
		return "select idLogCajero, accion, informacion, fecha, hora, ip, so, explorador, cajero_idCajero
				from LogCajero
				where idLogCajero = '" . $this -> idLogCajero . "'";
	}

	function selectAll() {
		return "select idLogCajero, accion, informacion, fecha, hora, ip, so, explorador, cajero_idCajero
				from LogCajero";
	}

	function selectAllByCajero() {
		return "select idLogCajero, accion, informacion, fecha, hora, ip, so, explorador, cajero_idCajero
				from LogCajero
				where cajero_idCajero = '" . $this -> cajero . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idLogCajero, accion, informacion, fecha, hora, ip, so, explorador, cajero_idCajero
				from LogCajero
				order by " . $orden . " " . $dir;
	}

	function selectAllByCajeroOrder($orden, $dir) {
		return "select idLogCajero, accion, informacion, fecha, hora, ip, so, explorador, cajero_idCajero
				from LogCajero
				where cajero_idCajero = '" . $this -> cajero . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idLogCajero, accion, informacion, fecha, hora, ip, so, explorador, cajero_idCajero
				from LogCajero
				where accion like '%" . $search . "%' or fecha like '%" . $search . "%' or hora like '%" . $search . "%' or ip like '%" . $search . "%' or so like '%" . $search . "%' or explorador like '%" . $search . "%'
				order by fecha desc, hora desc";
	}
}
?>

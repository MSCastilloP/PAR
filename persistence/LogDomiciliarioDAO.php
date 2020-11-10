<?php
class LogDomiciliarioDAO{
	private $idLogDomiciliario;
	private $accion;
	private $informacion;
	private $fecha;
	private $hora;
	private $ip;
	private $so;
	private $explorador;
	private $domiciliario;

	function LogDomiciliarioDAO($pIdLogDomiciliario = "", $pAccion = "", $pInformacion = "", $pFecha = "", $pHora = "", $pIp = "", $pSo = "", $pExplorador = "", $pDomiciliario = ""){
		$this -> idLogDomiciliario = $pIdLogDomiciliario;
		$this -> accion = $pAccion;
		$this -> informacion = $pInformacion;
		$this -> fecha = $pFecha;
		$this -> hora = $pHora;
		$this -> ip = $pIp;
		$this -> so = $pSo;
		$this -> explorador = $pExplorador;
		$this -> domiciliario = $pDomiciliario;
	}

	function insert(){
		return "insert into LogDomiciliario(accion, informacion, fecha, hora, ip, so, explorador, domiciliario_idDomiciliario)
				values('" . $this -> accion . "', '" . $this -> informacion . "', '" . $this -> fecha . "', '" . $this -> hora . "', '" . $this -> ip . "', '" . $this -> so . "', '" . $this -> explorador . "', '" . $this -> domiciliario . "')";
	}

	function update(){
		return "update LogDomiciliario set 
				accion = '" . $this -> accion . "',
				informacion = '" . $this -> informacion . "',
				fecha = '" . $this -> fecha . "',
				hora = '" . $this -> hora . "',
				ip = '" . $this -> ip . "',
				so = '" . $this -> so . "',
				explorador = '" . $this -> explorador . "',
				domiciliario_idDomiciliario = '" . $this -> domiciliario . "'	
				where idLogDomiciliario = '" . $this -> idLogDomiciliario . "'";
	}

	function select() {
		return "select idLogDomiciliario, accion, informacion, fecha, hora, ip, so, explorador, domiciliario_idDomiciliario
				from LogDomiciliario
				where idLogDomiciliario = '" . $this -> idLogDomiciliario . "'";
	}

	function selectAll() {
		return "select idLogDomiciliario, accion, informacion, fecha, hora, ip, so, explorador, domiciliario_idDomiciliario
				from LogDomiciliario";
	}

	function selectAllByDomiciliario() {
		return "select idLogDomiciliario, accion, informacion, fecha, hora, ip, so, explorador, domiciliario_idDomiciliario
				from LogDomiciliario
				where domiciliario_idDomiciliario = '" . $this -> domiciliario . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idLogDomiciliario, accion, informacion, fecha, hora, ip, so, explorador, domiciliario_idDomiciliario
				from LogDomiciliario
				order by " . $orden . " " . $dir;
	}

	function selectAllByDomiciliarioOrder($orden, $dir) {
		return "select idLogDomiciliario, accion, informacion, fecha, hora, ip, so, explorador, domiciliario_idDomiciliario
				from LogDomiciliario
				where domiciliario_idDomiciliario = '" . $this -> domiciliario . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idLogDomiciliario, accion, informacion, fecha, hora, ip, so, explorador, domiciliario_idDomiciliario
				from LogDomiciliario
				where accion like '%" . $search . "%' or fecha like '%" . $search . "%' or hora like '%" . $search . "%' or ip like '%" . $search . "%' or so like '%" . $search . "%' or explorador like '%" . $search . "%'
				order by fecha desc, hora desc";
	}
}
?>

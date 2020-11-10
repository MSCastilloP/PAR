<?php
class LogClienteDAO{
	private $idLogCliente;
	private $accion;
	private $informacion;
	private $fecha;
	private $hora;
	private $ip;
	private $so;
	private $explorador;
	private $cliente;

	function LogClienteDAO($pIdLogCliente = "", $pAccion = "", $pInformacion = "", $pFecha = "", $pHora = "", $pIp = "", $pSo = "", $pExplorador = "", $pCliente = ""){
		$this -> idLogCliente = $pIdLogCliente;
		$this -> accion = $pAccion;
		$this -> informacion = $pInformacion;
		$this -> fecha = $pFecha;
		$this -> hora = $pHora;
		$this -> ip = $pIp;
		$this -> so = $pSo;
		$this -> explorador = $pExplorador;
		$this -> cliente = $pCliente;
	}

	function insert(){
		return "insert into LogCliente(accion, informacion, fecha, hora, ip, so, explorador, cliente_idCliente)
				values('" . $this -> accion . "', '" . $this -> informacion . "', '" . $this -> fecha . "', '" . $this -> hora . "', '" . $this -> ip . "', '" . $this -> so . "', '" . $this -> explorador . "', '" . $this -> cliente . "')";
	}

	function update(){
		return "update LogCliente set 
				accion = '" . $this -> accion . "',
				informacion = '" . $this -> informacion . "',
				fecha = '" . $this -> fecha . "',
				hora = '" . $this -> hora . "',
				ip = '" . $this -> ip . "',
				so = '" . $this -> so . "',
				explorador = '" . $this -> explorador . "',
				cliente_idCliente = '" . $this -> cliente . "'	
				where idLogCliente = '" . $this -> idLogCliente . "'";
	}

	function select() {
		return "select idLogCliente, accion, informacion, fecha, hora, ip, so, explorador, cliente_idCliente
				from LogCliente
				where idLogCliente = '" . $this -> idLogCliente . "'";
	}

	function selectAll() {
		return "select idLogCliente, accion, informacion, fecha, hora, ip, so, explorador, cliente_idCliente
				from LogCliente";
	}

	function selectAllByCliente() {
		return "select idLogCliente, accion, informacion, fecha, hora, ip, so, explorador, cliente_idCliente
				from LogCliente
				where cliente_idCliente = '" . $this -> cliente . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idLogCliente, accion, informacion, fecha, hora, ip, so, explorador, cliente_idCliente
				from LogCliente
				order by " . $orden . " " . $dir;
	}

	function selectAllByClienteOrder($orden, $dir) {
		return "select idLogCliente, accion, informacion, fecha, hora, ip, so, explorador, cliente_idCliente
				from LogCliente
				where cliente_idCliente = '" . $this -> cliente . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idLogCliente, accion, informacion, fecha, hora, ip, so, explorador, cliente_idCliente
				from LogCliente
				where accion like '%" . $search . "%' or fecha like '%" . $search . "%' or hora like '%" . $search . "%' or ip like '%" . $search . "%' or so like '%" . $search . "%' or explorador like '%" . $search . "%'
				order by fecha desc, hora desc";
	}
}
?>

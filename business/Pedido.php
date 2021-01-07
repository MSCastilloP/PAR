<?php
require_once ("persistence/PedidoDAO.php");
require_once ("persistence/Connection.php");

class Pedido {
	private $idPedido;
	private $fecha;
	private $hora;
	private $descripcion;
	private $precio;
	private $cocinando;
	private $cajero;
	private $pedidoDAO;
	private $connection;

	function getIdPedido() {
		return $this -> idPedido;
	}

	function setIdPedido($pIdPedido) {
		$this -> idPedido = $pIdPedido;
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

	function getDescripcion() {
		return $this -> descripcion;
	}

	function setDescripcion($pDescripcion) {
		$this -> descripcion = $pDescripcion;
	}

	function getPrecio() {
		return $this -> precio;
	}

	function setPrecio($pPrecio) {
		$this -> precio = $pPrecio;
	}

	function getCocinando() {
		return $this -> cocinando;
	}

	function setCocinando($pCocinando) {
		$this -> cocinando = $pCocinando;
	}

	function getCajero() {
		return $this -> cajero;
	}

	function setCajero($pCajero) {
		$this -> cajero = $pCajero;
	}

	function Pedido($pIdPedido = "", $pFecha = "", $pHora = "", $pDescripcion = "", $pPrecio = "", $pCocinando = "", $pCajero = ""){
		$this -> idPedido = $pIdPedido;
		$this -> fecha = $pFecha;
		$this -> hora = $pHora;
		$this -> descripcion = $pDescripcion;
		$this -> precio = $pPrecio;
		$this -> cocinando = $pCocinando;
		$this -> cajero = $pCajero;
		$this -> pedidoDAO = new PedidoDAO($this -> idPedido, $this -> fecha, $this -> hora, $this -> descripcion, $this -> precio, $this -> cocinando, $this -> cajero);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idPedido = $result[0];
		$this -> fecha = $result[1];
		$this -> hora = $result[2];
		$this -> descripcion = $result[3];
		$this -> precio = $result[4];
		$this -> cocinando = $result[5];
		$cajero = new Cajero($result[6]);
		$cajero -> select();
		$this -> cajero = $cajero;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoDAO -> selectAll());
		$pedidos = array();
		while ($result = $this -> connection -> fetchRow()){
			$cajero = new Cajero($result[6]);
			$cajero -> select();
			array_push($pedidos, new Pedido($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $cajero));
		}
		$this -> connection -> close();
		return $pedidos;
	}

	function selectAllByCajero(){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoDAO -> selectAllByCajero());
		$pedidos = array();
		while ($result = $this -> connection -> fetchRow()){
			$cajero = new Cajero($result[6]);
			$cajero -> select();
			array_push($pedidos, new Pedido($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $cajero));
		}
		$this -> connection -> close();
		return $pedidos;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoDAO -> selectAllOrder($order, $dir));
		$pedidos = array();
		while ($result = $this -> connection -> fetchRow()){
			$cajero = new Cajero($result[6]);
			$cajero -> select();
			array_push($pedidos, new Pedido($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $cajero));
		}
		$this -> connection -> close();
		return $pedidos;
	}

	function selectAllByCajeroOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoDAO -> selectAllByCajeroOrder($order, $dir));
		$pedidos = array();
		while ($result = $this -> connection -> fetchRow()){
			$cajero = new Cajero($result[6]);
			$cajero -> select();
			array_push($pedidos, new Pedido($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $cajero));
		}
		$this -> connection -> close();
		return $pedidos;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoDAO -> search($search));
		$pedidos = array();
		while ($result = $this -> connection -> fetchRow()){
			$cajero = new Cajero($result[6]);
			$cajero -> select();
			array_push($pedidos, new Pedido($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $cajero));
		}
		$this -> connection -> close();
		return $pedidos;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}




	function insertTemporal($idp,$idn,$total,$cantidad){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoDAO -> insertTemporal($idp,$idn,$total,$cantidad));
		$this -> connection -> close();
	}
	function imprimirTemporal(){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoDAO -> imprimirTemporal());
		$pedidos = array();
		while ($result = $this -> connection -> fetchRow()){
			$arrays = array($result[0],$result[1],$result[2],$result[3],$result[4]);
			array_push($pedidos, $arrays);


		}
		$this -> connection -> close();
		return $pedidos;
	}

	function consultarOrdenes($id){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoDAO -> consultarOrdenes($id));
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		if($result[0]>0){
			return 1;
		}else{
			return 0;
		}

		

}
function eliminar($id){
	$this -> connection -> open();
		$this -> connection -> run($this -> pedidoDAO -> eliminar($id));
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;

}
function verificar(){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoDAO -> verificar());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		if($result[0]>0){
			return 1;
		}else{
			return 0;
		}

		

}
function traerID ($fecha, $hora){
	$this -> connection -> open();
		$this -> connection -> run($this -> pedidoDAO -> traerID($fecha, $hora));
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();

		return $result;

}
function eliminarTemporal(){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoDAO -> eliminarTemporal());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
}

function verificarTemporal($id){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoDAO -> verificarTemporal($id));
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		if($result[0]==1){
			return $result[1];
		}else{
			return 0;
		}
	
}
function updateTemporal($idp,$total,$cantidad){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoDAO -> updateTemporal($idp,$total,$cantidad));
		$this -> connection -> close();
	}

}

?>

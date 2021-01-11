<?php
require_once ("persistence/PedidoProDAO.php");
require_once ("persistence/Connection.php");

class PedidoPro {
	private $idPedidoPro;
	private $pedido;
	private $producto;
	private $pedidoProDAO;
	private $descripcion;
	private $cantidad;
	private $connection;

	function getIdPedidoPro() {
		return $this -> idPedidoPro;
	}

	function setIdPedidoPro($pIdPedidoPro) {
		$this -> idPedidoPro = $pIdPedidoPro;
	}

	function getPedido() {
		return $this -> pedido;
	}

	function setPedido($pPedido) {
		$this -> pedido = $pPedido;
	}

	function getProducto() {
		return $this -> producto;
	}
	

	function setProducto($pProducto) {
		$this -> producto = $pProducto;
	}
	function getCantidad() {
		return $this -> cantidad;
	}
	

	function setCantidad($pCantidad) {
		$this -> cantidad = $pCantidad;
	}

	function getDescripcion() {
		return $this -> descripcion;
	}
	function setDescripcion($pDescripcion) {
		$this -> descripcion = $pDescripcion;
	}

	function PedidoPro($pIdPedidoPro = "", $pPedido = "", $pProducto = "",$pCantidad="", $pDescripcion=""){
		$this -> idPedidoPro = $pIdPedidoPro;
		$this -> pedido = $pPedido;
		$this -> producto = $pProducto;
		$this -> cantidad = $pCantidad;
		$this -> descripcion = $pDescripcion;
		$this -> pedidoProDAO = new PedidoProDAO($this -> idPedidoPro, $this -> pedido, $this -> producto,$this -> cantidad, $this -> descripcion);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoProDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoProDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoProDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idPedidoPro = $result[0];
		$pedido = new Pedido($result[1]);
		$pedido -> select();
		$this -> pedido = $pedido;
		$producto = new Producto($result[2]);
		$producto -> select();
		$this -> producto = $producto;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoProDAO -> selectAll());
		$pedidoPros = array();
		while ($result = $this -> connection -> fetchRow()){
			$pedido = new Pedido($result[1]);
			$pedido -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($pedidoPros, new PedidoPro($result[0], $pedido, $producto));
		}
		$this -> connection -> close();
		return $pedidoPros;
	}

	
	function selectAllByProducto(){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoProDAO -> selectAllByProducto());
		$pedidoPros = array();
		while ($result = $this -> connection -> fetchRow()){
			$pedido = new Pedido($result[1]);
			$pedido -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($pedidoPros, new PedidoPro($result[0], $pedido, $producto));
		}
		$this -> connection -> close();
		return $pedidoPros;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoProDAO -> selectAllOrder($order, $dir));
		$pedidoPros = array();
		while ($result = $this -> connection -> fetchRow()){
			$pedido = new Pedido($result[1]);
			$pedido -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($pedidoPros, new PedidoPro($result[0], $pedido, $producto));
		}
		$this -> connection -> close();
		return $pedidoPros;
	}


/*
private $idPedidoPro;
	private $pedido;
	private $producto;
	private $pedidoProDAO;
	private $descripcion;
	private $cantidad;
	private $connection;*/
	function selectAllByPedido(){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoProDAO -> selectAllByPedido());
		$pedidoPros = array();
		while ($result = $this -> connection -> fetchRow()){
			$pedido = new Pedido($result[1]);
			$pedido -> select();			
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($pedidoPros, new PedidoPro($result[0], $pedido, $producto,$result[3],$result[4]));
		}
		$this -> connection -> close();
		return $pedidoPros;
	}

	function selectAllByPedidoOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoProDAO -> selectAllByPedidoOrder($order, $dir));
		$pedidoPros = array();
		while ($result = $this -> connection -> fetchRow()){
			$pedido = new Pedido($result[1]);
			$pedido -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($pedidoPros, new PedidoPro($result[0], $pedido, $producto,$result[3],$result[4]));
		}
		$this -> connection -> close();
		return $pedidoPros;
	}

	function selectAllByProductoOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoProDAO -> selectAllByProductoOrder($order, $dir));
		$pedidoPros = array();
		while ($result = $this -> connection -> fetchRow()){
			$pedido = new Pedido($result[1]);
			$pedido -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($pedidoPros, new PedidoPro($result[0], $pedido, $producto));
		}
		$this -> connection -> close();
		return $pedidoPros;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoProDAO -> search($search));
		$pedidoPros = array();
		while ($result = $this -> connection -> fetchRow()){
			$pedido = new Pedido($result[1]);
			$pedido -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($pedidoPros, new PedidoPro($result[0], $pedido, $producto));
		}
		$this -> connection -> close();
		return $pedidoPros;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> pedidoProDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>

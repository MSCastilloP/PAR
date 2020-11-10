<?php
class PedidoProDAO{
	private $idPedidoPro;
	private $pedido;
	private $producto;

	function PedidoProDAO($pIdPedidoPro = "", $pPedido = "", $pProducto = ""){
		$this -> idPedidoPro = $pIdPedidoPro;
		$this -> pedido = $pPedido;
		$this -> producto = $pProducto;
	}

	function insert(){
		return "insert into PedidoPro(pedido_idPedido, producto_idProducto)
				values('" . $this -> pedido . "', '" . $this -> producto . "')";
	}

	function update(){
		return "update PedidoPro set 
				pedido_idPedido = '" . $this -> pedido . "',
				producto_idProducto = '" . $this -> producto . "'	
				where idPedidoPro = '" . $this -> idPedidoPro . "'";
	}

	function select() {
		return "select idPedidoPro, pedido_idPedido, producto_idProducto
				from PedidoPro
				where idPedidoPro = '" . $this -> idPedidoPro . "'";
	}

	function selectAll() {
		return "select idPedidoPro, pedido_idPedido, producto_idProducto
				from PedidoPro";
	}

	function selectAllByPedido() {
		return "select idPedidoPro, pedido_idPedido, producto_idProducto
				from PedidoPro
				where pedido_idPedido = '" . $this -> pedido . "'";
	}

	function selectAllByProducto() {
		return "select idPedidoPro, pedido_idPedido, producto_idProducto
				from PedidoPro
				where producto_idProducto = '" . $this -> producto . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idPedidoPro, pedido_idPedido, producto_idProducto
				from PedidoPro
				order by " . $orden . " " . $dir;
	}

	function selectAllByPedidoOrder($orden, $dir) {
		return "select idPedidoPro, pedido_idPedido, producto_idProducto
				from PedidoPro
				where pedido_idPedido = '" . $this -> pedido . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByProductoOrder($orden, $dir) {
		return "select idPedidoPro, pedido_idPedido, producto_idProducto
				from PedidoPro
				where producto_idProducto = '" . $this -> producto . "'
				order by " . $orden . " " . $dir;
	}

	function delete(){
		return "delete from PedidoPro
				where idPedidoPro = '" . $this -> idPedidoPro . "'";
	}
}
?>

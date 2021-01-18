<?php
class PedidoProDAO{
	private $idPedidoPro;
	private $pedido;
	private $producto;
	private $descripcion;
	private $cantidad;

	function PedidoProDAO($pIdPedidoPro = "", $pPedido = "", $pProducto = "",$pCantidad="", $pDescripcion=" "){
		$this -> idPedidoPro = $pIdPedidoPro;
		$this -> pedido = $pPedido;
		$this -> producto = $pProducto;
		$this -> cantidad = $pCantidad;
		$this -> descripcion = $pDescripcion;
	}

	function insert(){
		return "insert into PedidoPro(pedido_idPedido, producto_idProducto,cantidad, descripcion)



				values('" . $this -> pedido . "', '" . $this -> producto . "', '" . $this -> cantidad . "', '" . $this -> descripcion . "')";
	}

	function update(){
		return "update PedidoPro set 
				pedido_idPedido = '" . $this -> pedido . "',
				producto_idProducto = '" . $this -> producto . "'	
				where idPedidoPro = '" . $this -> idPedidoPro . "'";
	}

	function updatePEPO($idp,$idPro,$total,$cantidad){
		return "update PedidoPro set 
				cantidad  = " . $cantidad . ",
				descripcion = '" . $total . "'	
				where producto_idProducto = " . $idPro ." and 
				pedido_idPedido =".$idp
				;
	}





	function select() {
		return "select idPedidoPro, pedido_idPedido, producto_idProducto
				from PedidoPro
				where idPedidoPro = '" . $this -> idPedidoPro . "'";
	}

	function traerCantidades($idp) {
		return "select cantidad
				from PedidoPro
				where pedido_idPedido = " .$idp. "
				order by producto_idProducto";
	}

	function traer() {
		return "select descripcion  
				from PedidoPro
				where pedido_idPedido = '" . $this -> pedido . "' and producto_idProducto= '".$this->producto ."'";
	}

	function selectAll() {
		return "select idPedidoPro, pedido_idPedido, producto_idProducto
				from PedidoPro";
	}




	function selectAllByPedido() {
		return "select idPedidoPro, pedido_idPedido, producto_idProducto, cantidad, descripcion
				from PedidoPro
				where pedido_idPedido = " . $this -> pedido ."
				order by producto_idProducto" ;
	}

	function selectEliminar() {
		return "select idPedidoPro, pedido_idPedido, producto_idProducto, cantidad, descripcion
				from PedidoPro
				where idPedidoPro = " . $this -> idPedidoPro ;
	}

	function selectAllByPedidoOrder($orden, $dir) {
		return "select idPedidoPro, pedido_idPedido, producto_idProducto, cantidad, descripcion
				from PedidoPro
				where pedido_idPedido = " . $this -> pedido . "
				order by " . $orden . " " . $dir;
	}





	function selectAllByProducto() {
		return "select idPedidoPro, pedido_idPedido, producto_idProducto, cantidad, descripcion
				from PedidoPro
				where producto_idProducto = '" . $this -> producto . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idPedidoPro, pedido_idPedido, producto_idProducto
				from PedidoPro
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

	function deletePedido(){
		return "delete from PedidoPro
				where pedido_idPedido = " . $this -> pedido;
	}


	function validar(){
		return "select count(pedido_idPedido) from PedidoPro where pedido_idPedido=". $this-> pedido;
	}
}
?>

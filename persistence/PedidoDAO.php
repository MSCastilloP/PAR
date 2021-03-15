<?php
class PedidoDAO{
	private $idPedido;
	private $fecha;
	private $hora;
	private $descripcion;
	private $precio;
	private $cocinando;
	private $cajero;

	function PedidoDAO($pIdPedido = "", $pFecha = "", $pHora = "", $pDescripcion = "", $pPrecio = "", $pCocinando = "", $pCajero = ""){
		$this -> idPedido = $pIdPedido;
		$this -> fecha = $pFecha;
		$this -> hora = $pHora;
		$this -> descripcion = $pDescripcion;
		$this -> precio = $pPrecio;
		$this -> cocinando = $pCocinando;
		$this -> cajero = $pCajero;
	}

	function insert(){
		return "insert into Pedido(fecha, hora, descripcion, precio, cocinando, cajero_idCajero)
				values('" . $this -> fecha . "', '" . $this -> hora . "', '" . $this -> descripcion . "', '" . $this -> precio . "', '" . $this -> cocinando . "', '" . $this -> cajero . "')";
	}

	function update(){
		return "update Pedido set 
				fecha = '" . $this -> fecha . "',
				hora = '" . $this -> hora . "',
				descripcion = '" . $this -> descripcion . "',
				precio = '" . $this -> precio . "',
				cocinando = '" . $this -> cocinando . "',
				cajero_idCajero = '" . $this -> cajero . "'	
				where idPedido = '" . $this -> idPedido . "'";
	}
	function updateP(){
		return "update Pedido set 
				descripcion = '" . $this -> descripcion . "',
				precio = " . $this -> precio . "
				where idPedido = " . $this -> idPedido  ;
	}

	function select() {
		return "select idPedido, fecha, hora, descripcion, precio, cocinando, cajero_idCajero
				from Pedido
				where idPedido = '" . $this -> idPedido . "'";
	}

	function selectAll() {
		return "select idPedido, fecha, hora, descripcion, precio, cocinando, cajero_idCajero
				from Pedido";
	}

	function selectAllByCajero() {
		return "select idPedido, fecha, hora, descripcion, precio, cocinando, cajero_idCajero
				from Pedido
				where cajero_idCajero = '" . $this -> cajero . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idPedido, fecha, hora, descripcion, precio, cocinando, cajero_idCajero
				from Pedido
				order by " . $orden . " " . $dir;
	}

	function selectAllByCajeroOrder($orden, $dir) {
		return "select idPedido, fecha, hora, descripcion, precio, cocinando, cajero_idCajero
				from Pedido
				where cajero_idCajero = '" . $this -> cajero . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idPedido, fecha, hora, descripcion, precio, cocinando, cajero_idCajero
				from Pedido
				where fecha like '%" . $search . "%' or hora like '%" . $search . "%' or descripcion like '%" . $search . "%' or precio like '%" . $search . "%' or cocinando like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Pedido
				where idPedido = " . $this -> idPedido;
	}



	function insertTemporal($idp,$idn,$total,$cantidad){
		return "insert into Temporal(idp, idn, descripcion, cantidad)
				values(" . $idp . ", '" . $idn . "', '" . $total . "', '" . $cantidad . "')";
	}



	function imprimirTemporal(){
		return " select t.idp, t.idn, t.descripcion, t.cantidad, p.precio
				from temporal as t, producto as p 
				where t.idp=p.idProducto";
	}


	function consultarOrdenes($id){
		return "select count(idp) from temporal where idp=".$id;
	}


	function eliminar($id){
		return "delete from temporal
				where idp = '" . $id. "'";

	}

	function verificar(){
		return " select count(idp) from temporal";
	}		

	function eliminarTemporal(){
		return "delete from temporal";
	}

	function traerID($fecha, $hora ){
		return "select idPedido from pedido where fecha= '". $fecha. "'  and hora= '".$hora."'  ";
	}

	function verificarTemporal($id ){
		return "select count(idp), descripcion  from temporal where idp=". $id;
	}
	function updateTemporal($idp,$total,$cantidad){
		return "update temporal set 
				descripcion = '" . $total . "',
				cantidad = " . $cantidad . "
				where idp = " . $idp . "";
	}


	function selectAllCocinero() {
		return "select idPedido,  hora, descripcion,  cocinando
				from Pedido
				where cocinando<3 
				order by hora";
	}
	function traerHoraFecha() {
		return "select hora, fecha
				from Pedido
				where idPedido=".$this -> idPedido;
	}

	function updateEstado($variable){
		return "update pedido set 
				cocinando =".$variable."
				where idPedido = " . $this -> idPedido;
	}
	
	
}
?>	

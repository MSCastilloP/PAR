<?php
class DomicilioDAO{
	private $idDomicilio;
	private $direccion;
	private $fecha;
	private $hora;
	private $precio;
	private $descripcion;
	private $cocinando;
	private $domiciliario;
	private $cliente;

	function DomicilioDAO($pIdDomicilio = "", $pDireccion = "", $pFecha = "", $pHora = "", $pPrecio = "", $pDescripcion = "", $pCocinando = "", $pDomiciliario = "", $pCliente = ""){
		$this -> idDomicilio = $pIdDomicilio;
		$this -> direccion = $pDireccion;
		$this -> fecha = $pFecha;
		$this -> hora = $pHora;
		$this -> precio = $pPrecio;
		$this -> descripcion = $pDescripcion;
		$this -> cocinando = $pCocinando;
		$this -> domiciliario = $pDomiciliario;
		$this -> cliente = $pCliente;
	}

	function insert(){
		echo $this -> fecha." ".$this -> hora." ".$this -> precio." ".$this -> descripcion." ".$this -> cocinando." ".$this -> cliente;
		return "insert into domicilio(fecha, hora, precio, descripcion, cocinando,  cliente_idCliente, domiciliario_idDomiciliario)
				values('" . $this -> fecha . "', '" . $this -> hora . "', " . $this -> precio . ", '" . $this -> descripcion . "', " . $this -> cocinando . ", " . $this -> cliente . ", 1)";
	}

	function update(){
		return "update Domicilio set 
				direccion = '" . $this -> direccion . "',
				fecha = '" . $this -> fecha . "',
				hora = '" . $this -> hora . "',
				precio = '" . $this -> precio . "',
				descripcion = '" . $this -> descripcion . "',
				cocinando = '" . $this -> cocinando . "',
				domiciliario_idDomiciliario = '" . $this -> domiciliario . "',
				cliente_idCliente = '" . $this -> cliente . "'	
				where idDomicilio = '" . $this -> idDomicilio . "'";
	}

	function select() {
		return "select idDomicilio, direccion, fecha, hora, precio, descripcion, cocinando, domiciliario_idDomiciliario, cliente_idCliente
				from Domicilio
				where idDomicilio = '" . $this -> idDomicilio . "'";
	}

	function selectAll() {
		return "select idDomicilio, direccion, fecha, hora, precio, descripcion, cocinando, domiciliario_idDomiciliario, cliente_idCliente
				from Domicilio";
	}

	function selectAllByDomiciliario() {
		return "select idDomicilio, direccion, fecha, hora, precio, descripcion, cocinando, domiciliario_idDomiciliario, cliente_idCliente
				from Domicilio
				where domiciliario_idDomiciliario = '" . $this -> domiciliario . "'";
	}

	function selectAllByCliente() {
		return "select idDomicilio, direccion, fecha, hora, precio, descripcion, cocinando, domiciliario_idDomiciliario, cliente_idCliente
				from Domicilio
				where cliente_idCliente = '" . $this -> cliente . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idDomicilio, direccion, fecha, hora, precio, descripcion, cocinando, domiciliario_idDomiciliario, cliente_idCliente
				from Domicilio
				order by " . $orden . " " . $dir;
	}

	function selectAllByDomiciliarioOrder($orden, $dir) {
		return "select idDomicilio, direccion, fecha, hora, precio, descripcion, cocinando, domiciliario_idDomiciliario, cliente_idCliente
				from Domicilio
				where domiciliario_idDomiciliario = '" . $this -> domiciliario . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByClienteOrder($orden, $dir) {
		return "select idDomicilio, direccion, fecha, hora, precio, descripcion, cocinando, domiciliario_idDomiciliario, cliente_idCliente
				from Domicilio
				where cliente_idCliente = '" . $this -> cliente . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idDomicilio, direccion, fecha, hora, precio, descripcion, cocinando, domiciliario_idDomiciliario, cliente_idCliente
				from Domicilio
				where direccion like '%" . $search . "%' or fecha like '%" . $search . "%' or hora like '%" . $search . "%' or precio like '%" . $search . "%' or descripcion like '%" . $search . "%' or cocinando like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Domicilio
				where idDomicilio = '" . $this -> idDomicilio . "'";
	}







	function verificarTemporal($id,$idc ){
		return "select count(idp), descripcion  
		from temporaldomicilio 
		where idp=". $id." and idc=".$idc;
	}


	function insertTemporal($idp,$idn,$total,$cantidad,$idc){
		return "insert into temporaldomicilio(idp, idn, descripcion, cantidad,idc)
				values(" . $idp . ", '" . $idn . "', '" . $total . "', '" . $cantidad . "',".$idc.")";
	}

	function updateTemporal($idp,$total,$cantidad,$idc){
		return "update temporaldomicilio set 
				descripcion = '" . $total . "',
				cantidad = " . $cantidad . "
				where idp = " . $idp . "
				 and idc =".$idc;
	}

	function imprimirTemporal($idc){
		return " select t.idp, t.idn, t.descripcion, t.cantidad, p.precio
				from temporaldomicilio as t, producto as p 
				where t.idp=p.idProducto and t.idc=".$idc;
	}

	function eliminar($id,$idc){
		return "delete from temporaldomicilio
				where idp = '" . $id. "' and idc=".$idc;

	}
	function eliminarTemporal($idc){
		return "delete from temporaldomicilio where idc=".$idc;
	}

	function traerID($fecha, $hora ){
		return "select idPedido from pedido where fecha= '". $fecha. "'  and hora= '".$hora."'  ";
	}
	function verificar($idc){
		return " select count(idp) from temporaldomicilio where idc=".$idc;
	}



}
?>

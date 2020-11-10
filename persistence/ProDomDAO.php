<?php
class ProDomDAO{
	private $idProDom;
	private $domicilio;
	private $producto;

	function ProDomDAO($pIdProDom = "", $pDomicilio = "", $pProducto = ""){
		$this -> idProDom = $pIdProDom;
		$this -> domicilio = $pDomicilio;
		$this -> producto = $pProducto;
	}

	function insert(){
		return "insert into ProDom(domicilio_idDomicilio, producto_idProducto)
				values('" . $this -> domicilio . "', '" . $this -> producto . "')";
	}

	function update(){
		return "update ProDom set 
				domicilio_idDomicilio = '" . $this -> domicilio . "',
				producto_idProducto = '" . $this -> producto . "'	
				where idProDom = '" . $this -> idProDom . "'";
	}

	function select() {
		return "select idProDom, domicilio_idDomicilio, producto_idProducto
				from ProDom
				where idProDom = '" . $this -> idProDom . "'";
	}

	function selectAll() {
		return "select idProDom, domicilio_idDomicilio, producto_idProducto
				from ProDom";
	}

	function selectAllByDomicilio() {
		return "select idProDom, domicilio_idDomicilio, producto_idProducto
				from ProDom
				where domicilio_idDomicilio = '" . $this -> domicilio . "'";
	}

	function selectAllByProducto() {
		return "select idProDom, domicilio_idDomicilio, producto_idProducto
				from ProDom
				where producto_idProducto = '" . $this -> producto . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idProDom, domicilio_idDomicilio, producto_idProducto
				from ProDom
				order by " . $orden . " " . $dir;
	}

	function selectAllByDomicilioOrder($orden, $dir) {
		return "select idProDom, domicilio_idDomicilio, producto_idProducto
				from ProDom
				where domicilio_idDomicilio = '" . $this -> domicilio . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByProductoOrder($orden, $dir) {
		return "select idProDom, domicilio_idDomicilio, producto_idProducto
				from ProDom
				where producto_idProducto = '" . $this -> producto . "'
				order by " . $orden . " " . $dir;
	}

	function delete(){
		return "delete from ProDom
				where idProDom = '" . $this -> idProDom . "'";
	}
}
?>

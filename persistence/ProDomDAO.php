<?php
class ProDomDAO{
	private $idProDom;
	private $domicilio;
	private $producto;
	private $cantidad;
	private $descripcion;

	function ProDomDAO($pIdProDom = "", $pDomicilio = "", $pProducto = "",$pCantidad = "", $pDescripcion = ""){
		$this -> idProDom = $pIdProDom;
		$this -> domicilio = $pDomicilio;
		$this -> producto = $pProducto;
		$this -> cantidad = $pCantidad;
		$this -> descripcion = $pDescripcion;

	}

	function insert(){
		return "insert into ProDom(domicilio_idDomicilio, producto_idProducto, cantidad , descripcion)
				values('" . $this -> domicilio . "', '" . $this -> producto . "', " . $this -> cantidad . ", '" . $this -> descripcion . "')";
	}

	function update(){
		return "update ProDom set 
				domicilio_idDomicilio = '" . $this -> domicilio . "',
				producto_idProducto = '" . $this -> producto . "'	
				where idProDom = '" . $this -> idProDom . "'";
	}

	function select() {
		return "select idProDom, domicilio_idDomicilio, producto_idProducto, cantidad , descripcion
				from ProDom
				where idProDom =" . $this -> idProDom ;
	}

	function selectAll() {
		return "select idProDom, domicilio_idDomicilio, producto_idProducto
				from ProDom";
	}

	function selectAllByDomicilio() {
		return "select idProDom, domicilio_idDomicilio, producto_idProducto,cantidad, descripcion
				from ProDom
				where domicilio_idDomicilio = '" . $this -> domicilio . "'";
	}

	function selectAllByProducto() {
		return "select idProDom, domicilio_idDomicilio, producto_idProducto,
				from ProDom
				where producto_idProducto = '" . $this -> producto . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idProDom, domicilio_idDomicilio, producto_idProducto
				from ProDom
				order by " . $orden . " " . $dir;
	}

	function selectAllByDomicilioOrder($orden, $dir) {
		return "select idProDom, domicilio_idDomicilio, producto_idProducto,cantidad,descripcion
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
				where idProDom =" . $this -> idProDom;
	}
	function deletePedo(){
		return "delete from ProDom
				where domicilio_idDomicilio =" . $this -> domicilio;
	}
	
	function traer() {
		return "select descripcion  
				from ProDom
				where domicilio_idDomicilio = '" . $this -> domicilio . "' and producto_idProducto= '".$this-> producto ."'";
	}

	function updatePEDO($idp,$idPro,$total,$cantidad){
		return "update ProDom set 
				cantidad  = " . $cantidad . ",
				descripcion = '" . $total . "'	
				where producto_idProducto = " . $idPro ." and 
				domicilio_idDomicilio =".$idp
				;
	}
	function traerCantidades($idp) {
		return "select cantidad
				from ProDom
				where domicilio_idDomicilio = " .$idp. "
				order by producto_idProducto";
	}
	function validar(){
		return "select count(domicilio_idDomicilio) from ProDom where domicilio_idDomicilio=". $this-> domicilio;
	}

	function selectDescripcionCocinero($id) {
		return "select pro.descripcion , p.nombre, pro.cantidad 
				from proDom as pro , producto as p 
				where pro.domicilio_idDomicilio = " . $id ." and p.idProducto = pro.producto_idProducto";
	}
}
?>

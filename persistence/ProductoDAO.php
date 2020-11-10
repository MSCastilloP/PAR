<?php
class ProductoDAO{
	private $idProducto;
	private $nombre;
	private $precio;
	private $descripcion;
	private $foto;

	function ProductoDAO($pIdProducto = "", $pNombre = "", $pPrecio = "", $pDescripcion = "", $pFoto = ""){
		$this -> idProducto = $pIdProducto;
		$this -> nombre = $pNombre;
		$this -> precio = $pPrecio;
		$this -> descripcion = $pDescripcion;
		$this -> foto = $pFoto;
	}

	function insert(){
		return "insert into Producto(nombre, precio, descripcion, foto)
				values('" . $this -> nombre . "', '" . $this -> precio . "', '" . $this -> descripcion . "', '" . $this -> foto . "')";
	}

	function update(){
		return "update Producto set 
				nombre = '" . $this -> nombre . "',
				precio = '" . $this -> precio . "',
				descripcion = '" . $this -> descripcion . "',
				foto = '" . $this -> foto . "'	
				where idProducto = '" . $this -> idProducto . "'";
	}

	function select() {
		return "select idProducto, nombre, precio, descripcion, foto
				from Producto
				where idProducto = '" . $this -> idProducto . "'";
	}

	function selectAll() {
		return "select idProducto, nombre, precio, descripcion, foto
				from Producto";
	}

	function selectAllOrder($orden, $dir){
		return "select idProducto, nombre, precio, descripcion, foto
				from Producto
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idProducto, nombre, precio, descripcion, foto
				from Producto
				where nombre like '%" . $search . "%' or precio like '%" . $search . "%' or descripcion like '%" . $search . "%' or foto like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Producto
				where idProducto = '" . $this -> idProducto . "'";
	}
}
?>

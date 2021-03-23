<?php
class ProductoDAO{
	private $idProducto;
	private $nombre;
	private $precio;
	private $descripcion;
	private $foto;
	private $estado;

	function ProductoDAO($pIdProducto = "", $pNombre = "", $pPrecio = "", $pDescripcion = "", $pFoto = "", $pEstado = ""){
		$this -> idProducto = $pIdProducto;
		$this -> nombre = $pNombre;
		$this -> precio = $pPrecio;
		$this -> descripcion = $pDescripcion;
		$this -> foto = $pFoto;
		$this -> estado = $pEstado;
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
				estado = '" . $this -> estado . "'
				where idProducto = '" . $this -> idProducto . "'";
	}

	function select() {
		return "select idProducto, nombre, precio, descripcion, foto, estado
				from Producto
				where idProducto = '" . $this -> idProducto . "'";
	}

	function selectAll() {
		return "select idProducto, nombre, precio, descripcion, foto, estado
				from Producto";
	}

	function selectAllOrder($orden, $dir){
		return "select idProducto, nombre, precio, descripcion, foto, estado
				from Producto
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idProducto, nombre, precio, descripcion, foto,estado
				from Producto
				where nombre like '%" . $search . "%' or precio like '%" . $search . "%' or descripcion like '%" . $search . "%' or foto like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Producto
				where idProducto = '" . $this -> idProducto . "'";
	}
	function encontrar() {
		return "select idProducto
				from Producto
				where nombre = '" . $this -> nombre . "' and descripcion= '".$this -> descripcion."'";
	}
	function traer($id) {
		return "select nombre
				from Producto
				where idProducto = '" . $id . "'";
	}

	function updateImage($attribute, $value){
		return "update Producto set "
				. $attribute . " = '" . $value . "'
				where idProducto = '" . $this -> idProducto . "'";
	}

	function verificarNombre(){
		return "select count(nombre)
		from Producto
		where nombre='".$this->nombre."'";
	}
	function cambiarEstado($estado){
		return "update Producto set 
				estado = '" . $estado . "'
				where idProducto = '" . $this -> idProducto . "'";
	}

}
?>

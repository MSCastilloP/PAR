<?php
require_once ("persistence/ProductoDAO.php");
require_once ("persistence/Connection.php");

class Producto {
	private $idProducto;
	private $nombre;
	private $precio;
	private $descripcion;
	private $foto;
	private $estado;
	private $productoDAO;
	private $connection;

	function getIdProducto() {
		return $this -> idProducto;
	}

	function setIdProducto($pIdProducto) {
		$this -> idProducto = $pIdProducto;
	}
	function getEstado() {
		return $this -> estado;
	}

	function setEstado($pEstado) {
		$this -> estado = $pEstado;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function getPrecio() {
		return $this -> precio;
	}

	function setPrecio($pPrecio) {
		$this -> precio = $pPrecio;
	}

	function getDescripcion() {
		return $this -> descripcion;
	}

	function setDescripcion($pDescripcion) {
		$this -> descripcion = $pDescripcion;
	}

	function getFoto() {
		return $this -> foto;
	}

	function setFoto($pFoto) {
		$this -> foto = $pFoto;
	}

	function Producto($pIdProducto = "", $pNombre = "", $pPrecio = "", $pDescripcion = "", $pFoto = "", $pEstado = ""){
		$this -> idProducto = $pIdProducto;
		$this -> nombre = $pNombre;
		$this -> precio = $pPrecio;
		$this -> descripcion = $pDescripcion;
		$this -> foto = $pFoto;
		$this -> estado = $pEstado;
		$this -> productoDAO = new ProductoDAO($this -> idProducto, $this -> nombre, $this -> precio, $this -> descripcion, $this -> foto, $this -> estado);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> productoDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> productoDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> productoDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idProducto = $result[0];
		$this -> nombre = $result[1];
		$this -> precio = $result[2];
		$this -> descripcion = $result[3];
		$this -> foto = $result[4];
		$this -> estado = $result[5];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> productoDAO -> selectAll());
		$productos = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($productos, new Producto($result[0], $result[1], $result[2], $result[3], $result[4],$result[5]));
		}
		$this -> connection -> close();
		return $productos;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> productoDAO -> selectAllOrder($order, $dir));
		$productos = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($productos, new Producto($result[0], $result[1], $result[2], $result[3], $result[4],$result[5]));
		}
		$this -> connection -> close();
		return $productos;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> productoDAO -> search($search));
		$productos = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($productos, new Producto($result[0], $result[1], $result[2], $result[3], $result[4],$result[5]));
		}
		$this -> connection -> close();
		return $productos;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> productoDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
	function encontrar(){
		$this -> connection -> open();
		$this -> connection -> run($this -> productoDAO -> encontrar());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idProducto = $result[0];
	}
	function traer($id){
		$this -> connection -> open();
		$this -> connection -> run($this -> productoDAO -> traer($id));
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> nombre = $result[0];
		

	}
	function updateImage($attribute, $value){
		$this -> connection -> open();
		$this -> connection -> run($this -> productoDAO -> updateImage($attribute, $value));
		$this -> connection -> close();
	}
	function verificarNombre(){
		$this -> connection -> open();
		$this -> connection -> run($this -> productoDAO -> verificarNombre());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		if($result[0]>0){
			return false;
		}else{
			return true;
		}
	
}
function cambiarEstado($estado){
	$this -> connection -> open();
	$this -> connection -> run($this -> productoDAO -> cambiarEstado($estado));
	$this -> connection -> close();
}

function consultarVentasP($fecha1,$fecha2){
	$this -> connection -> open();
	$this -> connection -> run($this -> productoDAO -> consultarVentasP($fecha1,$fecha2));
	$productos = array();
	while ($result = $this -> connection -> fetchRow()){
		array_push($productos, array($result[0], $result[1], $result[2],$result[3]));
	}
	$this -> connection -> close();
	return $productos;
}
function consultarVentasD($fecha1,$fecha2){
	$this -> connection -> open();
	$this -> connection -> run($this -> productoDAO -> consultarVentasD($fecha1,$fecha2));
	$productos = array();
	while ($result = $this -> connection -> fetchRow()){
		array_push($productos,array($result[0], $result[1],$result[2],$result[3]));
	}
	$this -> connection -> close();
	return $productos;
}
}
?>

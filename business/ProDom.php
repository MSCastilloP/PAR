<?php
require_once ("persistence/ProDomDAO.php");
require_once ("persistence/Connection.php");

class ProDom {
	private $idProDom;
	private $domicilio;
	private $producto;
	private $descripcion;
	private $cantidad;
	private $proDomDAO;
	private $connection;

	function getIdProDom() {
		return $this -> idProDom;
	}

	function setIdProDom($pIdProDom) {
		$this -> idProDom = $pIdProDom;
	}

	function getDomicilio() {
		return $this -> domicilio;
	}

	function setDomicilio($pDomicilio) {
		$this -> domicilio = $pDomicilio;
	}

	function getDescripcion() {
		return $this -> descripcion;
	}

	function setDescripcion($pDescripcion) {
		$this -> descripcion = $pDescripcion;
	}

	function getCantidad() {
		return $this -> cantidad;
	}

	function setCantidad($pCantidad) {
		$this -> cantidad = $pCantidad;
	}


	function getProducto() {
		return $this -> producto;
	}

	function setProducto($pProducto) {
		$this -> producto = $pProducto;
	}

	function ProDom($pIdProDom = "", $pDomicilio = "", $pProducto = "",$pCantidad = "", $pDescripcion = ""){
		$this -> idProDom = $pIdProDom;
		$this -> domicilio = $pDomicilio;
		$this -> producto = $pProducto;
		$this -> cantidad = $pCantidad;
		$this -> descripcion = $pDescripcion;
		$this -> proDomDAO = new ProDomDAO($this -> idProDom, $this -> domicilio, $this -> producto,$this-> cantidad , $this -> descripcion);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> proDomDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> proDomDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> proDomDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idProDom = $result[0];
		$domicilio = new Domicilio($result[1]);
		$domicilio -> select();
		$this -> domicilio = $domicilio;
		$producto = new Producto($result[2]);
		$producto -> select();
		$this -> producto = $producto;
		$this -> cantidad = $result[3];
		$this -> descripcion = $result[4];

	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> proDomDAO -> selectAll());
		$proDoms = array();
		while ($result = $this -> connection -> fetchRow()){
			$domicilio = new Domicilio($result[1]);
			$domicilio -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($proDoms, new ProDom($result[0], $domicilio, $producto));
		}
		$this -> connection -> close();
		return $proDoms;
	}

	function selectAllByDomicilio(){
		$this -> connection -> open();
		$this -> connection -> run($this -> proDomDAO -> selectAllByDomicilio());
		$proDoms = array();
		while ($result = $this -> connection -> fetchRow()){
			$domicilio = new Domicilio($result[1]);
			$domicilio -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($proDoms, new ProDom($result[0], $domicilio, $producto,$result[3],$result[4]));
		}
		$this -> connection -> close();
		return $proDoms;
	}

	function selectAllByProducto(){
		$this -> connection -> open();
		$this -> connection -> run($this -> proDomDAO -> selectAllByProducto());
		$proDoms = array();
		while ($result = $this -> connection -> fetchRow()){
			$domicilio = new Domicilio($result[1]);
			$domicilio -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($proDoms, new ProDom($result[0], $domicilio, $producto));
		}
		$this -> connection -> close();
		return $proDoms;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> proDomDAO -> selectAllOrder($order, $dir));
		$proDoms = array();
		while ($result = $this -> connection -> fetchRow()){
			$domicilio = new Domicilio($result[1]);
			$domicilio -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($proDoms, new ProDom($result[0], $domicilio, $producto));
		}
		$this -> connection -> close();
		return $proDoms;
	}

	function selectAllByDomicilioOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> proDomDAO -> selectAllByDomicilioOrder($order, $dir));
		$proDoms = array();
		while ($result = $this -> connection -> fetchRow()){
			$domicilio = new Domicilio($result[1]);
			$domicilio -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($proDoms, new ProDom($result[0], $domicilio, $producto,$result[3],$result[4]));
		}
		$this -> connection -> close();
		return $proDoms;
	}

	function selectAllByProductoOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> proDomDAO -> selectAllByProductoOrder($order, $dir));
		$proDoms = array();
		while ($result = $this -> connection -> fetchRow()){
			$domicilio = new Domicilio($result[1]);
			$domicilio -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($proDoms, new ProDom($result[0], $domicilio, $producto));
		}
		$this -> connection -> close();
		return $proDoms;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> proDomDAO -> search($search));
		$proDoms = array();
		while ($result = $this -> connection -> fetchRow()){
			$domicilio = new Domicilio($result[1]);
			$domicilio -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($proDoms, new ProDom($result[0], $domicilio, $producto));
		}
		$this -> connection -> close();
		return $proDoms;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> proDomDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
	function deletePedo(){
		$this -> connection -> open();
		$this -> connection -> run($this -> proDomDAO -> deletePedo());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
	function traer(){
		$this -> connection -> open();
		$this -> connection -> run($this -> proDomDAO -> traer());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> descripcion = $result[0];
		
	}
	function updatePEDO($idp,$idPro,$total,$cantidad){
		$this -> connection -> open();
		$this -> connection -> run($this -> proDomDAO -> updatePEDO($idp,$idPro,$total,$cantidad));
		$this -> connection -> close();
	}
	
	function traerCantidades($idp){
		$this -> connection -> open();
		$this -> connection -> run($this -> proDomDAO -> traerCantidades($idp));
		$pedidoPros = array();
		while ($result = $this -> connection -> fetchRow()){
			
			array_push($pedidoPros, $result[0]);
		}
		$this -> connection -> close();
		return $pedidoPros;
	}
		function validar(){
		$this -> connection -> open();
		$this -> connection -> run($this -> proDomDAO -> validar());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		if($result[0]>0){
			return 1;
		}else{
			return 0;
		}

		

}
}
?>
	
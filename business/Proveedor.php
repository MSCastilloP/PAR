<?php
require_once ("persistence/ProveedorDAO.php");
require_once ("persistence/Connection.php");

class Proveedor {
	private $idProveedor;
	private $nombreEmpresa;
	private $telefono;
	private $descripcion;
	private $proveedorDAO;
	private $connection;

	function getIdProveedor() {
		return $this -> idProveedor;
	}

	function setIdProveedor($pIdProveedor) {
		$this -> idProveedor = $pIdProveedor;
	}

	function getNombreEmpresa() {
		return $this -> nombreEmpresa;
	}

	function setNombreEmpresa($pNombreEmpresa) {
		$this -> nombreEmpresa = $pNombreEmpresa;
	}

	function getTelefono() {
		return $this -> telefono;
	}

	function setTelefono($pTelefono) {
		$this -> telefono = $pTelefono;
	}

	function getDescripcion() {
		return $this -> descripcion;
	}

	function setDescripcion($pDescripcion) {
		$this -> descripcion = $pDescripcion;
	}

	function Proveedor($pIdProveedor = "", $pNombreEmpresa = "", $pTelefono = "", $pDescripcion = ""){
		$this -> idProveedor = $pIdProveedor;
		$this -> nombreEmpresa = $pNombreEmpresa;
		$this -> telefono = $pTelefono;
		$this -> descripcion = $pDescripcion;
		$this -> proveedorDAO = new ProveedorDAO($this -> idProveedor, $this -> nombreEmpresa, $this -> telefono, $this -> descripcion);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> proveedorDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> proveedorDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> proveedorDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idProveedor = $result[0];
		$this -> nombreEmpresa = $result[1];
		$this -> telefono = $result[2];
		$this -> descripcion = $result[3];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> proveedorDAO -> selectAll());
		$proveedors = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($proveedors, new Proveedor($result[0], $result[1], $result[2], $result[3]));
		}
		$this -> connection -> close();
		return $proveedors;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> proveedorDAO -> selectAllOrder($order, $dir));
		$proveedors = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($proveedors, new Proveedor($result[0], $result[1], $result[2], $result[3]));
		}
		$this -> connection -> close();
		return $proveedors;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> proveedorDAO -> search($search));
		$proveedors = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($proveedors, new Proveedor($result[0], $result[1], $result[2], $result[3]));
		}
		$this -> connection -> close();
		return $proveedors;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> proveedorDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>

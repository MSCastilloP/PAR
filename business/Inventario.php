<?php
require_once ("persistence/InventarioDAO.php");
require_once ("persistence/Connection.php");

class Inventario {
	private $idInventario;
	private $fecha;
	private $cantidadInicial;
	private $unidades;
	private $cantidadFinal;
	private $ingrediente;
	private $inventarioDAO;
	private $connection;

	function getIdInventario() {
		return $this -> idInventario;
	}

	function setIdInventario($pIdInventario) {
		$this -> idInventario = $pIdInventario;
	}

	function getFecha() {
		return $this -> fecha;
	}

	function setFecha($pFecha) {
		$this -> fecha = $pFecha;
	}

	function getCantidadInicial() {
		return $this -> cantidadInicial;
	}

	function setCantidadInicial($pCantidadInicial) {
		$this -> cantidadInicial = $pCantidadInicial;
	}

	function getUnidades() {
		return $this -> unidades;
	}

	function setUnidades($pUnidades) {
		$this -> unidades = $pUnidades;
	}

	function getCantidadFinal() {
		return $this -> cantidadFinal;
	}

	function setCantidadFinal($pCantidadFinal) {
		$this -> cantidadFinal = $pCantidadFinal;
	}

	function getIngrediente() {
		return $this -> ingrediente;
	}

	function setIngrediente($pIngrediente) {
		$this -> ingrediente = $pIngrediente;
	}

	function Inventario($pIdInventario = "", $pFecha = "", $pCantidadInicial = "", $pUnidades = "", $pCantidadFinal = "", $pIngrediente = ""){
		$this -> idInventario = $pIdInventario;
		$this -> fecha = $pFecha;
		$this -> cantidadInicial = $pCantidadInicial;
		$this -> unidades = $pUnidades;
		$this -> cantidadFinal = $pCantidadFinal;
		$this -> ingrediente = $pIngrediente;
		$this -> inventarioDAO = new InventarioDAO($this -> idInventario, $this -> fecha, $this -> cantidadInicial, $this -> unidades, $this -> cantidadFinal, $this -> ingrediente);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> inventarioDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> inventarioDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> inventarioDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idInventario = $result[0];
		$this -> fecha = $result[1];
		$this -> cantidadInicial = $result[2];
		$this -> unidades = $result[3];
		$this -> cantidadFinal = $result[4];
		$ingrediente = new Ingrediente($result[5]);
		$ingrediente -> select();
		$this -> ingrediente = $ingrediente;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> inventarioDAO -> selectAll());
		$inventarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$ingrediente = new Ingrediente($result[5]);
			$ingrediente -> select();
			array_push($inventarios, new Inventario($result[0], $result[1], $result[2], $result[3], $result[4], $ingrediente));
		}
		$this -> connection -> close();
		return $inventarios;
	}

	function selectAllByIngrediente(){
		$this -> connection -> open();
		$this -> connection -> run($this -> inventarioDAO -> selectAllByIngrediente());
		$inventarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$ingrediente = new Ingrediente($result[5]);
			$ingrediente -> select();
			array_push($inventarios, new Inventario($result[0], $result[1], $result[2], $result[3], $result[4], $ingrediente));
		}
		$this -> connection -> close();
		return $inventarios;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> inventarioDAO -> selectAllOrder($order, $dir));
		$inventarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$ingrediente = new Ingrediente($result[5]);
			$ingrediente -> select();
			array_push($inventarios, new Inventario($result[0], $result[1], $result[2], $result[3], $result[4], $ingrediente));
		}
		$this -> connection -> close();
		return $inventarios;
	}

	function selectAllByIngredienteOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> inventarioDAO -> selectAllByIngredienteOrder($order, $dir));
		$inventarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$ingrediente = new Ingrediente($result[5]);
			$ingrediente -> select();
			array_push($inventarios, new Inventario($result[0], $result[1], $result[2], $result[3], $result[4], $ingrediente));
		}
		$this -> connection -> close();
		return $inventarios;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> inventarioDAO -> search($search));
		$inventarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$ingrediente = new Ingrediente($result[5]);
			$ingrediente -> select();
			array_push($inventarios, new Inventario($result[0], $result[1], $result[2], $result[3], $result[4], $ingrediente));
		}
		$this -> connection -> close();
		return $inventarios;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> inventarioDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>

<?php
require_once ("persistence/IngreProDAO.php");
require_once ("persistence/Connection.php");

class IngrePro {
	private $idIngrePro;
	private $ingrediente;
	private $producto;
	private $ingreProDAO;
	private $connection;

	function getIdIngrePro() {
		return $this -> idIngrePro;
	}

	function setIdIngrePro($pIdIngrePro) {
		$this -> idIngrePro = $pIdIngrePro;
	}

	function getIngrediente() {
		return $this -> ingrediente;
	}

	function setIngrediente($pIngrediente) {
		$this -> ingrediente = $pIngrediente;
	}

	function getProducto() {
		return $this -> producto;
	}

	function setProducto($pProducto) {
		$this -> producto = $pProducto;
	}

	function IngrePro($pIdIngrePro = "", $pIngrediente = "", $pProducto = ""){
		$this -> idIngrePro = $pIdIngrePro;
		$this -> ingrediente = $pIngrediente;
		$this -> producto = $pProducto;
		$this -> ingreProDAO = new IngreProDAO($this -> idIngrePro, $this -> ingrediente, $this -> producto);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingreProDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingreProDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingreProDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idIngrePro = $result[0];
		$ingrediente = new Ingrediente($result[1]);
		$ingrediente -> select();
		$this -> ingrediente = $ingrediente;
		$producto = new Producto($result[2]);
		$producto -> select();
		$this -> producto = $producto;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingreProDAO -> selectAll());
		$ingrePros = array();
		while ($result = $this -> connection -> fetchRow()){
			$ingrediente = new Ingrediente($result[1]);
			$ingrediente -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($ingrePros, new IngrePro($result[0], $ingrediente, $producto));
		}
		$this -> connection -> close();
		return $ingrePros;
	}

	function selectAllByIngrediente(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingreProDAO -> selectAllByIngrediente());
		$ingrePros = array();
		while ($result = $this -> connection -> fetchRow()){
			$ingrediente = new Ingrediente($result[1]);
			$ingrediente -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($ingrePros, new IngrePro($result[0], $ingrediente, $producto));
		}
		$this -> connection -> close();
		return $ingrePros;
	}

	function selectAllByProducto(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingreProDAO -> selectAllByProducto());
		$ingrePros = array();
		while ($result = $this -> connection -> fetchRow()){
			$ingrediente = new Ingrediente($result[1]);
			$ingrediente -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($ingrePros, new IngrePro($result[0], $ingrediente, $producto));
		}
		$this -> connection -> close();
		return $ingrePros;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingreProDAO -> selectAllOrder($order, $dir));
		$ingrePros = array();
		while ($result = $this -> connection -> fetchRow()){
			$ingrediente = new Ingrediente($result[1]);
			$ingrediente -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($ingrePros, new IngrePro($result[0], $ingrediente, $producto));
		}
		$this -> connection -> close();
		return $ingrePros;
	}

	function selectAllByIngredienteOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingreProDAO -> selectAllByIngredienteOrder($order, $dir));
		$ingrePros = array();
		while ($result = $this -> connection -> fetchRow()){
			$ingrediente = new Ingrediente($result[1]);
			$ingrediente -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($ingrePros, new IngrePro($result[0], $ingrediente, $producto));
		}
		$this -> connection -> close();
		return $ingrePros;
	}

	function selectAllByProductoOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingreProDAO -> selectAllByProductoOrder($order, $dir));
		$ingrePros = array();
		while ($result = $this -> connection -> fetchRow()){
			$ingrediente = new Ingrediente($result[1]);
			$ingrediente -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($ingrePros, new IngrePro($result[0], $ingrediente, $producto));
		}
		$this -> connection -> close();
		return $ingrePros;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingreProDAO -> search($search));
		$ingrePros = array();
		while ($result = $this -> connection -> fetchRow()){
			$ingrediente = new Ingrediente($result[1]);
			$ingrediente -> select();
			$producto = new Producto($result[2]);
			$producto -> select();
			array_push($ingrePros, new IngrePro($result[0], $ingrediente, $producto));
		}
		$this -> connection -> close();
		return $ingrePros;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingreProDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
	function traerIngre($id){
		$this -> connection -> open();
		$this -> connection -> run($this -> ingreProDAO -> traerIngre($id));
		$ingredientes = array();
		while ($result = $this -> connection -> fetchRow()){
		
			array_push($ingredientes,new Ingrediente($result[0],$result[1],$result[2]));
		}
		$this -> connection -> close();
		return $ingredientes;
	}

	function ingretra($id){

		$this -> connection -> open();
		$this -> connection -> run($this -> ingreProDAO -> ingretra($id));
		$ingredientes = array();
		while ($result = $this -> connection -> fetchRow()){
			
			array_push($ingredientes,$result[0]);
		}
		$this -> connection -> close();
		return $ingredientes;
	}

	function deleteUpdate(){
		$this -> connection -> open();
		echo "entro";
		$this -> connection -> run($this -> ingreProDAO -> deleteUpdate());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		echo "salio";
		return $success;
	}

}
?>

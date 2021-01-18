<?php
require_once ("persistence/ClienteDAO.php");
require_once ("persistence/Connection.php");

class Cliente {
	private $idCliente;
	private $nombre;
	private $apellido;
	private $correo;
	private $clave;
	private $foto;
	private $telefono;
	private $direccion;

	private $clienteDAO;
	private $connection;

	function getIdCliente() {
		return $this -> idCliente;
	}

	function setIdCliente($pIdCliente) {
		$this -> idCliente = $pIdCliente;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function getApellido() {
		return $this -> apellido;
	}

	function setApellido($pApellido) {
		$this -> apellido = $pApellido;
	}

	function getCorreo() {
		return $this -> correo;
	}

	function setCorreo($pCorreo) {
		$this -> correo = $pCorreo;
	}

	function getClave() {
		return $this -> clave;
	}

	function setClave($pClave) {
		$this -> clave = $pClave;
	}

	function getFoto() {
		return $this -> foto;
	}

	function setFoto($pFoto) {
		$this -> foto = $pFoto;
	}

	function getTelefono() {
		return $this -> telefono;
	}

	function setTelefono($pTelefono) {
		$this -> telefono = $pTelefono;
	}

	function getDireccion() {
		return $this -> direccion;
	}

	function setDireccion($pDireccion) {
		$this -> direccion = $pDireccion;
	}

	

	function Cliente($pIdCliente = "", $pNombre = "", $pApellido = "", $pCorreo = "", $pClave = "", $pFoto = "", $pTelefono = "", $pDireccion = ""){
		$this -> idCliente = $pIdCliente;
		$this -> nombre = $pNombre;
		$this -> apellido = $pApellido;
		$this -> correo = $pCorreo;
		$this -> clave = $pClave;
		$this -> foto = $pFoto;
		$this -> telefono = $pTelefono;
		$this -> direccion = $pDireccion;
		
		$this -> clienteDAO = new ClienteDAO($this -> idCliente, $this -> nombre, $this -> apellido, $this -> correo, $this -> clave, $this -> foto, $this -> telefono, $this -> direccion);
		$this -> connection = new Connection();
	}

	function logIn($email, $password){
		$this -> connection -> open();
		$this -> connection -> run($this -> clienteDAO -> logIn($email, $password));
		if($this -> connection -> numRows()==1){
			$result = $this -> connection -> fetchRow();
			$this -> idCliente = $result[0];
			$this -> nombre = $result[1];
			$this -> apellido = $result[2];
			$this -> correo = $result[3];
			$this -> clave = $result[4];
			$this -> foto = $result[5];
			$this -> telefono = $result[6];
			$this -> direccion = $result[7];
	
			$this -> connection -> close();
			return true;
		}else{
			$this -> connection -> close();
			return false;
		}
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> clienteDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> clienteDAO -> update());
		$this -> connection -> close();
	}

	function updateClave($password){
		$this -> connection -> open();
		$this -> connection -> run($this -> clienteDAO -> updateClave($password));
		$this -> connection -> close();
	}

	function existEmail($email){
		$this -> connection -> open();
		$this -> connection -> run($this -> clienteDAO -> existEmail($email));
		if($this -> connection -> numRows()==1){
			$this -> connection -> close();
			return true;
		}else{
			$this -> connection -> close();
			return false;
		}
	}

	function recoverPassword($email, $password){
		$this -> connection -> open();
		$this -> connection -> run($this -> clienteDAO -> recoverPassword($email, $password));
		$this -> connection -> close();
	}

	function updateImage($attribute, $value){
		$this -> connection -> open();
		$this -> connection -> run($this -> clienteDAO -> updateImage($attribute, $value));
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> clienteDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idCliente = $result[0];
		$this -> nombre = $result[1];
		$this -> apellido = $result[2];
		$this -> correo = $result[3];
		$this -> clave = $result[4];
		$this -> foto = $result[5];
		$this -> telefono = $result[6];
		$this -> direccion = $result[7];
		
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> clienteDAO -> selectAll());
		$clientes = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($clientes, new Cliente($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7]));
		}
		$this -> connection -> close();
		return $clientes;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> clienteDAO -> selectAllOrder($order, $dir));
		$clientes = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($clientes, new Cliente($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7]));
		}
		$this -> connection -> close();
		return $clientes;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> clienteDAO -> search($search));
		$clientes = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($clientes, new Cliente($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7]));
		}
		$this -> connection -> close();
		return $clientes;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> clienteDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>

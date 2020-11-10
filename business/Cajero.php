<?php
require_once ("persistence/CajeroDAO.php");
require_once ("persistence/Connection.php");

class Cajero {
	private $idCajero;
	private $nombre;
	private $apellido;
	private $correo;
	private $clave;
	private $foto;
	private $salario;
	private $telefono;
	private $rol;
	private $state;
	private $cajeroDAO;
	private $connection;

	function getIdCajero() {
		return $this -> idCajero;
	}

	function setIdCajero($pIdCajero) {
		$this -> idCajero = $pIdCajero;
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

	function getSalario() {
		return $this -> salario;
	}

	function setSalario($pSalario) {
		$this -> salario = $pSalario;
	}

	function getTelefono() {
		return $this -> telefono;
	}

	function setTelefono($pTelefono) {
		$this -> telefono = $pTelefono;
	}

	function getRol() {
		return $this -> rol;
	}

	function setRol($pRol) {
		$this -> rol = $pRol;
	}

	function getState() {
		return $this -> state;
	}

	function setState($pState) {
		$this -> state = $pState;
	}

	function Cajero($pIdCajero = "", $pNombre = "", $pApellido = "", $pCorreo = "", $pClave = "", $pFoto = "", $pSalario = "", $pTelefono = "", $pRol = "", $pState = ""){
		$this -> idCajero = $pIdCajero;
		$this -> nombre = $pNombre;
		$this -> apellido = $pApellido;
		$this -> correo = $pCorreo;
		$this -> clave = $pClave;
		$this -> foto = $pFoto;
		$this -> salario = $pSalario;
		$this -> telefono = $pTelefono;
		$this -> rol = $pRol;
		$this -> state = $pState;
		$this -> cajeroDAO = new CajeroDAO($this -> idCajero, $this -> nombre, $this -> apellido, $this -> correo, $this -> clave, $this -> foto, $this -> salario, $this -> telefono, $this -> rol, $this -> state);
		$this -> connection = new Connection();
	}

	function logIn($email, $password){
		$this -> connection -> open();
		$this -> connection -> run($this -> cajeroDAO -> logIn($email, $password));
		if($this -> connection -> numRows()==1){
			$result = $this -> connection -> fetchRow();
			$this -> idCajero = $result[0];
			$this -> nombre = $result[1];
			$this -> apellido = $result[2];
			$this -> correo = $result[3];
			$this -> clave = $result[4];
			$this -> foto = $result[5];
			$this -> salario = $result[6];
			$this -> telefono = $result[7];
			$this -> rol = $result[8];
			$this -> state = $result[9];
			$this -> connection -> close();
			return true;
		}else{
			$this -> connection -> close();
			return false;
		}
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cajeroDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cajeroDAO -> update());
		$this -> connection -> close();
	}

	function updateClave($password){
		$this -> connection -> open();
		$this -> connection -> run($this -> cajeroDAO -> updateClave($password));
		$this -> connection -> close();
	}

	function existEmail($email){
		$this -> connection -> open();
		$this -> connection -> run($this -> cajeroDAO -> existEmail($email));
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
		$this -> connection -> run($this -> cajeroDAO -> recoverPassword($email, $password));
		$this -> connection -> close();
	}

	function updateImage($attribute, $value){
		$this -> connection -> open();
		$this -> connection -> run($this -> cajeroDAO -> updateImage($attribute, $value));
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cajeroDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idCajero = $result[0];
		$this -> nombre = $result[1];
		$this -> apellido = $result[2];
		$this -> correo = $result[3];
		$this -> clave = $result[4];
		$this -> foto = $result[5];
		$this -> salario = $result[6];
		$this -> telefono = $result[7];
		$this -> rol = $result[8];
		$this -> state = $result[9];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cajeroDAO -> selectAll());
		$cajeros = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($cajeros, new Cajero($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]));
		}
		$this -> connection -> close();
		return $cajeros;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> cajeroDAO -> selectAllOrder($order, $dir));
		$cajeros = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($cajeros, new Cajero($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]));
		}
		$this -> connection -> close();
		return $cajeros;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> cajeroDAO -> search($search));
		$cajeros = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($cajeros, new Cajero($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]));
		}
		$this -> connection -> close();
		return $cajeros;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cajeroDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>

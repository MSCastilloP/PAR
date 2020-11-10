<?php
require_once ("persistence/DomiciliarioDAO.php");
require_once ("persistence/Connection.php");

class Domiciliario {
	private $idDomiciliario;
	private $nombre;
	private $apellido;
	private $correo;
	private $clave;
	private $foto;
	private $telefono;
	private $salario;
	private $rol;
	private $state;
	private $domiciliarioDAO;
	private $connection;

	function getIdDomiciliario() {
		return $this -> idDomiciliario;
	}

	function setIdDomiciliario($pIdDomiciliario) {
		$this -> idDomiciliario = $pIdDomiciliario;
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

	function getSalario() {
		return $this -> salario;
	}

	function setSalario($pSalario) {
		$this -> salario = $pSalario;
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

	function Domiciliario($pIdDomiciliario = "", $pNombre = "", $pApellido = "", $pCorreo = "", $pClave = "", $pFoto = "", $pTelefono = "", $pSalario = "", $pRol = "", $pState = ""){
		$this -> idDomiciliario = $pIdDomiciliario;
		$this -> nombre = $pNombre;
		$this -> apellido = $pApellido;
		$this -> correo = $pCorreo;
		$this -> clave = $pClave;
		$this -> foto = $pFoto;
		$this -> telefono = $pTelefono;
		$this -> salario = $pSalario;
		$this -> rol = $pRol;
		$this -> state = $pState;
		$this -> domiciliarioDAO = new DomiciliarioDAO($this -> idDomiciliario, $this -> nombre, $this -> apellido, $this -> correo, $this -> clave, $this -> foto, $this -> telefono, $this -> salario, $this -> rol, $this -> state);
		$this -> connection = new Connection();
	}

	function logIn($email, $password){
		$this -> connection -> open();
		$this -> connection -> run($this -> domiciliarioDAO -> logIn($email, $password));
		if($this -> connection -> numRows()==1){
			$result = $this -> connection -> fetchRow();
			$this -> idDomiciliario = $result[0];
			$this -> nombre = $result[1];
			$this -> apellido = $result[2];
			$this -> correo = $result[3];
			$this -> clave = $result[4];
			$this -> foto = $result[5];
			$this -> telefono = $result[6];
			$this -> salario = $result[7];
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
		$this -> connection -> run($this -> domiciliarioDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> domiciliarioDAO -> update());
		$this -> connection -> close();
	}

	function updateClave($password){
		$this -> connection -> open();
		$this -> connection -> run($this -> domiciliarioDAO -> updateClave($password));
		$this -> connection -> close();
	}

	function existEmail($email){
		$this -> connection -> open();
		$this -> connection -> run($this -> domiciliarioDAO -> existEmail($email));
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
		$this -> connection -> run($this -> domiciliarioDAO -> recoverPassword($email, $password));
		$this -> connection -> close();
	}

	function updateImage($attribute, $value){
		$this -> connection -> open();
		$this -> connection -> run($this -> domiciliarioDAO -> updateImage($attribute, $value));
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> domiciliarioDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idDomiciliario = $result[0];
		$this -> nombre = $result[1];
		$this -> apellido = $result[2];
		$this -> correo = $result[3];
		$this -> clave = $result[4];
		$this -> foto = $result[5];
		$this -> telefono = $result[6];
		$this -> salario = $result[7];
		$this -> rol = $result[8];
		$this -> state = $result[9];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> domiciliarioDAO -> selectAll());
		$domiciliarios = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($domiciliarios, new Domiciliario($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]));
		}
		$this -> connection -> close();
		return $domiciliarios;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> domiciliarioDAO -> selectAllOrder($order, $dir));
		$domiciliarios = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($domiciliarios, new Domiciliario($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]));
		}
		$this -> connection -> close();
		return $domiciliarios;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> domiciliarioDAO -> search($search));
		$domiciliarios = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($domiciliarios, new Domiciliario($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]));
		}
		$this -> connection -> close();
		return $domiciliarios;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> domiciliarioDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>

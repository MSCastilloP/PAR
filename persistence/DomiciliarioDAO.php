<?php
class DomiciliarioDAO{
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

	function DomiciliarioDAO($pIdDomiciliario = "", $pNombre = "", $pApellido = "", $pCorreo = "", $pClave = "", $pFoto = "", $pTelefono = "", $pSalario = "", $pRol = "", $pState = ""){
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
	}

	function logIn($correo, $clave){
		return "select idDomiciliario, nombre, apellido, correo, clave, foto, telefono, salario, rol, state
				from Domiciliario
				where correo = '" . $correo . "' and clave = '" . md5($clave) . "'";
	}

	function insert(){
		return "insert into Domiciliario(nombre, apellido, correo, clave, foto, telefono, salario, rol, state)
				values('" . $this -> nombre . "', '" . $this -> apellido . "', '" . $this -> correo . "', md5('" . $this -> clave . "'), '" . $this -> foto . "', '" . $this -> telefono . "', '" . $this -> salario . "', '" . $this -> rol . "', '" . $this -> state . "')";
	}

	function update(){
		return "update Domiciliario set 
				nombre = '" . $this -> nombre . "',
				apellido = '" . $this -> apellido . "',
				correo = '" . $this -> correo . "',
				telefono = '" . $this -> telefono . "',
				salario = '" . $this -> salario . "',
				rol = '" . $this -> rol . "',
				state = '" . $this -> state . "'	
				where idDomiciliario = '" . $this -> idDomiciliario . "'";
	}

	function updateClave($password){
		return "update Domiciliario set 
				clave = '" . md5($password) . "'
				where idDomiciliario = '" . $this -> idDomiciliario . "'";
	}

	function existEmail($email){
		return "select idDomiciliario, nombre, apellido, correo, clave, foto, telefono, salario, rol, state
				from Domiciliario
				where email = '" . $email . "'";
	}

	function recoverPassword($email, $password){
		return "update Domiciliario set 
				clave = '" . md5($password) . "'
				where correo = '" . $email . "'";
	}

	function updateImage($attribute, $value){
		return "update Domiciliario set "
				. $attribute . " = '" . $value . "'
				where idDomiciliario = '" . $this -> idDomiciliario . "'";
	}

	function select() {
		return "select idDomiciliario, nombre, apellido, correo, clave, foto, telefono, salario, rol, state
				from Domiciliario
				where idDomiciliario = '" . $this -> idDomiciliario . "'";
	}

	function selectAll() {
		return "select idDomiciliario, nombre, apellido, correo, clave, foto, telefono, salario, rol, state 
				from Domiciliario where state = 1 ";
	}

	function selectAllOrder($orden, $dir){
		return "select idDomiciliario, nombre, apellido, correo, clave, foto, telefono, salario, rol, state
				from Domiciliario where state = 1
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idDomiciliario, nombre, apellido, correo, clave, foto, telefono, salario, rol, state
				from Domiciliario
				where nombre like '%" . $search . "%' or apellido like '%" . $search . "%' or correo like '%" . $search . "%' or telefono like '%" . $search . "%' or salario like '%" . $search . "%' or rol like '%" . $search . "%' or state like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Domiciliario
				where idDomiciliario = '" . $this -> idDomiciliario . "'";
	}
}
?>

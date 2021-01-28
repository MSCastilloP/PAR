<?php
class ClienteDAO{
	private $idCliente;
	private $nombre;
	private $apellido;
	private $correo;
	private $clave;
	private $foto;
	private $telefono;
	private $direccion;


	function ClienteDAO($pIdCliente = "", $pNombre = "", $pApellido = "", $pCorreo = "", $pClave = "", $pFoto = "", $pTelefono = "", $pDireccion = ""){
		$this -> idCliente = $pIdCliente;
		$this -> nombre = $pNombre;
		$this -> apellido = $pApellido;
		$this -> correo = $pCorreo;
		$this -> clave = $pClave;
		$this -> foto = $pFoto;
		$this -> telefono = $pTelefono;
		$this -> direccion = $pDireccion;
		
	}

	function logIn($correo, $clave){
		return "select idCliente, nombre, apellido, correo, clave, foto, telefono, direccion
				from Cliente
				where correo = '" . $correo . "' and clave = '" . md5($clave) . "'";
	}

	function insert(){
		return "insert into Cliente(nombre, apellido, correo, clave, foto, telefono, direccion)
				values('" . $this -> nombre . "', '" . $this -> apellido . "', '" . $this -> correo . "', md5('" . $this -> clave . "'), '" . $this -> foto . "', '" . $this -> telefono . "', '" . $this -> direccion . "')";
	}

	function update(){
		return "update Cliente set 
				nombre = '" . $this -> nombre . "',
				apellido = '" . $this -> apellido . "',
				correo = '" . $this -> correo . "',
				telefono = '" . $this -> telefono . "',
				direccion = '" . $this -> direccion . "'
					
				where idCliente = '" . $this -> idCliente . "'";
	}

	function updateClave($password){
		return "update Cliente set 
				clave = '" . md5($password) . "'
				where idCliente = '" . $this -> idCliente . "'";
	}

	function existEmail($email){
		return "select idCliente, nombre, apellido, correo, clave, foto, telefono, direccion
				from Cliente
				where email = '" . $email . "'";
	}

	function recoverPassword($email, $password){
		return "update Cliente set 
				clave = '" . md5($password) . "'
				where correo = '" . $email . "'";
	}

	function updateImage($attribute, $value){
		return "update Cliente set "
				. $attribute . " = '" . $value . "'
				where idCliente = '" . $this -> idCliente . "'";
	}

	function select() {
		return "select idCliente, nombre, apellido, correo, clave, foto, telefono, direccion
				from Cliente
				where idCliente = '" . $this -> idCliente . "'";
	}

	function selectAll() {
		return "select idCliente, nombre, apellido, correo, clave, foto, telefono, direccion
				from Cliente";
	}

	function selectAllOrder($orden, $dir){
		return "select idCliente, nombre, apellido, correo, clave, foto, telefono, direccion
				from Cliente
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idCliente, nombre, apellido, correo, clave, foto, telefono, direccion
				from Cliente
				where nombre like '%" . $search . "%' or apellido like '%" . $search . "%' or correo like '%" . $search . "%' or telefono like '%" . $search . "%' or direccion like '%" . $search . "%' ";
	}

	function delete(){
		return "delete from Cliente
				where idCliente = '" . $this -> idCliente . "'";
	}
		function consultarCorreo(){
		return "select count(correo) from cliente where correo = '". $this -> correo."'";
	}
}
?>

<?php
class CajeroDAO{
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

	function CajeroDAO($pIdCajero = "", $pNombre = "", $pApellido = "", $pCorreo = "", $pClave = "", $pFoto = "", $pSalario = "", $pTelefono = "", $pRol = "", $pState = ""){
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
	}

	function logIn($correo, $clave){
		return "select idCajero, nombre, apellido, correo, clave, foto, salario, telefono, rol, state
				from Cajero
				where correo = '" . $correo . "' and clave = '" . md5($clave) . "'";
	}

	function insert(){
		return "insert into Cajero(nombre, apellido, correo, clave, foto, salario, telefono, rol, state)
				values('" . $this -> nombre . "', '" . $this -> apellido . "', '" . $this -> correo . "', md5('" . $this -> clave . "'), '" . $this -> foto . "', '" . $this -> salario . "', '" . $this -> telefono . "', '" . $this -> rol . "', '" . $this -> state . "')";
	}

	function update(){
		return "update Cajero set 
				nombre = '" . $this -> nombre . "',
				apellido = '" . $this -> apellido . "',
				correo = '" . $this -> correo . "',
				salario = '" . $this -> salario . "',
				telefono = '" . $this -> telefono . "',
				rol = '" . $this -> rol . "',
				state = '" . $this -> state . "'	
				where idCajero = '" . $this -> idCajero . "'";
	}

	function updateClave($password){
		return "update Cajero set 
				clave = '" . md5($password) . "'
				where idCajero = '" . $this -> idCajero . "'";
	}

	function existEmail($email){
		return "select idCajero, nombre, apellido, correo, clave, foto, salario, telefono, rol, state
				from Cajero
				where email = '" . $email . "'";
	}

	function recoverPassword($email, $password){
		return "update Cajero set 
				clave = '" . md5($password) . "'
				where correo = '" . $email . "'";
	}

	function updateImage($attribute, $value){
		return "update Cajero set "
				. $attribute . " = '" . $value . "'
				where idCajero = '" . $this -> idCajero . "'";
	}

	function select() {
		return "select idCajero, nombre, apellido, correo, clave, foto, salario, telefono, rol, state
				from Cajero
				where idCajero = '" . $this -> idCajero . "'";
	}

	function selectAll() {
		return "select idCajero, nombre, apellido, correo, clave, foto, salario, telefono, rol, state
				from Cajero";
	}

	function selectAllOrder($orden, $dir){
		return "select idCajero, nombre, apellido, correo, clave, foto, salario, telefono, rol, state
				from Cajero
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idCajero, nombre, apellido, correo, clave, foto, salario, telefono, rol, state
				from Cajero
				where nombre like '%" . $search . "%' or apellido like '%" . $search . "%' or correo like '%" . $search . "%' or salario like '%" . $search . "%' or telefono like '%" . $search . "%' or rol like '%" . $search . "%' or state like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Cajero
				where idCajero = '" . $this -> idCajero . "'";
	}
	function asistencia ($id,$nombre,$fecha){
		return " insert into asistencia(idEmpleado,nombre,fecha)  
		values(".$id.",'".$nombre."','".$fecha."' ) ";
	}
	function verificarAsist ($id, $fecha){
		return "select count(idEmpleado) from asistencia where idEmpleado = ".$id." and 
		fecha = '".$fecha."'";
	}
}
?>

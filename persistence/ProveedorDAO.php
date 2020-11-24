<?php
class ProveedorDAO{
	private $idProveedor;
	private $nombreEmpresa;
	private $telefono;
	private $descripcion;

	function ProveedorDAO($pIdProveedor = "", $pNombreEmpresa = "", $pTelefono = "", $pDescripcion = ""){
		$this -> idProveedor = $pIdProveedor;
		$this -> nombreEmpresa = $pNombreEmpresa;
		$this -> telefono = $pTelefono;
		$this -> descripcion = $pDescripcion;
	}

	function insert(){
		return "insert into Proveedor(nombreEmpresa, telefono, descripcion)
				values('" . $this -> nombreEmpresa . "', '" . $this -> telefono . "', '" . $this -> descripcion . "')";
	}

	function update(){
		return "update Proveedor set 
				nombreEmpresa = '" . $this -> nombreEmpresa . "',
				telefono = '" . $this -> telefono . "',
				descripcion = '" . $this -> descripcion . "'	
				where idProveedor = '" . $this -> idProveedor . "'";
	}

	function select() {
		return "select idProveedor, nombreEmpresa, telefono, descripcion
				from Proveedor
				where idProveedor = '" . $this -> idProveedor . "'";
	}

	function selectAll() {
		return "select idProveedor, nombreEmpresa, telefono, descripcion
				from Proveedor";
	}

	function selectAllOrder($orden, $dir){
		return "select idProveedor, nombreEmpresa, telefono, descripcion
				from Proveedor
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idProveedor, nombreEmpresa, telefono, descripcion
				from Proveedor
				where nombreEmpresa like '%" . $search . "%' or telefono like '%" . $search . "%' or descripcion like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Proveedor
				where idProveedor = '" . $this -> idProveedor . "'";
	}
}
?>

CREATE TABLE Administrador (
	idAdministrador int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	apellido varchar(45) NOT NULL,
	correo varchar(45) NOT NULL,
	clave varchar(45) NOT NULL,
	foto varchar(45) DEFAULT NULL,
	telefono varchar(45) DEFAULT NULL,
	celular varchar(45) DEFAULT NULL,
	estado tinyint DEFAULT NULL,
	PRIMARY KEY (idAdministrador)
);

INSERT INTO Administrador(idAdministrador, nombre, apellido, correo, clave, telefono, celular, estado) VALUES 
	('1', 'Admin', 'Admin', 'admin@udistrital.edu.co', md5('123'), '123', '123', '1'); 

CREATE TABLE LogAdministrador (
	idLogAdministrador int(11) NOT NULL AUTO_INCREMENT,
	accion varchar(45) NOT NULL,
	informacion text NOT NULL,
	fecha date NOT NULL,
	hora time NOT NULL,
	ip varchar(45) NOT NULL,
	so varchar(45) NOT NULL,
	explorador varchar(45) NOT NULL,
	administrador_idAdministrador int(11) NOT NULL,
	PRIMARY KEY (idLogAdministrador)
);

CREATE TABLE Inventario (
	idInventario int(11) NOT NULL AUTO_INCREMENT,
	fecha date NOT NULL,
	cantidadInicial int NOT NULL,
	unidades int NOT NULL,
	cantidadFinal int NOT NULL,
	ingrediente_idIngrediente int(11) NOT NULL,
	PRIMARY KEY (idInventario)
);

CREATE TABLE Ingrediente (
	idIngrediente int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	precio int NOT NULL,
	PRIMARY KEY (idIngrediente)
);

CREATE TABLE IngrePro (
	idIngrePro int(11) NOT NULL AUTO_INCREMENT,
	ingrediente_idIngrediente int(11) NOT NULL,
	producto_idProducto int(11) NOT NULL,
	PRIMARY KEY (idIngrePro)
);

CREATE TABLE Producto (
	idProducto int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(50) NOT NULL,
	precio int NOT NULL,
	descripcion varchar(200) NOT NULL,
	foto varchar(200) NOT NULL,
	PRIMARY KEY (idProducto)
);

CREATE TABLE ProDom (
	idProDom int(11) NOT NULL AUTO_INCREMENT,
	domicilio_idDomicilio int(11) NOT NULL,
	producto_idProducto int(11) NOT NULL,
	PRIMARY KEY (idProDom)
);

CREATE TABLE LogDomiciliario (
	idLogDomiciliario int(11) NOT NULL AUTO_INCREMENT,
	accion varchar(45) NOT NULL,
	informacion text NOT NULL,
	fecha date NOT NULL,
	hora time NOT NULL,
	ip varchar(45) NOT NULL,
	so varchar(45) NOT NULL,
	explorador varchar(45) NOT NULL,
	domiciliario_idDomiciliario int(11) NOT NULL,
	PRIMARY KEY (idLogDomiciliario)
);

CREATE TABLE Domiciliario (
	idDomiciliario int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	apellido varchar(45) NOT NULL,
	correo varchar(45) NOT NULL,
	clave varchar(45) NOT NULL,
	foto varchar(45) DEFAULT NULL,
	telefono varchar(50) NOT NULL,
	salario int NOT NULL,
	rol int NOT NULL,
	state tinyint NOT NULL,
	PRIMARY KEY (idDomiciliario)
);

CREATE TABLE LogCliente (
	idLogCliente int(11) NOT NULL AUTO_INCREMENT,
	accion varchar(45) NOT NULL,
	informacion text NOT NULL,
	fecha date NOT NULL,
	hora time NOT NULL,
	ip varchar(45) NOT NULL,
	so varchar(45) NOT NULL,
	explorador varchar(45) NOT NULL,
	cliente_idCliente int(11) NOT NULL,
	PRIMARY KEY (idLogCliente)
);

CREATE TABLE Cliente (
	idCliente int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	apellido varchar(45) NOT NULL,
	correo varchar(45) NOT NULL,
	clave varchar(45) NOT NULL,
	foto varchar(45) DEFAULT NULL,
	telefono varchar(50) NOT NULL,
	direccion varchar(200) NOT NULL,
	state tinyint NOT NULL,
	PRIMARY KEY (idCliente)
);

CREATE TABLE Domicilio (
	idDomicilio int(11) NOT NULL AUTO_INCREMENT,
	direccion varchar(200) NOT NULL,
	fecha date NOT NULL,
	hora date NOT NULL,
	precio int NOT NULL,
	descripcion varchar(400) NOT NULL,
	cocinando int NOT NULL,
	domiciliario_idDomiciliario int(11) NOT NULL,
	cliente_idCliente int(11) NOT NULL,
	PRIMARY KEY (idDomicilio)
);

CREATE TABLE LogCajero (
	idLogCajero int(11) NOT NULL AUTO_INCREMENT,
	accion varchar(45) NOT NULL,
	informacion text NOT NULL,
	fecha date NOT NULL,
	hora time NOT NULL,
	ip varchar(45) NOT NULL,
	so varchar(45) NOT NULL,
	explorador varchar(45) NOT NULL,
	cajero_idCajero int(11) NOT NULL,
	PRIMARY KEY (idLogCajero)
);

CREATE TABLE Cajero (
	idCajero int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	apellido varchar(45) NOT NULL,
	correo varchar(45) NOT NULL,
	clave varchar(45) NOT NULL,
	foto varchar(45) DEFAULT NULL,
	salario varchar(50) NOT NULL,
	telefono varchar(50) NOT NULL,
	rol int NOT NULL,
	state tinyint NOT NULL,
	PRIMARY KEY (idCajero)
);

CREATE TABLE Pedido (
	idPedido int(11) NOT NULL AUTO_INCREMENT,
	fecha date NOT NULL,
	hora date NOT NULL,
	descripcion varchar(200) NOT NULL,
	precio int NOT NULL,
	cocinando int NOT NULL,
	cajero_idCajero int(11) NOT NULL,
	PRIMARY KEY (idPedido)
);

CREATE TABLE PedidoPro (
	idPedidoPro int(11) NOT NULL AUTO_INCREMENT,
	pedido_idPedido int(11) NOT NULL,
	producto_idProducto int(11) NOT NULL,
	PRIMARY KEY (idPedidoPro)
);

CREATE TABLE Cocinero (
	idCocinero int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(50) NOT NULL,
	apellido varchar(50) NOT NULL,
	telefono varchar(50) NOT NULL,
	salario varchar(50) NOT NULL,
	PRIMARY KEY (idCocinero)
);

ALTER TABLE LogAdministrador
 	ADD FOREIGN KEY (administrador_idAdministrador) REFERENCES Administrador (idAdministrador); 

ALTER TABLE Inventario
 	ADD FOREIGN KEY (ingrediente_idIngrediente) REFERENCES Ingrediente (idIngrediente); 

ALTER TABLE IngrePro
 	ADD FOREIGN KEY (ingrediente_idIngrediente) REFERENCES Ingrediente (idIngrediente); 

ALTER TABLE IngrePro
 	ADD FOREIGN KEY (producto_idProducto) REFERENCES Producto (idProducto); 

ALTER TABLE ProDom
 	ADD FOREIGN KEY (domicilio_idDomicilio) REFERENCES Domicilio (idDomicilio); 

ALTER TABLE ProDom
 	ADD FOREIGN KEY (producto_idProducto) REFERENCES Producto (idProducto); 

ALTER TABLE LogDomiciliario
 	ADD FOREIGN KEY (domiciliario_idDomiciliario) REFERENCES Domiciliario (idDomiciliario); 

ALTER TABLE LogCliente
 	ADD FOREIGN KEY (cliente_idCliente) REFERENCES Cliente (idCliente); 

ALTER TABLE Domicilio
 	ADD FOREIGN KEY (domiciliario_idDomiciliario) REFERENCES Domiciliario (idDomiciliario); 

ALTER TABLE Domicilio
 	ADD FOREIGN KEY (cliente_idCliente) REFERENCES Cliente (idCliente); 

ALTER TABLE LogCajero
 	ADD FOREIGN KEY (cajero_idCajero) REFERENCES Cajero (idCajero); 

ALTER TABLE Pedido
 	ADD FOREIGN KEY (cajero_idCajero) REFERENCES Cajero (idCajero); 

ALTER TABLE PedidoPro
 	ADD FOREIGN KEY (pedido_idPedido) REFERENCES Pedido (idPedido); 

ALTER TABLE PedidoPro
 	ADD FOREIGN KEY (producto_idProducto) REFERENCES Producto (idProducto); 


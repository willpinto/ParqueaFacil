<?php
require_once '../modelo/conexion.php';
$data = array();
$pdo = Conexion::Conectar();
try {
	$sql = "DROP TABLE IF EXISTS administrador;
		CREATE TABLE administrador(documento INT PRIMARY KEY, nombres VARCHAR(50) NOT NULL, cargo VARCHAR(30) NOT NULL, contrasena VARCHAR(50) NOT NULL);
	DROP TABLE IF EXISTS vigilante;
		CREATE TABLE vigilante(documento INT PRIMARY KEY, nombres VARCHAR(50) NOT NULL, turno VARCHAR(10) NOT NULL, rol VARCHAR(25) NOT NULL, contrasena VARCHAR(50) NOT NULL, documento_adm INT NOT NULL, FOREIGN KEY(documento_adm) REFERENCES ADMINISTRADOR(documento));
	DROP TABLE IF EXISTS propietario_vehiculo;
		CREATE TABLE propietario_vehiculo(documento INT PRIMARY KEY, nombres VARCHAR(50) NOT NULL, apellidos VARCHAR(50) NOT NULL, direccion VARCHAR(150) NOT NULL, telefono VARCHAR(25) NULL, correo VARCHAR(50) NULL, fecha_nacimiento DATETIME NOT NULL, genero CHAR NOT NULL, tipo_licencia VARCHAR(2) NOT NULL, numero_licencia VARCHAR(20) NOT NULL);
	DROP TABLE IF EXISTS vehiculo;
		CREATE TABLE vehiculo(placa VARCHAR(7) PRIMARY KEY, tipo VARCHAR(20) NOT NULL, marca VARCHAR(25) NOT NULL, linea VARCHAR(20) NOT NULL, modelo SMALLINT NOT NULL, servicio VARCHAR(20) NOT NULL, cilindraje TINYINT NOT NULL, chasis VARCHAR(20) NULL, motor VARCHAR(20) NULL, color VARCHAR(25) NOT NULL, tipo_carroceria VARCHAR(20) NULL, documento_pro_veh INT NOT NULL, FOREIGN KEY(documento_pro_veh) REFERENCES PROPIETARIO_VEHICULO(documento));
	DROP TABLE IF EXISTS registro;
		CREATE TABLE registro(numero_ticket INT AUTO_INCREMENT PRIMARY KEY, fecha_ingreso DATETIME NOT NULL, fecha_salida DATETIME NOT NULL, estado BIT NOT NULL, placa_veh VARCHAR(7) NOT NULL, documento_vig INT NOT NULL, FOREIGN KEY(placa_veh) REFERENCES VEHICULO(placa), FOREIGN KEY(documento_vig) REFERENCES VIGILANTE(documento));
	DROP TABLE IF EXISTS noverdad_vehiculo;
		CREATE TABLE novedad_vehiculo(id INT AUTO_INCREMENT PRIMARY KEY, tipo VARCHAR(25) NOT NULL, descripcion TEXT NULL, numero_ticket_reg INT NOT NULL, FOREIGN KEY(numero_ticket_reg) REFERENCES REGISTRO(numero_ticket));";
	$comando = $pdo->exec($sql);
	$data['status'] = 'ok';
} catch (PDOException $e) {
	//  echo $sql . "<br>" . $e->getMessage();
	$data['status'] = 'err';
}

echo json_encode($data);

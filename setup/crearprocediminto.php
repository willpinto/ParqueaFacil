<?php

require_once '../modelo/conexion.php';
$data = array();
$pdo = Conexion::Conectar();
try {
	$sql = " 
		DROP PROCEDURE IF EXISTS `actualizaradministrador`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizaradministrador` (IN `cedula` INT, IN `nombres` VARCHAR(250), IN `cargo` VARCHAR(50), IN `contrasena` VARCHAR(50))  NO SQL
		UPDATE administrador SET nombres = nombres, cargo = cargo, contrasena = contrasena WHERE documento = cedula;

		DROP PROCEDURE IF EXISTS `actualizarpropietario`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarpropietario` (IN `cedula` INT(10), IN `nombres` VARCHAR(100), IN `apellidos` VARCHAR(100), IN `direccion` VARCHAR(250), IN `telefono` VARCHAR(20), IN `correo` VARCHAR(100), IN `fnacimiento` DATE, IN `genero` CHAR(1), IN `tlicencia` VARCHAR(3), IN `nlicencia` VARCHAR(20))  NO SQL
		UPDATE propietario_vehiculo SET nombres = nombres, apellidos = apellidos, direccion = direccion, telefono = telefono, correo = correo, fecha_nacimiento = fnacimiento, genero = genero, tipo_licencia = tlicencia, numero_licencia = nlicencia WHERE documento = cedula;

		DROP PROCEDURE IF EXISTS `actualizarregistro`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarregistro` (IN `id` INT(10), IN `fingreso` DATETIME, IN `fsalida` DATETIME, IN `estado` BOOLEAN, IN `placaveh` VARCHAR(7), IN `documentovig` INT(10))  NO SQL
		UPDATE registro SET fecha_ingreso = fingreso, fecha_salida = fsalida, estado = estado, placa_veh = placaveh, documento_vig = documentovig WHERE numero_ticket = id;

		DROP PROCEDURE IF EXISTS `actualizarvehiculo`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarvehiculo` (IN `id` VARCHAR(7), IN `tipo` VARCHAR(10), IN `marca` VARCHAR(50), IN `linea` VARCHAR(50), IN `modelo` INT(4), IN `servicio` VARCHAR(20), IN `cilindraje` INT(6), IN `chasis` VARCHAR(20), IN `motor` VARCHAR(20), IN `color` VARCHAR(30), IN `tcarroceria` VARCHAR(30), IN `documentopro` INT(10))  NO SQL
		UPDATE vehiculo SET tipo = tipo, marca = marca, linea = linea, modelo = modelo, servicio = servicio, cilindraje = cilindraje, chasis = chasis, motor = motor, color = color, tipo_carroceria = tcarroceria, documento_pro_veh = documentopro WHERE placa = id;

		DROP PROCEDURE IF EXISTS `actualizarvigilante`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarvigilante` (IN `cedula` INT, IN `nombres` VARCHAR(50), IN `turno` VARCHAR(10), IN `rol` VARCHAR(25), IN `contrasena` VARCHAR(50), IN `documentoadm` INT)  NO SQL
		UPDATE vigilante SET nombres = nombres, turno = turno, rol = rol, contrasena = contrasena WHERE documento = cedula;

		DROP PROCEDURE IF EXISTS `consultaradministrador`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaradministrador` (IN `id` INT)  NO SQL
		SELECT * FROM administrador WHERE documento = id;

		DROP PROCEDURE IF EXISTS `consultarloginadministrador`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarloginadministrador` (IN `cedula` INT(10), IN `pass` VARCHAR(25))  NO SQL
		SELECT * FROM administrador WHERE documento = cedula AND contrasena = pass;

		DROP PROCEDURE IF EXISTS `consultarloginvigilante`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarloginvigilante` (IN `cedula` INT(10), IN `pass` VARCHAR(25))  NO SQL
		SELECT * FROM vigilante WHERE documento = cedula AND contrasena = pass;

		DROP PROCEDURE IF EXISTS `consultarnumerovehiculosportipo`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarnumerovehiculosportipo` (IN `tipoveh` VARCHAR(10))  NO SQL
		SELECT * FROM vehiculo WHERE tipo = tipoveh;

		DROP PROCEDURE IF EXISTS `consultarpropietario`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarpropietario` (IN `cedula` INT(10))  NO SQL
		SELECT * FROM propietario_vehiculo WHERE documento = cedula;

		DROP PROCEDURE IF EXISTS `consultarregistro`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarregistro` (IN `id` INT(10))  NO SQL
		SELECT * FROM registro WHERE numero_ticket = id;

		DROP PROCEDURE IF EXISTS `consultarregistroactivo`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarregistroactivo` (IN `cedula` INT(10), IN `placa` VARCHAR(7))  NO SQL
		SELECT r.numero_ticket, pv.documento, pv.nombres, pv.apellidos, v.placa, v.tipo, v.marca, v.linea FROM registro r INNER JOIN vehiculo v ON r.placa_veh = v.placa INNER JOIN propietario_vehiculo pv ON v.documento_pro_veh = pv.documento WHERE pv.documento = cedula AND r.placa_veh = placa AND r.estado = 1;

		DROP PROCEDURE IF EXISTS `consultarregistroactivoporplaca`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarregistroactivoporplaca` (IN `placa` VARCHAR(7))  NO SQL
		SELECT * FROM registro WHERE placa_veh = placa AND estado = 1 ORDER BY numero_ticket DESC LIMIT 1;

		DROP PROCEDURE IF EXISTS `consultarvehiculo`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarvehiculo` (IN `id` VARCHAR(7))  NO SQL
		SELECT * FROM vehiculo WHERE placa = id;

		DROP PROCEDURE IF EXISTS `consultarvehiculoporplacadocumento`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarvehiculoporplacadocumento` (IN `placa` VARCHAR(7), IN `documento` INT)  NO SQL
		SELECT * FROM vehiculo WHERE placa = placa AND documento_pro_veh = documento;

		DROP PROCEDURE IF EXISTS `consultarvehiculosegresadosentrefechas`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarvehiculosegresadosentrefechas` (IN `finicio` DATE, IN `ffinal` DATE)  NO SQL
		SELECT v.* FROM vehiculo v INNER JOIN registro r ON v.placa = r.placa_veh WHERE r.fecha_salida BETWEEN finicio AND ffinal;

		DROP PROCEDURE IF EXISTS `consultarvehiculosingresadosentrefechas`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarvehiculosingresadosentrefechas` (IN `finicio` DATE, IN `ffinal` DATE)  NO SQL
		SELECT v.* FROM vehiculo v INNER JOIN registro r ON v.placa = r.placa_veh WHERE r.fecha_ingreso BETWEEN finicio AND ffinal;

		DROP PROCEDURE IF EXISTS `consultarvehiculosporpropietario`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarvehiculosporpropietario` (IN `documento` INT)  NO SQL
		SELECT * FROM vehiculo WHERE documento_pro_veh = documento;

		DROP PROCEDURE IF EXISTS `consultarvigilante`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarvigilante` (IN `id` INT)  NO SQL
		SELECT * FROM vigilante WHERE documento = id;

		DROP PROCEDURE IF EXISTS `eliminaradministrador`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminaradministrador` (IN `cedula` INT)  NO SQL
		DELETE FROM administrador WHERE documento = cedula;

		DROP PROCEDURE IF EXISTS `eliminarpropietario`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarpropietario` (IN `cedula` INT(10))  NO SQL
		DELETE FROM propietario_vehiculo WHERE documento = cedula;

		DROP PROCEDURE IF EXISTS `eliminarregistro`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarregistro` (IN `id` INT(10))  NO SQL
		DELETE FROM registro WHERE numero_ticket = id;

		DROP PROCEDURE IF EXISTS `eliminarvehiculo`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarvehiculo` (IN `id` VARCHAR(7))  NO SQL
		DELETE FROM vehiculo WHERE placa = id;

		DROP PROCEDURE IF EXISTS `eliminarvigilante`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarvigilante` (IN `cedula` INT)  NO SQL
		DELETE FROM vigilante WHERE documento = cedula;

		DROP PROCEDURE IF EXISTS `listaradministradores`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `listaradministradores` ()  NO SQL
		SELECT * FROM administrador;

		DROP PROCEDURE IF EXISTS `listarpropietarios`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `listarpropietarios` ()  NO SQL
		SELECT * FROM propietario_vehiculo;

		DROP PROCEDURE IF EXISTS `listarregistros`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `listarregistros` ()  NO SQL
		SELECT * FROM registro;

		DROP PROCEDURE IF EXISTS `listarvehiculos`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `listarvehiculos` ()  NO SQL
		SELECT * FROM vehiculo;

		DROP PROCEDURE IF EXISTS `listarvigilantes`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `listarvigilantes` ()  NO SQL
		SELECT * FROM vigilante;

		DROP PROCEDURE IF EXISTS `obteneridregistroactivoporplaca`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `obteneridregistroactivoporplaca` (IN `placa` VARCHAR(7))  NO SQL
		SELECT numero_ticket FROM registro WHERE placa_veh = placa AND estado = 1 ORDER BY numero_ticket DESC LIMIT 1;

		DROP PROCEDURE IF EXISTS `registraradministrador`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `registraradministrador` (IN `cedula` INT, IN `nombres` VARCHAR(250), IN `cargo` VARCHAR(50), IN `contrasena` VARCHAR(50))  NO SQL
		INSERT INTO administrador VALUES(cedula, nombres, cargo, contrasena);

		DROP PROCEDURE IF EXISTS `registrarpropietario`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarpropietario` (IN `documento` INT(10), IN `nombres` VARCHAR(100), IN `apellidos` VARCHAR(100), IN `direccion` VARCHAR(250), IN `telefono` VARCHAR(20), IN `correo` VARCHAR(100), IN `fnacimiento` DATE, IN `genero` CHAR(1), IN `tlicencia` VARCHAR(3), IN `nlicencia` VARCHAR(20))  NO SQL
		INSERT INTO propietario_vehiculo VALUES(documento, nombres, apellidos, direccion, telefono, correo, fnacimiento, genero, tlicencia, nlicencia);

		DROP PROCEDURE IF EXISTS `registrarregistro`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarregistro` (IN `fingreso` DATETIME, IN `fsalida` DATETIME, IN `estado` BOOLEAN, IN `placaveh` VARCHAR(7), IN `documentovig` INT(10))  NO SQL
		INSERT INTO registro VALUES(null, fingreso, fsalida, estado, placaveh, documentovig);

		DROP PROCEDURE IF EXISTS `registrarvehiculo`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarvehiculo` (IN `placa` VARCHAR(7), IN `tipo` VARCHAR(10), IN `marca` VARCHAR(50), IN `linea` VARCHAR(50), IN `modelo` INT(4), IN `servicio` VARCHAR(20), IN `cilindraje` INT(6), IN `chasis` VARCHAR(20), IN `motor` VARCHAR(20), IN `color` VARCHAR(30), IN `tcarroceria` VARCHAR(30), IN `documentopro` INT(10))  NO SQL
		INSERT INTO vehiculo VALUES(placa, tipo, marca, linea, modelo, servicio, cilindraje, chasis, motor, color, tcarroceria, documentopro);

		DROP PROCEDURE IF EXISTS `registrarvigilante`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarvigilante` (IN `cedula` INT, IN `nombres` VARCHAR(50), IN `turno` VARCHAR(10), IN `rol` VARCHAR(25), IN `contrasena` VARCHAR(50), IN `documentoadm` INT)  NO SQL
		INSERT INTO vigilante VALUES(cedula, nombres, turno, rol, contrasena, documentoadm);";

	$comando = $pdo->exec($sql);
	$data['status'] = 'ok';
} catch (PDOException $e) {
	$data['status'] = 'err';
}

echo json_encode($data);

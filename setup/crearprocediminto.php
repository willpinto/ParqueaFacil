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
		CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarpropietario` (IN `cedula` INT(10), IN `tdocumento` VARCHAR(2), IN `nombres` VARCHAR(100), IN `apellidos` VARCHAR(100), IN `direccion` VARCHAR(250), IN `telefono` VARCHAR(20), IN `correo` VARCHAR(100), IN `fnacimiento` DATE, IN `genero` CHAR(1), IN `tlicencia` VARCHAR(3), IN `nlicencia` VARCHAR(20))  NO SQL
		UPDATE conductor SET tipo_documento = tdocumento, nombres = nombres, apellidos = apellidos, direccion = direccion, telefono = telefono, correo = correo, fecha_nacimiento = fnacimiento, genero = genero, tipo_licencia = tlicencia, numero_licencia = nlicencia WHERE documento = cedula;
		
		DROP PROCEDURE IF EXISTS `actualizarregistro`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarregistro` (IN `id` INT(10), IN `fingreso` DATETIME, IN `fsalida` DATETIME, IN `estado` BOOLEAN, IN `placaveh` VARCHAR(7), IN `documentovig` INT(10))  NO SQL
		UPDATE registro SET fecha_ingreso = fingreso, fecha_salida = fsalida, estado = estado, id_cond_veh = placaveh, documento_vig = documentovig WHERE numero_ticket = id;
		
		DROP PROCEDURE IF EXISTS `actualizarvehiculo`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarvehiculo` (IN `id` VARCHAR(7), IN `tipo` VARCHAR(10), IN `marca` VARCHAR(50), IN `linea` VARCHAR(50), IN `modelo` INT(4), IN `servicio` VARCHAR(20), IN `cilindraje` INT(6), IN `chasis` VARCHAR(20), IN `motor` VARCHAR(20), IN `color` VARCHAR(30), IN `tcarroceria` VARCHAR(30))  NO SQL
		UPDATE vehiculo SET tipo = tipo, marca = marca, linea = linea, modelo = modelo, servicio = servicio, cilindraje = cilindraje, chasis = chasis, motor = motor, color = color, tipo_carroceria = tcarroceria WHERE placa = id;
		
		DROP PROCEDURE IF EXISTS `actualizarvigilante`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarvigilante` (IN `cedula` INT, IN `nombres` VARCHAR(50), IN `turno` VARCHAR(10), IN `rol` VARCHAR(25), IN `contrasena` VARCHAR(50), IN `documentoadm` INT)  NO SQL
		UPDATE vigilante SET nombres = nombres, turno = turno, rol = rol, contrasena = contrasena WHERE documento = cedula;
		
		DROP PROCEDURE IF EXISTS `asociarconductorvehiculo`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `asociarconductorvehiculo` (IN `documento` INT(10), IN `placa` VARCHAR(7))  NO SQL
		INSERT INTO conductor_vehiculo VALUES(null, documento, placa);
		
		DROP PROCEDURE IF EXISTS `cargarnovedadespornumeroticket`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `cargarnovedadespornumeroticket` (IN `id` INT)  NO SQL
		SELECT n.tipo, n.descripcion FROM novedad_vehiculo n INNER JOIN registro r ON r.numero_ticket = n.numero_ticket_reg WHERE n.numero_ticket_reg = id AND r.estado = 1;
		
		DROP PROCEDURE IF EXISTS `cargarnovedadesporregistro`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `cargarnovedadesporregistro` (IN `id` INT)  NO SQL
		SELECT * FROM novedad_vehiculo WHERE numero_ticket_reg = id;

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

		DROP PROCEDURE IF EXISTS `consultarplacasactivas`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarplacasactivas` ()  NO SQL
		SELECT r.numero_ticket idRegistro, cv.placa_veh placa FROM registro r INNER JOIN conductor_vehiculo cv ON r.id_cond_veh = cv.id WHERE r.estado = 1;

		DROP PROCEDURE IF EXISTS `consultarpropietario`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarpropietario` (IN `cedula` INT(10))  NO SQL
		SELECT * FROM conductor WHERE documento = cedula;

		DROP PROCEDURE IF EXISTS `consultarregistro`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarregistro` (IN `id` INT(10))  NO SQL
		SELECT * FROM registro WHERE numero_ticket = id;

		DROP PROCEDURE IF EXISTS `consultarregistroactivo`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarregistroactivo` (IN `cedula` INT(10), IN `placa` VARCHAR(7))  NO SQL
		SELECT r.numero_ticket, c.documento, c.nombres, c.apellidos, v.placa, v.tipo, v.marca, v.linea FROM registro r INNER JOIN conductor_vehiculo cv ON r.id_cond_veh = cv.id INNER JOIN vehiculo v ON cv.placa_veh = v.placa INNER JOIN conductor c ON cv.documento_cond = c.documento WHERE cv.documento_cond = cedula AND cv.placa_veh = placa AND r.estado = 1 ORDER BY r.numero_ticket DESC LIMIT 1;

		DROP PROCEDURE IF EXISTS `consultarregistroactivoporplaca`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarregistroactivoporplaca` (IN `placa` VARCHAR(7))  NO SQL
		SELECT r.* FROM registro r INNER JOIN conductor_vehiculo cv ON r.id_cond_veh = cv.id WHERE cv.placa_veh = placa AND r.estado = 1 ORDER BY r.numero_ticket DESC LIMIT 1;

		DROP PROCEDURE IF EXISTS `consultarregistroactivoporticket`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarregistroactivoporticket` (IN `numero` INT(10))  NO SQL
		SELECT r.* FROM registro r INNER JOIN conductor_vehiculo cv ON r.id_cond_veh = cv.id WHERE r.numero_ticket = numero AND r.estado = 1 ORDER BY r.numero_ticket DESC LIMIT 1;

		DROP PROCEDURE IF EXISTS `consultarvehiculo`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarvehiculo` (IN `id` VARCHAR(7))  NO SQL
		SELECT * FROM vehiculo WHERE placa = id;

		DROP PROCEDURE IF EXISTS `consultarvehiculoporplacadocumento`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarvehiculoporplacadocumento` (IN `placa` VARCHAR(7), IN `documento` INT)  NO SQL
		SELECT v.* FROM vehiculo v INNER JOIN conductor_vehiculo cv ON cv.placa_veh = v.placa WHERE v.placa = placa AND cv.documento_cond = documento;

		DROP PROCEDURE IF EXISTS `consultarvehiculosegresadosentrefechas`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarvehiculosegresadosentrefechas` (IN `finicio` DATE, IN `ffinal` DATE)  NO SQL
		SELECT cv.documento_cond conductor, v.placa, v.tipo, v.marca, v.linea, v.modelo, r.numero_ticket id_registro, r.fecha_salida FROM vehiculo v INNER JOIN conductor_vehiculo cv ON cv.placa_veh = v.placa INNER JOIN registro r ON cv.id = r.id_cond_veh WHERE r.fecha_salida BETWEEN finicio AND DATE_ADD(ffinal, INTERVAL 1 DAY);

		DROP PROCEDURE IF EXISTS `consultarvehiculosingresadosentrefechas`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarvehiculosingresadosentrefechas` (IN `finicio` DATE, IN `ffinal` DATE)  NO SQL
		SELECT cv.documento_cond conductor, v.placa, v.tipo, v.marca, v.linea, v.modelo, r.numero_ticket id_registro, r.fecha_ingreso FROM vehiculo v INNER JOIN conductor_vehiculo cv ON cv.placa_veh = v.placa INNER JOIN registro r ON cv.id = r.id_cond_veh WHERE r.fecha_ingreso BETWEEN finicio AND  DATE_ADD(ffinal, INTERVAL 1 DAY);

		DROP PROCEDURE IF EXISTS `consultarvehiculosporpropietario`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarvehiculosporpropietario` (IN `documento` INT)  NO SQL
		SELECT v.* FROM vehiculo v INNER JOIN conductor_vehiculo cv ON cv.placa_veh = v.placa WHERE cv.documento_cond = documento;

		DROP PROCEDURE IF EXISTS `consultarvigilante`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarvigilante` (IN `id` INT)  NO SQL
		SELECT * FROM vigilante WHERE documento = id;

		DROP PROCEDURE IF EXISTS `eliminaradministrador`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminaradministrador` (IN `cedula` INT)  NO SQL
		DELETE FROM administrador WHERE documento = cedula;

		DROP PROCEDURE IF EXISTS `eliminarpropietario`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarpropietario` (IN `cedula` INT(10))  NO SQL
		DELETE FROM conductor WHERE documento = cedula;

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
		SELECT * FROM conductor;

		DROP PROCEDURE IF EXISTS `listarregistros`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `listarregistros` ()  NO SQL
		SELECT * FROM registro;

		DROP PROCEDURE IF EXISTS `listarvehiculos`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `listarvehiculos` ()  NO SQL
		SELECT * FROM vehiculo;

		DROP PROCEDURE IF EXISTS `listarvigilantes`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `listarvigilantes` ()  NO SQL
		SELECT * FROM vigilante;

		DROP PROCEDURE IF EXISTS `obtenerDatosConductorCheckOut`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerDatosConductorCheckOut` (IN `id` INT(10))  NO SQL
		SELECT c.documento, c.nombres, c.apellidos, v.placa FROM registro r INNER JOIN conductor_vehiculo cv ON r.id_cond_veh = cv.id INNER JOIN conductor c ON cv.documento_cond = c.documento INNER JOIN vehiculo v ON cv.placa_veh = v.placa WHERE r.numero_ticket = id ORDER BY id DESC LIMIT 1;

		DROP PROCEDURE IF EXISTS `obteneridasociadoconductorvehiculo`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `obteneridasociadoconductorvehiculo` (IN `documento` INT(10), IN `placa` VARCHAR(7))  NO SQL
		SELECT id FROM conductor_vehiculo WHERE documento_cond = documento AND placa_veh = placa ORDER BY id DESC LIMIT 1;

		DROP PROCEDURE IF EXISTS `obteneridregistroactivoporplaca`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `obteneridregistroactivoporplaca` (IN `placa` VARCHAR(7))  NO SQL
		SELECT r.numero_ticket FROM registro r INNER JOIN conductor_vehiculo cv ON r.id_cond_veh = cv.id WHERE cv.placa_veh = placa AND r.estado = 1 ORDER BY r.numero_ticket DESC LIMIT 1;

		DROP PROCEDURE IF EXISTS `registraradministrador`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `registraradministrador` (IN `cedula` INT, IN `nombres` VARCHAR(250), IN `cargo` VARCHAR(50), IN `contrasena` VARCHAR(50))  NO SQL
		INSERT INTO administrador VALUES(cedula, nombres, cargo, contrasena);

		DROP PROCEDURE IF EXISTS `registrarnovedad`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarnovedad` (IN `tipo` VARCHAR(25), IN `descripcion` TEXT, IN `ticket` INT(11))  NO SQL
		INSERT INTO novedad_vehiculo VALUES(null, tipo, descripcion, ticket);

		DROP PROCEDURE IF EXISTS `registrarpropietario`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarpropietario` (IN `documento` INT(10), IN `tdocumento` VARCHAR(2), IN `nombres` VARCHAR(100), IN `apellidos` VARCHAR(100), IN `direccion` VARCHAR(250), IN `telefono` VARCHAR(20), IN `correo` VARCHAR(100), IN `fnacimiento` DATE, IN `genero` CHAR(1), IN `tlicencia` VARCHAR(3), IN `nlicencia` VARCHAR(20))  NO SQL
		INSERT INTO conductor VALUES(documento, tdocumento, nombres, apellidos, direccion, telefono, correo, fnacimiento, genero, tlicencia, nlicencia);

		DROP PROCEDURE IF EXISTS `registrarregistro`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarregistro` (IN `fingreso` DATETIME, IN `fsalida` DATETIME, IN `estado` BOOLEAN, IN `placaveh` VARCHAR(7), IN `documentovig` INT(10))  NO SQL
		INSERT INTO registro VALUES(null, fingreso, fsalida, estado, placaveh, documentovig);

		DROP PROCEDURE IF EXISTS `registrarvehiculo`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarvehiculo` (IN `placa` VARCHAR(7), IN `tipo` VARCHAR(10), IN `marca` VARCHAR(50), IN `linea` VARCHAR(50), IN `modelo` INT(4), IN `servicio` VARCHAR(20), IN `cilindraje` INT(6), IN `chasis` VARCHAR(20), IN `motor` VARCHAR(20), IN `color` VARCHAR(30), IN `tcarroceria` VARCHAR(30))  NO SQL
		INSERT INTO vehiculo VALUES(placa, tipo, marca, linea, modelo, servicio, cilindraje, chasis, motor, color, tcarroceria);

		DROP PROCEDURE IF EXISTS `registrarvigilante`;
		CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarvigilante` (IN `cedula` INT, IN `nombres` VARCHAR(50), IN `turno` VARCHAR(10), IN `rol` VARCHAR(25), IN `contrasena` VARCHAR(50), IN `documentoadm` INT)  NO SQL
		INSERT INTO vigilante VALUES(cedula, nombres, turno, rol, contrasena, documentoadm);";
	$comando = $pdo->exec($sql);
	$data['status'] = 'ok';
} catch (PDOException $e) {
	$data['status'] = 'err';
}

echo json_encode($data);

<?php
$datosConexion = "";
require($datosConexion . '../modelo/conexion.php');
$datos_Conexion = implode('', file($datosConexion . "../modelo/conexion.php"));
$server = $_POST['servidor'];
$bd = $_POST['bd'];
$user = $_POST['usuario'];
$password = $_POST['password'];
$data = array();

try {
	$pdo = new PDO("mysql:host=$server;dbname=$bd", $user, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$validar = true;
} catch (PDOException $e) {
	$validar = false;
	$data['status'] = 'err';
}

if ($validar == true) {
	$datos_Conexion = str_replace("\$servidor = '$servidor'", "\$servidor = '$_POST[servidor]'", $datos_Conexion);
	$datos_Conexion = str_replace("\$usuario = '$usuario'", "\$usuario = '$_POST[usuario]'", $datos_Conexion);
	$datos_Conexion = str_replace("\$contrasena = '$contrasena'", "\$contrasena = '$_POST[password]'", $datos_Conexion);
	$datos_Conexion = str_replace("\$basedatos = '$basedatos'", "\$basedatos = '$_POST[bd]'", $datos_Conexion);
	$fp = fopen($datosConexion . "../modelo/conexion.php", "w+");
	fwrite($fp, $datos_Conexion);
	fclose($fp);
	//echo "datos gurdados";
	$data['status'] = 'ok';
}
echo json_encode($data);

<?php
$servidor = 'localhost';
$usuario = 'root';
$contrasena = '';
$basedatos = 'parqueafaciltest';

class conexion
{

    public static function conectar()
    {
        $servidor = 'localhost';
        $usuario = 'root';
        $contrasena = '';
        $basedatos = 'parqueafaciltest';
        $sql = "mysql:host=" . $servidor . ";dbname=" . $basedatos . ";charset=utf8";
        $pdo = new PDO($sql, $usuario, $contrasena);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}

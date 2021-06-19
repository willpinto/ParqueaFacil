<?php
 
require_once '../modelo/conexion.php';
$data = array();   
 
$pdo = Conexion::Conectar();

$documento = $_POST['cedula'];
$nombres = $_POST['nombres'];
$cargo = $_POST['cargo'];
$contrasena = $_POST['contrasena'];
 
try {
    $comando=$pdo->prepare("CALL registraradministrador(:documento,:nombres,:cargo,:contrasena)");
    $comando->bindParam(':documento', $documento);
    $comando->bindParam(':nombres', $nombres);
    $comando->bindParam(':cargo', $cargo);
    $comando->bindParam(':contrasena', $contrasena);
    $comando->execute();
    $data['status'] = 'ok'; 
} catch (PDOException $e) {
   $data['status'] = 'err';
}

echo json_encode($data);

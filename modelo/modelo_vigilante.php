<?php
class Modelo_Vigilante
{
    private $pdo;
    public function __construct()
    {
        try {
            $this->pdo = conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ListarVigilantes()
    {
        try {
            $comando = $this->pdo->prepare("CALL listarvigilantes");
            $comando->execute();
            $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ConsultarVigilante($id)
    {
        try {
            $comando = $this->pdo->prepare("CALL consultarvigilante(:id)");
            $comando->bindParam(':id', $id);
            $comando->execute();
            $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function RegistrarVigilante($vigilante)
    {
        try {
            $comando = $this->pdo->prepare("CALL registrarvigilante(:cedula,:nombres,:turno,:rol,:contrasena,:documentoadm)");
            $comando->bindParam(':cedula', $vigilante->cedula);
            $comando->bindParam(':nombres', $vigilante->nombres);
            $comando->bindParam(':turno', $vigilante->turno);
            $comando->bindParam(':rol', $vigilante->rol);
            $comando->bindParam(':contrasena', $vigilante->contrasena);
            $comando->bindParam(':documentoadm', $vigilante->documentoadm);
            $comando->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function EliminarVigilante($id)
    {
        try {
            $comando = $this->pdo->prepare("CALL eliminarvigilante(:id)");
            $comando->bindParam(':id', $id);
            $comando->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ActualizarVigilante($vigilante)
    {
        try {
            $comando = $this->pdo->prepare("CALL actualizarvigilante(:cedula,:nombres,:turno,:rol,:contrasena,:documentoadm)");
            $comando->bindParam(':cedula', $vigilante->cedula);
            $comando->bindParam(':nombres', $vigilante->nombres);
            $comando->bindParam(':turno', $vigilante->turno);
            $comando->bindParam(':rol', $vigilante->rol);
            $comando->bindParam(':contrasena', $vigilante->contrasena);
            $comando->bindParam(':documentoadm', $vigilante->documentoadm);
            $comando->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
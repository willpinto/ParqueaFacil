<?php
class Modelo_Propietario
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

    function ListarPropietarios()
    {
        try {
            $comando = $this->pdo->prepare("CALL listarpropietarios");
            $comando->execute();
            $resultado = $comando->fetchAll();
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ConsultarPropietario($cedula)
    {
        try {
            $comando = $this->pdo->prepare("CALL consultarpropietario(:cedula)");
            $comando->bindParam(':cedula', $cedula);
            $comando->execute();
            $resultado = $comando->fetchAll();
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function RegistrarPropietario($propietario)
    {
        try {
            $comando = $this->pdo->prepare("CALL registrarpropietario(:documento,:tdocumento,:nombres,:apellidos,:direccion,:telefono,:correo,:fnacimiento,:genero,:tlicencia,:nlicencia)");
            $comando->bindParam(':documento', $propietario->documento);
            $comando->bindParam(':tdocumento', $propietario->tdocumento);
            $comando->bindParam(':nombres', $propietario->nombres);
            $comando->bindParam(':apellidos', $propietario->apellidos);
            $comando->bindParam(':direccion', $propietario->direccion);
            $comando->bindParam(':telefono', $propietario->telefono);
            $comando->bindParam(':correo', $propietario->correo);
            $comando->bindParam(':fnacimiento', $propietario->fnacimiento);
            $comando->bindParam(':genero', $propietario->genero);
            $comando->bindParam(':tlicencia', $propietario->tlicencia);
            $comando->bindParam(':nlicencia', $propietario->nlicencia);
            $comando->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function EliminarPropietario($cedula)
    {
        try {
            $comando = $this->pdo->prepare("CALL eliminarpropietario(:cedula)");
            $comando->bindParam(':cedula', $cedula);
            $comando->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ActualizarPropietario($propietario)
    {
        try {
            $comando = $this->pdo->prepare("CALL actualizarpropietario(:documento,:tdocumento,:nombres,:apellidos,:direccion,:telefono,:correo,:fnacimiento,:genero,:tlicencia,:nlicencia)");
            $comando->bindParam(':documento', $propietario->documento);
            $comando->bindParam(':tdocumento', $propietario->tdocumento);
            $comando->bindParam(':nombres', $propietario->nombres);
            $comando->bindParam(':apellidos', $propietario->apellidos);
            $comando->bindParam(':direccion', $propietario->direccion);
            $comando->bindParam(':telefono', $propietario->telefono);
            $comando->bindParam(':correo', $propietario->correo);
            $comando->bindParam(':fnacimiento', $propietario->fnacimiento);
            $comando->bindParam(':genero', $propietario->genero);
            $comando->bindParam(':tlicencia', $propietario->tlicencia);
            $comando->bindParam(':nlicencia', $propietario->nlicencia);
            $comando->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}

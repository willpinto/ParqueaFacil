<?php
class Modelo_Vehiculo
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

    function ListarVehiculos()
    {
        try {
            $comando = $this->pdo->prepare("CALL listarvehiculos");
            $comando->execute();
            $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ConsultarVehiculo($placa)
    {
        try {
            $comando = $this->pdo->prepare("CALL consultarvehiculo(:id)");
            $comando->bindParam(':id', $placa);
            $comando->execute();
            $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function RegistrarVehiculo($vehiculo)
    {
        try {
            $comando = $this->pdo->prepare("CALL registrarvehiculo(:Placa,:Tipo,:Marca,:Linea,:Modelo,:Servicio,:Cilindraje,:Chasis,:Motor,:Color,:Tcarroceria)");
            $comando->bindParam(':Placa', $vehiculo->placa);
            $comando->bindParam(':Tipo', $vehiculo->tipo);
            $comando->bindParam(':Marca', $vehiculo->marca);
            $comando->bindParam(':Linea', $vehiculo->linea);
            $comando->bindParam(':Modelo', $vehiculo->modelo);
            $comando->bindParam(':Servicio', $vehiculo->servicio);
            $comando->bindParam(':Cilindraje', $vehiculo->cilindraje);
            $comando->bindParam(':Chasis', $vehiculo->chasis);
            $comando->bindParam(':Motor', $vehiculo->motor);
            $comando->bindParam(':Color', $vehiculo->color);
            $comando->bindParam(':Tcarroceria', $vehiculo->tcarroceria);
            $comando->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function EliminarVehiculo($placa)
    {
        try {
            $comando = $this->pdo->prepare("CALL eliminarvehiculo(:id)");
            $comando->bindParam(':id', $placa);
            $comando->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ActualizarVehiculo($vehiculo)
    {
        try {
            $comando = $this->pdo->prepare("CALL actualizarvehiculo(:Placa,:Tipo,:Marca,:Linea,:Modelo,:Servicio,:Cilindraje,:Chasis,:Motor,:Color,:Tcarroceria)");
            $comando->bindParam(':Placa', $vehiculo->placa);
            $comando->bindParam(':Tipo', $vehiculo->tipo);
            $comando->bindParam(':Marca', $vehiculo->marca);
            $comando->bindParam(':Linea', $vehiculo->linea);
            $comando->bindParam(':Modelo', $vehiculo->modelo);
            $comando->bindParam(':Servicio', $vehiculo->servicio);
            $comando->bindParam(':Cilindraje', $vehiculo->cilindraje);
            $comando->bindParam(':Chasis', $vehiculo->chasis);
            $comando->bindParam(':Motor', $vehiculo->motor);
            $comando->bindParam(':Color', $vehiculo->color);
            $comando->bindParam(':Tcarroceria', $vehiculo->tcarroceria);
            $comando->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ConsultarVehiculoPorPlacaDocumento($placa, $documento)
    {
        try {
            $comando = $this->pdo->prepare("CALL consultarvehiculoporplacadocumento(:placa,:documento)");
            $comando->bindParam(':placa', $placa);
            $comando->bindParam(':documento', $documento);
            $comando->execute();
            $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ConsultarVehiculosPorPropietario($documento)
    {
        try {
            $comando = $this->pdo->prepare("CALL consultarvehiculosporpropietario(:documento)");
            $comando->bindParam(':documento', $documento);
            $comando->execute();
            $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}

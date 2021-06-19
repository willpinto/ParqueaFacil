<?php
class Modelo_Registro
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

    function ListarRegistros()
    {
        try {
            $comando = $this->pdo->prepare("CALL listarregistros");
            $comando->execute();
            $resultado = $comando->fetchAll();
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ConsultarRegistro($id)
    {
        try {
            $comando = $this->pdo->prepare("CALL consultarregistro(:id)");
            $comando->bindParam(':id', $id);
            $comando->execute();
            $resultado = $comando->fetchAll();
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function RegistrarRegistro($registro)
    {
        try {
            $comando = $this->pdo->prepare("CALL registrarregistro(:fingreso,:fsalida,:estado,:placaveh,:documentovig)");
            $comando->bindParam(':fingreso', $registro->fingreso);
            $comando->bindParam(':fsalida', $registro->fsalida);
            $comando->bindParam(':estado', $registro->estado);
            $comando->bindParam(':placaveh', $registro->idAsociado);
            $comando->bindParam(':documentovig', $registro->documentovig);
            $comando->execute();
            if($comando == true) {
                $resultado = $this->ObtenerIDRegistroActivoPorPlaca($registro->placaveh);
                return $resultado;
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function AsociarConductorVehiculo($data)
    {
        try {
            $comando = $this->pdo->prepare("CALL asociarconductorvehiculo(:documento,:placa)");
            $comando->bindParam(':documento', $data->documento);
            $comando->bindParam(':placa', $data->placa);
            $comando->execute();
            if($comando == true) {
                $resultado = $this->ObtenerIDAsociadoConductorVehiculo($data);
                return $resultado;
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function EliminarRegistro($id)
    {
        try {
            $comando = $this->pdo->prepare("CALL eliminarregistro(:id)");
            $comando->bindParam(':id', $id);
            $comando->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ActualizarRegistro($registro)
    {
        try {
            $comando = $this->pdo->prepare("CALL actualizarregistro(:id,:fingreso,:fsalida,:estado,:placaveh,:documentovig)");
            $comando->bindParam(':id', $registro->id);
            $comando->bindParam(':fingreso', $registro->fingreso);
            $comando->bindParam(':fsalida', $registro->fsalida);
            $comando->bindParam(':estado', $registro->estado);
            $comando->bindParam(':placaveh', $registro->placaveh);
            $comando->bindParam(':documentovig', $registro->documentovig);
            $comando->execute();
            if($comando == true) {
                $resultado = $this->ObtenerDatosConductorCheckOut($registro->id);
                return $resultado;
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function VerificarRegistro($documento, $placa) {
        try {
            $comando = $this->pdo->prepare("CALL consultarregistroactivo(:documento,:placa)");
            $comando->bindParam(':documento', $documento);
            $comando->bindParam(':placa', $placa);
            $comando->execute();
            $resultado = $comando->fetchAll();
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ObtenerIDRegistroActivoPorPlaca($placa) {
        try {
            $comando = $this->pdo->prepare("CALL obteneridregistroactivoporplaca(:placa)");
            $comando->bindParam(':placa', $placa);
            $comando->execute();
            $resultado = $comando->fetchColumn();
            if($resultado != null) {
                return $resultado;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ConsultarRegistroActivoPorPlaca($placa) {
        try {
            $comando = $this->pdo->prepare("CALL consultarregistroactivoporplaca(:placa)");
            $comando->bindParam(':placa', $placa);
            $comando->execute();
            $resultado = $comando->fetchAll();
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ConsultarRegistroActivoPorTicket($numero) {
        try {
            $comando = $this->pdo->prepare("CALL consultarregistroactivoporticket(:numero)");
            $comando->bindParam(':numero', $numero);
            $comando->execute();
            $resultado = $comando->fetchAll();
            return $resultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ObtenerIDAsociadoConductorVehiculo($data) {
        try {
            $comando = $this->pdo->prepare("CALL obteneridasociadoconductorvehiculo(:documento, :placa)");
            $comando->bindParam(':documento', $data->documento);
            $comando->bindParam(':placa', $data->placa);
            $comando->execute();
            $resultado = $comando->fetchColumn();
            if($resultado != null) {
                return $resultado;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ObtenerDatosConductorCheckOut($id) {
        try {
            $comando = $this->pdo->prepare("CALL obtenerDatosConductorCheckOut(:id)");
            $comando->bindParam(':id', $id);
            $comando->execute();
            $resultado = $comando->fetchAll();
            if($resultado != null) {
                return $resultado;
            }
            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function ConsultarPlacasActivas() {
        try {
            $comando = $this->pdo->prepare("CALL consultarplacasactivas");
            $comando->execute();
            $resultado = $comando->fetchAll();
            if($resultado != null) {
                return $resultado;
            }
            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}

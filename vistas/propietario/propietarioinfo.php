<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parquea fácil</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilosgeneral.css">
    <link rel="stylesheet" type="text/css" href="css/imageoption.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="row pt-4">
                    <div class="col">
                        <h1 class="display-3 font-weight-bold text-primary-dark">Bienvenido</h1>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <h3 class="text-center text-white bg-primary-dark">Parquea Fácil</h3>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
            <div class="col">
                <div class="row h-100">
                    <div class="col d-flex justify-content-end align-items-center">
                        <button id="misDatos" class="btn btn-orange mx-1 disabled">Mis datos</button>
                        <button id="registrarse" class="btn btn-orange mx-1 d-none" data-toggle="tooltip" data-placement="bottom" title="Botón temporal/Primera vez al registrarse">Registrarse</button>
                        <button id="cerrarSesionProp" class="btn btn-orange mx-1">Salir</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col-4">
                        <img class="logo-sena-medium" src="img/logos/senalogo.png" alt="sena logo">
                    </div>
                    <div class="col">
                        <div class="form-group row d-flex justify-content-end">
                            <label for="usuario" class="col-sm-2 col-form-label">Usuario:</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="usuario-info" value="<?php echo $_POST['nombre']; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-end">
                            <label for="cedula" class="col-sm-2 col-form-label">Cédula:</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="cedula-info" value="<?php echo $_POST['documento']; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-end">
                            <label for="placa" class="col-sm-2 col-form-label">Placa:</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="placa-info" value="<?php echo $_POST['placa'] ?>" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <h3 class="text-primary">Novedades del vehículo</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <textarea id="novedad" class="form-control" cols="30" rows="5" readonly></textarea>
                    </div>
                </div>
            </div>
            <div class="col ml-3">
                <div class="row">
                    <div class="col">
                        <h1 class="text-primary-dark">Cámaras</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="cam">
                            <p class="text-right font-weight-bold text-white pr-2 pt-1">CAM 1</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="cam">
                            <p class="text-right font-weight-bold text-white pr-2 pt-1">CAM 2</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <div class="cam">
                            <p class="text-right font-weight-bold text-white pr-2 pt-1">CAM 3</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="cam">
                            <p class="text-right font-weight-bold text-white pr-2 pt-1">CAM 4</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Modales-->
    <div class="modal fade" id="registro-propietario-modal" data-backdrop="static" data-keyboard="false" tabindex="-2" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Completado del registro del conductor</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col my-3">
                            <div class="row">
                                <div class="col">
                                    <p class="text-justify">Por favor, complete la información con respecto a los datos de su cédulo y posteriormente los de su tarjeta de propiedad</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Documento:</label>
                                        <div class="col">
                                            <input type="number" class="form-control" id="documento" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Tipo documento:</label>
                                        <div class="col">
                                            <select class="form-control" id="tipo-documento">
                                                <option value="" disabled>Seleccione un tipo documento</option>
                                                <option value="cc">Cédula de ciudadania</option>
                                                <option value="ti">Tarjeta de identidad</option>
                                                <option value="ce">Cédula de extranjeria</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">*Nombres</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="nombres">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">*Apellidos</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="apellidos">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">*Dirección</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="direccion">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">*Teléfono</label>
                                        <div class="col">
                                            <input type="number" class="form-control" id="telefono">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">*Correo</label>
                                        <div class="col">
                                            <input type="email" class="form-control" id="correo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">*Fecha de nacimiento:</label>
                                        <div class="col">
                                            <input type="date" class="form-control" id="fecha-nacimiento">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">*Género</label>
                                        <div class="col">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="genero" id="male" class="form-check-input" value="H">
                                                <label for="male" class="form-check-label">Hombre</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="genero" id="female" class="form-check-input" value="M">
                                                <label for="female" class="form-check-label">Mujer</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">*Clase licencia</label>
                                        <div class="col">
                                            <select class="form-control" id="clase-licencia">
                                                <option value="" disabled>Seleccione clase licencia</option>
                                                <option value="A1">A1</option>
                                                <option value="A2">A2</option>
                                                <option value="B1">B1</option>
                                                <option value="B2">B2</option>
                                                <option value="B3">B3</option>
                                                <option value="C1">C1</option>
                                                <option value="C2">C2</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">*Número licencia</label>
                                        <div class="col">
                                            <input type="number" class="form-control" id="numero-licencia">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <button id="mostrarTC" class="btn btn-secondary">Continuar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tc-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <h1>Términos y condiciones</h1>
                                    <div class="form-group">
                                        <textarea id="txtTC" class="form-control no-resize-textarea" cols="30" rows="8" ReadOnly="true"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input type="checkbox" id="chkAceptarTC" class="form-check-input">
                                        <label for="chkAceptarTC" class="form-check-label">Aceptar términos y condiciones</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button id="GuardarRegistroPropietario" class="btn btn-success disabled">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="registro-vehiculo-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Mis vehículos</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col my-3">
                            <div class="row">
                                <div class="col">
                                    <p class="text-justify">Por favor, complete los datos de su vehículo:</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Documento:</label>
                                        <div class="col">
                                            <input type="number" class="form-control" id="cedula" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Placa:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="placa" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>*T.Vehiculo:</label>
                                </div>
                                <div class="col">
                                    <input type="radio" name="tipo-veh" class="form-control check-image" id="chkCarro" value="carro">
                                    <label for="chkCarro" class="check-image-label"><img src="img/logos/carro.png" /></label>
                                </div>
                                <div class="col">
                                    <input type="radio" name="tipo-veh" class="form-control check-image" id="chkMoto" value="moto">
                                    <label for="chkMoto" class="check-image-label"><img src="img/logos/moto.png" /></label>
                                </div>
                                <div class="col">
                                    <input type="radio" name="tipo-veh" class="form-control check-image" id="chkBici" value="bicicleta">
                                    <label for="chkBici" class="check-image-label"><img src="img/logos/bicicleta.png" /></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">*Marca:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="marca">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">*Modelo:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="modelo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">*Línea:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="linea">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">*Servicio:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="servicio">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Cilindraje:</label>
                                        <div class="col">
                                            <input type="number" class="form-control" id="cilindraje">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">N° Chasis:</label>
                                        <div class="col">
                                            <input type="text" class="form-control text-uppercase" id="chasis">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">N° Motor:</label>
                                        <div class="col">
                                            <input type="text" class="form-control text-uppercase" id="motor">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">*Color:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="color">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Carroceria:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="tcarroceria">
                                        </div>
                                    </div>
                                </div>
                                <div class="col"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <button id="GuardarRegistroVehiculo" class="btn btn-secondary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="mis-datos-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Mis datos</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <span class="font-weight-bold">Documento: </span>
                            <label id="lblDocumento"></label>
                        </div>
                        <div class="col">
                            <span class="font-weight-bold">Nombres: </span>
                            <label id="lblNombres"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span class="font-weight-bold">Apellidos: </span>
                            <label id="lblApellidos"></label>
                        </div>
                        <div class="col">
                            <span class="font-weight-bold">Dirección: </span>
                            <label id="lblDireccion"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span class="font-weight-bold">Teléfono: </span>
                            <label id="lblTelefono"></label>
                        </div>
                        <div class="col">
                            <span class="font-weight-bold">Correo: </span>
                            <label id="lblCorreo"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span class="font-weight-bold">Fecha Nacimiento: </span>
                            <label id="lblFechaNacimiento"></label>
                        </div>
                        <div class="col">
                            <span class="font-weight-bold">Género: </span>
                            <label id="lblGenero"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span class="font-weight-bold">Tipo licencia: </span>
                            <label id="lblTipoLicencia"></label>
                        </div>
                        <div class="col">
                            <span class="font-weight-bold">Número licencia: </span>
                            <label id="lblNumeroLicencia"></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col d-flex flex-row-reverse">
                            <button id="btnMisVehiculos" class="btn btn-success mx-1">Mis Vehículos</button>
                            <button id="btnRegistrarVehiculoActual" class="btn btn-success mx-1 d-none" data-toggle="tooltip" data-placement="top" title="Vehiculo pendiente por ingresar">Ingresar vehículo actual</button>
                            <button class="btn btn-secondary mx-1" data-dismiss="modal">Atrás</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="mis-vehiculos-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Mis vehículos</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-0">
                    <div class="row mx-2">
                        <div class="col">
                            <table class="table-warning table-striped table-bordered table-hover w-100" id="tablavehiculos"></table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <button id="regresarMisDatos" class="btn btn-secondary">Atrás</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="ticket" value="<?php echo $_POST['numero-ticket']; ?>">
    <div id="form-oculto"></div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="js/scriptgeneral.js"></script>
    <script src="js/scriptpropietario.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parquea fácil</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilosgeneral.css">
    <link rel="stylesheet" type="text/css" href="css/loading.css">
    <link rel="stylesheet" type="text/css" href="css/estilosvigilante.css">
</head>

<body>
    <div class="container vh-100">
        <div class="row pt-5">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <h1 class="display-3 font-weight-bold text-primary-dark">Bienvenido</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <h3 class="text-center text-white bg-primary-dark">Parquea Fácil</h3>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
            <div class="col-1">
                <button id="logout" class="btn btn-primary-dark py-3 px-4" data-toggle="tooltip" data-placement="left" title="Logout"><i class="fas fa-sign-out-alt"></i></button>
            </div>
        </div>
        <div class="row h-65">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <img class="logo-sena-large mt-auto" src="img/logos/senalogo.png" alt="sena logo">
                    </div>
                </div>
                <div class="row h-25">
                    <div class="col d-flex align-items-end">
                        <button class="btn btn-orange" id="btn-ingresar-novedad">Ingresar novedad</button>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="row h-40">
                    <div class="col d-flex flex-column">
                        <button id="btnCheckOut" class="btn btn-circle btn-check outline out h-100" data-toggle="tooltip" data-placement="left" title="Check OUT"></button>
                    </div>
                </div>
                <div class="row mt-2 h-40">
                    <div class="col d-flex flex-column">
                        <button id="btnCheckIn" class="btn btn-circle btn-check in outline h-100" data-toggle="tooltip" data-placement="left" title="Check IN"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Modales-->
    <div class="modal fade" id="checkin-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" id="closeCI" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2 class="text-center">Check IN</h2>
                    <div class="form-group row mt-5">
                        <label class="col-2 col-form-label">Cedula:</label>
                        <div class="col-9">
                            <input class="form-control" id="cedula-ci" type="number" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Placa:</label>
                        <div class="col-9">
                            <input class="form-control text-uppercase mask-placa" id="placa-ci" type="text" required autocomplete="false">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span id="cargaCI" class="h3 d-none">
                        <div class="lds-ellipsis">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </span>
                    <button id="ConfirmarCheckIn" class="btn btn-success">Check IN</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="checkin-info-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-dialog-scrollable">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mx-3">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <h2 class="text-center">Parquea Fácil SENA</h2>
                                    </div>
                                    <div class="col-5">
                                        <img class="logo-sena-smallium" src="img/logos/senalogo.png" alt="sena logo">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col ml-3">
                                        <div class="row">
                                            <span class="font-weight-bold">
                                                Cédula: <label id="label-cedula-ci" class="font-weight-normal"></label>
                                            </span>
                                        </div>
                                        <div class="row">
                                            <span class="font-weight-bold">
                                                Nombre: <label id="label-nombre-ci" class="font-weight-normal"></label>
                                            </span>
                                        </div>
                                        <div class="row">
                                            <span class="font-weight-bold">
                                                Placa: <label id="label-placa-ci" class="font-weight-normal"></label>
                                            </span>
                                        </div>
                                        <div class="row">
                                            <span class="font-weight-bold">
                                                # de ticket: <label id="label-ticket-ci" class="font-weight-normal"></label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label id="msg-adicional" class="text-small"></label>
                            </div>
                        </div>
                        <div class="row align-self-end">
                            <div class="col-5">
                                <svg id="user-barcode"></svg>
                                <!--<img class="logo-sena-small" src="img/logos/barcode.png" alt="sena logo">-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <button id="AceptarCheckIn" class="btn btn-success" data-dismiss="modal">Continuar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="checkout-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mx-5 px-5">
                        <h2 class="text-center">Check OUT</h2>
                        <div class="row">
                            <div class="col">
                                <h4 class="text-center">Escanea código de barras del ticket</h4>
                            </div>
                            <div class="col">
                                <span>
                                    <div class="lds-ellipsis">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <button id="ConfirmarCheckOutManual" class="btn btn-success">Check OUT Manual</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="checkout-manual-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" id="closeCO" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2 class="text-center">Check OUT Manual</h2>
                    <div class="row mt-3 d-flex flex-row-reverse">
                        <div class="col-3">
                            <div class="form-check">
                                <input type="checkbox" id="chkPorTicket" class="form-check-input">
                                <label for="chkPorTicket" class="form-check-label">Por Ticket</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-2" id="por-documento">
                        <div class="col">
                            <div class="form-group row mt-3">
                                <label class="col-4 col-form-label">Cedula:</label>
                                <div class="col">
                                    <input class="form-control" id="cedula-co" type="number" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-4 col-form-label">Placa:</label>
                                <div class="col">
                                    <input class="form-control text-uppercase mask-placa" id="placa-co" type="text" required autocomplete="false">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-2 d-none" id="por-ticket">
                        <div class="col">
                            <div class="form-group row mt-3">
                                <label class="col-4 col-form-label">Número ticket:</label>
                                <div class="col">
                                    <input class="form-control" id="ticket-co" type="number" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span id="cargaCO" class="h3 d-none">
                        <div class="lds-ellipsis">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </span>
                    <button id="ConfirmarCheckOut" class="btn btn-success">Check OUT</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="checkout-info-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mx-3">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <h2 class="text-center">Parquea Fácil SENA</h2>
                                    </div>
                                    <div class="col-5">
                                        <img class="logo-sena-small" src="img/logos/logo-sena.jpg" alt="sena logo">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col ml-3">
                                        <div class="row">
                                            <span class="font-weight-bold">
                                                Cédula: <label id="label-cedula-co" class="font-weight-normal"></label>
                                            </span>
                                        </div>
                                        <div class="row">
                                            <span class="font-weight-bold">
                                                Nombre: <label id="label-nombre-co" class="font-weight-normal"></label>
                                            </span>
                                        </div>
                                        <div class="row">
                                            <span class="font-weight-bold">
                                                Placa: <label id="label-placa-co" class="font-weight-normal"></label>
                                            </span>
                                        </div>
                                        <div class="row">
                                            <span class="font-weight-bold">
                                                # de ticket: <label id="label-ticket-co" class="font-weight-normal"></label>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="row">
                                            <div class="col">
                                                <p>Se realizo check out correctamente</p>
                                            </div>
                                            <div class="col">
                                                <p>El vehículo ya no se encuentra en las instalaciones</p>
                                            </div>
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
                            <button id="AceptarCheckOut" class="btn btn-success" data-dismiss="modal">Continuar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ingresar-novedad" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset id="form-novedad">
                        <div class="mx-3">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <h2 class="text-center">Registro de novedades</h2>
                                            <div class="alert alert-danger d-none" id="mensaje-novedad" role="alert">
                                                No existe vehículos registrados para ingresar novedad
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col ml-3">
                                            <div class="row">
                                                <div class="form-group col">
                                                    <label for="placa-activa">Placa activa:</label>
                                                    <select class="form-control form-novedad" id="placa-activa"></select>
                                                </div>
                                                <div class="form-group col">
                                                    <label for="tipo-novedad">Tipo:</label>
                                                    <select class="form-control form-novedad" id="tipo-novedad">
                                                        <option value="" disabled selected>Seleccione un tipo</option>
                                                        <option value="externo">Daño externo</option>
                                                        <option value="interno">Daño interno</option>
                                                        <option value="especifico">Especifico</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col">
                                                    <label for="detalle-novedad">Detalle:</label>
                                                    <textarea class="form-control form-novedad" id="detalle-novedad" cols="30" rows="6"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <button id="IngresarNovedad" class="btn btn-success">Ingresar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="documento-vig" value="<?php echo $_POST['documentovig'] ?>">
    <div id="form-oculto"></div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="js/JsBarcode.all.min.js"></script>
    <script src="js/scriptvigilante.js"></script>
    <script src="js/scriptgeneral.js"></script>
</body>

</html>
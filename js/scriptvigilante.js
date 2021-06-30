var debeRegistrarsePropietario = false;
var debeRegistrarseVehiculo = false;
var faltaDatosPropietario = false;
var faltaDatosVehiculo = false;
var dataPropietario;
var dataVehiculo;
var dataRegistro;
var data, registro, idAsociado;

function RealizarCheckIn() {
    data = recuperarPlacaDocumento('i');
    registro = recuperarPlacaDocumentoVig('i');
    bloquearCheckIN();
    verificarExistenciaRegistroPorPlacaIngresada(true, 'detectar');
}

function RealizarCheckOut() {
    bloquearCheckOUT();
    if($("#chkPorTicket").is(":checked")) {
        verificarExistenciaRegistroPorTicket();
    } else {
        data = recuperarPlacaDocumento('o');
        registro = recuperarPlacaDocumentoVig('o');
        verificarExistenciaRegistroPorPlacaIngresada(false, 'traerRegistro');
    }
}

function limpiarInputs() {
    $('#placa-ci').val('');
    $('#cedula-ci').val('');
    $('#placa-co').val('');
    $('#cedula-co').val('');
    $('#ticket-co').val('');
    debeRegistrarsePropietario = false;
    debeRegistrarseVehiculo = false;
    faltaRegistroPropietario = false;
    faltaRegistroVehiculo = false;
    dataPropietario = null;
    dataVehiculo = null;
    dataRegistro = null;
    data = null;
    registro = null;
}

function activarChecks() {
    $('#placa-ci').removeAttr('disabled');
    $('#cedula-ci').removeAttr('disabled');
    $('#placa-co').removeAttr('disabled');
    $('#cedula-co').removeAttr('disabled');
    $('#ticket-co').removeAttr('disabled');
    $('#cargaCI').addClass('d-none');
    $('#cargaCO').addClass('d-none');
    $('#closeCI').removeClass('disabled');
    $('#closeCO').removeClass('disabled');
    $('#ConfirmarCheckIn').removeClass('disabled');
    $('#ConfirmarCheckOut').removeClass('disabled');
}

function bloquearCheckIN() {
    $('#placa-ci').prop('disabled', true);
    $('#cedula-ci').prop('disabled', true);
    $('#cargaCI').removeClass('d-none');
    $('#closeCI').addClass('disabled');
    $('#ConfirmarCheckIn').addClass('disabled');
}

function bloquearCheckOUT() {
    $('#placa-co').prop('disabled', true);
    $('#cedula-co').prop('disabled', true);
    $('#ticket-co').prop('disabled', true);
    $('#cargaCO').removeClass('d-none');
    $('#closeCO').addClass('disabled');
    $('#ConfirmarCheckOut').addClass('disabled');
}

function desbloquearFormNovedad() {
    $('#mensaje-novedad').addClass('d-none');
    $('#form-novedad').removeAttr('disabled');
    $('#IngresarNovedad').removeAttr('disabled');
    $('.form-novedad').val("");
}

function recuperarPlacaDocumento(val) {
    let data = {
        placa: $('#placa-c' + val).val().toUpperCase(),
        cedula: $('#cedula-c' + val).val(),
        accion: '',
        usuario: 'vigi'
    };
    return data;
}

function rellenarPlacasActivas() {
    let data = {
        accion: 'abstraer'
    };
    $.ajax({
        url: 'controlador/controlador_registro.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            let data = JSON.parse(resp);
            desbloquearFormNovedad();
            if (data != null) {
                llenarComboPlacasActivas(data);
            } else {
                $('#mensaje-novedad').removeClass('d-none');
                $('#form-novedad').prop('disabled', true);
                $('#IngresarNovedad').prop('disabled', true);
            }
            $('#ingresar-novedad').modal('show');
        },
        error: function () {
            alert("Hubo un problema al registrar el propietario, intentelo más tarde");
        }
    });
}

function llenarComboPlacasActivas(data) {
    $('#placa-activa').empty();
    $('#placa-activa').append('<option value="" disabled selected>Seleccione placa</option>')
    data.forEach(function (element, index) {
        $('#placa-activa').append(`<option value="${element.idRegistro}">${element.placa}</option>`);
    });
}

function ingresarNuevaNovedad() {
    let data = {
        tipo: $('#tipo-novedad').val(),
        descripcion: $('#detalle-novedad').val(),
        ticket: $('#placa-activa').val(),
        accion: 'registrar'
    };
    $.ajax({
        url: 'controlador/controlador_novedad.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            if (resp == "null") {
                alert("Solicitud ejecutada con éxito");
                $('#ingresar-novedad').modal('hide');
                desbloquearFormNovedad();
            } else {
                alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
            }
        },
        error: function () {
            alert("Hubo un problema al registrar el administrador, intentelo más tarde");
        }
    });
}

function recuperarPlacaDocumentoVig(val) {
    let data = {
        placa: $('#placa-c' + val).val().toUpperCase(),
        cedula: $('#documento-vig').val(),
        idAsociado: '',
        accion: '',
        check: ''
    };
    return data;
}

function verificarExistenciaRegistroPorPlacaIngresada(esCheckIn, accion) {
    data.accion = accion;
    $.ajax({
        url: 'controlador/controlador_registro.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            if(esCheckIn) {
                if (resp == 0) {
                    verificarExistenciaPropietario(true);
                } else {
                    alert("El vehiculo YA se encuentra en las instalaciones\nPor favor revise de nuevo los datos");
                    activarChecks();
                }
            } else {
                let data = JSON.parse(resp);
                ajustarSalidaVehiculo(data, false);
            }
        },
        error: function () {
            alert("Hubo un problema, intentelo más tarde");
            activarChecks();
        }
    });
}

function verificarExistenciaRegistroPorTicket() {
    let data = {
        numero: $('#ticket-co').val(),
        accion: "indagar"
    };
    $.ajax({
        url: 'controlador/controlador_registro.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            let data = JSON.parse(resp);
            ajustarSalidaVehiculo(data, true);
        },
        error: function () {
            alert("Hubo un problema, intentelo más tarde");
            activarChecks();
        }
    });
}

function ajustarSalidaVehiculo(data, conNumeroTicket) {
    if(data[0] != null) {
        dataRegistro = {
            id: data[0].numero_ticket,
            fingreso: data[0].fecha_ingreso,
            placa: data[0].id_cond_veh,
            cedula: data[0].documento_vig,
            accion: 'actualizar',
            check: 'out'
        }
        if(conNumeroTicket) {
            actualizarCheckOutRegistro();
            return;
        }
        verificarExistenciaPropietario(false);
    } else {
        alert("El vehiculo NO se encuentra en las instalaciones\nPor favor realice check in del mismo o verifique los datos nuevamente");
        activarChecks();
    }
}

function verificarExistenciaPropietario(esCheckIn) {
    data.accion = 'consultar';
    $.ajax({
        url: 'controlador/controlador_propietario.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            dataPropietario = JSON.parse(resp);
            if(esCheckIn) {
                if (dataPropietario.length == 0) {
                    debeRegistrarsePropietario = true;
                } else if (dataPropietario[0].nombres == "" && dataPropietario[0].apellidos == "" && dataPropietario[0].direccion == "" &&
                    dataPropietario[0].telefono == "" && dataPropietario[0].correo == "" && dataPropietario[0].genero == "" &&
                    dataPropietario[0].tipo_licencia == "" && dataPropietario[0].numero_licencia == "") {
                    faltaDatosPropietario = true;
                }
                verificarExistenciaVehiculo();
            } else {
                actualizarCheckOutRegistro();
            }
        },
        error: function () {
            alert("Hubo un problema, intentelo más tarde");
            activarChecks();
        }
    });
}

function verificarExistenciaVehiculo() {
    $.ajax({
        url: 'controlador/controlador_vehiculo.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            dataVehiculo = JSON.parse(resp);
            if (dataVehiculo.length == 0) {
                debeRegistrarseVehiculo = true;
            } else if (dataVehiculo[0].tipo == "" && dataVehiculo[0].marca == "" &&
                dataVehiculo[0].modelo == "" && dataVehiculo[0].servicio == "" && dataVehiculo[0].color) {
                faltaDatosVehiculo = true;
            }
            establecerRegistros();
        },
        error: function () {
            alert("Hubo un problema, intentelo más tarde");
            activarChecks();
        }
    });
}

function establecerRegistros() {
    if (debeRegistrarsePropietario) {
        RegistrarNuevoUsuario();
    } else if (debeRegistrarseVehiculo) {
        RegistrarNuevoVehiculo();
    } else {
        BuscarIDAsociadoConductorVehiculo();
    }
}

function RegistrarNuevoUsuario() {
    data.accion = "registrar";
    $.ajax({
        url: 'controlador/controlador_propietario.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            if(resp == "null") {
                if(debeRegistrarseVehiculo) {
                    RegistrarNuevoVehiculo();
                } else {
                    AsociarConductorVehiculo();
                }
            } else {
                alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
                activarChecks();
            }
        },
        error: function () {
            alert("Hubo un problema al registrar el propietario, intentelo más tarde");
            activarChecks();
        }
    });
}

function RegistrarNuevoVehiculo() {
    data.accion = "registrar";
    $.ajax({
        url: 'controlador/controlador_vehiculo.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            if(resp == "null") {
                AsociarConductorVehiculo();
            } else {
                alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
                activarChecks();
            }
        },
        error: function () {
            alert("Hubo un problema al registrar el vehiculo, intentelo más tarde");
            activarChecks();
        }
    });
}

function AsociarConductorVehiculo() {
    data.accion = "asociar";
    $.ajax({
        url: 'controlador/controlador_registro.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            if(resp != 0) {
                IngresarCheckInARegistro(resp);
            } else {
                alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
                activarChecks();
            }
        },
        error: function () {
            alert("Hubo un problema al registrar el vehiculo, intentelo más tarde");
            activarChecks();
        }
    });
}

function BuscarIDAsociadoConductorVehiculo() {
    data.accion = "buscarAsociado";
    $.ajax({
        url: 'controlador/controlador_registro.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            if(resp != 0) {
                IngresarCheckInARegistro(resp);
            } else {
                alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
                activarChecks();
            }
        },
        error: function () {
            alert("Hubo un problema al registrar el vehiculo, intentelo más tarde");
            activarChecks();
        }
    });
}

function IngresarCheckInARegistro(idAsociado) {
    registro.idAsociado = idAsociado;
    registro.check = 'in';
    registro.accion = 'registrar';
    $.ajax({
        url: 'controlador/controlador_registro.php',
        type: 'POST',
        data: registro,
        success: function (resp) {
            if (resp != 0) {
                let existeNombre = dataPropietario.length != 0,
                    codigoTicket = resp.padStart(10, "0"),
                    separateCodigoTicket = undefined,
                    forBarcode = "";
                if(existeNombre) {
                    existeNombre = dataPropietario[0].nombres != "" && dataPropietario[0].apellidos != "";
                }
                separateCodigoTicket = Array.from(codigoTicket);
                separateCodigoTicket.forEach(function(element, index) {
                    forBarcode += (index == 5 ? data.cedula.substring(data.cedula.length - 3) : "") + element;
                });
                $('#label-cedula-ci').text(data.cedula);
                $('#label-nombre-ci').text(existeNombre ? dataPropietario[0].nombres + " " + dataPropietario[0].apellidos : "Sin registro");
                $('#label-placa-ci').text(data.placa);
                $('#label-ticket-ci').text(codigoTicket);
                JsBarcode("#user-barcode", forBarcode, {
                    format: "code128",
                    lineColor: "#000",
                    width: 3,
                    height: 50,
                    displayValue: false
                });
                $('#checkin-modal').modal('hide');
                $('#checkin-info-modal').modal('show');
                ValidarMensajeAdicional();
                limpiarInputs();
            } else {
                alert("No se pudo realizar check in\nIntentelo más tarde");
            }
            activarChecks();
        },
        error: function () {
            alert("Hubo un problema al registrar el vehiculo, intentelo más tarde");
            activarChecks();
        }
    });
}

function ValidarMensajeAdicional() {
    let msg = "";
    if (debeRegistrarsePropietario && debeRegistrarseVehiculo) {
        msg += "Apreciado conductor, por favor llene los datos ingresando por \"Revisa tu vehículo\" en parqueafacilsena.com";
    } else if (faltaDatosPropietario || faltaDatosVehiculo) {
        msg += "Apreciado conductor, aún no te has registrado, por favor hágalo ingresando desde \"Revisa tu vehículo\" en parqueafacilsena.com";
    } else if (debeRegistrarseVehiculo) {
        msg += "Apreciado conductor, por favor ingrese su nuevo vehículo ingresando por \"Revisa tu vehículo\" en parqueafacilsena.com";
    } else if (faltaDatosVehiculo) {
        msg += "Apreciado conductor, te falta registrar tu vehículo, hazlo en \"Revisa tu vehículo\" en el sitio parqueafacilsena.com";
    }
    $('#msg-adicional').text(msg);
}

function actualizarCheckOutRegistro() {
    $.ajax({
        url: 'controlador/controlador_registro.php',
        type: 'POST',
        data: dataRegistro,
        success: function (resp) {
            let registroData = JSON.parse(resp);
            if (registroData[0] != "null") {
                //let hayRegistro = false;
                hayNombre = registroData[0].nombres != "" || registroData[0].apellidos != "";
                $('#label-cedula-co').text(registroData[0].documento);
                $('#label-nombre-co').text(hayNombre ? registroData[0].nombres + " " + registroData[0].apellidos : "Sin registro");
                $('#label-placa-co').text(registroData[0].placa);
                $('#label-ticket-co').text(dataRegistro.id.padStart(10, "0"));
                $('#checkout-manual-modal').modal('hide');
                $('#checkout-info-modal').modal('show');
                limpiarInputs();
            } else {
                alert("No se pudo realizar el check out\nIntentelo más tarde");
            }
            activarChecks();
        },
        error: function () {
            alert("Hubo un problema al realizar el check out, intentelo más tarde");
            activarChecks();
        }
    });
}
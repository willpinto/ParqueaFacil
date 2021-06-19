var dataAdministradores, tabla, dataCond;

$(document).ready(function () {
    let hoy = new Date();
    let mes = hoy.getMonth() + 1;
    let dia = hoy.getDate();
    let hoyString = hoy.getFullYear() + "-" + (mes < 10 ? "0" + mes : mes) + "-" + (dia < 10 ? "0" + dia : dia);
    $('#fecha-inicio').val(hoyString).attr('max', hoyString);
    $('#fecha-final').val(hoyString).attr({ 'max': hoyString, 'min': hoyString });

    cargarAdministradores();
});

function validarContrasenasAdmin(esRegistrar) {
    let pass = $('#pass-adm').val();
    let passr = $('#pass-rep-adm').val();
    if (pass == passr) {
        if (esRegistrar) {
            registrarAdministrador();
        } else {
            actualizarAdministrador();
        }
    } else {
        alert("Las contraseñas no son iguales\nPor favor, rectifique antes de registrar");
    }
}

function validarContrasenasVig(esRegistrar) {
    let pass = $('#pass-vig').val();
    let passr = $('#pass-rep-vig').val();
    if (pass == passr) {
        if (esRegistrar) {
            registrarVigilante();
        } else {
            actualizarVigilante();
        }
    } else {
        alert("Las contraseñas no son iguales\nPor favor, rectifique antes de registrar");
    }
}

function recuperarDatosAdministrador() {
    let data = {
        cedula: $('#cedula-adm').val(),
        nombres: $('#nombres-adm').val(),
        cargo: $('#cargo').val(),
        contrasena: $('#pass-adm').val(),
        accion: ''
    };
    return data;
}

function recuperarDatosVigilante() {
    let data = {
        cedula: $('#cedula-vig').val(),
        nombres: $('#nombres-vig').val(),
        turno: $('#turno').val(),
        rol: $('#rol').val(),
        contrasena: $('#pass-vig').val(),
        documentoadm: $('#documentoadm').val(),
        accion: ''
    };
    return data;
}

function recuperarDatosConductor() {
    let registro = {
        cedula: $('#documento-cond').val(),
        tipoDocumento: $('#tipo-documento-cond').val(),
        nombres: $('#nombres-cond').val(),
        apellidos: $('#apellidos-cond').val(),
        direccion: $('#direccion-cond').val(),
        telefono: $('#telefono-cond').val(),
        correo: $('#correo-cond').val(),
        fechaNacimiento: $('#fecha-nacimiento-cond').val(),
        genero: $('input:radio[name=genero]:checked').val() == undefined ? "" : $('input:radio[name=genero]:checked').val(),
        tipoLicencia: $('#clase-licencia-cond').val(),
        numeroLicencia: $('#numero-licencia-cond').val(),
        usuario: 'admin',
        accion: ''
    };
    return registro;
}

function recuperarDatosVehiculo() {
    let registro = {
        placa: $('#placa-veh').val(),
        tipo: $('input:radio[name=tipo-veh]:checked').val(),
        marca: $('#marca-veh').val(),
        linea: $('#linea-veh').val(),
        modelo: $('#modelo-veh').val(),
        servicio: $('#servicio-veh').val(),
        cilindraje: $('#cilindraje-veh').val(),
        chasis: $('#chasis-veh').val().toUpperCase(),
        motor: $('#motor-veh').val().toUpperCase(),
        color: $('#color-veh').val(),
        tcarroceria: $('#tcarroceria-veh').val(),
        cedula: $('#documento-veh').val(),
        usuario: 'admin',
        accion: ''
    };
    return registro;
}

function recuperarCedulaConsulta() {
    let data = {
        cedula: $('#cedula-usu').val(),
        accion: ''
    };
    return data;
}

function recuperarDatosReportes() {
    let data = {
        tipoveh: $('#tipo-veh').val(),
        finicio: $('#fecha-inicio').val(),
        ffinal: $('#fecha-final').val(),
        accion: $('#parametro').val()
    };
    return data;
}

function limpiarElementosAdmin() {
    $('#cedula-adm').val('');
    $('#nombres-adm').val('');
    $('#cargo').val('');
    $('#pass-adm').val('');
    $('#pass-rep-adm').val('');
}

function limpiarElementosVig() {
    $('#cedula-vig').val('');
    $('#nombres-vig').val('');
    $('#turno').val('');
    $('#rol').val('');
    $('#pass-vig').val('');
    $('#pass-rep-vig').val('');
    $('#documentoadm').val('');
}

function habilitarModificarEliminar() {
    $('.consultas').addClass('ocultar');
    $('.ingresar').addClass('ocultar');
    $('#modificar-eliminar').removeClass('ocultar');
}

function consultarUsuario(usuario) {
    switch (usuario) {
        case "adm":
            consultarYLlenarDatosAdministrador();
            break;
        case "vig":
            consultarYLlenarDatosVigilante();
            break;
    }
}

function llenarInfoConductor() {
    $('#tipo-documento-cond-info').text(dataCond[0].tipo_documento);
    $('#documento-cond-info').text(dataCond[0].documento);
    $('.nombres-cond').text(dataCond[0].nombres);
    $('#apellidos-cond-info').text(dataCond[0].apellidos);
}

function limpiarFormConductor() {
    $('#documento-cond').val("");
    $('#tipo-documento-cond').val("");
    $('#nombres-cond').val("");
    $('#direccion-cond').val("");
    $('#apellidos-cond').val("");
    $('#telefono-cond').val("");
    $('#correo-cond').val("");
    $('#fecha-nacimiento-cond').val("");
    $('input:radio[name=genero]').prop('checked', false);
    $('#clase-licencia-cond').val("");
    $('#numero-licencia-cond').val("");   
}

function limpiarDatosVehiculo() {
    $('#placa-veh').val("");
    $('input:radio[name=tipo-veh]').prop('checked', false);
    $('#marca-veh').val("");
    $('#linea-veh').val("");
    $('#modelo-veh').val("");
    $('#servicio-veh').val("");
    $('#cilindraje-veh').val("");
    $('#chasis-veh').val("");
    $('#motor-veh').val("");
    $('#color-veh').val("");
    $('#tcarroceria-veh').val("");
    $('#documento-veh').val("");
}

function mostrarDatosRegistroConductor() {
    $('#documento-cond').val(dataCond[0].documento);
    $('#tipo-documento-cond').val(dataCond[0].tipo_documento);
    $('#nombres-cond').val(dataCond[0].nombres);
    $('#direccion-cond').val(dataCond[0].direccion);
    $('#apellidos-cond').val(dataCond[0].apellidos);
    $('#telefono-cond').val(dataCond[0].telefono);
    $('#correo-cond').val(dataCond[0].correo);
    $('#fecha-nacimiento-cond').val(dataCond[0].fecha_nacimiento);
    $('input:radio[name=genero][value="' + dataCond[0].genero + '"]').prop('checked', 'true');
    $('#clase-licencia-cond').val(dataCond[0].tipo_licencia);
    $('#numero-licencia-cond').val(dataCond[0].numero_licencia);    
}

function visualizacionFormConductor(disabledField, button) {
    $('.buttons-conductor-modal').addClass("d-none");
    $('#form-conductor').prop("disabled", disabledField);
    $(button).removeClass("d-none");
}

function visualizacionFormVehiculo(disabledField, button) {
    $('.buttons-vehiculo-modal').addClass("d-none");
    $('#form-vehiculo').prop("disabled", disabledField);
    $(button).removeClass("d-none");
}

function visualizacionBotonesVerificarVehiculo(button) {
    $('.buttons-validar-vehiculo-modal').addClass("d-none");
    if(button != undefined) {
        $(button).removeClass("d-none");
    }
}

function cargarAdministradores() {
    let data = {
        accion: 'listar'
    };
    $.ajax({
        url: 'controlador/controlador_administrador.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            let data = JSON.parse(resp);
            if (data[0] != "null") {
                llenarComboAdministradores(data);
            } else {
                alert("No existe administradores\nPor favor, ingrese uno para continuar");
            }
        },
        error: function () {
            alert("Hubo un problema al registrar el propietario, intentelo más tarde");
        }
    });
}

function llenarComboAdministradores(data) {
    $('#documentoadm').empty();
    data.forEach(function (element, index) {
        $('#documentoadm').append(`<option value="${element.documento}">${element.nombres} - ${element.documento}</option>`);
    });
}

function activarComponentesReportes() {
    let param = $('#parametro').val();
    switch (param) {
        case "nvt":
            $('#tipo-veh').removeAttr('disabled');
            $('#fecha-inicio').prop('disabled', 'true');
            $('#fecha-final').prop('disabled', 'true');
            break;
        case "vif":
            $('#tipo-veh').prop('disabled', 'true');
            $('#fecha-inicio').removeAttr('disabled');
            $('#fecha-final').removeAttr('disabled');
            break;
        case "vef":
            $('#tipo-veh').prop('disabled', 'true');
            $('#fecha-inicio').removeAttr('disabled');
            $('#fecha-final').removeAttr('disabled');
            break;
    }
}

function setMinDateFechaFinal() {
    let fechaMinima = $('#fecha-inicio').val();
    $('#fecha-final').attr('min', fechaMinima);
}


function registrarAdministrador() {
    let data = recuperarDatosAdministrador();
    data.accion = 'registrar';
    $.ajax({
        url: 'controlador/controlador_administrador.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            if (resp == "null") {
                alert("Solicitud ejecutada con éxito");
                limpiarElementosAdmin();
                cargarAdministradores();
            } else {
                alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
            }
        },
        error: function () {
            alert("Hubo un problema al registrar el administrador, intentelo más tarde");
        }
    });
}

function registrarVigilante() {
    let data = recuperarDatosVigilante();
    data.accion = 'registrar';
    $.ajax({
        url: 'controlador/controlador_vigilante.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            if (resp == "null") {
                alert("Solicitud ejecutada con éxito");
                limpiarElementosVig();
            } else {
                alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
            }
        },
        error: function () {
            alert("Hubo un problema al registrar el vigilante, intentelo más tarde");
        }
    });
}

function actualizarAdministrador() {
    let data = recuperarDatosAdministrador();
    data.accion = 'actualizar';
    $.ajax({
        url: 'controlador/controlador_administrador.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            if (resp == "null") {
                alert("Solicitud ejecutada con éxito");
                limpiarElementosAdmin();
                cargarAdministradores();
                $('#administrador').addClass('ocultar');
                $('#modificar-eliminar').addClass('ocultar');
                $('#cedula-usu').val('');
                $('#cedula-usu').focus();
            } else {
                alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
            }
        },
        error: function () {
            alert("Hubo un problema al actualizar el administrador, intentelo más tarde");
        }
    });
}

function actualizarVigilante() {
    let data = recuperarDatosVigilante();
    data.accion = 'actualizar';
    $.ajax({
        url: 'controlador/controlador_vigilante.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            if (resp == "null") {
                alert("Solicitud ejecutada con éxito");
                limpiarElementosVig();
                $('#vigilante').addClass('ocultar');
                $('#modificar-eliminar').addClass('ocultar');
                $('#cedula-usu').val('');
                $('#cedula-usu').focus();
            } else {
                alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
            }
        },
        error: function () {
            alert("Hubo un problema al actualizar el vigilante, intentelo más tarde");
        }
    });
}

function eliminarAdministrador() {
    let data = recuperarCedulaConsulta();
    data.accion = 'eliminar';
    if (confirm("¿Esta seguro de eliminar el administrador?")) {
        $.ajax({
            url: 'controlador/controlador_administrador.php',
            type: 'POST',
            data: data,
            success: function (resp) {
                if (resp == "null") {
                    alert("Solicitud ejecutada con éxito");
                    limpiarElementosVig();
                    cargarAdministradores();
                    $('#administrador').addClass('ocultar');
                    $('#modificar-eliminar').addClass('ocultar');
                    $('#cedula-usu').val('');
                    $('#cedula-usu').focus();
                } else {
                    alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
                }
            },
            error: function () {
                alert("Hubo un problema al registrar el vigilante, intentelo más tarde");
            }
        });
    }
}

function eliminarVigilante() {
    let data = recuperarCedulaConsulta();
    data.accion = 'eliminar';
    if (confirm("¿Esta seguro de eliminar el vigilante?")) {
        $.ajax({
            url: 'controlador/controlador_vigilante.php',
            type: 'POST',
            data: data,
            success: function (resp) {
                if (resp == "null") {
                    alert("Solicitud ejecutada con éxito");
                    limpiarElementosVig();
                    $('#vigilante').addClass('ocultar');
                    $('#modificar-eliminar').addClass('ocultar');
                    $('#cedula-usu').val('');
                    $('#cedula-usu').focus();
                } else {
                    alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
                }
            },
            error: function () {
                alert("Hubo un problema al registrar el vigilante, intentelo más tarde");
            }
        });
    }
}

function consultarYLlenarDatosAdministrador() {
    let data = recuperarCedulaConsulta();
    data.accion = 'consultar';
    $.ajax({
        url: 'controlador/controlador_administrador.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            let data = JSON.parse(resp);
            if (data[0] != "null") {
                $('#cedula-adm').val(data[0].documento);
                $('#nombres-adm').val(data[0].nombres);
                $('#cargo').val(data[0].cargo);
                $('#pass-adm').val(data[0].contrasena);
                $('#pass-rep-adm').val(data[0].contrasena.split("").reverse().join(""));
                habilitarModificarEliminar();
                $('#administrador').removeClass('ocultar');
            } else {
                alert("No se encontró el administrador\nVerifique el número de cédula o el administrador no existe");
            }
        },
        error: function () {
            alert("Hubo un problema al registrar el propietario, intentelo más tarde");
        }
    });
}

function consultarYLlenarDatosVigilante() {
    let data = recuperarCedulaConsulta();
    data.accion = 'consultar';
    $.ajax({
        url: 'controlador/controlador_vigilante.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            let data = JSON.parse(resp);
            if (data[0] != "null") {
                $('#cedula-vig').val(data[0].documento);
                $('#nombres-vig').val(data[0].nombres);
                $('#turno').val(data[0].turno);
                $('#rol').val(data[0].rol);
                $('#pass-vig').val(data[0].contrasena);
                $('#pass-rep-vig').val(data[0].contrasena.split("").reverse().join(""));
                $('#documentoadm').val(data[0].documento_adm);
                habilitarModificarEliminar();
                $('#vigilante').removeClass('ocultar');
            } else {
                alert("No se encontró el vigilante\nVerifique el número de cédula o el vigilante no existe");
            }
        },
        error: function () {
            alert("Hubo un problema al registrar el propietario, intentelo más tarde");
        }
    });
}

function consultarConductor(id) {
    let data = {
        cedula: id,
        accion: 'consultar'
    };
    $.ajax({
        url: 'controlador/controlador_propietario.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            dataCond = JSON.parse(resp);
            if (dataCond.length > 0) {
                $('#info-cond').removeClass('d-none');
                llenarInfoConductor();
                mostrarVehiculosPorConductor(dataCond[0].documento);
            } else {
                $('#nuevo-conductor-modal').modal('show');
                $('#new-doc').text(id);
                limpiarFormConductor();
                $('#documento-cond').val(id);
            }
        },
        error: function () {
            alert("Hubo un problema al registrar el vigilante, intentelo más tarde");
        }
    });
}

function RegistrarConductor() {
    let data = recuperarDatosConductor();
    data.accion = 'registrar';
    $.ajax({
        url: 'controlador/controlador_propietario.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            recargarConsultaConductor(resp, data.cedula);
            visualizacionFormConductor(false, '#btnRegistrarConductor');
            $('#btnRegistrarConductor').removeAttr('disabled');
        },
        error: function () {
            alert("problema");
        }
    });
}

function ActualizarConductor() {
    let data = recuperarDatosConductor();
    data.accion = 'actualizar';
    $.ajax({
        url: 'controlador/controlador_propietario.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            recargarConsultaConductor(resp, data.cedula);
            visualizacionFormConductor(false, '#btnActualizarConductor');
            $('#btnActualizarConductor').removeAttr('disabled');
        },
        error: function () {
            alert("problema");
        }
    });
}

function validarAsociaciónVehiculo(placa) {
    let data = {
        placa: placa,
        cedula: dataCond[0].documento,
        accion: 'obtener'
    };
    $.ajax({
        url: 'controlador/controlador_vehiculo.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            let dataAso = JSON.parse(resp);
            if (dataAso.length > 0) {
                $('#info-vehiculo').removeClass('d-none');
                $('#new-placa').text(placa);
                $('#no-vehiculo').addClass('d-none');
                $('#pregunta-vehiculo').text("Ya esta asociado al conductor actual");
            } else {
                consultarVehiculo(data.placa);
            }
        },
        error: function () {
            alert("Hubo un problema al registrar el vigilante, intentelo más tarde");
        }
    });
}

function consultarVehiculo(placa) {
    let data = {
        placa: placa,
        accion: 'consultar'
    };
    $.ajax({
        url: 'controlador/controlador_vehiculo.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            let dataVeh = JSON.parse(resp);
            $('#info-vehiculo').removeClass('d-none');
            $('#new-placa').text(placa);
            if (dataVeh.length > 0) {
                $('#no-vehiculo').addClass('d-none');
                $('#pregunta-vehiculo').text("¿Desea asociarlo al conductor actual?");
                visualizacionBotonesVerificarVehiculo('#btnAsociarVehiculo');
            } else {
                $('#no-vehiculo').removeClass('d-none');
                $('#pregunta-vehiculo').text("¿Desea crear y asociar este vehículo?");
                visualizacionBotonesVerificarVehiculo('#btnCrearNuevoVehiculo');
                limpiarDatosVehiculo();
                $('#documento-veh').val(dataCond[0].documento);
                $('#placa-veh').val(placa);
            }
        },
        error: function () {
            alert("Hubo un problema al registrar el vigilante, intentelo más tarde");
        }
    });
}

function RegistrarVehiculo() {
    let data = recuperarDatosVehiculo();
    data.accion = "registrar";
    $.ajax({
        url: 'controlador/controlador_vehiculo.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            if(resp == "null") {
                AsociarConductorVehiculo(false);
            } else {
                alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
            }
        },
        error: function () {
            alert("Hubo un problema al registrar el vehiculo, intentelo más tarde");
            activarChecks();
        }
    });
}

function AsociarConductorVehiculo(desdeVerificarVehiculo) {
    let data = {
        placa: $('#placa-veh-search').val().toUpperCase(),
        cedula: dataCond[0].documento,
        accion: 'asociar',
        usuario: 'admin'
    }
    $.ajax({
        url: 'controlador/controlador_registro.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            if(resp != 0) {
                if(desdeVerificarVehiculo) {
                    $('#verificar-vehiculo-modal').modal('hide');
                } else {
                    $('#registro-vehiculo-modal').modal('hide');
                    $('#btnRegistrarVehiculo').removeAttr('disabled');
                }
                mostrarVehiculosPorConductor(data.cedula);
            } else {
                alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
            }
        },
        error: function () {
            alert("Hubo un problema al registrar el vehiculo, intentelo más tarde");
            activarChecks();
        }
    });
}

function mostrarVehiculosPorConductor(id) {
    let data = {
        cedula: id,
        accion: 'adquirir'
    }
    generarTabla(data, "#tablavehiculosporconductor", "vehiculo");
}

function recargarConsultaConductor(resp, documento) {
    if(resp == "null") {
        $('#registro-conductor-modal').modal('hide');
        consultarConductor(documento);
    } else {
        alert("Ocurrió un problema mientras se completaba el registro del propietario");
    }
}

function generarReporte() {
    let data = recuperarDatosReportes();
    generarTabla(data, "#tablavehiculos", "administrador");
}

function generarTabla(data, table, controller) {
    $(table).empty();
    if(tabla != null) {
        tabla.destroy();
    }
    tabla = $(table).DataTable({
        "scrollX": true,
        "responsive": true,
        "ajax": {
            url: "controlador/controlador_" + controller + ".php",
            data: data,
            type: "POST",
            dataSrc: ""
        },
        "columns": [{
                "data": "placa",
                "title": "Placa"
            },
            {
                "data": "tipo",
                "title": "Tipo Vehículo"
            },
            {
                "data": "marca",
                "title": "Marca"
            },
            {
                "data": "linea",
                "title": "Línea"
            },
            {
                "data": "modelo",
                "title": "Modelo"
            },
            {
                "data": "servicio",
                "title": "Servicio"
            },
            {
                "data": "cilindraje",
                "title": "Cilindraje"
            },
            {
                "data": "chasis",
                "title": "Chasis"
            },
            {
                "data": "motor",
                "title": "Motor"
            },
            {
                "data": "color",
                "title": "Color"
            },
            {
                "data": "tipo_carroceria",
                "title": "Tipo carroceria"
            }
        ],
        "language": {
            "url": "js/spanish.json",
        },
    });
    new $.fn.dataTable.FixedHeader(tabla);
}
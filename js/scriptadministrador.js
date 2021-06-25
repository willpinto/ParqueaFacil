var dataAdministradores, tabla, altTabla, dataCond;

$(document).ready(function () {
    let hoy = new Date();
    let mes = hoy.getMonth() + 1;
    let dia = hoy.getDate();
    let hoyString = hoy.getFullYear() + "-" + (mes < 10 ? "0" + mes : mes) + "-" + (dia < 10 ? "0" + dia : dia);
    $('#fecha-inicio').val(hoyString).attr('max', hoyString);
    $('#fecha-final').val(hoyString).attr({ 'max': hoyString, 'min': hoyString });
});

function validarContrasenasAdmin(accion) {
    let pass = $('#pass-adm').val();
    let passr = $('#pass-rep-adm').val();
    if (pass == passr) {
        visualizacionForm(true, `#btn${accion}Administrador`, "administrador");
        $(`#btn${accion}Administrador`).prop('disabled', true);
        if(accion == "Guardar") {
            registrarAdministrador();
        } else {
            actualizarAdministrador();
        }
    } else {
        alert("Las contraseñas no son iguales\nPor favor, rectifique antes de registrar");
    }
}

function validarContrasenasVig(accion) {
    let pass = $('#pass-vig').val();
    let passr = $('#pass-rep-vig').val();
    if (pass == passr) {
        visualizacionForm(true, `#btn${accion}Vigilante`, "vigilante");
        $(`#btn${accion}Vigilante`).prop('disabled', true);
        if(accion == "Guardar") {
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
        cargo: $('#cargo-adm').val(),
        contrasena: $('#pass-adm').val(),
        accion: ''
    };
    return data;
}

function recuperarDatosVigilante() {
    let data = {
        cedula: $('#cedula-vig').val(),
        nombres: $('#nombres-vig').val(),
        turno: $('#turno-vig').val(),
        rol: $('#rol-vig').val(),
        contrasena: $('#pass-vig').val(),
        documentoadm: $('#documento-adm-vig').val(),
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
        usuario: 'admin',
        accion: ''
    };
    return registro;
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

function recuperarCedulaConsulta(usuario) {
    let data = {
        cedula: $('#cedula-' + usuario).val(),
        accion: ''
    };
    return data;
}

function limpiarElementosAdmin() {
    $('#cedula-adm').val('');
    $('#nombres-adm').val('');
    $('#cargo-adm').val('');
    $('#pass-adm').val('');
    $('#pass-rep-adm').val('');
}

function limpiarElementosVig() {
    $('#cedula-vig').val('');
    $('#nombres-vig').val('');
    $('#turno-vig').val('');
    $('#rol-vig').val('');
    $('#pass-vig').val('');
    $('#pass-rep-vig').val('');
    $('#documento-adm-vig').val('');
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

function visualizacionForm(disabledField, button, entity) {
    $(`.buttons-${entity}-modal`).addClass("d-none");
    $(`#form-${entity}`).prop("disabled", disabledField);
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
            if (data.length > 0) {
                llenarComboAdministradores(data);
            } else {
                alert("No existe administradores\nPor favor, ingrese uno para continuar");
            }
        },
        error: function () {
            alert("Hubo un problema al cargar los administradores, intentelo más tarde");
        }
    });
}

function llenarComboAdministradores(data) {
    $('#documento-adm-vig').empty();
    data.forEach(function (element, index) {
        $('#documento-adm-vig').append(`<option value="${element.documento}">${element.nombres} - ${element.documento}</option>`);
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

function llenarDatosAdministrador(data) {
    $('#cedula-adm').val(data.documento);
    $('#nombres-adm').val(data.nombres);
    $('#cargo-adm').val(data.cargo);
    $('#pass-adm').val(data.contrasena);
    $('#pass-rep-adm').val(data.contrasena.split("").reverse().join(""));
    visualizacionForm(true, '#btnEditarAdministrador', "administrador");
    $('#btnEliminarAdministrador').removeClass("d-none");
    $('#cedula-adm').prop("disabled", true);
    $('#administrador-modal').modal("show");
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
                alert("Se ha registrado el administrador correctamente");
                limpiarElementosAdmin();
                $('#btnGuardarAdministrador').removeAttr('disabled');
                $('#administrador-modal').modal("hide");
                prepararGeneracionTabla({ accion: "listar" }, "#tablaadministrador", "administrador", true);
            } else {
                alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
                visualizacionForm(false, '#btnGuardarAdministrador', "administrador");
                $('#btnGuardarAdministrador').removeAttr('disabled');
            }
        },
        error: function () {
            alert("Hubo un problema al registrar el administrador, intentelo más tarde");
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
                alert("Se ha actualizado el administrador correctamente");
                limpiarElementosAdmin();
                $('#btnActualizarAdministrador').removeAttr('disabled');
                $('#administrador-modal').modal("hide");
                prepararGeneracionTabla({ accion: "listar" }, "#tablaadministrador", "administrador", true);
            } else {
                alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
                visualizacionForm(false, '#btnActualizarAdministrador', "administrador");
                $('#btnActualizarAdministrador').removeAttr('disabled');
            }
        },
        error: function () {
            alert("Hubo un problema al actualizar el administrador, intentelo más tarde");
        }
    });
}

function eliminarAdministrador() {
    let data = recuperarCedulaConsulta("adm");
    data.accion = 'eliminar';
    if (confirm("¿Esta seguro de eliminar el administrador?")) {
        $.ajax({
            url: 'controlador/controlador_administrador.php',
            type: 'POST',
            data: data,
            success: function (resp) {
                if (resp == "null") {
                    alert("Se ha eliminado el administrador correctamente");
                    limpiarElementosVig();
                    $('#administrador-modal').modal("hide");
                    prepararGeneracionTabla({ accion: "listar" }, "#tablaadministrador", "administrador", true);
                } else {
                    alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
                }
            },
            error: function () {
                alert("Hubo un problema al eliminar el administrador, intentelo más tarde");
            }
        });
    }
}

function llenarDatosVigilante(data) {
    $('#cedula-vig').val(data.documento);
    $('#nombres-vig').val(data.nombres);
    $('#turno-vig').val(data.turno);
    $('#rol-vig').val(data.rol);
    $('#pass-vig').val(data.contrasena);
    $('#pass-rep-vig').val(data.contrasena.split("").reverse().join(""));
    $('#documento-adm-vig').val(data.documento_adm);
    visualizacionForm(true, '#btnEditarVigilante', "vigilante");
    $('#btnEliminarVigilante').removeClass("d-none");
    $('#cedula-vig').prop("disabled", true);
    $('#vigilante-modal').modal("show");
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
                alert("Se ha registrado el vigilante correctamente");
                $('#vigilante-modal').modal("hide");
                limpiarElementosVig();
                $('#btnGuardarVigilante').removeAttr('disabled');
                prepararGeneracionTabla({ accion: "listar" }, "#tablavigilante", "vigilante", true);
            } else {
                alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
                visualizacionForm(false, '#btnGuardarVigilante', "vigilante");
                $('#btnGuardarVigilante').removeAttr('disabled');
            }
        },
        error: function () {
            alert("Hubo un problema al registrar el vigilante, intentelo más tarde");
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
                alert("Se ha actualizado el vigilante correctamente");
                limpiarElementosVig();
                $('#btnActualizarVigilante').removeAttr('disabled');
                $('#vigilante-modal').modal("hide");
                prepararGeneracionTabla({ accion: "listar" }, "#tablavigilante", "vigilante", true);
            } else {
                alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
                visualizacionForm(false, '#btnActualizarVigilante', "vigilante");
                $('#btnActualizarVigilante').removeAttr('disabled');
            }
        },
        error: function () {
            alert("Hubo un problema al actualizar el vigilante, intentelo más tarde");
        }
    });
}

function eliminarVigilante() {
    let data = recuperarCedulaConsulta("vig");
    data.accion = 'eliminar';
    if (confirm("¿Esta seguro de eliminar el vigilante?")) {
        $.ajax({
            url: 'controlador/controlador_vigilante.php',
            type: 'POST',
            data: data,
            success: function (resp) {
                if (resp == "null") {
                    alert("Se ha eliminado el vigilante correctamente");
                    limpiarElementosVig();
                    $('#vigilante-modal').modal("hide");
                    prepararGeneracionTabla({ accion: "listar" }, "#tablavigilante", "vigilante", true);
                } else {
                    alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
                }
            },
            error: function () {
                alert("Hubo un problema al eliminar el vigilante, intentelo más tarde");
            }
        });
    }
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
            alert("Hubo un problema al registrar el conductor, intentelo más tarde");
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
            visualizacionForm(false, '#btnRegistrarConductor', "conductor");
            $('#btnRegistrarConductor').removeAttr('disabled');
        },
        error: function () {
            alert("Hubo un problema al registrar el conductor, intentelo más tarde");
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
            visualizacionForm(false, '#btnActualizarConductor', "conductor");
            $('#btnActualizarConductor').removeAttr('disabled');
        },
        error: function () {
            alert("Hubo un problema al actualizar el conductor, intentelo más tarde");
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
                visualizacionBotonesVerificarVehiculo();
            } else {
                consultarVehiculo(data.placa);
            }
        },
        error: function () {
            alert("Hubo un problema al validar el asociamiento del vehículo, intentelo más tarde");
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
                $('#placa-veh').val(placa);
            }
        },
        error: function () {
            alert("Hubo un problema al consultar el vehículo, intentelo más tarde");
        }
    });
}

function llenarDatosVehiculo(data) {
    $('#placa-veh').val(data.placa);
    $(`input:radio[name=tipo-veh][value=${data.tipo}]`).prop('checked', true);
    $('#marca-veh').val(data.marca);
    $('#linea-veh').val(data.linea);
    $('#modelo-veh').val(data.modelo);
    $('#servicio-veh').val(data.servicio);
    $('#cilindraje-veh').val(data.cilindraje);
    $('#chasis-veh').val(data.chasis);
    $('#motor-veh').val(data.motor);
    $('#color-veh').val(data.color);
    $('#tcarroceria-veh').val(data.tipo_carroceria);
    visualizacionForm(true, '#btnEditarVehiculo', "vehiculo");
    $('#btnEliminarVehiculo').removeClass("d-none");
    $('#placa-veh').prop("disabled", true);
    $('#vehiculo-modal').modal("show");
}

function RegistrarVehiculo(esGestionar) {
    let data = recuperarDatosVehiculo();
    data.accion = "registrar";
    $.ajax({
        url: 'controlador/controlador_vehiculo.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            if(resp == "null") {
                if(esGestionar) {
                    alert("Se ha registrado el vehículo correctamente");
                    limpiarDatosVehiculo();
                    $('#vehiculo-modal').modal('hide');
                    $('#btnGuardarVehiculo').removeAttr('disabled');
                    prepararGeneracionTabla({ accion: "listar" }, '#tablavehiculo', "vehiculo", true);
                } else {
                    AsociarConductorVehiculo(false);
                }
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
                    $('#vehiculo-modal').modal('hide');
                    $('#btnGuardarVehiculo').removeAttr('disabled');
                }
                mostrarVehiculosPorConductor(data.cedula);
            } else {
                alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
            }
        },
        error: function () {
            alert("Hubo un problema al asociar el vehiculo, intentelo más tarde");
            activarChecks();
        }
    });
}

function actualizarVehiculo() {
    let data = recuperarDatosVehiculo();
    data.accion = 'actualizar';
    $.ajax({
        url: 'controlador/controlador_vehiculo.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            if (resp == "null") {
                alert("Se ha actualizado el vehiculo correctamente");
                limpiarDatosVehiculo();
                $('#btnActualizarVehiculo').removeAttr('disabled');
                $('#vehiculo-modal').modal("hide");
                prepararGeneracionTabla({ accion: "listar" }, "#tablavehiculo", "vehiculo", true);
            } else {
                alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
                visualizacionForm(false, '#btnActualizarVehiculo', "vehiculo");
                $('#btnActualizarVehiculo').removeAttr('disabled');
            }
        },
        error: function () {
            alert("Hubo un problema al actualizar el vehiculo, intentelo más tarde");
        }
    });
}

function eliminarVehiculo() {
    let data = {
        placa: $('#placa-veh').val(),
        accion: "eliminar" 
    };
    if (confirm("¿Esta seguro de eliminar el vehiculo?")) {
        $.ajax({
            url: 'controlador/controlador_vehiculo.php',
            type: 'POST',
            data: data,
            success: function (resp) {
                if (resp == "null") {
                    alert("Se ha eliminado el vehiculo correctamente");
                    limpiarDatosVehiculo();
                    $('#vehiculo-modal').modal("hide");
                    prepararGeneracionTabla({ accion: "listar" }, "#tablavehiculo", "vehiculo", true);
                } else {
                    alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
                }
            },
            error: function () {
                alert("Hubo un problema al eliminar el vehiculo, intentelo más tarde");
            }
        });
    }
}

function mostrarVehiculosPorConductor(id) {
    let data = {
        cedula: id,
        accion: 'adquirir'
    }
    prepararGeneracionTabla(data, "#tablavehiculosporconductor", "vehiculo", false, "conductor");
}

function llenarDatosRegistro(data){
    let dataIn = {
        id: data.numero_ticket,
        accion: 'mostrar'
    }
    $('#novedad-modal').modal("show");
    prepararGeneracionTabla(dataIn, '#tablanovedad', "novedad", false, "", true);
}

function generarReporte() {
    let data = recuperarDatosReportes();
    prepararGeneracionTabla(data, "#tablavehiculos", "administrador", false, "reportes");
}

function recargarConsultaConductor(resp, documento) {
    if(resp == "null") {
        $('#registro-conductor-modal').modal('hide');
        consultarConductor(documento);
    } else {
        alert("Ocurrió un problema mientras se completaba el registro del propietario");
    }
}

function prepararGeneracionTabla(dataIn, table, controller, withDetails, plus = "", altTable = false) {
    $.ajax({
        url: `controlador/controlador_${controller}.php`,
        type: 'POST',
        data: dataIn,
        success: function (resp) {
            let data = JSON.parse(resp), objectColumnas;
            if(data.length > 0) {
                objectColumnas = cargarObjetoColumnas(Object.keys(data[0]), withDetails);
                if(altTable) {
                    generarTablaAlternativa(data, table, objectColumnas);
                } else {
                    generarTabla(data, table, objectColumnas);
                }
                asignarEventoBotonDetails(withDetails, controller);
                $(`#mensaje${controller}${plus}`).addClass("d-none");
            } else {
                //alert("Hubo un fallo interno\nVuelvalo a intentar más tarde");
                $(`#mensaje${controller}${plus}`).removeClass("d-none");
                if(altTable) {
                    destruirTablaAlternativa(table);
                } else {
                    destruirTabla(table);
                }
            }
        },
        error: function () {
            alert("Hubo un problema al preparar la generación de la tabla, intentelo más tarde");
            activarChecks();
        }
    })
}

function cargarObjetoColumnas(keys, withDetails) {
    let columns = [], object;
    keys.forEach(function(item, index) {
        object = {
            "data": item,
            "title": item.replace(/_/, " ").replace(/^\w/, function(c) { return c.toUpperCase(); })
        };
        columns.push(object);
    });
    if(withDetails) {
        object = {
            "data": null,
            "title": "Detalles",
            "className": "dt-center",
            "defaultContent": `<button class="btn btn-info details"><i class="fa fa-info-circle"/></button>`,
            "orderable": false
        };
        columns.push(object);
    }
    return columns;
}

function destruirTablaAlternativa(table) {
    $(table).empty();
    if(altTabla != null) {
        altTabla.destroy();
        $(`${table} thead`).remove();
    }
}

function destruirTabla(table) {
    $(table).empty();
    if(tabla != null) {
        tabla.destroy();
        $(`${table} thead`).remove();
    }
}

function generarTablaAlternativa(dataOut, table, columns) {
    destruirTablaAlternativa(table);
    altTabla = $(table).DataTable({
        "scrollX": true,
        "responsive": true,
        "fixedHeader": true,
        "data": dataOut,
        "columns": columns,
        "language": {
            "url": "js/spanish.json",
        },
    });
}

function generarTabla(dataOut, table, columns) {
    destruirTabla(table);
    tabla = $(table).DataTable({
        "scrollX": true,
        "responsive": true,
        "fixedHeader": true,
        "data": dataOut,
        "columns": columns,
        "language": {
            "url": "js/spanish.json",
        },
    });
}

function asignarEventoBotonDetails(withDetails, table) {
    if(withDetails) {
        $(`#tabla${table} tbody`).on('click', 'button.details', function() {
            let data = tabla.row($(this).parents('tr')).data();
            window[`llenarDatos${table.replace(/^\w/, function(c) { return c.toUpperCase(); })}`].apply(this, [data]);
            $(`#titulo-${table}-modal`).text(`Detalles ${table}`);
        });
    }
}
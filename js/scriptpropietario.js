var dataInfo, dataPropietario, dataVehiculo, faltaRegistroVehiculo;
var tableMisVehiculos;

$(document).ready(function () {
    let fechaPermitida = new Date();
    fechaPermitida.setFullYear(fechaPermitida.getFullYear() - 16);
    let anio = fechaPermitida.getFullYear()
    let mes = fechaPermitida.getMonth() < 9 ? "0" + (fechaPermitida.getMonth() + 1) : (fechaPermitida.getMonth() + 1);
    let dia = fechaPermitida.getDate() < 10 ? "0" + fechaPermitida.getDate() : fechaPermitida.getDate();
    $('#fecha-nacimiento').prop('max', anio + "-" + mes + "-" + dia);

    $('#txtTC').text("Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati tempore quaerat nulla dolorum earum quam numquam labore doloremque consequatur quas facilis, tenetur voluptas facere alias sed harum aspernatur ducimus minima!");

    faltaRegistroVehiculo = true;

    cargarNovedades();
    setInterval(cargarNovedades, 1000);
    
    activarInfoPropietario();
    inicializarTableMisVehiculos();
});

function activarInfoPropietario() {
    dataInfo = recuperarDatosInfo();
    ObtenerDatosPropietario();
}

function GuardarRegistroPropietario() {
    let registroPropietario = recuperarDatosPropietario();
    confirmarRegistroPropietario(registroPropietario);
}

function GuardarRegistroVehiculo() {
    let registroVehiculo = recuperarDatosVehiculo();
    confirmarRegistroVehiculo(registroVehiculo);
}

function recuperarDatosVehiculo() {
    let registro = {
        placa: $('#placa').val(),
        tipo: $('input:radio[name=tipo-veh]:checked').val() == undefined ? "" : $('input:radio[name=tipo-veh]:checked').val(),
        marca: $('#marca').val(),
        linea: $('#linea').val(),
        modelo: $('#modelo').val(),
        servicio: $('#servicio').val(),
        cilindraje: $('#cilindraje').val(),
        chasis: $('#chasis').val().toUpperCase(),
        motor: $('#motor').val().toUpperCase(),
        color: $('#color').val(),
        tcarroceria: $('#tcarroceria').val(),
        cedula: $('#cedula').val(),
        usuario: 'prop',
        accion: ''
    };
    return registro;
}

function recuperarDatosPropietario() {
    let registro = {
        cedula: $('#documento').val(),
        tipoDocumento: $('#tipo-documento').val(),
        nombres: $('#nombres').val(),
        apellidos: $('#apellidos').val(),
        direccion: $('#direccion').val(),
        telefono: $('#telefono').val(),
        correo: $('#correo').val(),
        fechaNacimiento: $('#fecha-nacimiento').val(),
        genero: $('input:radio[name=genero]:checked').val() == undefined ? "" : $('input:radio[name=genero]:checked').val(),
        tipoLicencia: $('#clase-licencia').val(),
        numeroLicencia: $('#numero-licencia').val(),
        usuario: 'prop',
        accion: ''
    };
    return registro;
}

function recuperarDatosInfo() {
    let data = {
        cedula: $('#cedula-info').val(),
        placa: $('#placa-info').val(),
        accion: ''
    };
    return data;
}

function limpiarDatosVehiculo() {
    $('#placa').val('');
    $('input:radio[name=tipo-veh]').prop('checked', false);
    $('#marca').val('');
    $('#linea').val('');
    $('#modelo').val('');
    $('#servicio').val('');
    $('#cilindraje').val('');
    $('#chasis').val('');
    $('#motor').val('');
    $('#color').val('');
    $('#tcarroceria').val('');
    $('#cedula').val('');
}

function ObtenerDatosPropietario() {
    dataInfo.accion = 'consultar';
    $.ajax({
        url: 'controlador/controlador_propietario.php',
        type: 'POST',
        data: dataInfo,
        success: function (resp) {
            dataPropietario = JSON.parse(resp);
            if(dataPropietario[0].nombres != "" && dataPropietario[0].apellidos != "") {
                $('#usuario-info').val(dataPropietario[0].nombres + " " + dataPropietario[0].apellidos)
            }
            ObtenerDatosVehiculo();
        },
        error: function () {
            alert("problema");
        }
    });
}

function ObtenerDatosVehiculo() {
    dataInfo.accion = 'obtener';
    $.ajax({
        url: 'controlador/controlador_vehiculo.php',
        type: 'POST',
        data: dataInfo,
        success: function (resp) {
            dataVehiculo = JSON.parse(resp);
            ValidarBotones();
        },
        error: function () {
            alert("problema");
        }
    });
}

function ValidarBotones() {
    if (dataPropietario[0].tipo_documento == "" || dataPropietario[0].nombres == "" || dataPropietario[0].apellidos == "" ||
        dataPropietario[0].direccion == "" || dataPropietario[0].telefono == "" || dataPropietario[0].correo == "" ||
        dataPropietario[0].genero == "" || dataPropietario[0].tipo_licencia == "" || dataPropietario[0].numero_licencia == "") {
        $('#registrarse').removeClass('d-none');
    } else {
        $('#registrarse').addClass('d-none');
        $('#misDatos').removeAttr('disabled');
    }
    if (dataVehiculo[0].tipo == "" || dataVehiculo[0].marca == "" ||
        dataVehiculo[0].modelo == "" || dataVehiculo[0].servicio == "" || dataVehiculo[0].color == "") {
        $('#btnRegistrarVehiculoActual').removeClass('d-none');
    } else {
        $('#btnRegistrarVehiculoActual').addClass('d-none');
        faltaRegistroVehiculo = false;
    }
}

function mostrarDatosRegistroPropietario() {
    $('#documento').val(dataPropietario[0].documento);
    $('#tipo-documento').val(dataPropietario[0].tipo_documento);
    $('#nombres').val(dataPropietario[0].nombres);
    $('#direccion').val(dataPropietario[0].direccion);
    $('#apellidos').val(dataPropietario[0].apellidos);
    $('#telefono').val(dataPropietario[0].telefono);
    $('#correo').val(dataPropietario[0].correo);
    $('#fecha-nacimiento').val(dataPropietario[0].fecha_nacimiento);
    $('input:radio[name=genero][value="' + dataPropietario[0].genero + '"]').prop('checked', 'true');
    $('#clase-licencia').val(dataPropietario[0].tipo_licencia);
    $('#numero-licencia').val(dataPropietario[0].numero_licencia);    
}

function mostrarDatosRegistroVehiculo() {
    $('#placa').val(dataVehiculo[0].placa);
    $('input:radio[name=tipo-veh][value="' + dataVehiculo[0].tipo + '"]').prop('checked', 'true');
    $('#marca').val(dataVehiculo[0].marca);
    $('#linea').val(dataVehiculo[0].linea);
    $('#modelo').val(dataVehiculo[0].modelo);
    $('#servicio').val(dataVehiculo[0].servicio);
    $('#cilindraje').val(dataVehiculo[0].cilindraje);
    $('#chasis').val(dataVehiculo[0].chasis);
    $('#motor').val(dataVehiculo[0].motor);
    $('#color').val(dataVehiculo[0].color);
    $('#tcarroceria').val(dataVehiculo[0].tipo_carroceria);
    $('#cedula').val(dataPropietario[0].cedula);
}

function confirmarRegistroPropietario(data) {
    data.accion = 'actualizar';
    $.ajax({
        url: 'controlador/controlador_propietario.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            if(resp == "null") {
                $('#registro-propietario-modal').modal('hide');
                $('#tc-modal').modal('hide');
                if(faltaRegistroVehiculo) {
                    $('#registro-vehiculo-modal').modal('show');
                }
                faltaRegistroVehiculo = true;
                ObtenerDatosPropietario();
                mostrarDatosRegistroVehiculo();
            } else {
                alert("Ocurrió un problema mientras se completaba el registro del propietario");
            }
        },
        error: function () {
            alert("problema");
        }
    });
}

function confirmarRegistroVehiculo(data) {
    data.accion = 'actualizar';
    $.ajax({
        url: 'controlador/controlador_vehiculo.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            if(resp == "null") {
                $('#registro-vehiculo-modal').modal('hide');
                ObtenerDatosPropietario();
            } else {
                alert("Ocurrió un problema mientras se completaba el registro del propietario");
            }
        },
        error: function () {
            alert("problema");
        }
    });
}

function mostrarMisDatos() {
    $('#lblDocumento').text(dataPropietario[0].documento);
    $('#lblNombres').text(dataPropietario[0].nombres);
    $('#lblApellidos').text(dataPropietario[0].apellidos);
    $('#lblDireccion').text(dataPropietario[0].direccion);
    $('#lblTelefono').text(dataPropietario[0].telefono);
    $('#lblCorreo').text(dataPropietario[0].correo);
    $('#lblFechaNacimiento').text(dataPropietario[0].fecha_nacimiento);
    $('#lblGenero').text(dataPropietario[0].genero == "M" ? "Mujer" : "Hombre");
    $('#lblTipoLicencia').text(dataPropietario[0].tipo_licencia);
    $('#lblNumeroLicencia').text(dataPropietario[0].numero_licencia);
}

function cargarNovedades() {
    let data = {
        id: $('#ticket').val(),
        accion: "cargar"
    }
    $.ajax({
        url: 'controlador/controlador_novedad.php',
        type: 'POST',
        data: data,
        success: function (resp) {
            let novedades = "";
            let dataNovedades = JSON.parse(resp);
            if(dataNovedades[0] != null) {
                dataNovedades.forEach(function(element, index) {
                    novedades += `${element.descripcion} (${element.tipo})${(dataNovedades.length - 1) != index ? "\n" : ""}`;
                });
            } else { 
                novedades = "Sin novedad";
            }
            $('#novedad').val(novedades);
        },
        error: function () {
            alert("problema");
        }
    });
}

function inicializarTableMisVehiculos() {
    dataInfo.accion = 'adquirir';
    tableMisVehiculos = $("#tablavehiculos").DataTable({
        "scrollX": true,
        "ajax": {
            url: "controlador/controlador_vehiculo.php",
            data: dataInfo,
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
}

function recargarTableMisVehiculos() {
    tableMisVehiculos.ajax.reload();
}
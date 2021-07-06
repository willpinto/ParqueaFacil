$(document).ready(function() {
    let patternPlaca = /^[A-Z]{3}-\d{2}[0-9A-Z]?$/, esGestionar;
    $('[data-toggle="tooltip"]').tooltip();
    if($('.mask-placa').length > 0) {
        $('.mask-placa').inputmask({
            mask: 'AAA-99[*]',
            greedy: true
        });
    }

    //Eventos para login/página principal
    $('#login').click(function() {
        $('#login-modal').modal('show');
    });

    $('#confirmar-ingresar').click(function() {
        IniciarAdmOVig();
    });

    $('#ingresar-propietario').click(function() {
        if($('#cedula').val() != "" && $('#placa').val() != "") {
            IniciarPropietarioInfo();
            return;
        }
        alert("Debe llenar documento y placa para ir a la información del vehículo");
    });

    //Eventos para vigilante
    $('#logout').click(function() {
        CerrarSesion();
    });

    $('#btnCheckIn').click(function() {
        limpiarInputs();
        $('#checkin-modal').modal('show');
    });

    $('#ConfirmarCheckIn').click(function() {
        let placa = $('#placa-ci').val().toUpperCase();
        if($('#cedula-ci').val() == "" || placa == ""){
            alert("Aún falta datos validos");
            return;
        }
        if(!patternPlaca.test(placa)) {
            alert("La placa no cumple con el formato establecido");
            return;
        }
        RealizarCheckIn();
    });

    $('#btnCheckOut').click(function() {
        limpiarInputs();
        $('#checkout-modal').modal('show');
    });

    $('#ConfirmarCheckOutManual').click(function() {
        $('#checkout-manual-modal').modal('show');
        $('#checkout-modal').modal('hide');
    });

    $('#ConfirmarCheckOut').click(function() {
        let placa = "";
        if($("#chkPorTicket").is(":checked")) {
            if($('#ticket-co').val() == "") {
                alert("Aún falta datos validos");
                return;
            }
        } else {
            placa = $('#placa-co').val().toUpperCase();
            if($('#cedula-co').val() == "" || placa == ""){
                alert("Aún falta datos validos");
                return;
            }
            if(!patternPlaca.test(placa)) {
                alert("La placa no cumple con el formato establecido");
                return;
            }
        }
        RealizarCheckOut();
    });

    $('#btn-ingresar-novedad').click(function() {
        rellenarPlacasActivas();
    });

    $('#IngresarNovedad').click(function() {
        if($('#placa-activa').val() != "" && $('#tipo-novedad').val() != "" && $('#detalle-novedad').val() != "") {
            ingresarNuevaNovedad();
            return;
        }
        alert("Debe ingresar todos los datos para poder continuar");
    });

    //Eventos para conductor 
    $('#cerrarSesionProp').click(function() {
        CerrarSesion();
    });

    $('#misDatos').click(function() {
        mostrarMisDatos();
        $('#mis-datos-modal').modal('show');
    });

    $('#registrarse').click(function() {
        mostrarDatosRegistroPropietario();
        $('#registro-propietario-modal').modal('show');
    });

    $('#mostrarTC').click(function() {
        $('#tc-modal').modal('show');
    });

    $('#GuardarRegistroPropietario').click(function() {
        GuardarRegistroPropietario();
    });

    $('#chkAceptarTC').click(function() {
        $('#GuardarRegistroPropietario').toggleClass('disabled');
    });

    $('#chkPorTicket').click(function() {
        $('#por-documento').toggleClass('d-none');
        $('#por-ticket').toggleClass('d-none');
        $('#cedula-co').val('');
        $('#placa-co').val('');
        $('#ticket-co').val('');
    });

    $('#GuardarRegistroVehiculo').click(function() {
        GuardarRegistroVehiculo();
    });

    $('#btnRegistrarVehiculoActual').click(function() {
        mostrarDatosRegistroVehiculo();
        $('#mis-datos-modal').modal('hide');
        $('#registro-vehiculo-modal').modal('show');
    });

    $('#btnMisVehiculos').click(function() {
        recargarTableMisVehiculos();
        $('#mis-vehiculos-modal').modal('show');
        $('#mis-datos-modal').modal('hide');
    });

    $('#regresarMisDatos').click(function() {
        $('#mis-datos-modal').modal('show');
        $('#mis-vehiculos-modal').modal('hide');
    });

    function CerrarSesion() {
        $('#form-oculto').html('<form action="/" name="form1" method="post" style="display:none;"><input type="text" name="perfil" value="salir" /></form>');
        document.forms['form1'].submit();
    }

    //Eventos para administrador
    $('#activar-administrador').click(function() {
        ocultarElementos("#administrador");
        prepararGeneracionTabla({ accion: "listar" }, "#tablaadministrador", "administrador", true);
    });
    $('#activar-vigilante').click(function() {
        ocultarElementos("#vigilante");
        cargarAdministradores();
        prepararGeneracionTabla({ accion: "listar" }, "#tablavigilante", "vigilante", true);
    });  
    $('#activar-conductor').click(function() {
        ocultarElementos("#conductor");
        $('#placa-veh').prop('disabled', true);
    });
    $('#activar-vehiculo').click(function() {
        ocultarElementos("#vehiculo");
        $('#placa-veh').removeAttr('disabled');
        prepararGeneracionTabla({ accion: "listar" }, "#tablavehiculo", "vehiculo", true);
    });
    $('#activar-registro').click(function() {
        ocultarElementos("#registro");
        prepararGeneracionTabla({ accion: "listar" }, "#tablaregistro", "registro", true);
    });
    $('#activar-reportes').click(function() {
        ocultarElementos("#reportes");
        activarComponentesReportes();
    });

    $('#salir-admin').click(function() {
        $('#form-oculto').html('<form action="/" name="form1" method="post" style="display:none;"><input type="text" name="perfil" value="salir" /></form>');
        document.forms['form1'].submit();
    });

    function ocultarElementos(entity) {
        $('.pages').addClass('d-none');
        $(entity).removeClass('d-none');
        $('#info-cond').addClass('d-none');
    }

    $('#btnRegistrarAdministrador').click(function() {
        limpiarElementosAdmin();
        $('#titulo-administrador-modal').text("Registrar administrador");
        $('#administrador-modal').modal("show");
        visualizacionForm(false, '#btnGuardarAdministrador', "administrador");
        $('#btnEliminarAdministrador').addClass("d-none");
        $('#cedula-adm').removeAttr("disabled");
    });

    $('#btnGuardarAdministrador').click(function() {
        if(validarDatosAdministrador()) {
            validarContrasenasAdmin("Guardar");
        }
    });

    $('#btnEditarAdministrador').click(function() {
        $('#titulo-administrador-modal').text("Actualizar administrador");
        visualizacionForm(false, '#btnActualizarAdministrador', "administrador");
        $('#btnEliminarAdministrador').addClass("d-none");
    });

    $('#btnActualizarAdministrador').click(function() {
        if(validarDatosAdministrador()) {
            validarContrasenasAdmin("Actualizar");
        }
    });

    $('#btnEliminarAdministrador').click(function() {
        eliminarAdministrador();
    });

    $('#btnRegistrarVigilante').click(function() {
        limpiarElementosVig();
        $('#titulo-vigilante-modal').text("Registrar vigilante");
        $('#vigilante-modal').modal("show");
        visualizacionForm(false, '#btnGuardarVigilante', "vigilante");
        $('#btnEliminarVigilante').addClass("d-none");
        $('#cedula-vig').removeAttr("disabled");
    });

    $('#btnGuardarVigilante').click(function() {
        if(validarDatosVigilante()) {
            validarContrasenasVig("Guardar");
        }
    });

    $('#btnEditarVigilante').click(function() {
        $('#titulo-vigilante-modal').text("Actualizar vigilante");
        visualizacionForm(false, '#btnActualizarVigilante', "vigilante");
        $('#btnEliminarVigilante').addClass("d-none");
    });

    $('#btnActualizarVigilante').click(function() {
        if(validarDatosVigilante()) {
            validarContrasenasVig("Actualizar");
        }
    });

    $('#btnEliminarVigilante').click(function() {
        eliminarVigilante();
    });

    $('#btnBuscarConductor').click(function() {
        let id = $('#documento-cond-search').val();
        if(id != "") {
            consultarConductor(id);
            return;
        }
        alert("Llenar campo de documento antes de buscar conductor");
    });

    $('#btnCrearNuevoConductor').click(function() {
        $('#titulo-registro-conductor-modal').text("Registrar conductor");
        $('#registro-conductor-modal').modal('show');
        visualizacionForm(false, '#btnRegistrarConductor', "conductor");
        $('#nuevo-conductor-modal').modal('hide');
    });

    $('#btnRegistrarConductor').click(function() {
        if(validarDatosConductor()) {
            visualizacionForm(true, '#btnRegistrarConductor', "conductor");
            $('#btnRegistrarConductor').prop('disabled', true);
            RegistrarConductor();
        }
    });

    $('#btnEditarConductor').click(function() {
        $('#titulo-registro-conductor-modal').text("Editar conductor");
        visualizacionForm(false, "#btnActualizarConductor", "conductor");
    });

    $('#btnActualizarConductor').click(function() {
        if(validarDatosConductor()) {
            visualizacionForm(true, '#btnActualizarConductor', "conductor");
            $('#btnActualizarConductor').prop('disabled', true);
            ActualizarConductor();
        }
    });

    $('#btnVerMasConductor').click(function() {
        limpiarFormConductor();
        mostrarDatosRegistroConductor();
        $('#titulo-registro-conductor-modal').text("Detalles conductor");
        $('#registro-conductor-modal').modal('show');
        visualizacionForm(true, "#btnEditarConductor", "conductor");
    });

    $('#btnAgregarVehiculo').click(function() {
        $('#verificar-vehiculo-modal').modal('show');
        $('#placa-veh-search').val("");
        $('#info-vehiculo').addClass('d-none');
        visualizacionBotonesVerificarVehiculo();
    });

    $('#btnBuscarVehiculo').click(function() {
        let placa = $('#placa-veh-search').val().toUpperCase();
        if(placa == "") {
            alert("Llenar campo de placa antes de buscar vehiculo");
            return;
        }
        if(!patternPlaca.test(placa)) {
            alert("La placa no cumple con el formato establecido");
            return
        }
        validarAsociaciónVehiculo(placa);
    });

    $('#btnCrearNuevoVehiculo').click(function() {
        esGestionar = false;
        $('#verificar-vehiculo-modal').modal('hide');
        $('#vehiculo-modal').modal('show');
        $('#titulo-vehiculo-modal').text("Registrar vehiculo");
        $('#btnGuardarVehiculo').text("Guardar y asociar");
        visualizacionForm(false, '#btnGuardarVehiculo', "vehiculo");
    });

    $('#btnRegistrarVehiculo').click(function() {
        esGestionar = true;
        limpiarDatosVehiculo();
        $('#titulo-vehiculo-modal').text("Registrar vehiculo");
        $('#vehiculo-modal').modal("show");
        $('#btnGuardarVehiculo').text("Guardar");
        visualizacionForm(false, '#btnGuardarVehiculo', "vehiculo");
        $('#placa-veh').removeAttr("disabled");
    });

    $('#btnGuardarVehiculo').click(function() {
        let placa = $('#placa-veh').val().toUpperCase();
        if(validarDatosVehiculo()) {
            if(!patternPlaca.test(placa)) {
                alert("La placa no cumple con el formato establecido");
                return
            }
            visualizacionForm(true, '#btnGuardarVehiculo', "vehiculo");
            $('#btnGuardarVehiculo').prop('disabled', true);
            RegistrarVehiculo(esGestionar);
        }
    });

    $('#btnAsociarVehiculo').click(function() {
        AsociarConductorVehiculo(true);
    });

    $('#btnEditarVehiculo').click(function() {
        $('#titulo-vehiculo-modal').text("Actualizar vehiculo");
        visualizacionForm(false, '#btnActualizarVehiculo', "vehiculo");
        $('#btnEliminarVehiculo').addClass("d-none");
    });

    $('#btnActualizarVehiculo').click(function() {
        if(validarDatosVehiculo()) {
            visualizacionForm(true, '#btnActualizarVehiculo', "vehiculo");
            $('#btnActualizarVehiculo').prop('disabled', true);
            actualizarVehiculo();
        }
    });

    $('#btnEliminarVehiculo').click(function() {
        eliminarVehiculo();
    });

    $('#parametro').change(function() {
        activarComponentesReportes();
    });

    $('#fecha-inicio').change(function() {
        setMinDateFechaFinal();
    });

    $('#btnReportes').click(function() {
        generarReporte();
    });

    function validarDatosAdministrador() {
        if($('#cedula-adm').val() == "" || $('#nombres-adm').val() == "" ||
            $('#cargo-adm').val() == "" || $('#pass-adm').val() == "") {
            alert("Faltan datos por ingresar, por favor ingresar los datos requeridos");
            return false;
        }
        return true;
    }

    function validarDatosVigilante() {
        if($('#cedula-vig').val() == "" || $('#nombres-vig').val() == "" ||
            $('#rol-vig').val() == "" || $('#turno-vig').val() == "" ||
            $('#pass-vig').val() == "" || $('#documento-adm-vig').val() == "") {
            alert("Faltan datos por ingresar, por favor ingresar los datos requeridos");
            return false;
        }
        return true;
    }

    function validarDatosConductor() {
        if($('#documento-cond').val() == "" || $('#tipo-documento-cond').val() == "" ||
            $('#nombres-cond').val() == "" || $('#apellidos-cond').val() == "" ||
            $('#direccion-cond').val() == "" || $('#telefono-cond').val() == "" ||
            $('#correo-cond').val() == "" || $('#fecha-nacimiento-cond').val() == "" ||
            !$('input:radio[name=genero]').is(':checked') || $('#clase-licencia-cond').val() == "" ||
            $('#numero-licencia-cond').val() == "") {
            alert("Faltan datos por ingresar, por favor ingresar los datos requeridos");
            return false;
        }
        return true;
    }

    function validarDatosVehiculo() {
        if($('#placa-veh').val() == "" || !$('input:radio[name=tipo-veh]').is(':checked') ||
            $('#marca-veh').val() == "" || $('#modelo-veh').val() == "" || $('#linea-veh').val() == "" ||
            $('#servicio-veh').val() == "" || $('#cilindraje-veh').val() == "" ||
            $('#chasis-veh').val() == "" || $('#motor-veh').val() == "" || $('#color-veh').val() == "" ||
            $('#tcarroceria-veh').val() == "") {
            alert("Faltan datos por ingresar, por favor ingresar los datos requeridos");
            return false;
        }
        return true;
    }
});
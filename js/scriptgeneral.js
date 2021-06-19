$(document).ready(function() {
    let patternPlaca = /^[A-Z]{3}-\d{2}[0-9A-Z]?$/;
    $('[data-toggle="tooltip"]').tooltip();
    $('.text-uppercase').inputmask({
        mask: 'AAA-99[*]',
        greedy: true
    });

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
            placa = $('#placa-co').val();
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

    //Eventos para propietario 
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
        ocultarElementos();
        $('#administrador').removeClass('ocultar');
    });
    $('#activar-vigilante').click(function() {
        ocultarElementos();
        $('#vigilante').removeClass('ocultar');
    });  
    $('#activar-conductor').click(function() {
        ocultarElementos();
        $('#conductor').removeClass('ocultar');
    });  
    $('#activar-consultar').click(function() {
        ocultarElementos();
        $('#consultar').removeClass('ocultar');
    });  
    $('#activar-reportes').click(function() {
        ocultarElementos();
        $('#reportes').removeClass('ocultar');
        activarComponentesReportes();
    });

    $('#btnConsultar').click(function() {
        let usuario = $('#tipo-usuario').val();
        switch (usuario) {
            case "adm":
                consultarYLlenarDatosAdministrador();
                break;
            case "vig":
                consultarYLlenarDatosVigilante();
                break;
        }
    });

    $('#salir-admin').click(function() {
        $('#form-oculto').html('<form action="/" name="form1" method="post" style="display:none;"><input type="text" name="perfil" value="salir" /></form>');
        document.forms['form1'].submit();
    });

    function ocultarElementos() {
        $('.pages').addClass('ocultar');
        $('.ingresar').removeClass('ocultar');
        $('#modificar-eliminar').addClass('ocultar');
        $('#info-cond').addClass('d-none');
    }

    $('#btnAdministrador').click(function() {
        validarContrasenasAdmin(true);
    });

    $('#btnVigilante').click(function() {
        validarContrasenasVig(true);
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
        visualizacionFormConductor(false, '#btnRegistrarConductor');
        $('#nuevo-conductor-modal').modal('hide');
    });

    $('#btnRegistrarConductor').click(function() {
        if(validarDatosConductor()) {
            visualizacionFormConductor(true, '#btnRegistrarConductor');
            $('#btnRegistrarConductor').prop('disabled', true);
            RegistrarConductor();
        }
    });

    $('#btnEditarConductor').click(function() {
        $('#titulo-registro-conductor-modal').text("Editar conductor");
        visualizacionFormConductor(false, "#btnActualizarConductor");
    });

    $('#btnActualizarConductor').click(function() {
        if(validarDatosConductor()) {
            visualizacionFormConductor(true, '#btnActualizarConductor');
            $('#btnActualizarConductor').prop('disabled', true);
            ActualizarConductor();
        }
    });

    $('#btnVerMasConductor').click(function() {
        limpiarFormConductor();
        mostrarDatosRegistroConductor();
        $('#titulo-registro-conductor-modal').text("Detalles conductor");
        $('#registro-conductor-modal').modal('show');
        visualizacionFormConductor(true, "#btnEditarConductor");
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
        $('#verificar-vehiculo-modal').modal('hide');
        $('#registro-vehiculo-modal').modal('show');
        $('#titulo-registro-vehiculo-modal').text("Registrar vehiculo");
        visualizacionFormVehiculo(false, '#btnRegistrarVehiculo');
    });

    $('#btnRegistrarVehiculo').click(function() {
        if(validarDatosVehiculo()) {
            visualizacionFormVehiculo(true, '#btnRegistrarVehiculo');
            $('#btnRegistrarVehiculo').prop('disabled', true);
            RegistrarVehiculo();
        }
    });

    $('#btnAsociarVehiculo').click(function() {
        AsociarConductorVehiculo(true);
    });

    $('#btnConsultar').click(function() {
        let usuario = $('#cedula-usu').val();
        if(usuario == '') {
            alert("Debe ingresar un número de cédula valida para continuar");
            return;
        }
        consultarUsuario(usuario);
    });

    $('#btnActualizar').click(function() {
        let usuario = $('#tipo-usuario').val();
        switch (usuario) {
            case "adm":
                validarContrasenasAdmin(false);
                break;
            case "vig":
                validarContrasenasVig(false);
                break;
        }
    });

    $('#btnEliminar').click(function() {
        let usuario = $('#tipo-usuario').val();
        switch (usuario) {
            case "adm":
                eliminarAdministrador();
                break;
            case "vig":
                eliminarVigilante();
                break;
        }
    });

    $('#parametro').change(function() {
        activarComponentesReportes();
    });

    $('#fecha-inicio').change(function() {
        setMinDateFechaFinal();
    });

    $('#btnReportes').click(function() {
        generarTabla();
    });

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
        if($('#documento-veh').val() == "" || $('#placa-veh').val() == "" ||
            !$('input:radio[name=tipo-veh]').is(':checked') || $('#marca-veh').val() == "" ||
            $('#modelo-veh').val() == "" || $('#linea-veh').val() == "" || $('#servicio-veh').val() == "" ||
            $('#cilindraje-veh').val() == "" || $('#chasis-veh').val() == "" ||
            $('#motor-veh').val() == "" || $('#color-veh').val() == "" ||
            $('#tcarroceria-veh').val() == "") {
            alert("Faltan datos por ingresar, por favor ingresar los datos requeridos");
            return false;
        }
        return true;
    }
});
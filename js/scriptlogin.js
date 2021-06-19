function IniciarAdmOVig() {
    let registro = recuperarDatosFormularioLogin();
    login_comprobar(registro);
}

function IniciarPropietarioInfo() {
    let registro = recuperarDatosFormularioRevisaVehiculo();
    revisa_comprobar(registro);
}

function recuperarDatosFormularioLogin() {
    let registro = {
        user: $('#user').val(),
        pass: $('#pass').val()
    };
    return registro;
}

function recuperarDatosFormularioRevisaVehiculo() {
    let registro = {
        documento: $('#cedula').val(),
        placa: $('#placa').val().toUpperCase()
    };
    return registro;
}

function login_comprobar(registro) {
    $.ajax({
        url: 'controlador/controlador_login.php',
        type: 'POST',
        data: registro,
        success: function (resp) {
            var data = JSON.parse(resp);
            if (data[0] != null) {
                $perfil = data[0].tipo;
                alert("Bienvenido: " + data[0].nombres + "\nCargo: " + $perfil);
                if($perfil == "admin") {
                    $('#form-oculto').html('<form action="/" name="form1" method="post" style="display:none;"><input type="hidden" name="perfil" value="' + $perfil + '" /><input type="hidden" name="nombres-login" value="' + data[0].nombres + '" /><input type="hidden" name="cargo-login" value="' + data[0].cargo + '" /></form>');
                } else if($perfil == "vigi") {
                    $('#form-oculto').html('<form action="/" name="form1" method="post" style="display:none;"><input type="hidden" name="perfil" value="' + $perfil + '" /><input type="hidden" name="documentovig" value="' + data[0].documento + '" /></form>');
                }
                document.forms['form1'].submit();
                //location.href = "?perfil=" + $perfil;
            } else {
                alert("usuario o contraseña incorrectos");
            }
        },
        error: function () {
            alert("problema");
        }
    });
}

function revisa_comprobar(registro) {
    $.ajax({
        url: 'controlador/controlador_login.php',
        type: 'POST',
        data: registro,
        success: function (resp) {
            var data = JSON.parse(resp);
            if (data[0] != null) {
                $perfil = "prop";
                $('#form-oculto').html(`<form action="/" name="form1" method="post" style="display:none;">
                        <input type="hidden" name="perfil" value="${$perfil}" />
                        <input type="hidden" name="numero-ticket" value="${data[0].numero_ticket}" />
                        <input type="hidden" name="nombre" value="${data[0].nombres + ' ' + data[0].apellidos}" />
                        <input type="hidden" name="documento" value="${data[0].documento}" />
                        <input type="hidden" name="placa" value="${data[0].placa}" />
                    '</form>`);
                document.forms['form1'].submit();
                //location.href = "?perfil=" + $perfil;
            } else {
                alert("No hay ningún vehículo estacionado en las instalaciones o verifique su cédula y/o placa antes de ingresar");
            }
        },
        error: function () {
            alert("problema");
        }
    });
}
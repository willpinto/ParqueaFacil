$(document).ready(function () {
    $('#CrearConexionBD').on('click', function () {
        var servidor = $('#servidor').val();
        var bd = $('#bd').val();
        var usuario = $('#usuario').val();
        var password = $('#password').val();
        $.ajax({
            type: 'POST',
            url: 'config.php',
            dataType: "json",
            data: {
                servidor: servidor,
                bd: bd,
                usuario: usuario,
                password: password
            },
            success: function (data) {
                if (data.status == 'ok') {
                    alert("conexion creada  base de datos");
                    $('#CrearConexionBD').prop('disabled', true);
                    $('#CrearBD').prop('disabled', false);
                } else {
                    alert("datos incorrectos");
                }
            }
        });
    });

    $('#CrearBD').on('click', function () {
        $.ajax({
            url: 'creartablas.php',
            dataType: "json",
            success: function (data) {
                if (data.status == 'ok') {
                    alert(" tablas creadas en   base de datos");
                    $('#CrearConexionBD').prop('disabled', true);
                    $('#CrearBD').prop('disabled', true);
                    $('#CrearPA').prop('disabled', false);
                } else {
                    alert("problemas con la creación");
                }
            }
        });
    });

    $('#CrearPA').on('click', function () {
        $.ajax({
            url: 'crearprocediminto.php',
            dataType: "json",
            success: function (data) {
                if (data.status == 'ok') {
                    alert("Procedimientos almacenados creados en la  base de datos");
                    $('#CrearConexionBD').prop('disabled', true);
                    $('#CrearBD').prop('disabled', true);
                    $('#CrearPA').prop('disabled', true);
                    $('#documento').prop('disabled', false);
                    $('#nombres').prop('disabled', false);
                    $('#cargo').prop('disabled', false);
                    $('#contrasena').prop('disabled', false);
                    $('#CrearAdministrador').prop('disabled', false);
                } else {
                    alert("problemas con la creación");
                }
            }
        });
    });

    $('#CrearAdministrador').on('click', function () {
        var cedula = $('#documento').val();
        var nombres = $('#nombres').val();
        var cargo = $('#cargo').val();
        var contrasena = $('#contrasena').val();
        $.ajax({
            type: 'POST',
            url: 'crearAdmin.php',
            dataType: "json",
            data: {
                cedula: cedula,
                nombres: nombres,
                cargo: cargo,
                contrasena: contrasena
            },
            success: function (data) {
                if (data.status == 'ok') {
                    alert("Administrador creado");
                    location.href = "../";
                } else {
                    alert("Datos no validos");
                }
            }
        });
    });
});
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
    <title>Administra Parquea Fácil</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/sidenav.css">
    <link rel="stylesheet" type="text/css" href="css/estilosadministrador.css">
    <link rel="stylesheet" type="text/css" href="css/imageoption.css">
</head>

<body>
    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="#">Parquea Fácil SENA</a>
                    <div id="close-sidebar">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="sidebar-header">
                    <div class="user-pic">
                        <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg" alt="User picture">
                    </div>
                    <div class="user-info">
                        <span class="user-name">
                            <?php echo $_POST['nombres-login']; ?>
                        </span>
                        <span class="user-role">Administrator (<?php echo $_POST['cargo-login']; ?>)</span>
                        <span class="user-status">
                            <!--<i class="fa fa-circle"></i>
                            <span>Online</span>-->
                        </span>
                    </div>
                </div>
                <!-- sidebar-header  -->
                <div class="sidebar-search">

                </div>
                <!-- sidebar-search  -->
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <span>General</span>
                        </li>
                        <li class="sidebar-dropdown">
                            <a>
                                <i class="fa fa-tachometer-alt"></i>
                                <span>Gestionar</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a id="activar-administrador">Administrador</a>
                                    </li>
                                    <li>
                                        <a id="activar-vigilante">Vigilante</a>
                                    </li>
                                    <li>
                                        <a id="activar-conductor">Conductor</a>
                                    </li>
                                    <li>
                                        <a id="activar-vehiculo">Vehiculo</a>
                                    </li>
                                    <li>
                                        <a id="activar-registro">Registro</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="header-menu">
                            <span>Extra</span>
                        </li>
                        <!--<li>
                            <a id="activar-consultar">
                                <i class="fa fa-search"></i>
                                <span>Consultar</span>
                            </a>
                        </li>-->
                        <li>
                            <a id="activar-reportes">
                                <i class="fa fa-book"></i>
                                <span>Reportes</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
            <!-- sidebar-content  -->
            <div class="sidebar-footer">
                <a class="disabled">
                    <i class="fa fa-bell"></i>
                    <span class="badge badge-pill badge-warning notification d-none">3</span>
                </a>
                <a class="disabled">
                    <i class="fa fa-envelope"></i>
                    <span class="badge badge-pill badge-success notification d-none">7</span>
                </a>
                <a class="disabled">
                    <i class="fa fa-cog"></i>
                    <span class="badge-sonar d-none"></span>
                </a>
                <a id="salir-admin">
                    <i class="fa fa-power-off"></i>
                </a>
            </div>
        </nav>
        <!-- sidebar-wrapper  -->
        <main class="page-content">
            <div class="container-fluid">
                <div class="container px-5">
                    <!--Sección administrador-->
                    <div class="pages d-none" id="administrador">
                        <div class="row">
                            <div class="col">
                                <h1 class="text-center">Gestionar administrador</h1>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-2 d-flex flex-column">
                                <button id="btnRegistrarAdministrador" class="btn btn-primary">Nuevo...</button>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <div id="mensajeadministrador" class="alert alert-danger d-none" role="alert">
                                    Actualmente no existe administradores
                                </div>
                                <table class="table table-striped table-bordered table-hover w-100" id="tablaadministrador"></table>
                            </div>
                        </div>
                    </div>
                    <!--Sección vigilante-->
                    <div class="pages d-none" id="vigilante">
                        <div class="row">
                            <div class="col">
                                <h1 class="text-center">Gestionar vigilante</h1>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-2 d-flex flex-column">
                                <button id="btnRegistrarVigilante" class="btn btn-primary">Nuevo...</button>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="row pt-5">
                            <div class="col">
                                <div id="mensajevigilante" class="alert alert-danger d-none" role="alert">
                                    Actualmente no existe vigilantes
                                </div>
                                <table class="table table-striped table-bordered table-hover w-100" id="tablavigilante"></table>
                            </div>
                        </div>
                    </div>
                    <!--Sección Conductor y Vehículo-->
                    <div class="pages d-none" id="conductor">
                        <div class="row">
                            <div class="col">
                                <h1>Gestionar conductores y vehículos</h1>
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Número de documento del conductor</label>
                                            <input type="number" class="form-control wo-arrows" id="documento-cond-search">
                                        </div>
                                    </div>
                                    <div class="col-4 d-flex align-items-center">
                                        <button id="btnBuscarConductor" class="btn btn-primary btn-block mx-1">Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="info-cond" class="d-none">
                            <div class="card mb-5">
                                <div class="card-body">
                                    <div class="row mt-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <h3>Detalles del conductor</h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <h6>Tipo documento</h6>
                                                    <div class="my-1 text-center">
                                                        <span id="tipo-documento-cond-info"></span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <h6>Número documento</h6>
                                                    <div class="my-1 text-center">
                                                        <span id="documento-cond-info"></span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <h6>Nombres</h6>
                                                    <div class="my-1 text-center">
                                                        <span class="nombres-cond"></span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <h6>Apellidos</h6>
                                                    <div class="my-1 text-center">
                                                        <span id="apellidos-cond-info"></span>
                                                    </div>
                                                </div>
                                                <div class="col-4 d-flex align-items-center">
                                                    <button id="btnVerMasConductor" class="btn btn-link btn-block mx-1">Ver más...</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col d-flex flex-row-reverse">
                                            <button id="btnAgregarVehiculo" class="btn btn-success mx-1">Agregar vehículo</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <h3>Vehículos de <span class="nombres-cond"></span></h3>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div id="mensajevehiculoconductor" class="alert alert-danger d-none" role="alert">
                                                Actualmente no existe vehiculos asociados al conductor
                                            </div>
                                            <table class="table table-striped table-bordered table-hover w-100" id="tablavehiculosporconductor"></table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Sección vehiculo-->
                    <div class="pages d-none" id="vehiculo">
                        <div class="row">
                            <div class="col">
                                <h1 class="text-center">Gestionar vehiculo</h1>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-2 d-flex flex-column">
                                <button id="btnRegistrarVehiculo" class="btn btn-primary">Nuevo...</button>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="row pt-5">
                            <div class="col">
                                <div id="mensajevehiculo" class="alert alert-danger d-none" role="alert">
                                    Actualmente no existe vehiculos
                                </div>
                                <table class="table table-striped table-bordered table-hover w-100" id="tablavehiculo"></table>
                            </div>
                        </div>
                    </div>
                    <!--Sección registro-->
                    <div class="pages d-none" id="registro">
                        <div class="row">
                            <div class="col">
                                <h1 class="text-center">Gestionar registro</h1>
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col">
                                <div id="mensajeregistro" class="alert alert-danger d-none" role="alert">
                                    Actualmente no existe registros
                                </div>
                                <table class="table table-striped table-bordered table-hover w-100" id="tablaregistro"></table>
                            </div>
                        </div>
                    </div>
                    <!--Sección reportes-->
                    <div class="pages mb-5 d-none" id="reportes">
                        <div class="row">
                            <div class="col">
                                <h1>Reportes</h1>
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group my-3">
                                            <label>Tipo:</label>
                                            <select class="form-control" id="parametro">
                                                <option value="nvt">Número de vehículos por tipo</option>
                                                <option value="vif">Vehículos ingresados entre fechas</option>
                                                <option value="vef">Vehiculos egresados entre fechas</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Tipo de vehículo</label>
                                            <select class="form-control" id="tipo-veh" disabled>
                                                <option value="carro">Carro</option>
                                                <option value="moto">Moto</option>
                                                <option value="bicicleta">Bicicleta</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Fecha inicio</label>
                                            <input type="date" class="form-control" id="fecha-inicio" disabled>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Fecha final</label>
                                            <input type="date" class="form-control" id="fecha-final" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col"></div>
                            <div class="col-3 d-flex flex-column">
                                <button id="btnReportes" class="btn btn-primary">Generar</button>
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col">
                                <div id="mensajeadministradorreportes" class="alert alert-danger d-none" role="alert">
                                    No existen vehículos que cumplan con los parametros establecidos
                                </div>
                                <table class="table table-striped table-bordered table-hover w-100" id="tablavehiculos"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- page-content" -->
    </div>
    <!--Modales-->
    <div class="modal fade" id="administrador-modal" data-backdrop="static" data-keyboard="false" tabindex="-2" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="titulo-administrador-modal" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset id="form-administrador">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group my-3">
                                            <label>Cédula:</label>
                                            <input class="form-control wo-arrows" id="cedula-adm" type="number" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group my-3">
                                            <label>Nombres:</label>
                                            <input class="form-control" id="nombres-adm" type="text" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group my-3">
                                            <label>Cargo:</label>
                                            <input class="form-control" id="cargo-adm" type="text" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group my-3">
                                            <label>Contraseña:</label>
                                            <input class="form-control" id="pass-adm" type="text" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6"></div>
                                    <div class="col">
                                        <div class="form-group my-3">
                                            <label>Repita contraseña:</label>
                                            <input class="form-control" id="pass-rep-adm" type="text" required autocomplete="off">
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
                            <button id="btnGuardarAdministrador" class="buttons-administrador-modal btn btn-info d-none">Guardar</button>
                            <button id="btnEliminarAdministrador" class="buttons-administrador-modal btn btn-danger d-none">Eliminar</button>
                            <button id="btnActualizarAdministrador" class="buttons-administrador-modal btn btn-success d-none">Actualizar</button>
                            <button id="btnEditarAdministrador" class="buttons-administrador-modal btn btn-warning d-none">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="vigilante-modal" data-backdrop="static" data-keyboard="false" tabindex="-2" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="titulo-vigilante-modal" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset id="form-vigilante">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group my-3">
                                            <label>Cédula:</label>
                                            <input class="form-control wo-arrows" id="cedula-vig" type="number" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group my-3">
                                            <label>Nombres:</label>
                                            <input class="form-control" id="nombres-vig" type="text" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group my-3">
                                            <label>Rol:</label>
                                            <input class="form-control" id="rol-vig" type="text" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group my-3">
                                            <label>Turno:</label>
                                            <input class="form-control" id="turno-vig" type="text" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group my-3">
                                            <label>Contraseña:</label>
                                            <input class="form-control" id="pass-vig" type="text" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group my-3">
                                            <label>Repita contraseña:</label>
                                            <input class="form-control" id="pass-rep-vig" type="text" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6"></div>
                                    <div class="col">
                                        <div class="form-group my-3">
                                            <label for="documentoadm">Administrador a cargo</label>
                                            <select class="form-control" id="documento-adm-vig"></select>
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
                            <button id="btnGuardarVigilante" class="buttons-vigilante-modal btn btn-info d-none">Guardar</button>
                            <button id="btnEliminarVigilante" class="buttons-vigilante-modal btn btn-danger d-none">Eliminar</button>
                            <button id="btnActualizarVigilante" class="buttons-vigilante-modal btn btn-success d-none">Actualizar</button>
                            <button id="btnEditarVigilante" class="buttons-vigilante-modal btn btn-warning d-none">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="nuevo-conductor-modal" data-backdrop="static" data-keyboard="false" tabindex="-2" role="dialog">
        <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content alert-primary">
                <div class="modal-header">
                    <h4 class="modal-title">Información</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h6>El conductor "<span id="new-doc"></span>"<span class="text-danger"> no existe</span></h6>
                            <h6>¿Desea crearlo?</h6>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <button id="btnCrearNuevoConductor" class="btn btn-primary btn-block">Crear nuevo</button>
                            <button class="btn btn-secondary btn-block" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="registro-conductor-modal" data-backdrop="static" data-keyboard="false" tabindex="-2" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="titulo-registro-conductor-modal" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset id="form-conductor">
                        <div class="row">
                            <div class="col my-3">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-4 col-form-label">Documento</label>
                                            <div class="col">
                                                <input type="number" class="form-control wo-arrows" id="documento-cond" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-4 col-form-label">*Tipo documento:</label>
                                            <div class="col">
                                                <select class="form-control" id="tipo-documento-cond">
                                                    <option value="" disabled selected>Seleccione tipo documento</option>
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
                                                <input type="text" class="form-control" id="nombres-cond" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-4 col-form-label">*Apellidos</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="apellidos-cond" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-4 col-form-label">*Dirección</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="direccion-cond" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-4 col-form-label">*Teléfono</label>
                                            <div class="col">
                                                <input type="number" class="form-control wo-arrows" id="telefono-cond">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-4 col-form-label">*Correo</label>
                                            <div class="col">
                                                <input type="email" class="form-control" id="correo-cond" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-4 col-form-label">*Fecha de nacimiento:</label>
                                            <div class="col">
                                                <input type="date" class="form-control" id="fecha-nacimiento-cond">
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
                                                <select class="form-control" id="clase-licencia-cond">
                                                    <option value="" disabled selected>Seleccione clase licencia</option>
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
                                                <input type="number" class="form-control wo-arrows" id="numero-licencia-cond">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col"></div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <button id="btnRegistrarConductor" class="buttons-conductor-modal btn btn-info d-none">Guardar</button>
                            <button id="btnActualizarConductor" class="buttons-conductor-modal btn btn-success d-none">Actualizar</button>
                            <button id="btnEditarConductor" class="buttons-conductor-modal btn btn-warning d-none">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="verificar-vehiculo-modal" data-backdrop="static" data-keyboard="false" tabindex="-2" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Validar vehículo</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Placa del vehículo</label>
                                <input type="text" class="form-control text-uppercase mask-placa" id="placa-veh-search" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-4 d-flex align-items-center">
                            <button id="btnBuscarVehiculo" class="btn btn-primary btn-block mx-1">Buscar</button>
                        </div>
                    </div>
                    <div id="info-vehiculo" class="row d-none">
                        <div class="col">
                            <h6>El vehículo "<span id="new-placa"></span>" <span id="no-vehiculo" class="text-danger"></span></h6>
                            <h6 id="pregunta-vehiculo" class="font-italic"></h6>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <button id="btnAsociarVehiculo" class="buttons-validar-vehiculo-modal btn btn-success d-none">Asociar a conductor</button>
                            <button id="btnCrearNuevoVehiculo" class="buttons-validar-vehiculo-modal btn btn-primary d-none">Crear nuevo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="vehiculo-modal" data-backdrop="static" data-keyboard="false" tabindex="-2" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="titulo-vehiculo-modal" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset id="form-vehiculo">
                        <div class="row">
                            <div class="col my-3">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Placa:</label>
                                            <div class="col">
                                                <input type="text" class="form-control text-uppercase mask-placa" id="placa-veh" disabled autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-2">
                                                <label>*Tipo Vehiculo:</label>
                                            </div>
                                            <div class="col-3">
                                                <input type="radio" name="tipo-veh" class="form-control check-image" id="chkCarro" value="carro">
                                                <label for="chkCarro" class="check-image-label"><img src="img/logos/carro.png" /></label>
                                            </div>
                                            <div class="col-3">
                                                <input type="radio" name="tipo-veh" class="form-control check-image" id="chkMoto" value="moto">
                                                <label for="chkMoto" class="check-image-label"><img src="img/logos/moto.png" /></label>
                                            </div>
                                            <div class="col-3">
                                                <input type="radio" name="tipo-veh" class="form-control check-image" id="chkBici" value="bicicleta">
                                                <label for="chkBici" class="check-image-label"><img src="img/logos/bicicleta.png" /></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">*Marca:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="marca-veh" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">*Modelo:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="modelo-veh" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">*Línea:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="linea-veh" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">*Servicio:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="servicio-veh" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Cilindraje:</label>
                                            <div class="col">
                                                <input type="number" class="form-control wo-arrows" id="cilindraje-veh">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">N° Chasis:</label>
                                            <div class="col">
                                                <input type="text" class="form-control text-uppercase" id="chasis-veh" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">N° Motor:</label>
                                            <div class="col">
                                                <input type="text" class="form-control text-uppercase" id="motor-veh" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">*Color:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="color-veh" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Tipo carroceria:</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="tcarroceria-veh" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col"></div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <button id="btnGuardarVehiculo" class="buttons-vehiculo-modal btn btn-info d-none"></button>
                            <button id="btnEliminarVehiculo" class="buttons-vehiculo-modal btn btn-danger d-none">Eliminar</button>
                            <button id="btnActualizarVehiculo" class="buttons-vehiculo-modal btn btn-success d-none">Actualizar</button>
                            <button id="btnEditarVehiculo" class="buttons-vehiculo-modal btn btn-warning d-none">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="novedad-modal" data-backdrop="static" data-keyboard="false" tabindex="-2" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content alert-primary">
                <div class="modal-header">
                    <h4 class="modal-title">Novedades del registro</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div id="mensajenovedad" class="alert alert-danger d-none" role="alert">
                                No existen novedades para el registro seleccionado
                            </div>
                            <table class="table table-striped table-bordered table-hover w-100" id="tablanovedad"></table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-secondary btn-block" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="form-oculto"></div>
    <!-- page-wrapper -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="js/sidenav.js"></script>
    <script src="js/scriptgeneral.js"></script>
    <script src="js/scriptadministrador.js"></script>

</body>

</html>
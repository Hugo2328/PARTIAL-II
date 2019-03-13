<?php
	session_start();
	error_reporting(0);
	$varsesion = $_SESSION['auth'];
	if (isset($varsesion)){
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="css/estilos.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Usuarios</a>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="index.php">Sign out</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="usuarios.php">
                                <span data-feather="home"></span>
                                Usuarios <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="banner.php">
                                <span data-feather="file"></span>
                                Banner
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="works.php">
                                <span data-feather="file"></span>
                                Works
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="download.php">
                                <span data-feather="file"></span>
                                Download
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="footer.php">
                                <span data-feather="file"></span>
                                Footer
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" id="main">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Usuarios</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <button type="button" class="btn btn-sm btn-outline-danger cancelar">Cancelar</button>
                            <button type="button" class="btn btn-sm btn-outline-success" id="nuevo_registro">Nuevo</button>
                        </div>
                    </div>
                </div>
                <h2>Consultar Usuarios</h2>
                <div class="table-responsive view" id="show_data">
                    <table class="table table-striped table-sm" id="list-usuarios">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div id="insert_data" class="view">
                    <form action="#" id="form_data" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="correo">Correo Electrónico</label>
                                    <input type="email" id="correo" name="correo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="file" name="foto" id="foto">
                                    <input type="hidden" name="ruta" id="ruta" readonly="readonly">
                                </div>
                                <div id="preview"></div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="tel" id="telefono" name="telefono" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" id="password" name="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-success" id="guardar_datos">Guardar</button>
                            </div>
                        </div>
                        <div class="box">
                            <span class="alert alert-danger" id="error" style='display:none;'></span>
                            <span class="alert alert-success" id="success" style='display:none;'></span>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        //cambia vista
        function change_view(vista = 'show_data') {
            $("#main").find(".view").each(function() {
                // $(this).addClass("d-none");
                $(this).slideUp('fast');
                let id = $(this).attr("id");
                if (vista == id) {
                    $(this).slideDown(300);
                    // $(this).removeClass("d-none");
                }
            });
        }

        function consultar() {
            let obj = {
                "accion": "consultar_usuarios"
            };
            $.post("includes/_funciones.php", obj, function(respuesta) {
                let template = ``;
                $.each(respuesta, function(i, e) {
                    template +=
                        `
          <tr>
          <td>${e.usr_nombre}</td>
          <td>${e.usr_telefono}</td>
          <td>
          <a href="#" data-id="${e.id}" class="editar_registro">Editar</a>
          <a href="#" data-id="${e.id}" class="eliminar_usuario">Eliminar</a>
          </td>
          </tr>
          `;
                });
                $("#list-usuarios tbody").html(template);
            }, "JSON");
        }
        $(document).ready(function() {
            consultar();
            change_view();
        });

        //form change
        $("#nuevo_registro").click(function() {
            change_view('insert_data');
            $("#h2-title").text("Insertar Usuario");
        });

        //insertar usuario
        $("#guardar_datos").click(function() {
            let usr_nombre = $("#nombre").val();
            let usr_correo = $("#correo").val();
            let usr_telefono = $("#telefono").val();
            let usr_password = $("#password").val();
            let obj = {
                "accion": "insertar_usuario",
                "nombre": usr_nombre,
                "mail": usr_correo,
                "tel": usr_telefono,
                "pass": usr_password
            }
            $("#form_data").find("input").each(function() {
                $(this).removeClass("has-error");
                if ($(this).val() != "") {
                    obj[$(this).prop("name")] = $(this).val();
                } else {
                    $(this).addClass("has-error");
                    return false;
                }
            });
            //boton change insertar to edit
            if ($(this).data("editar") == 1) {
                obj["accion"] = "editar_usuario";
                obj["id"] = $(this).data('id');
            }
            $.post("includes/_funciones.php", obj, function(r) {
                if (r == 0) {
                    $("#error").html("Campos vacios").fadeIn();
                }
                if (r == 1) {
                    location.reload();
                }
            });
        });


        //eliminar usuario
        $("#main").on("click", ".eliminar_usuario", function(e) {
            e.preventDefault();
            let confirmacion = confirm('¿Desea eliminar este registro?');
            if (confirmacion) {
                let id = $(this).data('id'),
                    obj = {
                        "accion": "eliminar_usuario",
                        "id": id
                    };

                $.post("includes/_funciones.php", obj, function(r) {
                    if (r == 0) {
                        $("#error").html("Error al eliminar").fadeIn();
                    }
                    if (r == 1) {
                        location.reload();
                    }
                });
            }
        });

        //editar usuario
        $("#list-usuarios").on("click", ".editar_registro", function(e) {
            let id = $(this).data('id'),
                obj = {
                    "accion": "consultar_usuario",
                    "id": id
                };
            $("#form_data")[0].reset();
            change_view("insert_data");
            $("#guardar_datos").text("Editar").data("editar", 1).data('id', id);
            $.post('includes/_funciones.php', obj, function(r) {
                $("#nombre").val(r.usr_nombre);
                $("#correo").val(r.usr_correo);
                $("#telefono").val(r.usr_telefono);
                $("#password").val(r.usr_pass);
            }, "JSON");
            if (r == 0) {
                $("#error").html("Error al editar").fadeIn();
            }
            if (r == 1) {
                location.reload();
            }

        });

        

        /*
                //funcion foto
                $("#foto").on("change", function(e) {
                    let formDatos = new FormData($("#form_data")[0]);
                    FormDatos.append("accion", "carga_foto");
                    $.ajax({
                        url: "includes/_funciones.php"
                        type: "POST",
                        data: formDatos,
                        contentType: false,
                        processData: false,
                        success: function(datos) {
                            let respuesta = JSON.parse(datos);
                            if (respuesta.status == 0) {
                                alert("no se cargo la imagen");
                            }
                            let template = `
                                <img src="${respuesta.archivo}" alt="" class="img-fluid" />
                                `;
                            $("#ruta").val(respuesta.archivo);
                            $("#preview").html(template);
                        }
                    });
                });
        */

        //cancel button
        $("#main").find(".cancelar").click(function() {
            change_view();
            $("#form_data")[0].reset();
            $("#form_data").find("input").each(function() {
                $(this).removeClass("has-error");
            });
            $("#error").hide();
            $("#success").hide();
            $("#h2-title").text("Consultar Usuarios");
        });
    </script>
</body>

</html> 
<?php
	}else{
		header("Location:index.php");
	}
?>
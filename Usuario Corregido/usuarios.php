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
              <a class="nav-link" href="#">
                <span data-feather="file"></span>
                Main
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file"></span>
                Features
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="shopping-cart"></span>
                Works
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="users"></span>
                OurTeam
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="bar-chart-2"></span>
                Testimonials
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="layers"></span>
                Downloads
              </a>
            </li>
        </div>
      </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" id="main">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
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
                    <form action="#" id="form_data">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" id="inputNombre" name="nombre" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="correo">Correo Electrónico</label>
                                    <input type="email" id="inputCorreo" name="correo" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="tel" id="inputTelefono" name="telefono" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" id="inputPassword" name="password" class="form-control">
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
          <a href="#" data-id="${e.id_usr}" class="editar_registro">Editar</a>
          <a href="#" data-id="${e.id_usr}" class="eliminar_registro">Eliminar</a>
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
        $("#nuevo_registro").click(function() {
            change_view('insert_data');
        });
        $("#guardar_datos").click(function() {
            let usr_nombre = $("#inputNombre").val();
            let usr_correo = $("#inputCorreo").val();
            let usr_telefono = $("#inputTelefono").val();
            let usr_password = $("#inputPassword").val();
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
            $.post("includes/_funciones.php", obj, function(r) {
                if (r == 0) {
                    $("#error").html("Campos vacios").fadeIn();
                }
                if (r == 1) {
                    location.reload();
                }
            });
        });
        $("#main").on("click",".eliminar_registro" , function(e){
      e.preventDefault();
      let confirmacion= confirm("Desea eliminar este registro");
      if (confirmacion) {
        let id=$(this).data('id'),
            obj ={
              "accion":"eliminar_registro",
              "registro":id
            };
            $.post("includes/_funciones.php", obj, function(respuesta){
              alert(respuesta);
              consultar();
            });
      }
      else{
        alert("El registro no se ha eliminado");
      }
    });
    $("#main").find(".cancelar").click(function(){
      change_view();
      $("#form_data")[0].reset();
    });
  </script>
</body>
</html>
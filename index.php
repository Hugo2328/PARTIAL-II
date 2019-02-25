<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
	 crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body class="text-center">
	<form class="form-signin">
		<img class="mb-4" src="img/logotipo.png" alt="activebox">
		<h1 class="h3 mb-3 font-weight-normal" style = 'color:white;'>Iniciar Sesión</h1>
		<label for="inputEmail" class="sr-only">Correo Electronico</label>
		<input type="email" id="inputEmail" class="form-control" placeholder="Correo Electronico" required autofocus>
		<label for="inputPassword" class="sr-only">Contraseña</label>
		<input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
		<div class="checkbox mb-3">
			<label style = 'color:white;'>
				<input type="checkbox" value="remember-me"> Recuerdame
			</label>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="button" id="buttonSign">Iniciar</button>
		<div class="box">
            <span class="alert alert-danger" id="error" style='display:none;'></span>
            <span class="alert alert-success" id="success" style='display:none;'></span>
        </div>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
		<script>
			
			$("#buttonSign").click(function () {
				let correo = $("#inputEmail").val();
				let password = $("#inputPassword").val();
				let obj = {
					"accion": "login",
					"mail": correo,
					"password": password,
				};
				$.post("includes/_funciones.php", obj, function (r) {
				if (r == 2) {
					$("#error").html("Campos vacios").fadeIn();
				}if (r== 0) {
					$("#error").html("Usuario o contraseña incorrectos").fadeIn();
				}if (r== 1) {
					window.location.href = "usuarios.php";
				}
				
				});
			});
		</script>
	</form>
</body>

</html>
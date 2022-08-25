<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF_8">
	<title>Ingreso</title>
	<link rel="stylesheet" href="../css/login.css">
	<script type="text/javascript" src="../js/login.js"></script>
</head>
<body>
	<div class="login-page">
		<div class="form">
			<form class="login-form">
				<div class="col_100">
					<input id="usuario" name="usuario" class="campos" type="text" placeholder="usuario"/>
				</div>
				<div class="col_100">
					<input id="clave" name="clave" class="campos" type="password" placeholder="clave"/>
				</div>
				<div class="col_100">
					<button id="btnAcceder" class="btn" type="button">ACCEDER</button>
				</div>
			</form>
			<p class="message_error" id="mensaje" name="mensaje"></p>
		</div>
	</div>			
</body>
</html>
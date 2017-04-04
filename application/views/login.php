<!DOCTYPE html>
<html >
		<head>
			<meta charset="UTF-8">
			<link rel="stylesheet" type="text/css" href="/AdminZTE/assets/css/loginStyle.css"/>
			<link rel="stylesheet" href="/AdminZTE/assets/css/sweetalert/dist/sweetalert.css" />
			<script src="/AdminZTE/assets/css/sweetalert/dist/sweetalert.min.js"></script>
			<title>ZTE Fonade Proyect</title>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
			<script type="text/javascript" charset="utf-8" async defer>
					function showMessage(){
							sweetAlert("Error de autentificación", "Por favor verificar los datos", "error");
					}
			</script>
		</head>

		<body>
			<div class="body"></div>
				<div class="grad"></div>
				<div class="header">
					<div>ZTE - FONADE Project</div>
				</div>
				<br>
				<form id="login" action="ArcadiaLogin_submit" method="post" accept-charset="utf-8" >
				<div class="login">
						<input type="text" placeholder="Usuario" name="user" required><br>
						<input type="password" placeholder="Password" name="password" required><br>
						<input type="submit" class="button" onclick = "this.form.action = 'http://localhost/AdminZTE/index.php/User/loginUser'" value="Ingresar">
				</div>
				<?php
				if (isset($user)) {
					if ($user == "Error de informacion"){
						echo '<script type="text/javascript">showMessage();</script>';
					}
				}
				?>
			<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		</body>
</html>
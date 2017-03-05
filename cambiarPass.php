<?php require_once __DIR__.'/includes/php/config.php';?>
<!DOCTYPE html>
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<html lang="en">
  <head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="./includes/css/logo2.jpg" />


    <title>abServices</title>
 
    <!-- CSS de Bootstrap -->
    <link href="includes/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	<link rel="stylesheet" type="text/css" href="includes/css/style.css"> 
	<script type="text/javascript" src="includes/jquery/jquery-3.1.1.js"></script>
  </head>
  <?php
	require(__DIR__.'/includes/php/usuarios.php');
		if(isset($_POST['formPass'])) {
			$result = formPass($_POST,$_SESSION["usuario"]);
		}
	?>
  <body>
		<nav class="navbar navbar-default" role="navigation" id="navSup">
			<div class="navbar-header" id="navSupHeader">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
						data-target=".navbar-ex1-collapse">
				  <span class="sr-only">Desplegar navegación</span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="homeClientes.php"><span class="glyphicon glyphicon-home"></span> abServices</a>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse" id="navSupDerecha">
			 
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-user"></span>  <?php echo $_SESSION["usuario"] ?></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Configuración <span class="glyphicon glyphicon-menu-hamburger"></span></a>
						<ul class="dropdown-menu">
						  <li><a href="cambiarPass.php">Cambiar contraseña</a></li>
						  <li><a href="login.php">Cerrar Sesión </a></li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
		<div class="jumbotron">
				<div class="container">
				<h2 id="cab2">Cambio de contraseña</h2> 
				</div>
		</div>
			
		<div class="container-fluid">
			<div class="alert alert-danger" style="display: none" id="infoDatosRepeat">
						<script type="text/javascript">
							function succesDelete() {
							  document.getElementById("infoDatosRepeat").style.display = 'block';
							}
						</script>
						<?php 
							if(isset($result)){
								echo "<script>";
								echo "succesDelete();";
								echo "</script>";
							}
						?>
						<strong>Error!</strong> La contraseña actual no coincide con la introducida.
			</div>
			<form method = "POST" action="" autocomplete="on" onSubmit="return validarPasswd()" class="form-horizontal" role="form">
							<div class="form-group" id="divPass">
								<div class="container-fluid">
								  <input id="antPass" type="password" name="antPass" required="required" class="form-control" placeholder="Contraseña actual" maxlength="20"/>
								</div>
							</div>
							<div class="form-group" id="divPass1">
								<div class="container-fluid">
								  <input id="newPass1" type="password" name="newPass1" required="required" class="form-control" placeholder="Nueva contraseña" maxlength="20"/>
								</div>
							</div>
							<div class="form-group" id="divPass2">
								<div class="container-fluid">
								  <input id="newPass2" type="password" name="newPass2" required="required" class="form-control" placeholder="Repite nueva contraseña" maxlength="20"/>
								</div>
							</div>
							<div class="form-group">
								<div class="container-fluid">
								  <div class="center-block"><button type="submit" style="float:right" class="btn btn-primary" name="formPass" value="Sign in"><strong>Cambiar contraseña</strong></button></div>
								</div>
							</div>
						</form>
		</div>
		<script type="text/javascript">
				function validarPasswd() {
				var p = document.getElementById("antPass").value;
				var p1 = document.getElementById("newPass1").value;
				var p2 = document.getElementById("newPass2").value;
				var espacios1 = false;
				var cont = 0;
				while (!espacios1 && (cont < p1.length)) {
				  if (p1.charAt(cont) == " ")
					espacios1 = true;
				  cont++;
				}
				if (espacios1) {
				  //alert ("La contraseña no puede contener espacios en blanco");
				  document.getElementById("newPass1").value ="";
				  document.getElementById("newPass1").placeholder ="La contraseña no puede contener espacios en blanco";
				  document.getElementById("divPass1").className = "form-group has-error has-feedback";
				  return false;
				}
				var espacios2 = false;
				var cont = 0;
				while (!espacios2 && (cont < p2.length)) {
				  if (p2.charAt(cont) == " ")
					espacios2 = true;
				  cont++;
				}
				if (espacios2) {
				  document.getElementById("newPass2").value ="";
				  document.getElementById("newPass2").placeholder ="La contraseña no puede contener espacios en blanco";
				  document.getElementById("divPass2").className = "form-group has-error has-feedback";
				  return false;
				}
				var espacios = false;
				var cont = 0;
				while (!espacios && (cont < p.length)) {
				  if (p.charAt(cont) == " ")
					espacios = true;
				  cont++;
				}
				if (espacios) {
				  document.getElementById("antPass").value ="";
				  document.getElementById("antPass").placeholder ="La contraseña no puede contener espacios en blanco";
				  document.getElementById("divPass").className = "form-group has-error has-feedback";
				  return false;
				}
				if(p1 != p2){
				  document.getElementById("newPass2").value ="";
				  document.getElementById("newPass2").placeholder ="Las contraseñas deben coincidir";
				  document.getElementById("divPass2").className = "form-group has-error has-feedback"
				  document.getElementById("newPass1").value ="";
				  document.getElementById("newPass1").placeholder ="Las contraseñas deben coincidir";
				  document.getElementById("divPass1").className = "form-group has-error has-feedback"
				  return false;
				}
				}
		</script>
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="includes/js/bootstrap.min.js"></script>
  </body>
</html>
<?php require(__DIR__.'/includes/php/cleanup.php');?>
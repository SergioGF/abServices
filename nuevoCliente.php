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
	require(__DIR__.'/includes/php/clientes.php');
		if(isset($_POST['formRClient'])) {
			$result = formRegisterClient($_POST);
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
				<h2 id="cab2">Nuevo Cliente</h2> 
				</div>
		</div>
			
		<div class="container-fluid">
			<div class="panel panel-primary" >
						<div class="panel-heading" id="panelHead"><div class="text-center"><strong>Crear nuevo Cliente</strong></div></div>
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
						<strong>Error!</strong> El Id ya está cogido.
						</div>
						<form method = "POST" action="" autocomplete="on" onSubmit="return validarDatos()" class="form-horizontal" role="form">
						<div class="panel-body">
							<div class="form-group" id="divUser">
								<div class="container-fluid">
								 <input id="newCliente"  name="cliente" required="required" class="form-control" placeholder="Id de cliente" maxlength="30"/>
								</div>
							</div>
							<div class="form-group" id="divUser">
								<div class="container-fluid">
								 <input id="newCliente"  type="number" name="horas" required="required" class="form-control" placeholder="Horas contratadas" maxlength="30"/>
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<input  class="btn btn-primary" type="button" onClick="location.href='./gestionClientes.php'" value="Volver atrás"></input>
							<button type="submit" class="btn btn-primary" name="formRClient" value="Sign in" style="float: right"><strong>Crear cliente</strong></button>
						</div>
						</form>
			</div>
		</div>
		<script type="text/javascript">
				function validarDatos() {
				var p1 = document.getElementById("newCliente").value;
				var espacios1 = false;
				var cont = 0;
				while (!espacios1 && (cont < p1.length)) {
				  if (p1.charAt(cont) == " ")
					espacios1 = true;
				  cont++;
				}
				if (espacios1) {
				  document.getElementById("newCliente").value ="";
				  document.getElementById("newCliente").placeholder ="El Id no puede contener espacios en blanco";
				  document.getElementById("divUser").className = "form-group has-error has-feedback";
				  return false;
				}
				}
		</script>
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="includes/js/bootstrap.min.js"></script>
  </body>
</html>
<?php require(__DIR__.'/includes/php/cleanup.php');?>
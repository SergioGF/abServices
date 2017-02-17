﻿<?php require_once __DIR__.'/includes/php/config.php';?>
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


    <title>Usuario</title>
 
    <!-- CSS de Bootstrap -->
    <link href="includes/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	<link rel="stylesheet" type="text/css" href="includes/css/style.css"> 
	<script type="text/javascript" src="includes/jquery/jquery-3.1.1.js"></script>
  </head>
  <?php
	require(__DIR__.'/includes/php/registros.php');
		if(isset($_POST['formRUser'])) {
			$result = formRegisterUser($_POST);
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
				<a class="navbar-brand" href="principalUser.php"><span class="glyphicon glyphicon-home"></span> abServices</a>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse" id="navSupDerecha">
			 
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-user"></span>  <?php echo $_SESSION["usuario"] ?></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Configuración <span class="glyphicon glyphicon-menu-hamburger"></span></a>
						<ul class="dropdown-menu">
						  <li><a href="#">Cambiar nombre</a></li>
						  <li><a href="cambiarPass.php">Cambiar contraseña</a></li>
						  <li><a href="login.php">Cerrar Sesión </a></li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
		<?php/* include 'headerUser.php'; */?>
		<div class="jumbotron">
				<div class="container">
				<h2 id="cab2">Registrar nuevo trabajador</h2> 
				<p>  <?php 
						if($_SESSION["tipo"] == 3)
							echo "Administrador";
						else if($_SESSION["tipo"] == 2)
							echo "Trabajador";
						else
							echo "Cliente";
					?>
				</p>
				</div>
		</div>
			
		<div class="container-fluid">
			<div class="panel panel-primary" >
						<div class="panel-heading" id="panelHead"><div class="text-center"><strong>Registrar nuevo trabajador</strong></div></div>
						<div class="panel-body">
							<form method = "POST" action="" autocomplete="on" class="form-horizontal" role="form">
								<?php 
										if(isset($result)){
											echo '<ul>';
											foreach($result as $error){
												echo '<li class = "errorLogin">'.$error.'</li>';
											}
											echo '</ul>';
										}
								?>
								<div class="form-group">
									<div class="container-fluid">
									  <input id="usuario" type="text" name="usuario" required="required" class="form-control" placeholder="Usuario"/>
									</div>
								</div>
								<div class="form-group">
									<div class="container-fluid">
									  <input id="password" type="password" name="password" required="required" class="form-control" placeholder="Contraseña"/>
									</div>
								</div>
								<div class="form-group">
									<div class="container-fluid">
									 <p> Tipo de usuario </p>
										<select name="tipoUser">
										  <option value="cliente">Cliente</option>
										  <option value="trabajador">Trabajador</option>
										  <option value="administrador">Administrador</option>
										</select>
									</div>
								<div class="form-group">
									<div class="container-fluid">
									  abServices <input id="abservices" type="checkbox" name="abservices" class="form-control" value="abServices"/>
									  <input id="abservices" type="hidden" name="abservices" class="form-control" value="abServicesNo"/>
									</div>
								</div>
								<div class="form-group">
									<div class="container-fluid">
									  Euroico <input id="euroico" type="checkbox" name="euroico" class="form-control" value="Euroico"/> 
									   <input id="euroico" type="hidden" name="euroico" class="form-control" value="EuroicoNo"/> 
									</div>
								</div>								
								</div>								
								<div class="form-group">
									<div class="col-lg-offset-4 col-lg-11">
									  <div class="center-block"><button type="submit" class="btn btn-primary" name="formRUser" value="Sign in"><strong>Iniciar sesión</strong></button></div>
									</div>
								</div>
							</form>
						</div>
					</div>
		</div>
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="includes/js/bootstrap.min.js"></script>
  </body>
</html>
<?php require(__DIR__.'/includes/php/cleanup.php');?>
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


    <title>abServices</title>
 
    <!-- CSS de Bootstrap -->
    <link href="includes/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	<link rel="stylesheet" type="text/css" href="includes/css/style.css"> 
	<script type="text/javascript" src="includes/jquery/jquery-3.1.1.js"></script>
  </head>
  <?php 
    require(__DIR__.'/includes/php/clientes.php');
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
				<h2 id="cab2">Listado de clientes</h2> 
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
		<div class="row">
		<div class="col-md-6" > 	
		<div class="container-fluid">
						<div class="tamPanel panel panel-primary " >
						<div class="tamPanel panel-heading" id="panelHead"><div class="text-center"><strong>Listado de clientes</strong></div></div>
								<?php 
								
								$clientes = conseguirClientes();				
									foreach($clientes as $cliente){
									echo '<div class="form-group"><div class="container-fluid"><img id="margenIm" src="./includes/css/contacto.png"><a href = "./trabajosCliente.php?cliente='.$cliente['Id'].'">'.$cliente['Id'].'</a></div></div><hr id="lineas">';
									}
								
								?>	
						</div>	
		</div>
		</div>		
		<br><br><br><br>
			<div class="col-md-1" id="vacio"><h3> <div class="container-fluid"> </div> </h3></div>
			<div class="col-md-4" > <div class="container-fluid"> <img src="./includes/css/admin2.png" class="img-responsive"  alt="Imagen responsive"></div></div>
			<div class="col-md-1" id="vacio"><h3> <div class="container-fluid"> </div> </h3></div>						
		</div>
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="includes/js/bootstrap.min.js"></script>
  </body>
</html>
<?php require(__DIR__.'/includes/php/cleanup.php');?>
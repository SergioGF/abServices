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
						  <li><a href="cambiarUser.php">Cambiar nombre</a></li>
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
				<h2 id="cab2">Página Principal</h2> 
				<p>  Administrador  </p>
				</div>
		</div>
			
		<div class="container-fluid">
		<h3>Trabajadores </h3>	
		<div class="row">
			<div class="col-md-4" > 
				<ul class="list-group">
					<li class="list-group-item">
						Trabajador 1
						<span class="glyphicon glyphicon-remove" style="float: right"></span>
						
					</li>
					<li class="list-group-item">
						Trabajador 2
						<span class="glyphicon glyphicon-remove" style="float: right"></span>
						
					</li>
					<li class="list-group-item">
						Trabajador 3
						<span class="glyphicon glyphicon-remove" style="float: right"></span>
						
					</li>
				</ul>
			
			</div>
			<div class="col-md-5" id="vacio"><h3> <div class="container-fluid"> </div> </h3></div>
			<div class="col-md-3" > <div class="container-fluid"> <img src="./includes/css/workers.png" class="img-responsive"  alt="Imagen responsive"></div></div>
			</div>
		<a class="btn btn-primary"  href="nuevoTrabajador.php"><strong>+</strong></a>
		
		</div>
		
		  
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="includes/js/bootstrap.min.js"></script>
  </body>
</html>
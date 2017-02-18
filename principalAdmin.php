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
	<link rel="stylesheet" type="text/css" href="./includes/css/style.css"> 
	<script type="text/javascript" src="./includes/jquery/jquery-3.1.1.js"></script>
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
		<h3>Usuarios </h3>	
		<p> Desde este apartado se puede eliminar, modificar o añadir nuevos usuarios de cualquier tipo: administradores, trabajadores o clientes</p>
		<div class="row">
			<div class="col-md-6" > 
				<ul class="list-group">
					<li class="list-group-item" id="nameU">
						 <b>Root</b>
					</li>
					<li class="list-group-item" id="tipoU1">
						<div id="tipoUs" class="text-center"> Administrador </div>
						
					</li>
					<li class="list-group-item" id="accionesU">
						<span class="glyphicon glyphicon-pencil"></span>
						<span class="glyphicon glyphicon-remove" style="float: right"></span>
						
					</li>
				</ul>
				<ul class="list-group">
					<li class="list-group-item" id="nameU">
						 <b>Trabajador 1</b>
					</li>
					<li class="list-group-item" id="tipoU2">
						<div id="tipoUs" class="text-center"> Trabajador </div>
						
					</li>
					<li class="list-group-item" id="accionesU">
						<span class="glyphicon glyphicon-pencil"></span>
						<span class="glyphicon glyphicon-remove" style="float: right"></span>
						
					</li>
				</ul>
				<ul class="list-group">
					<li class="list-group-item" id="nameU">
						 <b>Trabajador 2</b>
					</li>
					<li class="list-group-item" id="tipoU2">
						<div id="tipoUs" class="text-center"> Trabajador </div>
						
					</li>
					<li class="list-group-item" id="accionesU">
						<span class="glyphicon glyphicon-pencil"></span>
						<span class="glyphicon glyphicon-remove" style="float: right"></span>
						
					</li>
				</ul>
				<ul class="list-group">
					<li class="list-group-item" id="nameU">
						 <b>Cliente 1</b>
					</li>
					<li class="list-group-item" id="tipoU3">
						<div id="tipoUs" class="text-center"> Cliente </div>
						
					</li>
					<li class="list-group-item" id="accionesU">
						<span class="glyphicon glyphicon-pencil"></span>
						<span class="glyphicon glyphicon-remove" style="float: right"></span>
						
					</li>
				</ul>
			</div>
			<div class="col-md-1" id="vacio"><h3> <div class="container-fluid"> </div> </h3></div>
			<div class="col-md-4" > <div class="container-fluid"> <img src="./includes/css/admin2.png" class="img-responsive"  alt="Imagen responsive"></div></div>
			<div class="col-md-1" id="vacio"><h3> <div class="container-fluid"> </div> </h3></div>
			</div>
		<a class="btn btn-primary"  href="nuevoTrabajador.php"><strong>Crear nuevo usuario +</strong></a>
		
		</div>
		
		  
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="includes/js/bootstrap.min.js"></script>
  </body>
</html>
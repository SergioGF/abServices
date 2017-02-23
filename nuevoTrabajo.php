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

	<?php
	$cliente= $_GET['cliente']; 
	?>
	
    <title>abServices</title>
 
    <!-- CSS de Bootstrap -->
    <link href="includes/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	<link rel="stylesheet" type="text/css" href="includes/css/style.css"> 
	<script type="text/javascript" src="includes/jquery/jquery-3.1.1.js"></script>
  </head>
  <?php
	require(__DIR__.'/includes/php/trabajos.php');
		if(isset($_POST['formRTrabajo'])) {
			$result = formRegisterTrabajo($_POST,$cliente,$_SESSION["usuario"]);
		}
	?>
	
	<script type="text/javascript">
	$(document).ready(function(){
			if ($("#mat").attr("checked")){
				$("#oculto").css("display", "none");
			}else{
				$("#oculto").css("display", "block");
			}
	});
	</script>
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
				<h2 id="cab2">Registrar nuevo trabajo a <?php echo $cliente?></h2> 
				</div>
		</div>
			
		<div class="container-fluid">
			<div class="panel panel-primary" >
						<div class="panel-heading" id="panelHead"><div class="text-center"><strong>Añadir nuevo trabajo</strong></div></div>

						<form method = "POST" action="" autocomplete="on" class="form-horizontal" role="form">
					
						<div class="panel-body">
							<div class="form-group">
							<center>
								<div class="container-fluid">
								 <strong>Descripción:</strong> <textarea id="descripcion" name="descripcion" required="required" rows="5" cols="35"></textarea>
								</div><br>
								<div class="container-fluid">
								 <strong>Fecha visita:</strong> <input id="fvisita" name="fvisita" type="date" required="required"/>
								</div><br>
								<div class="container-fluid">
								 <strong>Hora entrada:</strong> <input id="horae" name="horae" type="time" required="required"/>
								</div><br>
								<div class="container-fluid">
								 <strong>Hora salida:</strong> <input id="horas" name="horas" type="time" required="required"/>
								</div><br>
								<div class="container-fluid">
								 <strong>¿Se utilizó algun material?:</strong> <input id="mat" name="mat" type="checkbox"/>
								</div><br>
								<div class="container-fluid">
									<div class ="oculto" id="oculto" style="display: none;"> 
									 <strong>Descripción material:</strong><textarea id="descmat" name="descmat" rows="5" cols="35"></textarea>
									</div> 
								</div>
								<div class="container-fluid">
								 <strong>Observaciones:</strong> <textarea id="observaciones" name="observaciones" rows="5" cols="35"></textarea>
								</div><br>
							</center>
							</div>
						</div>
						<div class="panel-footer">
							<input  class="btn btn-primary" type="button" onClick="location.href='./trabajosCliente.php?cliente=<?php echo $cliente ?>'" value="Volver atrás"></input>
							<button type="submit" class="btn btn-primary" name="formRTrabajo" value="Sign in" style="float: right"><strong>Crear trabajo</strong></button>
						</div>
						</form>
			</div>
		</div>
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="includes/js/bootstrap.min.js"></script>
  </body>
</html>
<?php require(__DIR__.'/includes/php/cleanup.php');?>
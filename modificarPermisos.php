﻿<?php require_once __DIR__.'/includes/php/config.php';?>
<!DOCTYPE html>
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if($_SESSION["tipo"] != 3)
		header('Location: ./login.php');
if($_SESSION["tipo"] != 1 && $_SESSION["tipo"] != 2 && $_SESSION["tipo"] != 3)
		header('Location: ./login.php');
	
require(__DIR__.'/includes/php/usuarios.php');
$userEdit=$_GET['userToEdit'];
$user = getUser($userEdit);
?>
<html lang="en">
  <head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="./includes/css/abs_logo.jpg" />


    <title>abServices</title>
 
    <!-- CSS de Bootstrap -->
    <link href="includes/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	<link rel="stylesheet" type="text/css" href="includes/css/style.css"> 
	<script type="text/javascript" src="includes/jquery/jquery-3.1.1.js"></script>
	<script type="text/javascript">
		function formTipo(t) {
			document.getElementById("inputTipo").value=t;
			if(t == "Administrador"){
			document.getElementById("tipo3").style.backgroundColor = "#161e45";
			document.getElementById("tipo2").style.backgroundColor = "#286090";
			document.getElementById("tipo1").style.backgroundColor = "#286090";
			}
			else if(t == "Trabajador"){
			document.getElementById("tipo2").style.backgroundColor = "#161e45";
			document.getElementById("tipo1").style.backgroundColor = "#286090";
			document.getElementById("tipo3").style.backgroundColor = "#286090";
			}
			else{
			document.getElementById("tipo1").style.backgroundColor = "#161e45";
			document.getElementById("tipo2").style.backgroundColor = "#286090";
			document.getElementById("tipo3").style.backgroundColor = "#286090";
			}
		}
		function formEmpresa(e) {
			document.getElementById("inputEmpresa").value=e;
			if(e == "abServices"){
			document.getElementById("e1").style.backgroundColor = "#161e45";
			document.getElementById("e2").style.backgroundColor = "#286090";
			}
			else{
			document.getElementById("e2").style.backgroundColor = "#161e45";
			document.getElementById("e1").style.backgroundColor = "#286090";
			}
		}
	</script>
  </head>
  <?php
	require(__DIR__.'/includes/php/registros.php');
		if(isset($_POST['formRUser'])) {
			$result = changePermission($_POST, $userEdit);
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
				<!--<a class="navbar-brand" href="homeClientes.php"><span class="glyphicon glyphicon-home"></span> abServices</a>-->
				<a class="navbar-brand" href="homeClientes.php"><img src="./includes/css/home.jpg" class="img-responsive" alt="Imagen responsive"></a>
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
		<?php/* include 'headerUser.php'; */?>
		<div class="jumbotron">
			<div class="container">
				<h2 id="cab2">Modificar Usuario</h2> 
		</div>
		</div>
			
		<div class="container-fluid">
			<div class="panel panel-primary" >
						<div class="panel-heading" id="panelHead"><div class="text-center"><strong>Modificar permisos de <?php  echo $userEdit?></strong></div></div>
						<div class="alert alert-danger" style="display: none" id="datosFail">
						<strong>Error!</strong> Hay que señalar tipo de usuario y empresa
						</div>
						<form method = "POST" action="" autocomplete="on" onSubmit="return validarDatos()" class="form-horizontal" role="form">
						<div class="panel-body">
								<?php 
										if(isset($result)){
											echo '<ul>';
											foreach((array)$result as $error){
												echo '<li class = "errorLogin">'.$error.'</li>';
											}
											echo '</ul>';
										}
								?>
								<div class="form-group">
									<div class="container-fluid">
										<div class="text-center"> <p><strong> Tipo de usuario </strong></p></div>
										<div class="text-center"><div class="btn-group">
										  <button type="button" class="btn btn-primary" id="tipo1" onClick="formTipo('TrabajadorL')">Trabajador Lectura</button>
										  <button type="button" class="btn btn-primary" id="tipo2" onClick="formTipo('Trabajador')">Trabajador</button>
										  <button type="button" class="btn btn-primary" id="tipo3" onClick="formTipo('Administrador')">Administrador</button>
										  <input id="inputTipo"  name="tipo" required="required" class="form-control" value=" " style="display: none"/>
										</div></div>
									</div>
								</div><hr />
								<div class="form-group">
									<div class="container-fluid">
										<div class="text-center"> <p><strong> Empresa </strong></p></div>
										<div class="text-center"><div class="btn-group">
										  <button type="button" class="btn btn-primary" id="e1" onClick="formEmpresa('abServices')">abServices</button>
										  <button type="button" class="btn btn-primary" id="e2" onClick="formEmpresa('Euroico')">Euroico</button>
  										  <input id="inputEmpresa"  name="empresa" required="required" class="form-control" value=" " style="display: none"/>

										</div></div>
									</div>
								</div>												
						</div>
						<?php
							if($user["Tipo"] == 3){
								echo "<script>";
								echo "formTipo('Administrador');";
								echo "</script>";
							}
							else if($user["Tipo"] == 2){
								echo "<script>";
								echo "formTipo('Trabajador');";
								echo "</script>";
							}
							else if ($user["Tipo"] == 1){
								echo "<script>";
								echo "formTipo('TrabajadorL');";
								echo "</script>";
							}
							if($user["abServices"] == 1){
								echo "<script>";
								echo "formEmpresa('abServices');";
								echo "</script>";
							}
							else if($user["EUROICO"] == 1){
								echo "<script>";
								echo "formEmpresa('Euroico');";
								echo "</script>";
							}
						?>
						<div class="panel-footer">
							<input  class="btn btn-primary" type="button" onClick="location.href='./gestionUsuarios.php'" value="Volver a los anteriores"></input>
							<button type="submit" class="btn btn-primary" name="formRUser" value="Sign in" style="float: right"><strong>Guardar cambios</strong></button>
						</div>
						</form>
			</div>
		</div>
		<script type="text/javascript">
				function validarDatos() {
				var p3 = document.getElementById("inputEmpresa").value;
				if(p3 == " "){
				 document.getElementById("datosFail").style.display = 'block';
				 return false;
				}
				var p4 = document.getElementById("inputTipo").value;
				if(p4 == " "){
				document.getElementById("datosFail").style.display = 'block';
				return false;
				}
				}
		</script>
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="includes/js/bootstrap.min.js"></script>
  </body>
</html>
<?php require(__DIR__.'/includes/php/cleanup.php');?>
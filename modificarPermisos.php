﻿<?php require_once __DIR__.'/includes/php/config.php';?>
<!DOCTYPE html>
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
	<link rel="shortcut icon" href="./includes/css/logo2.jpg" />


    <title>Usuario</title>
 
    <!-- CSS de Bootstrap -->
    <link href="includes/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	<link rel="stylesheet" type="text/css" href="includes/css/style.css"> 
	<script type="text/javascript" src="includes/jquery/jquery-3.1.1.js"></script>
	<script type="text/javascript">
		function formTipo(t) {
			document.getElementById("inputTipo").value=t;
		}
		function formEmpresa(e) {
			document.getElementById("inputEmpresa").value=e;
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
				<h2 id="cab2">Modificar permisos</h2> 
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
						<div class="panel-heading" id="panelHead"><div class="text-center"><strong>Modificar permisos de <?php  echo $userEdit?></strong></div></div>
						<div class="alert alert-danger" style="display: none" id="datosFail">
						<strong>Error!</strong> Hay que señalar tipo de usuario y empresa
						</div>
						<form method = "POST" action="" autocomplete="on" onSubmit="return validarDatos()" class="form-horizontal" role="form">
						<div class="panel-body">
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
										<div class="text-center"> <p><strong> Tipo de usuario </strong></p></div>
										<!--<select name="tipoUser">
										  <option value="cliente">Cliente</option>
										  <option value="trabajador">Trabajador</option>
										  <option value="administrador">Administrador</option>
										</select>-->
										<div class="text-center"><div class="btn-group">
										  <button type="button" class="btn btn-primary" id="tipo1" onClick="formTipo('Cliente')">Cliente</button>
										  <button type="button" class="btn btn-primary" id="tipo2" onClick="formTipo('Trabajador')">Trabajador</button>
										  <button type="button" class="btn btn-primary" id="tipo3" onClick="formTipo('Administrador')">Administrador</button>
										  <input id="inputTipo"  name="tipo" required="required" class="form-control" value="" style="display: none"/>
										</div></div>
									</div>
								</div><hr />
								<div class="form-group">
									<div class="container-fluid">
										<div class="text-center"> <p><strong> Empresa </strong></p></div>
										<div class="text-center"><div class="btn-group">
										  <button type="button" class="btn btn-primary" id="e1" onClick="formEmpresa('abServices')">abServices</button>
										  <button type="button" class="btn btn-primary" id="e2" onClick="formEmpresa('Euroico')">Eurico</button>
  										  <input id="inputEmpresa"  name="empresa" required="required" class="form-control" value="" style="display: none"/>

										</div></div>
									</div>
								</div>												
						</div>
						<div class="panel-footer">
							<input  class="btn btn-primary" type="button" onClick="location.href='./principalAdmin.php'" value="Volver a los anteriores"></input>
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
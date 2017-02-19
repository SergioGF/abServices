<?php require_once __DIR__.'/includes/php/config.php';?>
<!DOCTYPE html>
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$userEdit=$_GET['userToEdit'];
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
						<form method = "POST" action="" autocomplete="on" class="form-horizontal" role="form">
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
										  <button type="button" class="btn btn-primary">Cliente</button>
										  <button type="button" class="btn btn-primary">Trabajador</button>
										  <button type="button" class="btn btn-primary">Administrador</button>
										</div></div>
									</div>
								</div><hr />
								<div class="form-group">
									<div class="container-fluid">
										<div class="text-center"> <p><strong> Empresa </strong></p></div>
										<div class="text-center"><div class="btn-group">
										  <button type="button" class="btn btn-primary">abServices</button>
										  <button type="button" class="btn btn-primary">Eurico</button>
										</div></div>
									</div>
								</div><hr />													
							
						</div>
						<div class="panel-footer">
							<button type="submit" class="btn btn-primary" name="formRUser" value="Sign in"><strong>Guardar cambios</strong></button>
							<button type="submit" class="btn btn-primary" name="formRUser" ><strong>Volver a los anteriores</strong></button>
						</div>
						</form>
			</div>
		</div>
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="includes/js/bootstrap.min.js"></script>
  </body>
</html>
<?php require(__DIR__.'/includes/php/cleanup.php');?>
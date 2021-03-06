﻿<?php require_once __DIR__.'/includes/php/config.php';?>
<!DOCTYPE html>
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if($_SESSION["tipo"] != 1 && $_SESSION["tipo"] != 2 && $_SESSION["tipo"] != 3)
		header('Location: ./login.php');
?>
<html lang="en">
  <head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="./includes/css/abs_logo.jpg" />

	<?php
	$cliente= $_GET['cliente']; 
	?>

    <title>Cliente <?php echo $cliente?> </title>
 
    <!-- CSS de Bootstrap -->
    <link href="includes/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	<link rel="stylesheet" type="text/css" href="includes/css/style.css"> 
	<script type="text/javascript" src="includes/jquery/jquery-3.1.1.js"></script>
  </head>
  <?php 
    require(__DIR__.'/includes/php/trabajos.php');
	require(__DIR__.'/includes/php/clientes.php');
?>
  <body id="scroll">
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
				<div class="col-md-4" >
				<h2 id="cab2">Cliente <?php echo $cliente?></h2> 
				</div>
				<div class="col-md-5" ></div>
				<div class="col-md-3" id="derecha">
				<center><h4>Mes actual</h4></center>
				<strong><span> Horas contratadas: <?php $a = conseguirHoras($cliente); $a = $a.':00'; echo $a?></span></br>
				<span> Horas usadas: <?php $b = horasUsadas($cliente); echo $b?> </span><hr style="margin-top: 10px; margin-bottom: 10px;">
				<span> Horas disponibles: 
				<?php 
				$a = conversorHorasSegundos($a);
				$b = conversorHorasSegundos($b);
				$c = $a - $b;
				
				echo conversorSegundosHoras($c);
				?></span></strong>
				</div>
				</div>
		</div>
			
		<div class="container-fluid">
						<div class="panel panel-primary" >
						<div class="panel-heading" id="panelHead"><div class="text-center"><strong>Listado de trabajos</strong></div></div>
						<div class="panel-body">
							<div class="alert alert-success" style="display: none" id="infoNewTrabajo">
								<script type="text/javascript">
									function succesNew() {
									  document.getElementById("infoNewTrabajo").style.display = 'block';
									}
								</script>
								<?php 
									if($_GET['newTrabajo'] == 1){
										echo "<script>";
										echo "succesNew();";
										echo "</script>";
									}
								?>
								<strong>Exito!</strong> Has creado el trabajo correctamente.
							</div>
							<div class="alert alert-success" style="display: none" id="infoDeleteTrabajo">
								<script type="text/javascript">
									function succesDelete() {
									  document.getElementById("infoDeleteTrabajo").style.display = 'block';
									}
								</script>
								<?php 
									if($_GET['deleteTrabajo'] == 1){
										echo "<script>";
										echo "succesDelete();";
										echo "</script>";
									}
								?>
								<strong>Exito!</strong> Has eliminado el trabajo correctamente.
							</div>
								<?php 
								$trabajos = conseguirTrabajos($cliente);

									foreach((array)$trabajos as $trabajo){
										$descripcion = str_replace(array('\r\n','\r','\n','rn'),'<br>', $trabajo['Descripcion']);
									echo '<div class="form-group"><h4><a href = "./infoTrabajo.php?id='.$trabajo['Id'].'&cliente='.$cliente.'"><strong><div class="container-fluid"><img id="margenIm" src="./includes/css/trabajo.png">'. date_format(new DateTime($trabajo['FVisita']), 'd/m/y').'</div></strong><div id="derecha" style="width:100%; word-wrap: break-word;">'.$descripcion.'</div></a></h4></div><hr id="lineas">';
									}
								?>	<br>
								<?php 
							if($_SESSION["tipo"] != 1){
									?>
							<div class="form-group">
								<div class="col-lg-offset-4 col-lg-11">
									<div class="center-block"><a href="nuevoTrabajo.php?cliente=<?php echo $cliente ?>"><button id="botonCentrado" type="button" class="btn btn-primary"  value="Anadir"><strong>Añadir trabajo</strong></button></a></div>
								</div>
							</div>
								<?php 
							}
									?>

						</div>								
							</form>
						</div>
					</div>
		</div>
		</div>
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="includes/js/bootstrap.min.js"></script>
  </body>
</html>
<?php require(__DIR__.'/includes/php/cleanup.php');?>
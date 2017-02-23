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

    <title>Cliente <?php echo $cliente?> </title>
 
    <!-- CSS de Bootstrap -->
    <link href="includes/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	<link rel="stylesheet" type="text/css" href="includes/css/style.css"> 
	<script type="text/javascript" src="includes/jquery/jquery-3.1.1.js"></script>
  </head>
  <?php 
    require(__DIR__.'/includes/php/trabajos.php');
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
				<h2 id="cab2">Cliente <?php echo $cliente?></h2> 
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

									foreach($trabajos as $trabajo){
									echo '<div class="form-group"><a href = "./infoTrabajo.php?id='.$trabajo['Id'].'&cliente='.$cliente.'"><div class="container-fluid"><img id="margenIm" src="./includes/css/trabajo.png">'.$trabajo['Descripcion'].'<strong></div><div id="derecha">'.$trabajo['FVisita'].'</div></strong></a></div><hr id="lineas">';
									}
								?>	<br>
							<div class="form-group">
								<div class="col-lg-offset-4 col-lg-11">
									<div class="center-block"><a href="nuevoTrabajo.php?cliente=<?php echo $cliente ?>"><button id="botonCentrado" type="button" class="btn btn-primary"  value="Anadir"><strong>Añadir trabajo</strong></button></a></div>
								</div>
							</div>

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
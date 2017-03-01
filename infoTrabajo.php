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
	$client = $_GET['cliente']; 
	$id = $_GET['id'];
require(__DIR__.'/includes/php/trabajos.php');	
	if(isset($_POST['formDelete'])) {
	$result = deleteWork($_POST['trabajo'], $client);
	}
	?>

    <title>Trabajo</title>
 
    <!-- CSS de Bootstrap -->
    <link href="includes/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	<link rel="stylesheet" type="text/css" href="includes/css/style.css"> 
	<script type="text/javascript" src="includes/jquery/jquery-3.1.1.js"></script>
	<script type="text/javascript">
	function eliminarWk(trabajo) {
		document.getElementById("bodyPop").innerHTML = "¿Estás seguro de que deseas eliminar al trabajo Nº " + trabajo + " ?";
		document.getElementById("trabajo").value=trabajo;
	}
	</script>
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
				<h2 id="cab2">Trabajo hecho a <?php echo $client ?></h2> 
				</div>
		</div>
			
		<div class="container-fluid">
						<div class="panel panel-primary" >
						<div class="panel-heading" id="panelHead"><div class="text-center"><strong><img id="margenIm" src="./includes/css/trabajo.png">Trabajo Nº <?php echo $id ?></strong></div></div>
						<div class="panel-body">
								<?php 
								$trabajos = conseguirInfoTrabajo($id);
									
									foreach((array)$trabajos as $trabajo){ //Si no se pone el for, no deja sacar la información.
									echo '<div class="form-group"><div class="container-fluid">
										<ul>
										<li> <span id="negrita">Hecho por:</span> '.$trabajo['Trabajador'].'</li><br>
										<li> <span id="negrita">Descripción:</span> '.$trabajo['Descripcion'].'</li><br>
										<li> <span id="negrita">Fecha visita:</span> '.$trabajo['FVisita'].'</li><br>
										<li> <span id="negrita">Hora entrada:</span> '.$trabajo['HoraE'].'</li><br>
										<li> <span id="negrita">Hora salida:</span> '.$trabajo['HoraS'].'</li><br>
										<li> <span id="negrita">Materiales:</span> '.$trabajo['DescripcionMat'].'</li><br>
										<li> <span id="negrita">Observaciones:</span> '.$trabajo['Observaciones'].'</li><br>
										</ul>
										</div></div>';
									}
								?>	
						</div>
						<div class="panel-footer">
							<input  class="btn btn-primary" type="button" onClick="location.href='./principalAdmin.php'" value="Modificar"></input>
							<!--<button class="glyphicon glyphicon-remove" onclick="eliminarUs('<?php echo $us["Usuario"]?>')" data-toggle="modal" data-target="#myModal" id="deleteUser"></button>-->
							<input  class="btn btn-primary" type="button" onClick="eliminarWk('<?php echo $trabajo["Id"]?>')" value="Eliminar" data-toggle="modal" data-target="#myModal" id="deleteTrabajo" ></input>
							<a href="trabajosCliente.php?cliente=<?php echo $client ?>"><button style="float: right" id="botonCentrado" class="btn btn-primary"  value="Anadir"><strong>Volver a la lista de trabajos</strong></button></a>
						</div>	
						</div>
							</form>
						</div>
					</div>
		</div>
		
		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"></button>
				<h4 class="modal-title">Eliminar Trabajo</h4>
			  </div>
			  <div class="modal-body" id="bodyPop">
				<p>¿Estás seguro de que deseas eliminar?</p>
			  </div>
			  <div class="modal-footer">
				<form method = "POST" action="" autocomplete="on" class="form-horizontal" role="form">
					 <input id="trabajo" type="text" name="trabajo" class="form-control" placeholder="Trabajo" value="" style="display: none"/>
					<button class="btn btn-primary" style="float: right" type="submit" value="Sign in" name="formDelete">Si</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal" style="float: left">No</button>
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
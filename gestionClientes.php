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


    <title>abServices</title>
 
    <!-- CSS de Bootstrap -->
    <link href="includes/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	<link rel="stylesheet" type="text/css" href="includes/css/style.css"> 
	<script type="text/javascript" src="includes/jquery/jquery-3.1.1.js"></script>
	<script type="text/javascript">
	function eliminarCliente(nombre) {
	document.getElementById("bodyPop").innerHTML = "¿Estás seguro de que deseas eliminar a " + nombre + " ?";
	document.getElementById("cliente").value=nombre;
	}
	</script>
  </head>
  <?php
	require(__DIR__.'/includes/php/clientes.php');
		if(isset($_POST['formDelete'])) {
			$result = deleteClient($_POST['cliente']);
		}
	?>
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
				<h2 id="cab2">Gestión de Clientes</h2> 
				</div>
		</div>
			
		<div class="container-fluid">
		<!---- -->
			<h3>Clientes </h3>	
			<p> Desde este apartado se puede eliminar, modificar o añadir nuevos clientes</p>
			<div class="alert alert-success" style="display: none" id="infoClienteDelete">
			<script type="text/javascript">
				function succesDelete() {
				  document.getElementById("infoClienteDelete").style.display = 'block';
				}
			</script>
			<?php 
				if(isset($result)){
					echo "<script>";
					echo "succesDelete();";
					echo "</script>";
				}
			?>
			<strong>Exito!</strong> Has eliminado el cliente correctamente.
			</div>
			<div class="alert alert-success" style="display: none" id="infoClienteEdit">
			<script type="text/javascript">
				function succesEdit() {
				  document.getElementById("infoClienteEdit").style.display = 'block';
				}
			</script>
			<?php 
				if($_GET['clienteEdit'] == 1){
					echo "<script>";
					echo "succesEdit();";
					echo "</script>";
				}
			?>
			<strong>Exito!</strong> Has editado el cliente correctamente.
			</div>
			<div class="alert alert-success" style="display: none" id="infoClienteNew">
			<script type="text/javascript">
				function succesNew() {
				  document.getElementById("infoClienteNew").style.display = 'block';
				}
			</script>
			<?php 
				if($_GET['clienteNew'] == 1){
					echo "<script>";
					echo "succesNew();";
					echo "</script>";
				}
			?>
			<strong>Exito!</strong> Has creado el cliente correctamente.
			</div>
			<div class="row">
				<div class="col-md-6" > 
					<?php
					$clientes = conseguirClientes();				
					foreach((array)$clientes as $cliente){?>
					<ul class="list-group">
						<li class="list-group-item" id="nameC">
							<?php echo '<a href = "./trabajosCliente.php?cliente='.$cliente['Id'].'">'.$cliente['Id'].'</a>'; ?>
						</li>
						<li class="list-group-item" id="accionesC">
							<button class="glyphicon glyphicon-pencil" id="editC" onclick="location.href='./modificarCliente.php?clienteToEdit=<?php echo $cliente["Id"]?>';"></button>
							<button class="glyphicon glyphicon-remove" onclick="eliminarCliente('<?php echo $cliente["Id"]?>')" data-toggle="modal" data-target="#myModal" id="deleteC"></button>
						</li>
					</ul>
					<?php } ?>
				</div>
				<div class="col-md-4" > <div class="container-fluid"> <img src="./includes/css/cliente.png" class="img-responsive"  alt="Imagen responsive"></div></div>
				<div class="col-md-1" id="vacio"><h3> <div class="container-fluid"> </div> </h3></div>
				<div class="col-md-1" id="vacio"> <div class="container-fluid"> <div class="pull-right"><button onClick="location.href='./nuevoCliente.php'" id="botonCrearC" class="btn btn-primary" ><strong>Añadir Cliente</strong></button> </div></div></div>
				</div>
			<!--<a class="btn btn-primary"  href="nuevoCliente.php"><strong>Crear nuevo cliente +</strong></a> -->
			<!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"></button>
					<h4 class="modal-title">Eliminar Cliente</h4>
				  </div>
				  <div class="modal-body" id="bodyPop">
					<p>¿Estás seguro de que deseas eliminar?</p>
				  </div>
				  <div class="modal-footer">
					<form method = "POST" action="" autocomplete="on" class="form-horizontal" role="form">
						 <input id="cliente" type="text" name="cliente" class="form-control" placeholder="Cliente" value="" style="display: none"/>
						<button class="btn btn-primary" style="float: right" type="submit" value="Sign in" name="formDelete">Si</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal" style="float: left">No</button>
					</form>
				  </div>
				</div>

			  </div>
			</div>
		<!---- -->
		</div>
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="includes/js/bootstrap.min.js"></script>
  </body>
</html>
<?php require(__DIR__.'/includes/php/cleanup.php');?>
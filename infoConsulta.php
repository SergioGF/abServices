﻿<?php require_once __DIR__.'/includes/php/config.php';?>
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
	$tipo= $_GET['tipo']; 
	
	if($tipo == 1){
		$cliente = $_GET['cliente']; 
		$fIni = $_GET['fIni']; 
		$fFin = $_GET['fFin']; 
		
		if($fIni == null){
			$fIn = 'X';
		} else {
			$fIn = date_format(new DateTime($fIni), 'd-m-Y');
		}
	} else if($tipo == 2){
		$cliente = $_GET['cliente'];
		$fIni = $_GET['fIni'];
		$fFin = $_GET['fFin'];
		
		if($fIni == null){
			$fIn = 'X';
		} else {
			$fIn = date_format(new DateTime($fIni), 'd-m-Y');
		}
	} else{
		$tecnico = $_GET['tecnico'];
		$fIni = $_GET['fIni'];
		$fFin = $_GET['fFin'];
		
		if($fIni == null){
			$fIn = 'X';
		} else {
			$fIn = date_format(new DateTime($fIni), 'd-m-Y');
		}
	}
	?>

    <title>abServices</title>
 
    <!-- CSS de Bootstrap -->
    <link href="includes/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	<link rel="stylesheet" type="text/css" href="includes/css/style.css"> 
	<script type="text/javascript" src="includes/jquery/jquery-3.1.1.js"></script>
  </head>
  <?php 
    require(__DIR__.'/includes/php/consultas.php');
	require(__DIR__.'/includes/php/clientes.php');
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
				<h2 id="cab2">Consulta</h2> 
				</div>
		</div>
			
		<div class="container-fluid">
						<div class="panel panel-primary" >
						<div class="panel-heading" id="panelHead"><div class="text-center"><strong>Consulta de tipo '<?php if($tipo == 1) echo 'Acumulados ('.$cliente.': '.$fIn.' - '.date_format(new DateTime($fFin), 'd-m-Y').')'; else if($tipo == 2)  echo 'Fecha y Cliente (' .$cliente.': '.$fIn.' - '.date_format(new DateTime($fFin), 'd-m-Y').')'; else echo 'Fecha y Técnico (' .$tecnico.': '.$fIn.' - '.date_format(new DateTime($fFin), 'd-m-Y').')';?>'</strong></div></div>
						<div class="panel-body">
							<?php 
								$trabajos = [];
								
								if($tipo == 1){
									$horasCliente = conseguirHoras($cliente);
									$horasUsadas = consAcumulados($cliente,$fIni,$fFin);
									
									echo '<center><div class="form-group"><strong><span>Horas contratadas: '.$horasCliente.' horas</span><br><span>Horas usadas: '.$horasUsadas.' horas</span></strong></div></center></br>';
									
								} else if($tipo == 2){
									$trabajos = consByDateAndClient($cliente, $fIni, $fFin);
									foreach((array)$trabajos as $trabajo){
										echo '<div class="form-group"><h4><a href = "./infoTrabajo.php?id='.$trabajo['Id'].'&cliente='.$trabajo['IdCliente'].'"><div class="container-fluid"><img id="margenIm" src="./includes/css/trabajo.png">'.$trabajo['Descripcion'].'<strong></div><div id="derecha">'.$trabajo['FVisita'].'</div></strong></a></h4></div><hr id="lineas">';
									}
								} else{
									$trabajos = consByDateAndTechnician($tecnico, $fIni, $fFin);
									foreach((array)$trabajos as $trabajo){
										echo '<div class="form-group"><h4><a href = "./infoTrabajo.php?id='.$trabajo['Id'].'&cliente='.$trabajo['IdCliente'].'"><div class="container-fluid"><img id="margenIm" src="./includes/css/trabajo.png">'.$trabajo['Descripcion'].'<strong></div><div id="derecha">'.$trabajo['FVisita'].'</div></strong></a></h4></div><hr id="lineas">';
									}
								}
									
									//Hay que hacer esto para poder pasar un array por URL.
										$tr = serialize($trabajos); 
										$tr = urlencode($tr);  
									
							?>
						</div>	
							<div class="panel-footer">
							<?php
							if($tipo == 2 || $tipo == 3){
								echo '<a href="excel.php?trabajos='.$tr.'"><input class="btn btn-primary" type="button" value="Generar informe"></input></a>';
							} else {
								
							}
							?>
							<strong><a href="homeConsultas.php"><input style="float:right" id="botonCentrado" class="btn btn-primary"  value="Hacer otra consulta"></input></a></strong>
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
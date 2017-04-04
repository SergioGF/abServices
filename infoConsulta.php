<?php require_once __DIR__.'/includes/php/config.php';?>
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
	$tipo= $_GET['tipo']; 
	
	if($tipo == 1){
		$cliente = $_GET['cliente']; 
		$fIni = $_GET['fIni']; 
		$fFin = $_GET['fFin']; 
		
		if($fIni == null){
			$fIn = 'X';
		} else {
			$fIn = date_format(new DateTime($fIni), 'd/m/y');
		}
	} else if($tipo == 2){
		$cliente = $_GET['cliente'];
		$fIni = $_GET['fIni'];
		$fFin = $_GET['fFin'];
		
		if($fIni == null){
			$fIn = 'X';
		} else {
			$fIn = date_format(new DateTime($fIni), 'd/m/y');
		}
	}  else if($tipo == 4){
		$fIni = $_GET['fIni'];
		$fFin = $_GET['fFin'];
		
		if($fIni == null){
			$fIn = 'X';
		} else {
			$fIn = date_format(new DateTime($fIni), 'd/m/y');
		}
	}
	else{
		$tecnico = $_GET['tecnico'];
		$fIni = $_GET['fIni'];
		$fFin = $_GET['fFin'];
		
		if($fIni == null){
			$fIn = 'X';
		} else {
			$fIn = date_format(new DateTime($fIni), 'd/m/y');
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
				<h2 id="cab2">Consulta</h2> 
				</div>
		</div>
			
		<div class="container-fluid">
						<div class="panel panel-primary" >
						<div class="panel-heading" id="panelHead"><div class="text-center"><strong>Consulta de tipo '<?php if($tipo == 1) echo 'Acumulados ('.$cliente.': '.$fIn.' - '.date_format(new DateTime($fFin), 'd/m/y').')'; else if($tipo == 2)  echo 'Cliente (' .$cliente.': '.$fIn.' - '.date_format(new DateTime($fFin), 'd/m/y').')'; else if($tipo == 4)  echo 'Fechas ( '.$fIn.' - '.date_format(new DateTime($fFin), 'd/m/y').')'; else echo 'Técnico (' .$tecnico.': '.$fIn.' - '.date_format(new DateTime($fFin), 'd/m/y').')';?>'</strong></div></div>
						<div class="panel-body">
							<?php 
								$trabajos = [];
								
								if($tipo == 1){
									$horasCliente = conseguirHoras($cliente).':00';
									$horasUsadas = consAcumulados($cliente,$fIni,$fFin);
									
									echo '<center><br><div style="width:400px;height:100px;border:1px solid black; background-color:#D3F1EE;"><br><strong><span>Horas contratadas / mes: '.$horasCliente.' horas</span><br><span>Horas hechas en intervalo: '.$horasUsadas.' horas</span></strong></div></center></br>';
									
								} else if($tipo == 2){
									$trabajos = consByDateAndClient($cliente, $fIni, $fFin);
									foreach((array)$trabajos as $trabajo){
										echo '<div class="form-group"><h4><a href = "./infoTrabajo.php?id='.$trabajo['Id'].'&cliente='.$trabajo['IdCliente'].'"><div class="container-fluid"><img id="margenIm" src="./includes/css/trabajo.png">'.$trabajo['Descripcion'].'<strong></div><div id="derecha">'.$trabajo['FVisita'].'</div></strong></a></h4></div><hr id="lineas">';
									}
								} else if($tipo == 4){
									$trabajos = consByDate($fIni, $fFin);
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
							if($tipo == 2){
								echo '<a href="excel.php?trabajos='.$tr.'&cliente='.$cliente.'&tipo='.$tipo.'&fIni='.$fIn.'&fFin='.date_format(new DateTime($fFin), 'd-m-Y').'"><input class="btn btn-primary" type="button" value="Generar informe"></input></a>';
							} else if($tipo == 3){
								echo '<a href="excel.php?trabajos='.$tr.'&tecnico='.$tecnico.'&tipo='.$tipo.'&fIni='.$fIn.'&fFin='.date_format(new DateTime($fFin), 'd-m-Y').'"><input class="btn btn-primary" type="button" value="Generar informe"></input></a>';
							} else if($tipo == 4){
								echo '<a href="excel.php?trabajos='.$tr.'&tipo='.$tipo.'&fIni='.$fIn.'&fFin='.date_format(new DateTime($fFin), 'd-m-Y').'"><input class="btn btn-primary" type="button" value="Generar informe"></input></a>';
							}
							?>
							<?php
							if($tipo == 1){ ?>
							<button  class="btn btn-primary" onClick="location.href='./homeConsultas.php'">Hacer otra consulta</button>
							<?php } 
							else {
							?>
							<button  class="btn btn-primary" style="float:right" onClick="location.href='./homeConsultas.php'">Hacer otra consulta</button>
							<?php } ?>
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
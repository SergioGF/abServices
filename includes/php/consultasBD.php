<?php
require_once(__DIR__."/config.php");

function consultaPorCliente($cliente){
	global $mysqli;
	$trabajos = null;
	
	$args = array($cliente);
	sanitizeArgs($args);
	
	$pst = $mysqli->prepare("SELECT * FROM trabajos WHERE IdCliente = ? ORDER BY FVisita DESC;");
	$pst->bind_param("s",$args[0]);
	$pst->execute();
	$result = $pst->get_result();
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$trabajos[] = $row;
	}
	
	$pst->close();
	return $trabajos;  
}

function consultaPorClienteyFecha($cliente, $fIni, $fFin){
	global $mysqli;
	$trabajos = null;
	
	$args = array($cliente, $fIni, $fFin);
	sanitizeArgs($args);
	
	$pst = $mysqli->prepare("SELECT * FROM trabajos WHERE IdCliente = ? AND (FVisita BETWEEN ? AND ?) ORDER BY FVisita DESC;");
	$pst->bind_param("sss",$args[0], $args[1], $args[2]);
	$pst->execute();
	$result = $pst->get_result();
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$trabajos[] = $row;
	}
	
	$pst->close();
	return $trabajos;  
}

function consultaPorTecnico($tecnico){
	global $mysqli;
	$trabajos = null;
	
	$args = array($tecnico);
	sanitizeArgs($args);
	
	$pst = $mysqli->prepare("SELECT * FROM trabajos WHERE Trabajador = ? ORDER BY FVisita DESC;");
	$pst->bind_param("s",$args[0]);
	$pst->execute();
	$result = $pst->get_result();
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$trabajos[] = $row;
	}
	
	$pst->close();
	return $trabajos;  
}

function consultaPorTecnicoyFecha($tecnico, $fIni, $fFin){
	global $mysqli;
	$trabajos = null;
	
	$args = array($tecnico, $fIni, $fFin);
	sanitizeArgs($args);
	
	$pst = $mysqli->prepare("SELECT * FROM trabajos WHERE Trabajador = ? AND (FVisita BETWEEN ? AND ?) ORDER BY FVisita DESC;");
	$pst->bind_param("sss",$args[0], $args[1], $args[2]);
	$pst->execute();
	$result = $pst->get_result();
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$trabajos[] = $row;
	}
	
	$pst->close();
	return $trabajos;  
}
?>
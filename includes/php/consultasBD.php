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

function getAcumulados($id,$mes, $anyo){
	
	global $mysqli;
	$fecha = $anyo.'-'.$mes;
	$args = array($id);
	sanitizeArgs($args);
	
	$pst = $mysqli->prepare("SELECT * FROM trabajos WHERE (IdCliente = ?)");
	$pst->bind_param("s",$args[0]);
	$pst->execute();
	$result = $pst->get_result();
	$duracion = 0.0;
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$horas = $row;
		$pos = strpos($horas['FVisita'],$fecha);
		if($pos !== false){
			$horai=substr($horas['HoraE'],0,2);
			$mini=substr($horas['HoraE'],3,2);
			$segi=substr($horas['HoraE'],6,2);
		 
			$horaf=substr($horas['HoraS'],0,2);
			$minf=substr($horas['HoraS'],3,2);
			$segf=substr($horas['HoraS'],6,2);
		 
			$ini=((($horai*60)*60)+($mini*60)+$segi);
			$fin=((($horaf*60)*60)+($minf*60)+$segf);
			
			$duracion+=abs($fin-$ini);
			}
	}
	$duracion = conversorSegundosHoras($duracion);
	
	$pst->close();
	return $duracion;   
}	

?>
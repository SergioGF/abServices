<?php
require_once(__DIR__."/config.php");

function deleteWorksClient($id){
	
	global $mysqli;

	$args = array($id);
	sanitizeArgs($args);

	$pst = $mysqli->prepare("DELETE FROM trabajos WHERE IdCliente = ?");
	$pst->bind_param("s",$args[0]);
	$result = $pst->execute();

	$pst->close();
	
	return $result;
}

function getTrabajos($id){
	
	global $mysqli;
	$trabajos = null;
	
	$args = array($id);
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

function getInfoWork($id){
	
	global $mysqli;
	$args = array($id);
	sanitizeArgs($args);
	
	$pst = $mysqli->prepare("SELECT * FROM trabajos WHERE Id = ?");
	$pst->bind_param("i",$args[0]);
	$pst->execute();
	$result = $pst->get_result();
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$info = $row;
	}
	$pst->close();
	return $info;     
}

function registrarTrabajo($cliente, $usuario, $ubicacion, $fVisita, $horaE, $horaS, $desc, $descM, $obs){
	global $mysqli;
	$args = array($cliente,$usuario,$ubicacion, $fVisita, $horaE, $horaS, $desc, $descM, $obs);
	sanitizeArgs($args);
	$pst = $mysqli->prepare("INSERT INTO trabajos VALUES (null,?,?,?,?,?,?,?,?,?);"); //null para el campo autoincrement
	$pst->bind_param("sssssssss",$args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6], $args[7],$args[8]);
	$result = $pst->execute();
	
	$pst->close();
	
	return $result;
}

function modificarTrabajo($cliente, $fVisita, $ubicacion, $horaE, $horaS, $desc, $descM, $obs, $id){
	global $mysqli;
	$args = array($cliente, $ubicacion, $fVisita, $horaE, $horaS, $desc, $descM, $obs, $id);
	sanitizeArgs($args);
	$pst = $mysqli->prepare("UPDATE trabajos SET IdCliente = ?, Ubicacion = ?, FVisita = ?, HoraE = ?, HoraS = ?, Descripcion = ?, DescripcionMat = ?, Observaciones = ? WHERE Id = ?"); //null para el campo autoincrement
	$pst->bind_param("sssssssss",$args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6], $args[7], $args[8]);
	$result = $pst->execute();
	
	$pst->close();
	
	return $result;
}
function eliminarTrabajo($id){
	global $mysqli;

	$args = array($id);
	sanitizeArgs($args);

	$pst = $mysqli->prepare("DELETE FROM trabajos WHERE Id = ?");
	$pst->bind_param("i",$args[0]);
	$result = $pst->execute();

	$pst->close();
	
	return $result;
}

function updateWorksClient($idCliente, $idClienteN){
	global $mysqli;
	$args = array($idClienteN,$idCliente);
	sanitizeArgs($args);	
	$pst = $mysqli->prepare("UPDATE trabajos SET IdCliente = ? WHERE IdCliente = ?");
	$pst->bind_param("ss", $args[0], $args[1]);
	
	$result = $pst->execute();
	
	$pst->close();
	
	return $result;
}

function getHorasTrabajos($id){
	
	global $mysqli;
	
	$fIni = date("Y").'-'.date("m").'-01';
	$fFin = date("Y").'-'.date("m").'-31';
	
	$args = array($id, $fIni, $fFin);
	sanitizeArgs($args);
	
	$pst = $mysqli->prepare("SELECT * FROM trabajos WHERE IdCliente = ? AND (FVisita BETWEEN ? AND ?)");
	$pst->bind_param("sss",$args[0],$args[1],$args[2]);
	$pst->execute();
	$result = $pst->get_result();
	$duracion = 0.0;
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$horas = $row;
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
	$duracion = conversorSegundosHoras($duracion);
	
	$pst->close();
	return $duracion;          
}

function conversorSegundosHoras($tiempo_en_segundos) {
	$horas = floor($tiempo_en_segundos / 3600);
	$minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
	
	if($minutos == 0) $minutos = $minutos.'0';
	
	return $horas . ':' . $minutos;
}


?>
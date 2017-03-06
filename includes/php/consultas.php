<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/consultasBD.php';

function consByClient($cliente){
	$result = consultaPorCliente($cliente);
	
	return $result;
}

function consByDateAndClient($cliente, $fIni, $fFin){
	
	if($fIni == null & $fFin == null) $result = consultaPorCliente($cliente);
	else $result = consultaPorClienteyFecha($cliente, $fIni, $fFin);
	
	return $result;
}

function consByTechnician($tecnico){
	$result = consultaPorTecnico($tecnico);
	
	return $result;
}

function consByDateAndTechnician($tecnico, $fIni, $fFin){
	
	if($fIni == null & $fFin == null) $result = consultaPorTecnico($tecnico);
	else $result = consultaPorTecnicoyFecha($tecnico, $fIni, $fFin);
	
	return $result;
}


?>
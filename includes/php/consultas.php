<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/consultasBD.php';

function consByClient($cliente){
	$result = consultaPorCliente($cliente);
	
	return $result;
}

function consByDateAndClient($cliente, $fIni, $fFin){
	$result = consultaPorClienteyFecha($cliente, $fIni, $fFin);
	
	return $result;
}

function consByTechnician($tecnico){
	$result = consultaPorTecnico($tecnico);
	
	return $result;
}

?>
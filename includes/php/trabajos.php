<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/trabajosBD.php';

function borrarTrabajosCliente($idCliente){
	
	$result = deleteWorksClient($idCliente);
	
	return $result;
}

function conseguirTrabajos($id){
	
	$result = getTrabajos($id);
	
	return $result;
}

function conseguirInfoTrabajo($id){
	
	$result = getInfoWork($id);
	
	return $result;
}

function formRegisterTrabajo($params, $cliente) {
	
	$ok = false;
	
	$descMat = $params['DescripcionMat'];
	$obs = $params['Observaciones']; // Estos 2 campos pueden ser null.
	
	if($params['DescripcionMat'] == null) $descMat = null;
	if($params['Observaciones'] == null) $obs = null;
		
		$ok = registrarTrabajo($cliente,$params['fechaVisita'],$params['horaEntrada'], $params['horaSalida'], $params['Descripcion'],
								$descMat, $obs); //Campo ID autocompletable.
		
		if($ok){
			$result[] = "El registro se ha realizado con éxito.";
			header('Location: ./trabajosCliente.php?cliente=$cliente'); //Esto no se si funcionará.
		} else {
			$result[] = "El registro no se ha podido realizar con éxito.";
		}

  return $result;
}
?>
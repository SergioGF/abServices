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

function formRegisterTrabajo($params, $cliente, $usuario) {
	
	$ok = false;
	
	$descMat = $params['descmat'];
	$obs = $params['observaciones']; // Estos 2 campos pueden ser null.
	
	if($params['descmat'] == null) $descMat = null;
	if($params['observaciones'] == null) $obs = null;
		
		$ok = registrarTrabajo($cliente, $usuario, $params['fvisita'],$params['horae'], $params['horas'], $params['descripcion'],
								$descMat, $obs); //Campo ID autocompletable.
		
		if($ok){
			$result[] = "El registro se ha realizado con éxito.";
			header('Location: ./trabajosCliente.php?cliente='.$cliente.'&newTrabajo=1');
		} else {
			$result[] = "El registro no se ha podido realizar con éxito.";
		}

  return $result;
}

function deleteWork($id, $cliente){
	$ok = false;
	
	$ok = eliminarTrabajo($id);
	
	if($ok){
			$result[] = "El trabajo ha sido eliminado con éxito.";
			header('Location: ./trabajosCliente.php?cliente='.$cliente.'&deleteTrabajo=1');
		} else {
			$result[] = "El trabajo no se ha podido eliminar.";
	}
	return $result;
}

function actualizarTrabajosCliente($oldId, $newId){
	$result = updateWorksClient($oldId, $newId);
	return $result;
}
?>
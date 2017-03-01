<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/trabajos.php';
require_once __DIR__.'/clientesBD.php';

function conseguirClientes(){
	
	$result = getClientes();
	
	return $result;
}

function formRegisterClient($params) {
	
	$ok = false;
	
	if(buscarClient($params['cliente']) < 1){ // Si no hay algun cliente con ese nombre
  
		
		$ok = registrarCliente($params['cliente']);
		
		if($ok){
			$result[] = "El registro se ha realizado con éxito.";
			header('Location: ./gestionClientes.php?clienteNew=1');
		} else {
			$result[] = "El registro no se ha podido realizar con éxito.";
		}
	}else {
			$result[] = "El ID del cliente ya se encuentra en uso.";
	}

  return $result;
}

function deleteClient($id){

  $ok = false;
  $ok2 = false;
  // Si existe el cliente
	if(buscarClient($id) > 0) { // Siempre va a existir porque sale en la lista, aunque se realiza la comprobación por si acaso.
		$ok = eliminarCliente($id);
		$ok2 = borrarTrabajosCliente($id); // Se borran los trabajos asociados a dicho cliente.
		
		if($ok && $ok2){
			$result[] = "El cliente ha sido eliminado con éxito.";
		} else {
			$result[] = "El cliente no se ha podido eliminar.";
		}
	}
	else{
		$result[] = "El cliente no se ha podido eliminar.";
	}
	return $result;
}

function editClient($oldId, $newId){
	if(buscarClient($oldId) > 0) { // Siempre va a existir porque sale en la lista, aunque se realiza la comprobación por si acaso.
		$ok = actualizarCliente($oldId, $newId);
		$ok2 = actualizarTrabajosCliente($oldId, $newId); 
		
		if($ok && $ok2){
			$result[] = "El cliente ha sido editado con éxito.";
			header('Location: ./gestionClientes.php?clienteEdit=1');
		} else {
			$result[] = "El cliente no se ha podido editar.";
		}
	}
	else{
		$result[] = "El cliente no se ha podido editar.";
	}
	return $result;
}

function getCliente($id){
	
	$ok = false;
	
	if(buscarClient($id) > 0){
		$ok = true;
	}
	
	return $ok;
}

?>
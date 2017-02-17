<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/usuariosBD.php';
require_once __DIR__.'/registrosBD.php';

function formRegisterUser($params) {
	
	$ok = false;
	
	if(buscarNick($params['usuario']) < 1){ // Si no hay algun usuario con ese nombre
  
		$tipo = 1;
		$abservices = 0; //false
		$euroico = 0; // false;;
		
		if($params['tipoUser'] == 'cliente') $tipo = 1;
		else if ($params['tipoUser'] == 'trabajador') $tipo = 2;
		else if($params['tipoUser'] == 'administrador')$tipo = 3; 
		
		if($params['abservices'] == 'abServices') $abservices = 1;
		if($params['euroico'] == 'Euroico') $euroico = 1;
		
		$ok = registrarUsuario($params['usuario'],$params['password'],$tipo,$abservices,$euroico);
		
		if($ok){
			$result[] = "El registro se ha realizado con éxito.";
		} else {
			$result[] = "El registro no se ha podido realizar con éxito.";
		}
	}else {
			$result[] = "El nombre de usuario ya se encuentra en uso.";
	}

  return $result;
}

?>
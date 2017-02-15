<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/usuariosBD.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function formLogin($params, &$error) {

  $name = $params['usuario'];
  $pass = $params['password'];
  $result = [];
  
  $result = login($name, $pass, $error);

  return $result;
}

function login($nombreUsuario, $password, &$error) {
 
  $ok = false;
  $usuario = getInfoUser($nombreUsuario);
  
  // Si existe el usuario
	if ( $usuario ) {
		$ok = password_verify($password, $usuario['Password']);
		//Si la contraseña es correcta
		if($ok){
			$ok = [];
		  $ok[] = "Todo bien";
		  
		  $_SESSION["usuario"] = $usuario['Usuario'];
		  $_SESSION["password"] = $usuario['Password'];
		  $_SESSION["tipo"] = $usuario['Tipo'];
		// Rescatar tipo de usuario y ver donde situarlo.	
		} else {
		  $error = TRUE;
		  $ok = [];
		  $ok[] = "Usuario o contraseña no válidos";
		}
	}else {
		$error =  TRUE;
		$ok = [];
		$ok[] = "Usuario o contraseña no válidos";
	}
  return $ok;
  
}

?>
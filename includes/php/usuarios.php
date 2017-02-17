<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/usuariosBD.php';

function formLogin($params) {

  $name = $params['usuario'];
  $pass = $params['password'];
  $result = [];
  
  $result = login($name, $pass);

  return $result;
}

function login($nombreUsuario, $password) {
 
  $usuario = getInfoUser($nombreUsuario);
  
  // Si existe el usuario
	if ( $usuario ) {
		//Si la contraseña es correcta
		if($password == $usuario['Password']){
		// Rescatar tipo de usuario y ver donde situarlo.	
		  $_SESSION["usuario"] = $usuario['Usuario'];
		  $_SESSION["password"] = $usuario['Password'];
		  $_SESSION["tipo"] = $usuario['Tipo'];
		  if($usuario['Tipo'] == 3)
		  header('Location: ./principalAdmin.php');
		  else if($usuario['Tipo'] == 2)
		  header('Location: ./principalTrabajador.php');
		  else if($usuario['Tipo'] == 1)
		  header('Location: ./principalCliente.php');
		} else {
		  $ok = [];
		  $ok[] = "Usuario o contraseña no válidos";
		}
	}else {
		$ok = [];
		$ok[] = "Usuario o contraseña no válidos";
	}
  return $ok;
  
}

function formPass($params, $nick) {

  $passV = $params['antPass'];
  $passN = $params['newPass1'];
  $result = [];
  $ok = false;
  
   $usuario = getInfoUser($nick);

   if($usuario['Password'] == $passV){ //Si las contraseñas son iguales
	 $ok = editPass($nick,$passN);
	
		if($ok == false){
			$result[] = "La contraseña no se ha podido actualizar con éxito.";
		}
		else {
			$result[] = "La contraseña se ha actualizado con éxito.";
		}
   } else{
	   $result[] = "La contraseña que ha introducido no coincide con la actual.";
   }
  return $result;
}

function formUser($params, $nick) {

  $nickN = $params['nickNuevo'];
  $result = [];
  
  $ok = false;
 
	 $ok = editUser($nick,$nickN);
	
		if($ok == false){
			$result[] = "El nombre de usuario que ha introducido ya se encuentra en uso.";
		}
		else {
			$_SESSION["usuario"] = $nickN;
			$result[] = "El nombre de usuario se ha actualizado correctamente.";
		}
  return $result;
}


?>
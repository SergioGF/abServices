<?php
require_once(__DIR__."/config.php");

function getInfoUser($nick){
	global $mysqli;
	
	$args = array($nick);
	sanitizeArgs($args);
	$info = null;
	
	$pst = $mysqli->prepare("SELECT * FROM users WHERE Usuario = ?");
	$pst->bind_param("s",$args[0]);
	$pst->execute();

	$result = $pst->get_result();
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$info = $row;
	}
	$pst->close();
	return $info;
}                    

function editPass($nick, $passN){
	global $mysqli;
	$args = array($passN, $nick);
	sanitizeArgs($args);	
	$pst = $mysqli->prepare("UPDATE users SET Password = ? WHERE Usuario = ?");
	$pst->bind_param("ss", $args[0], $args[1]);
	
	$result = $pst->execute();
	
	$pst->close();
	
	return $result;
}

function editUser($nickV, $nickN){
	global $mysqli;
	$args = array($nickN, $nickV);
	sanitizeArgs($args);	
	$pst = $mysqli->prepare("UPDATE users SET Usuario = ? WHERE Usuario = ?");
	$pst->bind_param("ss", $args[0], $args[1]);
	
	$result = $pst->execute();
	
	$pst->close();
	
	return $result;
}            

function buscarNick($nick){
	global $mysqli;
	$err = 0;
	$args = array($nick);
	sanitizeArgs($args);
	$info = null;
	$pst = $mysqli->prepare("SELECT Usuario FROM users WHERE Usuario = ?");
	$pst->bind_param("s",$args[0]);
	$pst->execute();
	$result = $pst->get_result();
	$numregistros=$result->num_rows;
	$pst->close();
	return $numregistros;
}     

function getUsers(){
	global $mysqli;
	$usuarios = null;
	
	$pst = $mysqli->prepare("SELECT * FROM users ;");
	$pst->execute();
	$result = $pst->get_result();
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$usuarios[] = $row;
	}
	
	$pst->close();
	return $usuarios;
}                
?>
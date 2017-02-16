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
?>
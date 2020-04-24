<?php

	function deconnexion($elem){
		session_start();
		$_SESSION = array();
		session_destroy();
		unset($_SESSION[$elem]);
		header('Location: index.php');
		exit();
	}
	deconnexion('connected');

?>
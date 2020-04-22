<?php

	$infos = array();
	array_push($infos, $_POST['email'],hash('sha256', $_POST['mdp']);
	$handle = fopen('./comptes.csv', 'r');
	$found = false
	while ($lignes = fgets($handle) && $found == false) {
		$lignes = explode(";", $lignes);
		if ($lignes[2] == $infos[0]) {
			if ($lignes[3] == $infos[1]) {
				header("Location: ./donnees.php");
			}
			else{
				header("Location: ./index.php");
			}
		}
	}
	fclose($handle);

?>
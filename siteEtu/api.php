<?php

	$etus = array();
	if ($_GET['option'] == 'classe') {
		$classe = $_GET['classe'];
		$fichier = file('./comptes.csv');
		for ($i=0; $i < sizeof($fichier); $i++) { 
			$infos = explode(';', $fichier[$i]);
			$infos = array_slice($infos, 0, sizeof($infos)-2);
			unset($infos[3]);
			if ($infos[5] == $classe) {
				array_push($etus, $infos);
			}
		}
		$json = json_encode($etus);
		header("Content-type: application/json");
		echo $json;

	}

	elseif ($_GET['option'] == 'groupe') {
		
	}

?>
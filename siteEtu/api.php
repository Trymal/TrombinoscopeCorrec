<?php

	$etus = array();
	if ($_GET['option'] == 'classe') {
		$classe = $_GET['classe'];
		$fichier = file('./comptes.csv');
		for ($i=0; $i < sizeof($fichier); $i++) { 
			$infos = explode(';', $fichier[$i]);
			if ($infos[5] == $classe) {
				array_push($etus, $infos);
			}
		}
		print_r($etus);
	}

	elseif ($_GET['option'] == 'groupe') {
		
	}

?>
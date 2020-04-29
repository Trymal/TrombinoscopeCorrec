<?php

	$etus = array();
	$authorizedKeys = file('./keys.csv');
	$accesAPI = FALSE;
	foreach ($authorizedKeys as $value) {
		$ligne = explode(';', $value);
		if ($ligne[0] == $_GET['key']) {
			$accesAPI = TRUE;
		}
	}

	if ($accesAPI == TRUE) {
		if ($_GET['option'] == 'filiere') {
			$classe = $_GET['classe'];
			$fichier = file('./comptes.csv');
			for ($i=0; $i < sizeof($fichier); $i++) { 
				$infos = explode(';', $fichier[$i]);
				$infos = array_slice($infos, 0, sizeof($infos)-2);
				unset($infos[3]);
				if ($infos[5] == $classe) {
					array_push($etus, $infos);
				}
				if (sizeof($etus) == 0) {
					$etus = array("Cette filiere n'existe pas");
				}
			}
		}

		elseif ($_GET['option'] == 'groupe') {
			$classe = $_GET['filiere'];
			$groupe = $_GET['groupe'];
			$fichier = file('./comptes.csv');
			for ($i=0; $i < sizeof($fichier); $i++) { 
				$infos = explode(';', $fichier[$i]);
				$infos = array_slice($infos, 0, sizeof($infos)-1);
				unset($infos[3]);
				unset($infos[7]);
				if ($infos[5] == $classe && $infos[6] == $groupe) {
					array_push($etus, $infos);
				}
			}
			if (sizeof($etus) == 0) {
				$etus = array("Ce groupe n'existe pas");
			}
		}
	}
	else{
		$etus = array("La cle n'est pas bonne");
	}

	

	$json = json_encode($etus);
		header("Content-type: application/json");
		echo $json;

?>
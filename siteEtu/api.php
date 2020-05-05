<?php

	$etus = array();
	$authorizedKeys = file('./csv/keys.csv');
	$accesAPI = FALSE;
	foreach ($authorizedKeys as $value) {
		$ligne = explode(';', $value);
		if ($ligne[0] == $_GET['key']) {
			$accesAPI = TRUE;
		}
	}

	if ($accesAPI == TRUE) {
		if ($_GET['option'] == 'filiere') {
			$classe = $_GET['filiere'];
			$fichier = file('./csv/comptes.csv');
			for ($i=0; $i < sizeof($fichier); $i++) { 
				$infos = explode(';', $fichier[$i]);
				$infos = array_slice($infos, 0, sizeof($infos) -1);
				unset($infos[3]);
				unset($infos[7]);
				if ($infos[5] == $classe) {
					array_push($etus, $infos);
				}
			}
			if (sizeof($etus) == 0) {
				$etus = array("Cette filiere n'existe pas");
			}
		}

		elseif ($_GET['option'] == 'groupe') {
			$groupe = $_GET['groupe'];
			$fichier = file('./csv/comptes.csv');
			for ($i=0; $i < sizeof($fichier); $i++) { 
				$infos = explode(';', $fichier[$i]);
				$infos = array_slice($infos, 0, sizeof($infos) -1);
				unset($infos[3]);
				unset($infos[7]);
				if ($infos[6] == $groupe) {
					array_push($etus, $infos);
				}
			}
			if (sizeof($etus) == 0) {
				$etus = array("Ce groupe n'existe pas");
			}
		}

		elseif ($_GET['option'] == 'etu'){
			$fichier = file('./csv/comptes.csv');
			for ($i=0; $i < sizeof($fichier); $i++) { 
				$infos = explode(';', $fichier[$i]);
				$infos = array_slice($infos, 0, sizeof($infos)-1);
				unset($infos[3]);
				unset($infos[7]);
				if ($infos[0] == $_GET['etuNom'] && $infos[1] == $_GET['etuPren']) {
					array_push($etus, $infos);
				}
			}
			if (sizeof($etus) == 0) {
				$etus = array("Cet etudiant n'existe pas");
			}
		}
	}
	else{
		$etus = array("La cle n'est pas bonne");
	}

	

	$json = json_encode($etus);
		header("Content-type: application/json");
		header("Access-Control-Allow-Origin: http://correc.yo.fr");
		echo $json;

?>
<?php

	$etus = array();
	$authorizedKeys = file('./csv/keys.csv');
	$accesAPI = FALSE;
	foreach ($authorizedKeys as $value) {
		$ligne = explode(';', $value);
		//Si la clé est dans le fichier des clés autorisées, alors on accorde l'accès. Sinon message d'erreur
		if ($ligne[0] == $_GET['key']) {
			$accesAPI = TRUE;
		}
	}

	if ($accesAPI == TRUE) {
		//Api pour les étudiants selon la filière
		if ($_GET['option'] == 'filiere') {
			$classe = $_GET['filiere'];
			$fichier = file('./csv/comptes.csv');
			for ($i=0; $i < sizeof($fichier); $i++) { 
				$infos = explode(';', $fichier[$i]);
				$infos = array_slice($infos, 0, sizeof($infos) -1);
				unset($infos[3]);
				unset($infos[7]);
				if ($infos[5] == $classe) {
					//On met les données des étudiants dans la liste
					array_push($etus, $infos);
				}
			}
			if (sizeof($etus) == 0) {
				//Si aucun étudiant n'est dans la liste fournie, alors message d'erreur --> on considère que la filière n'existe pas
				$etus = array("Cette filiere n'existe pas");
			}
		}

		elseif ($_GET['option'] == 'groupe') {
			//Api pour les étudiants selon le groupe - Même architecture
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
			//Api pour un étudiant selon son nom et son prénom - Même architecture
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
	//On encode la liste
	header("Content-type: application/json");
	header("Access-Control-Allow-Origin: http://correc.yo.fr");
	//On autorise le site pédagogique à accéder à la page
	echo $json;
	//On écrit le flux json
?>
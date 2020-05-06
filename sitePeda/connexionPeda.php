<?php
	
	session_start();
	if (!isset($_SESSION['connected'])) {
		//Si la session n'existe pas on procède à la vérification des informations
		$infos = array();
		$handle = fopen('./comptes.csv', 'r');
		array_push($infos, $_POST['email']);		
		while ($lignes = fgets($handle)) {
			$lignes = explode(";", $lignes);
			if ($lignes[2] == $infos[0]) {
				array_push($infos, hash('sha256', $_POST['mdp'] . $lignes[4]));
				if ($lignes[3] == $infos[1]) {
					$_SESSION['connected'] = $_POST['email'];
					header("Location: ./donnees.php");
				}
				else{
					header("Location: ./index.php");
				}
			}
		}
		fclose($handle);
		header("Location: ./index.php");
	}
	else{
		//Si la session existe on redirige l'utilisateur à la page du trombinoscope
		header("Location: ./donnees.php");
	}
?>
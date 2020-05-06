<?php
	
	session_start();
	if (!isset($_SESSION['connected'])) {
		//Si la session n'existe pas alors on procède à la connexion
		$infos = array();
		$handle = fopen('./csv/comptes.csv', 'r');
		array_push($infos, $_POST['email']);
		while ($lignes = fgets($handle)) {
			$lignes = explode(";", $lignes);
			if ($lignes[2] == $infos[0]) {
				array_push($infos, hash('sha256', $_POST['mdp'] . $lignes[7]));
				//Vérification du mot de passe et du mail(servant d'identifiant)
				if ($lignes[3] == $infos[1]) {
					//Si c'est bon --> réussite, on remplit la session avec l'email de l'utilisateur
					$_SESSION['connected'] = $_POST['email'];
					//Ecriture des logs
					$handle = fopen('./csv/logs.csv', 'r');
					$file = '';
					while ($lignes = fgets($handle)) {
						$file = $file.$lignes;
					}
					fclose($handle);
					$handle = fopen('./csv/logs.csv', 'w');
					$line = "Connexion;Reussie;" . date("d:m:H:i") . ";" . $_POST['email'] . "\n";
					fwrite($handle, $file . "\n" . $line);
					fclose($handle);
					//Accès aux données de l'utilisateur
					header("Location: ./donnees.php");
				}
				//Sinon on le fait retourner à la page d'inscription
				else{
					//Ecriture des logs
					$handle = fopen('./csv/logs.csv', 'r');
					$file = '';
					while ($lignes = fgets($handle)) {
						$file = $file.$lignes;
					}
					fclose($handle);
					$handle = fopen('./csv/logs.csv', 'w');
					$line = "Connexion;Echouee;" . date("d:m:H:i") . ";" . $_POST['email'] . "\n";
					fwrite($handle, $file . "\n" . $line);
					fclose($handle);
					header("Location: ./index.php");
				}
			}
		}
		fclose($handle);
		header("Location: ./index.php");
	}
	//Si la session existe déjà, l'utilisateur accède directement à ses informations
	else{
		header("Location: ./donnees.php");
	}
?>
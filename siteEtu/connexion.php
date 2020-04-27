<?php
	
	session_start();
	if (!isset($_SESSION['connected'])) {
		$infos = array();
		$handle = fopen('./comptes.csv', 'r');
		array_push($infos, $_POST['email']);		
		while ($lignes = fgets($handle)) {
			$lignes = explode(";", $lignes);
			if ($lignes[2] == $infos[0]) {
				array_push($infos, hash('sha256', $_POST['mdp'] . $lignes[7]));
				if ($lignes[3] == $infos[1]) {
					$_SESSION['connected'] = $_POST['email'];
					//Ecriture des logs
					$handle = fopen('./logs.csv', 'r');
					$file = '';
					while ($lignes = fgets($handle)) {
						$file = $file.$lignes;
					}
					fclose($handle);
					$handle = fopen('./logs.csv', 'w');
					$line = "Connexion;Reussie;" . date("d:m:H:i") . ";" . $_POST['email'] . "\n";
					fwrite($handle, $file . "\n" . $line);
					fclose($handle);
					header("Location: ./donnees.php");
				}
				else{
					//Ecriture des logs
					$handle = fopen('./logs.csv', 'r');
					$file = '';
					while ($lignes = fgets($handle)) {
						$file = $file.$lignes;
					}
					fclose($handle);
					$handle = fopen('./logs.csv', 'w');
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
	else{
		header("Location: ./donnees.php");
	}
?>
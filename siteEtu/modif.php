<?php
	print_r($_POST);
	$randomCar = uniqid();
	$_POST['mdp'] = hash('sha256', $_POST['mdp'] . $randomCar);
	$ligne = implode(';', $_POST) . ";$randomCar";
	$fichier = file('./comptes.csv');
	for ($i=0; $i < sizeof($fichier); $i++) { 
		$infos = explode(';', $fichier[$i]);
		if ($infos[2] == $_POST['email']) {
			$fichier[$i] = $ligne;
		}
		else{
			$fichier[$i] = implode(';', $infos);
		}
	}
	$file = implode("\n", $fichier);
	$handle = fopen('./comptes.csv', 'w');
	ftruncate($handle, 0);
	fwrite($handle, $file);
	fclose($handle);


	header("Location: ./donnees.php");
	
?>
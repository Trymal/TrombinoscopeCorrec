<?php
	
	session_start();
	$infos = array();
	$line = '';
	$randomCar = uniqid();
	array_push($infos, $_POST['nom'],$_POST['prenom'],$_POST['email'],hash('sha256', $_POST['mdp'] . $randomCar),$randomCar);
	foreach ($infos as $value) {
		$line = $line . $value . ";";
	}
	$handle = fopen('./comptes.csv', 'r');
	$file = '';
	while ($lignes = fgets($handle)) {
		$file = $file.$lignes;
	}
	fclose($handle);
	$handle = fopen('./comptes.csv', 'w');
	fwrite($handle, $file."\n".$line);
	fclose($handle);

?>
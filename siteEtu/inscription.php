<?php

	$infos = array();
	$line = '';
	$nom_image = $_POST['email']. ".png";
	$type_image = $_FILES['imageEtu']['type'];
	$taille_image = $_FILES['imageEtu']['size'];
	$image_temp_name = $_FILES['imageEtu']['tmp_name'];
	move_uploaded_file($image_temp_name, "./files/$nom_image");
	$randomCar = uniqid();

	array_push($infos, $_POST['nom'],$_POST['prenom'],$_POST['email'],hash('sha256', $_POST['mdp'] . $randomCar),$_POST['naissance'],$_POST['classe'],$_POST['groupe'],$randomCar);
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

	//Ecriture des logs
	$handle = fopen('./logs.csv', 'r');
	$file = '';
	while ($lignes = fgets($handle)) {
		$file = $file.$lignes;
	}
	fclose($handle);
	$handle = fopen('./logs.csv', 'w');
	$line = "Inscription;" . date("d:m:H:i") . ";" . $_POST['email'] . "\n";
	fwrite($handle, $file . "\n" . $line);
	fclose($handle);

	header("Location: ./index.php");

?>
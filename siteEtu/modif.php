<?php
	//On récupère les informations de l'image
	$nom_image = $_POST['email']. ".png";
	$type_image = $_FILES['imageEtu']['type'];
	$taille_image = $_FILES['imageEtu']['size'];
	$image_temp_name = $_FILES['imageEtu']['tmp_name'];
	move_uploaded_file($image_temp_name, "./files/$nom_image");
	$urlImg = "http://correc.alwaysdata.net/files/" . $nom_image;
	$randomCar = uniqid();
	$_POST['mdp'] = hash('sha256', $_POST['mdp'] . $randomCar);
	$ligne = implode(';', $_POST) . ";$randomCar;$urlImg;";
	$fichier = file('./csv/comptes.csv');
	//On modifie la ligne du fichier correspondant à l'utilisateur
	for ($i=0; $i < sizeof($fichier); $i++) { 
		$infos = explode(';', $fichier[$i]);
		if ($infos[2] == $_POST['email']) {
			$fichier[$i] = $ligne;
		}
		else{
			$fichier[$i] = implode(';', $infos);
		}
	}
	$file = implode("", $fichier);
	$handle = fopen('./csv/comptes.csv', 'w');
	//On réécrit le fichier au complet
	ftruncate($handle, 0);
	fwrite($handle, $file);
	fclose($handle);
	$_SESSION['connected'] = $_POST['email'];

	//On redirige l'utilisateur vers ses informations
	header("Location: ./donnees.php");
	
?>
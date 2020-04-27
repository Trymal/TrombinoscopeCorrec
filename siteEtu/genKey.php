<?php

	$cle = hash('sha256', $_POST['cle']);
	$handle = fopen('./keys.csv', 'r');
	$file = '';
	while ($lignes = fgets($handle)) {
		$file = $file.$lignes;
	}
	fclose($handle);
	$handle = fopen('./keys.csv', 'w');
	fwrite($handle, $file . "\n" . $cle . ';');
	fclose($handle);
	header("Location: ./cleAPI.php?key=$cle");

?>
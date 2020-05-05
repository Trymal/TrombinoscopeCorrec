<?php

	$cle = hash('sha256', $_POST['cle']);
	$handle = fopen('./csv/keys.csv', 'r');
	$file = '';
	while ($lignes = fgets($handle)) {
		$file = $file.$lignes;
	}
	fclose($handle);
	$handle = fopen('./csv/keys.csv', 'w');
	fwrite($handle, $file . "\n" . $cle . ';');
	fclose($handle);
	header("Location: ./cleAPI.php?key=$cle");

?>
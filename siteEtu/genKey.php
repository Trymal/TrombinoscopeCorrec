<?php

	$cle = hash('sha256', $_POST['cle']);
	$handle = fopen('./keys.csv', 'w');
	fwrite($handle, $cle . '\n');
	fclose($handle);

?>
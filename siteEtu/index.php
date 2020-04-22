<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Inscription</title>
</head>
<body>
	<header>
		<a href="./docAPI.html">Documentation de l'API</a>
		<a href="./cleAPI.html">Obtenir une cle pour l'API</a>
	</header>

	<form action="./inscription.php" method="post">
		<input type="text" name="nom" placeholder="Nom">
		<input type="text" name="prenom" placeholder="Pr&eacute;nom">
		<input type="date" name="naissance" value="2000-01-01">
		<select name="classe">
			<?php 

			$handle = fopen('./classGrp.csv', 'r');
			while ($lignes = fgets($handle)) {
				$lignes = explode(';', $lignes);
				echo "<option value=\'".$lignes[0]."\'>".$lignes[0]."</option>";
			}
			fclose($handle);

			?>
		</select>
	</form>
</body>
</html>
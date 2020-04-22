<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Inscription</title>
</head>
<body>
	<header>
		<a href="./docAPI.html">Documentation de l'API</a>
		<a href="./cleAPI.html">Obtenir une cl&eacute; pour l'API</a>
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
		<select name="goupe">
			<option value="G1">Groupe 1</option>
			<option value="G2">Groupe 2</option>
		</select>
		<input type="file" name="imageEtu" accept="image/png, image/jpeg, image/jpg" value="Choisir une image">
		<input type="submit" value="Confirmer" onclick="alerte();">
		<script>
			function alerte(){
				alert("En confirmant vous accordez l'utilisation de vos donn&eacute;es et de votre image par le personnel pédagogique uniquement, vos donn&eacute;es ne seront partagées avec aucune personne tierce.");
			}
		</script>
	</form>
</body>
</html>
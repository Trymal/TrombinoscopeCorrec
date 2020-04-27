<?php
	session_start();
	if (isset($_SESSION['connected'])) {
		header("Location: ./donnees.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Inscription</title>
</head>
<body>
	<header>
		<a href="./docAPI.html">Documentation de l'API</a>
		<a href="./cleAPI.php">Obtenir une cl&eacute; pour l'API</a>
	</header>

	<div id="formulaire">
		<form action="./inscription.php" method="POST" id="inscript" enctype="multipart/form-data">
			<input type="text" name="nom" placeholder="Nom" required>
			<input type="text" name="prenom" placeholder="Pr&eacute;nom" required>
			<input type="email" name="email" placeholder="Adresse mail" required>
			<input type="date" name="naissance" value="2000-01-01" required>
			<select name="classe" required>
				<?php 

				$handle = fopen('./classGrp.csv', 'r');
				while ($lignes = fgets($handle)) {
					$lignes = explode(';', $lignes);
					echo "<option value=".$lignes[0].">".$lignes[0]."</option>";
				}
				fclose($handle);

				?>
			</select>
			<select name="groupe" required>
				<option value="G1">Groupe 1</option>
				<option value="G2">Groupe 2</option>
			</select>
			<input type="file" name="imageEtu" accept="image/png, image/jpeg, image/jpg" required>
			<input type="password" name="mdp" placeholder="Mot de passe" required>
			<input type="submit" value="Confirmer" onclick="alerteDroits();">
			<script>
				function alerteDroits(){
					alert("En confirmant vous accordez l'utilisation de vos données et de votre image par le personnel pédagogique uniquement, vos données ne seront partagées avec aucune personne tierce.");
				}
			</script>
		</form>
	</div>
	<div id="changerForm">
		<a href="./index.php?connexion=true" id="switchConnect">D&eacute;j&agrave; inscrit ? Connectez vous</a>
	</div>
	
	
	<script>
		function switchConn(){
			var form = document.getElementById('formulaire');
			form.innerHTML = "<form action='./connexion.php' method='POST' id='connect'><input type='email' name='email' placeholder='Adresse mail' required><input type='password' name='mdp' placeholder='Mot de passe' required><input type='submit' value='Confirmer'></form>";
			var texte = document.getElementById('changerForm');
			texte.innerHTML = "<a href='./index.php' id='switchConnect'>Pas encore inscrit ?</a>";
		}
	</script>
<?php if (isset($_GET['connexion'])) {
		echo "<script>switchConn();</script>";
	} ?>
</body>
</html>
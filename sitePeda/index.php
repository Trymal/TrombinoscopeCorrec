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
	<title>Accueil</title>
</head>
<body>
	<div id="formulaire">
		<form action="./inscriptionPeda.php" method="POST" id="inscript" enctype="multipart/form-data">
			<input type="text" name="nom" placeholder="Nom" required>
			<input type="text" name="prenom" placeholder="Pr&eacute;nom" required>
			<input type="email" name="email" placeholder="Adresse mail" required>
			<input type="password" name="mdp" placeholder="Mot de passe" required>
			<input type="submit" value="Confirmer">
		</form>
	</div>
	<div id="changerForm">
		<a href="./index.php?connexion=true" id="switchConnect">D&eacute;j&agrave; inscrit ? Connectez vous</a>
	</div>

	<script>
		function switchConn(){
			var form = document.getElementById('formulaire');
			form.innerHTML = "<form action='./connexionPeda.php' method='POST' id='connect'><input type='email' name='email' placeholder='Adresse mail' required><input type='password' name='mdp' placeholder='Mot de passe' required><input type='submit' value='Confirmer'></form>";
			var texte = document.getElementById('changerForm');
			texte.innerHTML = "<a href='./index.php' id='switchConnect'>Pas encore inscrit ?</a>";
		}
	</script>
	<?php if (isset($_GET['connexion'])) {
		echo "<script>switchConn();</script>";
	} ?>
</body>
</html>
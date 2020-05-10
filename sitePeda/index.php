<?php
	session_start();
	//Si la session existe déjà, on redirige l'utilisateur vers la page du tormbinoscope
	if (isset($_SESSION['connected'])) {
		header("Location: ./donnees.php");
	}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8"/>
	<title>Accueil</title>
	<link rel="stylesheet" type="text/css" href="./style.css"/>
</head>
<body>
	<h1>Accueil - Site pédagogique</h1>
	<div id="formulaire">
		<p class="mainTitle">Inscription</p>
		<form action="./inscriptionPeda.php" method="POST" id="inscript" enctype="multipart/form-data">
			<p>Nom et prénom</p>
			<div id="noms">
				<input type="text" name="nom" placeholder="Nom" required='required'/>
				<input type="text" name="prenom" placeholder="Prénom" required='required'/>
			</div>
			<p>Mail et mot de passe</p>
			<div id="mailmdp">
				<input type="email" name="email" placeholder="Adresse mail" required='required'/>
				<input type="password" name="mdp" placeholder="Mot de passe" required='required'/>
			</div>
			<input type="submit" value="Confirmer"/>
		</form>
	</div>
	<div id="changerForm">
		<a href="./index.php?connexion=true" id="switchConnect">Déjà inscrit ? Connectez vous</a>
	</div>

	<script>
		function switchConn(){
			//On modifie le formulaire d'inscription en formulaire de connexion
			var form = document.getElementById('formulaire');
			form.innerHTML = "<p class='mainTitle'>Connexion</p><form action='./connexionPeda.php' method='POST' id='connect'><input type='email' name='email' placeholder='Adresse mail' required='required'/><input type='password' name='mdp' placeholder='Mot de passe' required='required'/><input type='submit' value='Confirmer'/></form>";
			var texte = document.getElementById('changerForm');
			texte.innerHTML = "<a href='./index.php' id='switchConnect'>Pas encore inscrit ?</a>";
		}
	</script>
	<?php if (isset($_GET['connexion'])) {
		//Si la connexion est demandée, on lance le script de changement de formulaire
		echo "<script>switchConn();</script>";
	} ?>
</body>
</html>
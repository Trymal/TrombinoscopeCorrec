<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8"/>
	<title>Génération clé</title>
	<link rel="stylesheet" type="text/css" href="./style.css"/>
</head>
<body>
	<header>
		<a href="./docAPI.html" id="elem1">Documentation de l'API</a>
		<a href="./cleAPI.php" id="elem2">Obtenir une clé pour l'API</a>
		<a href="./index.php" id="elem3">Accueil</a>
	</header>

	<h1>Générer une clé pour utiliser l'API</h1>
	
	<div id="zoneCle">
		<form action="./genKey.php" method="post">
			<input type="text" name="cle" placeholder="Adresse mail"/>
			<input type="submit" name="submit"/>
		</form>
	</div>
	
	<script>
		//Après que la clé ait été générée, on l'affiche car la clé est contenue dans l'URL
		var zone = document.getElementById('zoneCle');
		var cle = <?php if(isset($_GET['key'])){echo("'" . $_GET['key'] . "'");} ?>;
		zone.innerHTML = "Votre clé : " + cle;
	</script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Génération clé</title>
</head>
<body>
	<header>
		<a href="./docAPI.html">Documentation de l'API</a>
		<a href="./cleAPI.php">Obtenir une cl&eacute; pour l'API</a>
	</header>
	
	<div id="zoneCle">
		<form action="./genKey.php" method="post">
			<input type="text" name="cle" placeholder="Adresse mail">
			<input type="submit" name="submit">
		</form>
	</div>
	
	<script>
		var zone = document.getElementById('zoneCle');
		var cle = <?php if(isset($_GET['key'])){echo("'" . $_GET['key'] . "'");} ?>;
		zone.innerHTML = "Votre clé : " + cle;
	</script>
</body>
</html>
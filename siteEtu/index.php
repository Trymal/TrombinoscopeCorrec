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
			<input type="text" name="nom" placeholder="Nom" required='required'>
			<input type="text" name="prenom" placeholder="Pr&eacute;nom" required='required'>
			<input type="email" name="email" placeholder="Adresse mail" required='required'>
			<input type="date" name="naissance" value="2000-01-01" required='required'>
			<select name="classe" onchange="selectGrp();" id="fil" required='required'>
				<?php 

				$handle = fopen('./classGrp.csv', 'r');
				while ($lignes = fgets($handle)) {
					$lignes = explode(';', $lignes);
					echo "<option value=".$lignes[0].">".$lignes[0]."</option>";
				}
				fclose($handle);

				?>
			</select>
			<div id="grp"></div>

			<script>
				
				function selectGrp(){
					var fils = new Array();
					<?php
						$infosFil = array();
						$filieres = file("./classGrp.csv");
						for ($i=0; $i < sizeof($filieres); $i++) { 
							$ligne = explode(";", $filieres[$i]);
							echo "fils[\"$ligne[0]\"] = [\"$ligne[1]\",\"" . substr($ligne[2],0,strlen($ligne[2])-2) . "\"];\n";

						}
							
					?>
					var filiere = document.getElementById('fil').value;
					var zoneGrp = document.getElementById('grp');
					var ligne = "";
					
					for (var i = 0; i < fils[filiere].length; i++) {
						ligne += "<option value=\"" + fils[filiere][i] + "\">" + fils[filiere][i] + "</option>";
					}
					zoneGrp.innerHTML = "<select name='groupe' id='groupe' required='required'>" + ligne + "</select>";

				}

			</script>
			<input type="file" name="imageEtu" accept="image/png, image/jpeg, image/jpg" required='required'>
			<input type="password" name="mdp" placeholder="Mot de passe" required='required'>
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
			form.innerHTML = "<form action='./connexion.php' method='POST' id='connect'><input type='email' name='email' placeholder='Adresse mail' required='required'><input type='password' name='mdp' placeholder='Mot de passe' required='required'><input type='submit' value='Confirmer'></form>";
			var texte = document.getElementById('changerForm');
			texte.innerHTML = "<a href='./index.php' id='switchConnect'>Pas encore inscrit ?</a>";
		}
	</script>
<?php if (isset($_GET['connexion'])) {
		echo "<script>switchConn();</script>";
	} ?>
</body>
</html>
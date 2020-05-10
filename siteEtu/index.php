<?php
	session_start();
	if (isset($_SESSION['connected'])) {
		//Si la session existe déjà, l'utilisateur accède à ses informations
		header("Location: ./donnees.php");
	}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8"/>
	<title>Inscription</title>
	<link rel="stylesheet" type="text/css" href="./style.css"/>
</head>
<body>
	<header>
		<a href="./docAPI.html" id="elem1">Documentation de l'API</a>
		<a href="./cleAPI.php" id="elem2">Obtenir une clé pour l'API</a>
		<a href="./index.php" id="elem3">Accueil</a>
	</header>

	<h1>Accueil - Site étudiant</h1>
	<div id="formulaire">
		<form action="./inscription.php" method="POST" id="inscript" enctype="multipart/form-data">
			<p>Nom et prénom</p>
			<div id="nompren">
				<input type="text" name="nom" placeholder="Nom" required='required'/>
				<input type="text" name="prenom" placeholder="Prénom" required='required'/>
			</div>
			<p>Mail et date de naissance</p>
			<div id="infosAnnex">
				<input type="email" name="email" placeholder="Adresse mail" required='required'/>
				<input type="date" name="naissance" value="2000-01-01" required='required'/>
			</div>
			<p>Filière et groupe</p>
			<div id="fili">
				<select name="classe" onchange="selectGrp();" id="fil" required='required'>
					<option value="">---</option>
					<?php 

					//Récupération des filières pour former la liste à partir du fichier des groupes

					$handle = fopen('./classGrp.csv', 'r');
					while ($lignes = fgets($handle)) {
						$lignes = explode(';', $lignes);
						echo "<option value=\"".$lignes[0]."\">".$lignes[0]."</option>";
					}
					fclose($handle);

					?>
				</select>

				<div id="grp"></div>
			</div>

			<script>
				
				function selectGrp(){
					//Fonction appelée à chaque changement de valeur de la liste des filières
					var fils = new Array();
					<?php
						$infosFil = array();
						$filieres = file("./classGrp.csv");
						//On récupère les groupes pour les assigner aux filières sous forme de liste
						for ($i=0; $i < sizeof($filieres); $i++) { 
							$ligne = explode(";", $filieres[$i]);
							echo "fils[\"$ligne[0]\"] = [\"$ligne[1]\",\"" . substr($ligne[2],0,strlen($ligne[2])-2) . "\"];\n";

						}
							
					?>
					var filiere = document.getElementById('fil').value;
					var zoneGrp = document.getElementById('grp');
					var ligne = "";
					//Quand la filière est modifiée, on modifie les groupes associés
					
					for (var i = 0; i < fils[filiere].length; i++) {
						ligne += "<option value=\"" + fils[filiere][i] + "\">" + fils[filiere][i] + "</option>";
					}
					zoneGrp.innerHTML = "<select name='groupe' id='groupe' required='required'>" + ligne + "</select>";

				}

			</script>
			<p>Photo de profil</p>
			<div id="img">
				<input type="file" name="imageEtu" accept="image/png, image/jpeg, image/jpg" required='required'/>
			</div>
			<div id="passwd">
				<input type="password" name="mdp" placeholder="Mot de passe" required='required'/>
			</div>
			<input type="submit" value="Confirmer" onclick="alerteDroits();"/>
			<script>
				function alerteDroits(){
					alert("En confirmant vous accordez l'utilisation de vos données et de votre image par le personnel pédagogique uniquement, vos données ne seront partagées avec aucune personne tierce.");
				}
			</script>
		</form>
	</div>
	<div id="changerForm">
		<a href="./index.php?connexion=true" id="switchConnect">Déjà inscrit ? Connectez vous</a>
	</div>
	
	
	<script>
		function switchConn(){
			//Modification du formulaire d'inscription en formulaire de connexion
			var form = document.getElementById('formulaire');
			form.innerHTML = "<p class='mainTitle'>Mail et mot de passe</p><form action='./connexion.php' method='POST' id='connect'><input type='email' name='email' placeholder='Adresse mail' required='required'/><input type='password' name='mdp' placeholder='Mot de passe' required='required'/><input type='submit' value='Confirmer'/></form>";
			var texte = document.getElementById('changerForm');
			texte.innerHTML = "<a href='./index.php' id='switchConnect'>Pas encore inscrit ?</a>";
		}
	</script>
<?php if (isset($_GET['connexion'])) {
	//Dès que l'utilisateur appuie sur Se connecter, il est ramené vers la même page avec ?connexion=true en plus
	//Si connexion est présent dans l'URL alors on modifie le formulaire en lancant le script
		echo "<script>switchConn();</script>";
	} ?>
</body>
</html>
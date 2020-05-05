<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Donnees</title>
	<link rel="stylesheet" type="text/css" href="./style.css"/>
</head>
<body>
	<header>
		<a href="./docAPI.html" id="elem1">Documentation de l'API</a>
		<a href="./cleAPI.php" id="elem2">Obtenir une cl&eacute; pour l'API</a>
		<a href="./index.php" id="elem3">Accueil</a>
	</header>
	<form action="./deconnexion.php">
		<input type="submit" value="Déconnexion" id="deco">
	</form>
	<div id="infosUser">
		<img src= <?php echo './files/' . $_SESSION['connected']. '.png'; ?> alt="ERROR" height="206" width="206"/>

		<?php

			$handle = fopen("./csv/comptes.csv", "r");
			while ($lignes = fgets($handle)) {
				$lignes = explode(";", $lignes);
				if ($lignes[2] == $_SESSION['connected']) {
					$line = $lignes;
				}
			}

			echo "<div id='liste'><ul><li id='nomFam'>Nom : $line[0]</li><li id='prenom'>Prénom : $line[1]</li><li id='mail'>Adresse mail : $line[2]</li><li id='pwd'>Mot de passe : *****</li><li id='dateNais'>Date de naissance : $line[4]</li><li id='class'>Filière : $line[5]</li><li id='grp'>Groupe : $line[6]</li></ul></div>";
		?>

		<button type="button" onclick="modifDonnees();">Changer les informations</button>
		<script>
			function modifDonnees(){
				var zoneInfos = document.getElementById('liste');
				var nom = document.getElementById('nomFam').textContent.substring(6);
				var prenom = document.getElementById('prenom').textContent.substring(9);
				var mail = document.getElementById('mail').textContent.substring(15);
				var dateNaissance = document.getElementById('dateNais').textContent.substring(20);
				var classe = document.getElementById('class').textContent.substring(9);
				var groupe = document.getElementById('grp').textContent.substring(9);

				zoneInfos.innerHTML = "<form action='./modif.php' method='POST' id='modif' enctype='multipart/form-data'><input type='text' name='nom' value='" + nom + "' required><input type='text' name='prenom' value='" + prenom + "' required><input type='email' name='email' value='" + mail +"' required><input type='password' name='mdp' placeholder='Nouveau mot de passe' required><input type='date' name='naissance' value='" + dateNaissance + "' required><select id='filier' name='classe' onchange='selectGrps();' required><?php $handle = fopen('./classGrp.csv', 'r');while ($lignes = fgets($handle)) {$lignes = explode(';', $lignes);echo '<option value='.$lignes[0].'>'.$lignes[0].'</option>';}fclose($handle);?></select><div id='grps'><select name='groupe' required><option>---</option></select></div><input type='file' name='imageEtu' id='imageEtu' accept='image/png, image/jpeg, image/jpg'><input type='submit' value='Confirmer'></form>";
			}
				
				function selectGrps(){
					var fils = new Array();
					<?php
						$infosFil = array();
						$filieres = file("./classGrp.csv");
						for ($i=0; $i < sizeof($filieres); $i++) { 
							$ligne = explode(";", $filieres[$i]);
							echo "fils[\"$ligne[0]\"] = [\"$ligne[1]\",\"" . substr($ligne[2],0,strlen($ligne[2])-2) . "\"];\n";

						}
							
					?>
					var filiere = document.getElementById('filier').value;
					var zoneGrp = document.getElementById('grps');
					var ligne = "";
					
					for (var i = 0; i < fils[filiere].length; i++) {
						ligne += "<option value=\"" + fils[filiere][i] + "\">" + fils[filiere][i] + "</option>";
					}
					zoneGrp.innerHTML = "<select name='groupe' id='groupes' required='required'>" + ligne + "</select>";

				}

			</script>

	</div>
	
</body>
</html>
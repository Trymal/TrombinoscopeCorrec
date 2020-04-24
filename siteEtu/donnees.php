<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Donnees</title>
</head>
<body>
	<header>
		<a href="./docAPI.html">Documentation de l'API</a>
		<a href="./cleAPI.html">Obtenir une cl&eacute; pour l'API</a>
	</header>
	<div id="infosUser">
		<table>
			<tr>
				<td>
					<img src= <?php echo './files/' . $_SESSION['connected']. '.png'; ?> alt="ERROR" height="300" width="300">
				</td>
			</tr>
		</table>

		<?php

			$handle = fopen("./comptes.csv", "r");
			while ($lignes = fgets($handle)) {
				$lignes = explode(";", $lignes);
				if ($lignes[2] == $_SESSION['connected']) {
					$line = $lignes;
				}
			}

			echo "<div id='liste'><ul><li id='nomFam'>Nom : $line[0]</li><li id='prenom'>Prénom : $line[1]</li><li id='mail'>Adresse mail : $line[2]</li><li id='pwd'>Mot de passe : *****</li><li id='dateNais'>Date de naissance : $line[4]</li><li id='class'>Classe : $line[5]</li><li id='grp'>Groupe : $line[6]</li></ul></div>";
		?>

		<button type="button" onclick="modifDonnees();">Changer les informations</button>
		<script>
			function modifDonnees(){
				var zoneInfos = document.getElementById('liste');
				var nom = document.getElementById('nomFam').substr(6);
				var prenom = document.getElementById('prenom').substr(9);
				var mail = document.getElementById('mail').substr(15);
				var dateNaissance = document.getElementById('dateNais').substr(20);
				var classe = document.getElementById('class').substr(9);
				var groupe = document.getElementById('grp').substr(9);

				zoneInfo.innerHTML = "<form action='./modif.php' method='POST' id='modif' enctype='multipart/form-data'><input type='text' name='nom' value='" + nom + "' required><input type='text' name='prenom' value='" + prenom + "' required><input type='email' name='email' value='" + mail +"' required><input type='date' name='naissance' value='" + dateNais + "' required><select name='classe' required><?php $handle = fopen('./classGrp.csv', 'r');while ($lignes = fgets($handle)) {$lignes = explode(';', $lignes);echo '<option value='.$lignes[0].'>'.$lignes[0].'</option>';}fclose($handle);?></select><select name='groupe'required><option value='G1'>Groupe 1</option><option value='G2'>Groupe 2</option></select><input type='file' name='imageEtu' accept='image/png, image/jpeg, image/jpg' required><input type='password' name='mdp' placeholder='Nouveau mot de passe' required><input type='submit' value='Confirmer'></form>"
			}
		</script>
	</div>
	
</body>
</html>
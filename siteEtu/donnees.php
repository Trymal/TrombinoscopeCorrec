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

			echo "<ul><li>Nom : $line[0]</li><li>Prénom : $line[1]</li><li>Adresse mail : $line[2]</li><li>Mot de passe : *****</li><li>Date de naissance : $line[4]</li><li>Classe : $line[5]</li><li>Groupe : $line[6]</li></ul>";
		?>

		<button ></button>
	</div>
	
</body>
</html>
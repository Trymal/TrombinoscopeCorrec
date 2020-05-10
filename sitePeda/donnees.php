<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8"/>
	<title>Données sur les étudiants</title>
	<link rel="stylesheet" type="text/css" href="./style.css"/>
</head>
<body>
	<form action="./deconnexion.php" id="butDeco">
		<input type="submit" value="Déconnexion"/>
	</form>
	<h1>Trombinoscope des étudiants</h1>
	<button onclick="window.print();">Impression</button>
	<form id="choisirFil">
		<h2>Recherche par filière</h2>
		<select id="listFil" onchange="getInfos();">
			<option value="">Filière</option>
			<?php 
			//On récupère la liste des filières depuis le site étu
				$handle = fopen('http://correc.alwaysdata.net/classGrp.csv', 'r');
				while ($lignes = fgets($handle)) {
					$lignes = explode(';', $lignes);
					echo "<option value=\"".$lignes[0]."\">".$lignes[0]."</option>";
				}
				fclose($handle);

			?>
		</select>
		<h2>Recherche par groupe</h2>
		<select id="listGrp" onchange="getInfosGrp();">
			<option value="">Groupe</option>
			<?php 
			//On récupère la liste des groupe depuis le site étu
				$handle = fopen('http://correc.alwaysdata.net/classGrp.csv', 'r');
				while ($lignes = fgets($handle)) {
					$lignes = explode(';', $lignes);
					echo "<option value=\"$lignes[1]\">$lignes[0] -- $lignes[1]</option>";
					echo "<option value=\"$lignes[2]\">$lignes[0] -- $lignes[2]</option>";
				}
				fclose($handle);

			?>
		</select>
		<script>
			function getInfos(){
				//Pour un choix par filière
				var filiere = document.getElementById('listFil').value;
				var tableau = document.getElementById('trombi');
				//Récupération de la liste des étudiants grâce à l'API option filière
				var link = "http://correc.alwaysdata.net/api.php?option=filiere&filiere=" + filiere + "&key=a6a873edc2638b826a00e0d80053852be35ac3f8a00569278b72c836060dc0e2";
				var req = new XMLHttpRequest();
				req.open("GET",link,false);
				req.send(null);
				var reponse = req.responseText;
				var infosJson = JSON.parse(reponse);
				var cpt = 0;
				//On forme le tableau des étudiants avec leur photo
				var ligne = "<table>";
				for (var i = 0; i < infosJson.length; i++) {
					if (cpt == 0) {
						ligne += "<tr>";
					}
					if (cpt == 6) {
						cpt = 0;
						ligne += "</tr>";
					}
					//Case d'un étudiant, nom + photo
					ligne += "<td><div class='nom'>" + infosJson[i][0] + " " + infosJson[i][1] + "</div><div class='photo' onclick=\"getInfosEtu(" + "\'" + infosJson[i][0] + "\'" + "," + "\'" + infosJson[i][1] + "\');\"><img src=\"" + infosJson[i][8] + "\" alt='Photo etu' height='206' weight='206' class='imgEtu'/></div></td>";
					cpt++;
				}
				if (ligne.substr(ligne.length - 5) == "</tr>") {
					ligne += "</table>";
				}
				else{
					ligne += "</tr></table>";
				}
				tableau.innerHTML = ligne;
				zoneRech = document.getElementById("zoneRech");
				zoneRech.innerHTML = "Étudiants de " + filiere;
			}
			function getInfosGrp(){
				//Pour un choix par groupe
				var filiere = document.getElementById('listGrp').value;
				var tableau = document.getElementById('trombi');
				//Récupération de la liste des étudiants grâce à l'API option groupe
				var link = "http://correc.alwaysdata.net/api.php?option=groupe&groupe=" + filiere + "&key=a6a873edc2638b826a00e0d80053852be35ac3f8a00569278b72c836060dc0e2";
				var req = new XMLHttpRequest();
				req.open("GET",link,false);
				req.send(null);
				var reponse = req.responseText;
				var infosJson = JSON.parse(reponse);
				var cpt = 0;
				//On forme le tableau des étudiants avec leur photo
				var ligne = "<table>";
				for (var i = 0; i < infosJson.length; i++) {
					if (cpt == 0) {
						ligne += "<tr>";
					}
					if (cpt == 6) {
						cpt = 0;
						ligne += "</tr>";
					}
					//Case d'un étudiant, nom + photo
					ligne += "<td><div class='nom'>" + infosJson[i][0] + " " + infosJson[i][1] + "</div><div class='photo' onclick=\"getInfosEtu(" + "\'" + infosJson[i][0] + "\'" + "," + "\'" + infosJson[i][1] + "\');\"><img src=\"" + infosJson[i][8] + "\" alt='Photo etu' height='206' weight='206' class='imgEtu'/></div></td>";
					cpt++;
				}
				if (ligne.substr(ligne.length - 5) == "</tr>") {
					ligne += "</table>";
				}
				else{
					ligne += "</tr></table>";
				}
				//On écrit le tableau dans la page
				tableau.innerHTML = ligne;
				zoneRech = document.getElementById("infoRech");
				zoneRech.innerHTML = "Étudiants de " + filiere;
			}
			function getInfosEtu(nomEtu,prenEtu){
				//Pour avoir les données d'un seul étudiant
				var zoneInfos = document.getElementById("infosEtu");
				//Récupération des données d'un étudiant grâce à l'API option etu
				var link = "http://correc.alwaysdata.net/api.php?option=etu&etuNom=" + nomEtu + "&etuPren=" + prenEtu +"&key=a6a873edc2638b826a00e0d80053852be35ac3f8a00569278b72c836060dc0e2";
				var req = new XMLHttpRequest();
				req.open("GET",link,false);
				req.send(null);
				var reponse = req.responseText;
				var infosJson = JSON.parse(reponse);
				//Liste des informations
				var ligne = "<ul><li>Nom : " + infosJson[0][0] + "</li><li>Prénom : " +infosJson[0][1] + "</li><li>Adresse mail : " + infosJson[0][2] + "</li><li>Date de naissance : " + infosJson[0][4] + "</li><li>Filière : " + infosJson[0][5] + "</li><li>Groupe : " + infosJson[0][6] + "</li><li><img src=\"" + infosJson[0][8] + "\" alt='photoEtu' height='206' weight='206'/></li></ul>";
				zoneInfos.innerHTML = ligne;
				

			}
		</script>
	</form>
	<div id="infosEtu"></div>
	<h2 id="infoRech">Trombinoscope</h2>
	<div id="trombi">
			
	</div>	
</body>
</html>
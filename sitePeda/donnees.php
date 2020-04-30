<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Données sur les étudiants</title>
</head>
<body>
	<form id="choisirFil">
		<select id="listFil" onchange="getInfos();">
			<option>---</option>
			<?php 

				$handle = fopen('http://correc.alwaysdata.net/classGrp.csv', 'r');
				while ($lignes = fgets($handle)) {
					$lignes = explode(';', $lignes);
					echo "<option value=".$lignes[0].">".$lignes[0]."</option>";
				}
				fclose($handle);

			?>
		</select>
		<select id="listGrp" onchange="getInfosGrp();"></select>
		<script>
			function getInfos(){
				var filiere = document.getElementById('listFil').value;
				var tableau = document.getElementById('trombi');
				var link = "http://correc.alwaysdata.net/api.php?option=filiere&filiere=" + filiere + "&key=a6a873edc2638b826a00e0d80053852be35ac3f8a00569278b72c836060dc0e2";
				var req = new XMLHttpRequest();
				req.open("GET",link,false);
				req.send(null);
				var reponse = req.responseText;
				var infosJson = JSON.parse(reponse);
				var cpt = 0;
				var ligne = "<table>";
				for (var i = 0; i < infosJson.length; i++) {
					if (cpt == 0) {
						ligne += "<tr>";
					}
					if (cpt == 6) {
						cpt = 0;
						ligne += "</tr>";
					}
					ligne += "<td>" + infosJson[i]["0"] + " " + infosJson[i]["1"] + "<img src=\"" + infosJson[i]["8"] + "\" alt='Photo etu' height='512' weight='512'/></td>";
					cpt++;
				}
				if (ligne.substr(ligne.length - 5) == "</tr>") {
					ligne += "</table>";
				}
				else{
					ligne += "</tr></table>";
				}


			}
		</script>
	</form>
	<div id="trombi">
			
	</div>	
</body>
</html>
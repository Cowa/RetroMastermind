<?php
	session_start();
	session_destroy();
?>
<!DOCTYPE html>
<!-- Configuration de la partie (Pseudo, Robot, Humain, etc.) -->
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<link rel="icon" type="image/x-icon" href="img/favicon.ico" />
		<title>Rétro Mastermind</title>
		<script>
			function visibilite(thingId)
			{
				var targetElement;
				targetElement = document.getElementById(thingId) ;
				if (targetElement.style.display == "none")
				{
					targetElement.style.display = "" ;
				}
				else
				{
					targetElement.style.display = "none" ;
				}
			}
		</script>
	</head>
	<body>
		<img src="img/logo.png" alt="" draggable="false"/>
		<h2>Edition spécial Noël</h2>
		<h4 style="position: absolute; margin-left: 380px; margin-top: -110px;">"Le Mastermind de mon enfance" -Jacques Chirac</h4>
		<h4 style="color: black;">offert par Alexis GIRAUDET et Brice THOMAS</h4>
			<form method="post" action="initialisation.post.php">
				<table>
					<tr>
						<th colspan=3>Configuration du jeu</th>
					</tr>
					<tr>
						<td><label for="j1" >J1 : codeur</label></td><td><input type ="text" name="pseudoJ1" id="j1" value="J1" size="15" maxlength="14"/></td>
						<td><label for="bot1">Bot</label><input type="checkbox" checked="checked" name="botJ1" id="bot1" onclick="javascript:visibilite('combiJ1'); return true;"/></td>
					</tr>
					<tr>
						<td><label for="j2" >J2 : décodeur</label></td><td><input type ="text" name="pseudoJ2" id="j2" value="J2" size="15" maxlength="14"/></td>
						<td><label for="bot2">Bot</label><input type="checkbox" name="botJ2" id="bot2" /></td>
					</tr>
					<tr>
						<td>Smart Bot</td><td><input type="checkbox" name="IAJ2" id="IAbot2" /></td><td></td>
					</tr>
					<tr>
						<td><label for="goodies">Valeur ajoutée</label></td><td><input type="checkbox" checked="checked" name="VA" id="goodies" /></td><td></td>
					</tr>
					<tr>
						<td><label for="debug">Debug mode</label></td><td><input type="checkbox" name="debug" id="debug" /></td><td></td>
					</tr>
					<tr>
						<td><label for="debug">Mode objet</label></td><td><input type="checkbox" name="debug" id="debugid" checked="checked" /></td><td></td>
					</tr>
					<tr id="combiJ1" style="display:none;" >
						<td>J1 entrez code</td>
						<td>
						<?php
							for($i=1; $i<5; $i++)
							{
								echo '<select name="c'.$i.'">';
								for($j=1; $j<9; $j++)
								{
									echo '<option>'.$j.'</option>';
								}
								echo '</select>';
							}
						?>
						</td><td></td>
					</tr>
					<tr>
						<td></td><td><input class="submit" type="submit" name="init" value="Lancer"/></td><td></td>
					</tr>
				</table>
			</form>
	</body>
</html>

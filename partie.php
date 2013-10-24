<?php
	session_start();
	require_once 'humain.class.php';
	require_once 'robot.class.php';
	require_once 'plateau.class.php';
	
	if(!isset($_SESSION["plateau"]))
	{
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Rétro Mastermind</title>
        <link rel="stylesheet" href="style.css" />
		<link rel="icon" type="image/x-icon" href="img/favicon.ico" />
	<script src="script.js"></script>
	</head>
	<body>
		<a href="index.php" id="deco">Quitter / Recommencer</a>

		<?php
			$plateau = unserialize($_SESSION["plateau"]);

			
			if(isset($_GET["reco"]))
			{
				$plateau->restart();
			}

			$plateau->afficher();

			if($plateau->get_tour() == 0 || ($plateau->fin_partie() == null))
			{
				include("combinaison.form.php");
			}
			else
			{
				echo "<br /><p id=\"resultat\">Partie terminée !<br/>";
				echo "Gagnant: ";
				echo htmlspecialchars($plateau->fin_partie());
				echo "<br/> en ". $plateau->get_tour() ." tours</p>";
			}
			// Activation de la valeur ajoutée
			if(isset($_SESSION["VA"]))
			{
				include("valeurAjoutee.html");
			}
			$_SESSION["plateau"] = serialize($plateau);
		?>
	</body>
</html>

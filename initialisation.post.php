<?php
	// Initialisation de la partie � partir des param�tres saisies lors de la configuration
	require_once("plateau.class.php");
	require_once("robot.class.php");
	require_once("humain.class.php");

	if($_POST["pseudoJ1"] == "" || $_POST["pseudoJ2"] == ""){}
	else
	{
		session_start();
		// Cr�ation joueur 1
		if(isset($_POST["botJ1"]))
		{
			$j1 = new Robot($_POST["pseudoJ1"]);
		}
		else
		{
			$j1 = new Humain($_POST["pseudoJ1"]);
		}
		
		// Cr�ation joueur 2
		if(isset($_POST["botJ2"]))
		{
			$j2 = new Robot($_POST["pseudoJ2"]);
		}
		else
		{
			$j2 = new Humain($_POST["pseudoJ2"]);
		}
		
		// Cr�ation du plateau
		$plateau = new Plateau($j1, $j2, $j1->combinaison($_POST["c1"], $_POST["c2"], $_POST["c3"], $_POST["c4"]));
		
		// Activation de l'IA pour J2 si souhait� par l'utilisateur
		if(isset($_POST["IAJ2"]) && isset($_POST["botJ2"]))
		{
			$j2->connexion_plateau($plateau);
		}
		
		if(isset($_POST["VA"]))
		{
			$_SESSION["VA"] = true;
		}
		
		$_SESSION["plateau"] = serialize($plateau);
	}
	header('Location: partie.php');
?>

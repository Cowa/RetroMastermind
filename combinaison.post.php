<?php
// Traitement de la combinaison proposé par le joueur 2
session_start();

require_once("humain.class.php");
require_once("plateau.class.php");
require_once("robot.class.php");

$plateau = unserialize($_SESSION["plateau"]);

if((isset($_POST["c1"]) && isset($_POST["c2"]) && isset($_POST["c3"]) && isset($_POST["c4"])) && ($_POST["c1"] != 0 && $_POST["c2"] != 0 && $_POST["c3"] != 0 && $_POST["c4"] != 0))
{
	$coup = $plateau->get_joueur2()->coup($_POST["c1"], $_POST["c2"], $_POST["c3"], $_POST["c4"]);
	$plateau->tour_jeu($coup);
}
else if($plateau->get_joueur2() instanceof Robot)
{
	$coup = $plateau->get_joueur2()->coup();
	$plateau->tour_jeu($coup);
}

$_SESSION["plateau"] = serialize($plateau);

header('Location: partie.php');

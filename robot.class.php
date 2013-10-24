<?php
require_once 'joueur.class.php';
require_once 'plateau.class.php';
/**
* Classe Robot, fait office de joueur mécanique
*/
class Robot extends Joueur
{	
	private $plateau; // accès au Plateau, pour pouvoir 'lire' l'historique (nécessaire pour l'IA)
	
	/**
	* Le robot se connecte au plateau pour avoir accès à l'historique (IA oblige)
	*/
	public function connexion_plateau(Plateau $plateau)
	{
		$this->plateau = $plateau;
	}
	
	/**
	* Méthode générant la combinaison secrète (aléatoirement)
	*/
	public function combinaison($c1, $c2, $c3, $c4)
	{
		return array (rand(1,8), rand(1,8), rand(1,8), rand(1,8));
	}
	
	/**
	* Méthode proposant une combinaison pour "casser" la combinaison secrète (aléatoirement)
	*/
	public function coup($c1=0, $c2=0, $c3=0, $c4=0)
	{
		//Si $plateau existe, alors le robot a une IA
		if(isset($this->plateau))
		{
			// ICI gérer l'IA du robot en utilisant la connexion au plateau
			return array (8, 7, 6, 5);
		}
		else
		{
			return array (rand(1,8), rand(1,8), rand(1,8), rand(1,8));
		}
	}

}

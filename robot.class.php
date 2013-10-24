<?php
require_once 'joueur.class.php';
require_once 'plateau.class.php';
/**
* Classe Robot, fait office de joueur m�canique
*/
class Robot extends Joueur
{	
	private $plateau; // acc�s au Plateau, pour pouvoir 'lire' l'historique (n�cessaire pour l'IA)
	
	/**
	* Le robot se connecte au plateau pour avoir acc�s � l'historique (IA oblige)
	*/
	public function connexion_plateau(Plateau $plateau)
	{
		$this->plateau = $plateau;
	}
	
	/**
	* M�thode g�n�rant la combinaison secr�te (al�atoirement)
	*/
	public function combinaison($c1, $c2, $c3, $c4)
	{
		return array (rand(1,8), rand(1,8), rand(1,8), rand(1,8));
	}
	
	/**
	* M�thode proposant une combinaison pour "casser" la combinaison secr�te (al�atoirement)
	*/
	public function coup($c1=0, $c2=0, $c3=0, $c4=0)
	{
		//Si $plateau existe, alors le robot a une IA
		if(isset($this->plateau))
		{
			// ICI g�rer l'IA du robot en utilisant la connexion au plateau
			return array (8, 7, 6, 5);
		}
		else
		{
			return array (rand(1,8), rand(1,8), rand(1,8), rand(1,8));
		}
	}

}

<?php
require_once 'joueur.class.php';

/**
* Classe Humain, manipulée par la pensée, et de temps en temps, par la logique de l'Homme
*/
class Humain extends Joueur
{	  
    public function combinaison($c1, $c2, $c3, $c4)
	{
		return array ($c1, $c2, $c3, $c4);
	}
	
	public function coup($c1, $c2, $c3, $c4)
	{
		return array ($c1, $c2, $c3, $c4);
	}
}

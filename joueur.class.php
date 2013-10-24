<?php
/**
* Classe Joueur, architecture du joueur quelconque
*/
abstract class Joueur
{
	private $nom;
	private $score;
	
	public function __construct($nom)
	{
		$this->nom = $nom;
		$this->score = 0;
	}
	
	/**
	* Méthode générant la combinaison secrète
	*/
	abstract public function combinaison($c1, $c2, $c3, $c4);
	
	/**
	* Méthode proposant une combinaison pour "casser" la combinaison secrète
	*/
	abstract public function coup($c1, $c2, $c3, $c4);
	
	public function getNom()
	{
		return $this->nom;
	}
	
	public function addScore()
	{
		return $this->score++;
	}
	
	public function getScore()
	{
		return $this->score;
	}
}

<?php
require_once 'joueur.class.php';

/**
* Classe maîtresse de structure de contrôle
*/
class Plateau
{
	private $joueur1; //joueur
	private $joueur2; //joueur
	private $combinaison; //array int
	private $historique; //array array int -> matrice int
	private $tour;
	
	public function __construct(Joueur $joueur1, Joueur $joueur2, $combinaison)
	{
		$this->joueur1 = $joueur1; //le joueur qui donne la combinaison
		$this->joueur2 = $joueur2; //le joueur qui cherche la combinaison
		$this->combinaison = $combinaison;
		$this->historique = array_fill(0, 10, array_fill(0, 4, 0));
		$this->tour = 0;
	}
	
	public function restart()
	{
		$this->tour = 0;
		$this->historique = array_fill(0, 10, array_fill(0, 4, 0));
	}
	
	public function tour_jeu($coup_du_tour)
	{
		$this->historique[$this->tour] = $coup_du_tour;
		$this->tour++;
	}
	
	public function get_tour()
	{
		return $this->tour;
	}
	public function set_tour($i)
	{
		$this->tour = $i;
	}
	
	public function get_joueur1()
	{
		return $this->joueur1;
	}
		public function get_joueur2()
	{
		return $this->joueur2;
	}	
	public function get_combinaison()
	{
		return $this->combinaison;
	}
	/**
	* Méthode d'affichage graphique du plateau
	*/
	public function afficher()
	{
		echo '<table>'."\n";
		
		echo '<tr>';
		echo '<td class="none"></td><td class="none"></td>'."\n";
		foreach($this->combinaison as $i)
		{
			if(($this->get_tour() == 0 || ($this->fin_partie() == null)) && !isset($_GET["unlock"]))
			{
				echo '<td><img src="img/lock.png" alt=""/></td>';
			}
			else 
			{
				echo '<td><img src="img/jeton' . $i .'.png" class="combi" alt=""/></td>'."\n";
			}
		}
		echo '<td class="none"></td><td class="none"><a href="partie.php?unlock=true"><img src="img/unlock.png" alt=""/></a></td>'."\n";
		echo '</tr>'."\n";
		
		foreach(array_reverse($this->historique, true) as $key => $i)
		{
			// on récupère le array des vérifications
			$verif = $this->verification_combinaison($i);
			echo '<tr>'."\n";
			
			echo '<td class="verif"><img src="img/check'. $verif[0] .'.png" alt=""/></td>'."\n";
			echo '<td class="verif"><img src="img/check'. $verif[1] .'.png" alt=""/></td>'."\n";
			
			foreach($i as $k => $j)
			{
				// Autoriser le drop
				if($key==$this->tour)
					echo '<td class="droppable" id="drop'.$k.'" ondrop="drop(event)" ondragover="allowDrop(event)"><img src="img/jeton' . $j .'.png" alt=""/></td>'."\n";
				else
					echo '<td><img src="img/jeton' . $j .'.png" draggable="false" alt=""/></td>'."\n";
			}
			
			echo '<td class="verif"><img src="img/check'. $verif[2] .'.png" alt=""/></td>'."\n";
			echo '<td class="verif"><img src="img/check'. $verif[3] .'.png" alt=""/></td>'."\n";

			echo '</tr>'."\n";
		}
		echo '</table>'."\n";
		echo '<table>'."\n";
		echo '<tr>'."\n";
		for($i=1; $i<9; $i++)
		{
			echo '<td class="draggable" id="drag'.$i.'"><img id="'.$i.'" draggable="true" ondragstart="drag(event)" src="img/jeton'. $i .'.png" alt=""/></td>'."\n";
		}
		echo '</tr>'."\n";
		echo '</table>'."\n";
		
	}
	
	/**
	* Renvoit le vecteur de vérification (pour indiquer au joueur un bon/mauvais placement)
	*/
	public function verification_combinaison($proposition)
	{
		//tmp
		$solution = $this->combinaison;
		$res = array(0,0,0,0);
		$j = 0;
		foreach($proposition as $i => $e)
		{
			if($solution[$i] == $e)
			{
				$res[$j] = 2;
				$j++;
				$solution[$i] = null;
				$proposition[$i] = null;
			}
		}
		foreach($proposition as $i => $e)
		{
			if(in_array($e,$solution) && $e != null)
			{
				$res[$j] = 1;
				$j++;
				$solution[array_search($e,$solution)] = null;
			}
		} 
		
		//tri manuel, sort() = merde
		$tmp = false;
		while(!$tmp)
		{
			$tmp = true;
			for($i=0;$i<count($res)-1;$i++)//($i=0;$i<3;$i++)
			{
				if($res[$i] < $res[$i+1])
				{
					$tmp = false;
					$tmpx = $res[$i];
					$res[$i] = $res[$i+1];
					$res[$i+1] = tmpx;
				}
			}
		}

		return $res;
	}
	
	/**
	* Méthode affirmant si la partie est terminée en se basant sur la proposition
	* du dernier tour. S'il la proposition est bonne, la partie est terminée et renvoit le nom du joueur 2.
	* Si le nombre max de tour est dépassé, la partie est terminée et renvoit le nom du joueur 1.
	*/
	public function fin_partie()
	{
		if(($this->historique[$this->tour-1] == $this->combinaison || $this->tour >= 10))
		{
			if($this->historique[$this->tour-1] == $this->combinaison)
			{
				return $this->joueur2->getNom();
			}
			else
			{
				return $this->joueur1->getNom();
			}
		}
		// La partie peut continuer
		else
		{
			return null;
		}
	}
}

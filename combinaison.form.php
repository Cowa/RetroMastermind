<?php
// Formulaire caché rempli secrètement par le fameux drag'n'drop
echo '<form class="choix" method="post" action="combinaison.post.php">';
	$plateau = unserialize($_SESSION["plateau"]);
	if(!$plateau->get_joueur2() instanceof Robot)
	{
		$k = 1;
		for($i=0; $i<4; $i++)
		{
			echo '<input type="text" id="cdrop'.$i.'" size="1" name="c'.$k.'" style="display:none;"/>';
			$k++;
		}
	}
	echo '<input class="submit" type="submit" name="jouer" value="Valider" />';
echo '</form>';


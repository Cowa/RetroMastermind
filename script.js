	var leclone;
	
	function allowDrop(ev)
	{
		ev.preventDefault();
	}
	function drag(ev)
	{
		leclone = ev.target.cloneNode(true);
	}
	function drop(ev)
	{
		ev.preventDefault();
		ev.currentTarget.replaceChild(leclone, ev.currentTarget.firstChild);
		// Formulaire dynamique
		text = document.getElementById('c'+ ev.currentTarget.id);
		text.value = leclone.id;
	}


<?php $this->assign('title', $titredepage);?>
<?php
	if($events == null)
		echo 'Pas d\'évènement récent à afficher dans cette zone.';
	else
	{
		foreach($events as $event)
			echo '(' . $event->date . '): ' . $event->name . ' à la position (' . $event->x . ' , ' . $event->y . ')<br />';  
	}
?>
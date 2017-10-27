<?php $this->assign('title', $titredepage);
 echo  $this->Html->script('Message') ; ?>
<?php
	if($events == null)
		echo 'No recent event to display in this zone';
	else
	{
		foreach($events as $event)
			echo '(' . $event->date . '): ' . $event->name . ' at position (' . $event->x . ' , ' . $event->y . ')<br />';  
	}
?>
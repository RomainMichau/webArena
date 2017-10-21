<?php
    $this->assign('title', "Tous les figters");?>
    <p> <?php echo $this->Html->link('ajouter fighter', array('controller' => 'Arenas', 'action' => 'createFighter')); ?> </p>


<?php foreach( $fighters as $fighter ): ?>
    <p> id:  <?php echo $fighter->id;?>  </p> 
    <p> name: <?php echo $this->Html->link($fighter->name, array('controller' => 'Arenas', 'action' => 'fighter', $fighter->id)); ?> </p>
    <p> cordX: <?php echo $fighter->coordinate_x ?> , cordY: <?php echo $fighter->coordinate_y ?> </p>
    <p> level: <?php echo $fighter->level ?> </p>
    <p> xp: <?php echo $fighter->xp ?> </p>
    <p> skill_sight: <?php echo $fighter->skill_sight ; echo $this->Form->button('Upgrade XP');?> </p>
    <p> skill_strength: <?php echo $fighter->skill_strength ?> </p>
    <p> skill_health: <?php echo $fighter->skill_health ?> </p>
    <p> current_health: <?php echo $fighter->current_health ?> </p>
    <br>
<?php endforeach; ?>

<?php $this->Html->link('fighter', array('controller' => 'Arenas', 'action' => 'fighter', $fighter->id ));?>

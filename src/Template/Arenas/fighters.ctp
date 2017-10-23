<?php
    $this->assign('title', "Tous les figters");?>
<div class="grid-container">
    <div class="grid-x grid-padding-x small-up-2 medium-up-3">
        
        <?php foreach( $fighters as $fighter ): ?>
            <div class="cell">
                <div class="card" style="width: 300px;">
                    <div class="card-divider">
                        name: <?php echo $this->Html->link($fighter->name, array('controller' => 'Arenas', 'action' => 'fighter', $fighter->id)); ?>
                    </div>
                    <div class="card-image">
                        <?= $this->Html->image('f' . $fighter->id . '.png', ['alt' => 'imgNotFound']) ?>
                    </div>
                    <div class="card-section">
                        <p> id:  <?php echo $fighter->id;?>  </p>
                        <p> cordX: <?php echo $fighter->coordinate_x ?> , cordY: <?php echo $fighter->coordinate_y ?> </p>
                        <p> level: <?php echo $fighter->level ?> </p>
                        <p> xp: <?php echo $fighter->xp ?> </p>
                        <p> skill_sight: <?php echo $fighter->skill_sight ; echo $this->Form->button('Upgrade XP');?> </p>
                        <p> skill_strength: <?php echo $fighter->skill_strength ?> </p>
                        <p> skill_health: <?php echo $fighter->skill_health ?> </p>
                        <p> current_health: <?php echo $fighter->current_health ?> </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        
    </div>
</div>

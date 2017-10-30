<?php
    $this->assign('title', 'Combattants de la grille');
    echo  $this->Html->script('Message') ; ?>
    
<div class="grid-container">
    <div class="grid-x grid-padding-x small-up-1 medium-up-2 large-up-3">
        
        <?php foreach( $fighters as $fighter ): ?>
            <div class="cell">
                <div class="card" style="width: 300px;">
                    <div class="card-divider">
                        name: <?php echo $fighter->name; ?>
                        <?php if($fighter->id != $idFighterAuth) {
                            echo $this->Html->link('Conv', array('controller' => 'Messages', 'action' => 'conversation', $fighter->id, $idFighterAuth), ['class' => 'button']);
                        }?>

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

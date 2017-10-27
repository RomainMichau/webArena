<?php
$this->assign('title', "Tous les guilds");?>
<div class="grid-container">
    <div class="grid-x grid-padding-x small-up-2 medium-up-3">

        <?php foreach( $guilds as $guild ): ?>
            <div class="cell">
                <div class="card" style="width: 300px;">
                    <div class="card-divider">
                        <p> id: <?php echo $guild->id ?> </p>
                        <p> name: <?php echo $guild->name ?> </p>
                        <?= $this->Html->link('add', array('controller' => 'Arenas', 'action' => 'joinGuild', $guild->id), ['class' => 'button']);?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

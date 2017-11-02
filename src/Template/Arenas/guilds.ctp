<?php
$this->assign('title', 'Guildes'); ?>

<div class="grid-container">
    
    <?= $this->Form->create('Guilds')?>
    <div class="grid-x align-center first-form-row">
        <div class="cell small-7 text-left"> 
            <?= $this->Form->input('nouveau guild', array('label' => 'Nom')) ?>
        </div>

        <div class="cell small-7 text-right">
            <?= $this->Form->button(__('Créer Guilde'), ['class' => 'button']); ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
    
    <hr>
    
    <div class="grid-x grid-margin-x grid-padding-x small-up-1 medium-up-2 large-up-3">
        <?php foreach( $guilds as $guild ): ?>
            <div class="cell">
                <div class="card card-divider">
                        <div class="grid-x grid-margin-x">
                            <div class="cell small-2">
                                <span class="badge"><?php echo $guild->id ?></span>
                            </div>
                            <div class="cell small-6">
                                <?= $this->Html->link($guild->name, array('controller' => 'Arenas', 'action' => 'guild', $guild->id))?>
                            </div>
                            <div class="cell small-4 text-right">
                              
                                <?php
                                    if($fighter->guild_id != $guild->id)
                                    {
                                        echo $this->Html->link('Rejoindre', array('controller' => 'Arenas', 'action' => 'joinGuild', $guild->id,$fighter->guild_id), ['class' => 'button']);
                                    }
                                    else if($fighter->guild_id == $guild->id)
                                    {
                                        echo $this->Html->link('Quitter', array('controller' => 'Arenas', 'action' => 'joinGuild', 0,$fighter->guild_id), ['class' => 'button alert']);
                                    }
                                ?>
                            </div>
                        </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>


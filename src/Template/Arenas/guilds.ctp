<?php
$this->assign('title', "Tous les guilds"); ?>

<?= $this->Form->create('Guilds')?>
<?= $this->Form->input('nouveau guild', array('label' => 'Nom')) ?>
<?= $this->Form->button(__('create')) ?>
<?= $this->Form->end() ?>

<div class="grid-container">
    <div class="grid-x grid-padding-x small-up-2 medium-up-3">
        <?php foreach( $guilds as $guild ): ?>
            <div class="cell">
                <div class="card" style="width: 300px;">
                    <div class="card-divider">
                        <p> id: <?php echo $guild->id ?> </p>
                        <p> name: <?php echo $guild->name ?> </p>
                        <?php
                            if($fighter->guild_id != $guild->id)
                            {
                                echo $this->Html->link('add', array('controller' => 'Arenas', 'action' => 'joinGuild', $guild->id), ['class' => 'button']);
                            }
                            else if($fighter->guild_id == $guild->id)
                            {
                                echo $this->Html->link('disADD', array('controller' => 'Arenas', 'action' => 'joinGuild', 0), ['class' => 'button alert']);
                            }
                        ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

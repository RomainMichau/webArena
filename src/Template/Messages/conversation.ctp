<?php
 echo  $this->Html->script('messagelu');
 echo  $this->Html->script('Message');

$this->assign('title', 'Conversation'); ?>
<div class="grid-container">
    <div class="grid-x grid-padding-x small-up-1 medium-up-2 large-up-3">
        <?php
        $i=0;
        if($messages==null){
            ?> <div>pas de message</div> <?php
        }
        foreach($messages as $message): ?>
            <div class="cell">
                <div class="card" style="width: 300px;">
                    <div class="card-divider">
                      <?php if($tab[$i]->name=="moi") {  ?>
                      <p> <?php } else { ?> 
                      <p class='autre' id=<?= $tab[$i]->id ?> >  <?php } ?> 
                            from: <?php echo $tab[$i]->name?> </p>
                        <?php echo $this->Html->image('f'.$tab[$i]->id.'.png', ['alt' => 'imgNotFound','width'=>'80','height'=>'80']); ?>
                    </div>
                    <div class="card-section">
                    
                        <p> message: <?php echo $message->message ?> </p>
                    </div>
                </div>
            </div>
        <?php $i++; endforeach; ?>
    </div>
    <?= $this->Form->create('Messages')?>
    <?= $this->Form->input('nouveau message'); ?>
    <?= $this->Form->button(__('Send')) ?>
    <?= $this->Form->end() ?>
</div>
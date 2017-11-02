<?php
 echo  $this->Html->script('messagelu');
 echo  $this->Html->script('Message');

$this->assign('title', 'Conversation'); ?>
<div class="grid-container">
        <?php
        $i=0;
        if($messages==null){
            ?> <div>pas de message</div> <?php
        }
        foreach( array_reverse($messages) as $message): ?>
            <div class="grid-x grid-padding-x">
                <div class="cell">
                    <div class="card" style="height: 150px;">
                        <div class="card-divider">
                            <?php if($tab[$i]->name=="moi") {  ?>
                            <p> <?php } else { ?> 
                            <p class='autre' id=<?= $tab[$i]->id ?> >  <?php } ?> 
                            <?php echo $this->Html->image('f'.$tab[$i]->id.'.png', ['alt' => 'imgNotFound','width'=>'80','height'=>'80']); ?>
                            De: <?php echo $tab[$i]->name?> </p>
                        </div>
                        <div class="card-section">
                            <p> message: <?php echo $message->message ?> </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php $i++; endforeach; ?>
    
    <hr>
    
    <?= $this->Form->create('Messages')?>
    <div class="grid-x align-center first-form-row">
        <div class="cell small-7 text-left"> 
            <?= $this->Form->input('nouveau message', array('label' => 'Message')) ?>
        </div>

        <div class="cell small-7 text-right">
            <?= $this->Form->button(__('Envoyer'), ['class' => 'button']); ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
    
    
    
</div>
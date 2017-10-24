


<?php $this->Form->create('Fighter', array('type' => 'file'));?>
<?php if($dead==1) { ?> votre perso est decédé :'( , merci d'en creer un nouveau <?php }
 else{ ?> Creer votre permier fighter ;)    
        


    <?php } ?>
    <?= $this->Form->input('name', array('label' => 'Nom'));?>
    <?= $this->Form->input('avatar_file',array('label'=>'Avatar', 'type' => 'file')); ?>


<?= $this->Form->button(__('Create')) ?>
<?= $this->Form->end() ?>
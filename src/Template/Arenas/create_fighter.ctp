
<?= $this->Form->create('Fighter', array('type' => 'file'));?>

<?php if($dead==1){ echo 'perso dead';} ?>

   
    <?= $this->Form->input('name', array('label' => 'Nom')); ?>
    <?= $this->Form->input('avatar_file',array('label'=>'Avatar', 'type' => 'file')); ?>


<?= $this->Form->button(__('Create')) ?>
<?= $this->Form->end() ?>
<?php $this->assign('title', 'Modifier combattant');?>

<?= $this->Form->create('Fighter', array('type' => 'file'));?>


    <?= $this->Form->input('name', array('label' => 'Nom', 'value' => $fighter->name)); ?>
    <?= $this->Html->image('f' . $fighter->id . '.png', ['alt' => 'imgNotFound','height' => '150']) ?>
    <?= $this->Form->input('avatar_file',array('label'=>'Avatar', 'type' => 'file')); ?>


<?= $this->Form->button(__('Edit')) ?>
<?= $this->Form->end() ?>
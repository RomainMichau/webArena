<?= $this->Form->create('Fighter', array('type' => 'file'));?>

    <?= $this->Form->input('name', array('label' => 'Nom'));?>
    <?= $this->Form->input('avatar_file',array('label'=>'Avatar', 'type' => 'file')); ?>


<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
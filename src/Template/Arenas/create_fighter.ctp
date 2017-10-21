<?= $this->Form->create('Fighters');?>

    <?= $this->Form->input('name', array('label' => 'Nom'));?>

<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
<div class="container clearfix row small-12 medium-10">

    <?php $this->assign('title', 'Créer combattant');?>

    <?= $this->Form->create('Fighter', array('type' => 'file'));?>

    <?php if($dead==1){ echo 'Vous êtes mort';} ?>


        <?= $this->Form->input('name', array('label' => 'Nom')); ?>
        <?= $this->Form->input('avatar_file',array('label'=>'Avatar', 'type' => 'file')); ?>


    <?= $this->Form->button(__('Create')) ?>
    <?= $this->Form->end() ?>
</div>

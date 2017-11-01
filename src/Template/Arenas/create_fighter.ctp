<div class="row">
    <?php $this->assign('title', 'Créer combattant');?>

	<?php if($dead==1){ echo 'Vous êtes mort';} ?>

    <?= $this->Form->create('Fighter', array('type' => 'file'));?>
        <div class="grid-x align-center first-form-row">
            <div class="cell small-7 text-center"> 
                <label>Nom du Combattant
                    <input type="text" name="name" id="name" placeholder="Nom" />
                </label>
            </div>
        </div>
        <div class="grid-x align-center">
            <div class="cell small-7 text-center">
                 <?= $this->Form->input('avatar_file',array('label'=>'Avatar', 'type' => 'file')); ?>
            </div>
        </div>

        <div class="grid-x align-center">
            <?= $this->Form->button(__('Création'), ['class' => 'cell small-3 large success button form-button']); ?>
        </div>
    <?= $this->Form->end() ?>
</div>
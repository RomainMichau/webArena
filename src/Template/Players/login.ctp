<?php $this->assign('title', $titredepage);?>

<?= $this->Form->create() ?>
<form>
    <fieldset class="fieldset">
        <legend><?= __('Login Form') ?></legend>
        <div class="grid-x">
            <div class="medium-3 cell"><label class="text-right middle">Email</label></div>
            <div class="medium-9 cell"><?= $this->Form->control('email', ['label' => false]) ?></div>
            <div class="medium-3 cell"><label class="text-right middle">Mot de passe</label></div>
            <div class="medium-9 cell"><?= $this->Form->control('password', ['label' => false]) ?></div>
        </div>
        <?= $this->Html->link('Forgot password', array('controller' => 'Players', 'action' => 'forgotPassword'));?>
        <?= $this->Form->button(__('Login'), ['class' => 'button']); ?>
        <?= $this->Form->end() ?>
    </fieldset>
</form>


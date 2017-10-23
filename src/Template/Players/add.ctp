<?php $this->assign('title', $titredepage);?>

<?= $this->Form->create($user) ?>
<form>
    <fieldset class="fieldset">
        <legend><?= __('Add User') ?></legend>
        <div class="grid-x">
            <div class="medium-3 cell"><label class="text-right middle">Email</label></div>
            <div class="medium-9 cell"><?= $this->Form->control('email', ['label' => false]) ?></div>
            <div class="medium-3 cell"><label class="text-right middle">Mot de passe</label></div>
            <div class="medium-9 cell"><?= $this->Form->control('password', ['label' => false]) ?></div>
        </div>

        <?= $this->Form->button(__('Submit'), ['class' => 'button']); ?>
        <?= $this->Form->end() ?>
    </fieldset>
</form>

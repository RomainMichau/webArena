<?php $this->assign('title', $titredepage);?>
<?= $this->Flash->render() ?>
<?= $this->Form->create() ?>
<form>
    <fieldset class="fieldset">
        <legend><?= __('Forgot Password') ?></legend>
        <div class="grid-x">
            <div class="medium-3 cell"><label class="text-right middle">Email</label></div>
            <div class="medium-9 cell"><?= $this->Form->control('email', ['label' => false]) ?></div>
            <div class="medium-3 cell"><label class="text-right middle">New Password</label></div>
            <div class="medium-9 cell"><?= $this->Form->control('password', ['label' => false]) ?></div>
        </div>
        <?= $this->Form->button(__('Reset'), ['class' => 'button']); ?>
        <?= $this->Form->end() ?>
    </fieldset>
</form>


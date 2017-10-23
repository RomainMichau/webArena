<?php $this->assign('title', $titredepage);?>

<form>
    <?= $this->Form->create($user) ?>
    <fieldset class="fieldset">
        <legend><?= __('Add User') ?></legend>
            <div class="grid-container">
                <div class="grid-x grid-padding-x">
                    
                    <div class="medium-3 cell">
                         <label class="text-right middle">Email</label>
                    </div>
                    <div class="medium-9 cell">
                        <?= $this->Form->control('email', ['label' => false]) ?>
                    </div>
                    
                    <div class="medium-3 cell">
                        <label class="text-right middle">Mot de passe</label>
                    </div>
                    <div class="medium-9 cell">
                        <?= $this->Form->control('password', ['label' => false]) ?>
                    </div>
                    
                    <div class="medium-12 cell">
                        <div class="button float-right"><?= $this->Form->button(__('Submit')); ?></div>
                    </div>
                </div>
            </div>
    </fieldset>
    <?= $this->Form->end() ?>
</form>

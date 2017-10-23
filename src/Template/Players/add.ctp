<?php $this->assign('title', $titredepage);?>

<div class="users form">
 <?= $this->Form->create($user) ?>
 <form>
     <fieldset class="fieldset">
          <legend><?= __('Add User') ?></legend>
         <?= $this->Form->control('email') ?>
         <?= $this->Form->control('password') ?>
    </fieldset>
 <?= $this->Form->button(__('Submit')); ?>
 <?= $this->Form->end() ?>
 </div> 

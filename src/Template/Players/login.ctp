<?php $this->assign('title', $titredepage);?>


<div class="users form">
 <?= $this->Form->create() ?>
 <form>
     <fieldset class="fieldset">
          <legend><?= __('Login Form') ?></legend>
         <?= $this->Form->control('email') ?>
         <?= $this->Form->control('password') ?>
    </fieldset>
 <?= $this->Form->button(__('Login')); ?>
 <?= $this->Form->end() ?>
 </div> 
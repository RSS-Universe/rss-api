<?php
/**
 * @var AppView $this
 */

use App\View\AppView;

?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <? if ($this->Auth->isLoggedIn()): ?>
            <li><?= $this->Html->link(__('Log Out'), ['action' => 'logout']) ?></li>
        <? else: ?>
            <li><?= $this->Html->link(__('Log In'), ['action' => 'login']) ?></li>
            <li><?= $this->Html->link(__('Register'), ['action' => 'register']) ?></li>
        <? endif; ?>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your email and password') ?></legend>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password') ?>
    </fieldset>
    <?= $this->Form->button(__('Login')); ?>
    <?= $this->Form->end() ?>
</div>

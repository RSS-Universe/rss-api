<?php
/**
 * @var AppView $this
 * @var User $user
 */

use App\Model\Entity\User;
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
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Register') ?></legend>
        <?php
        echo $this->Form->control('name');
        echo $this->Form->control('email');
        echo $this->Form->control('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

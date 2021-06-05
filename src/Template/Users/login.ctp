<?php
/**
 * @var AppView $this
 */

use App\View\AppView;

$this->extend('/Base/add');
$this->assign('title', 'Log In')
?>
<?= $this->Form->create(null) ?>
<?= $this->Form->control('email', ['required' => true]) ?>
<?= $this->Form->control('password', ['required' => true]) ?>
<?= $this->Form->button(__('Log In'), ['class' => 'btn btn-primary btn-block ']) ?>
<?= $this->Form->end() ?>

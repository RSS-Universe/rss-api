<?php
/**
 * @var AppView $this
 */

use App\View\AppView;

$this->extend('/Base/add');
$this->assign('title', 'Log In')
?>
<?= $this->Form->create(null) ?>
<?php
echo $this->Form->control('email');
echo $this->Form->control('password');
?>
<?= $this->Form->button(__('Log In'), ['class' => 'btn btn-primary btn-block ']) ?>
<?= $this->Form->end() ?>

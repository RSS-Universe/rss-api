<?php
/**
 * @var AppView $this
 * @var User $user
 */

use App\Model\Entity\User;
use App\View\AppView;

$this->extend('/Base/add');
$this->assign('title', 'Register')
?>
<?= $this->Form->create($user) ?>
<?php
echo $this->Form->control('name');
echo $this->Form->control('email');
echo $this->Form->control('password');
?>
<?= $this->Form->button(__('Register'), ['class' => 'btn btn-primary btn-block ']) ?>
<?= $this->Form->end() ?>

<?php
/**
 * @var AppView $this
 * @var RssDomain $rssDomain
 */

use App\Model\Entity\RssDomain;
use App\View\AppView;

$this->extend('/Base/add');
$this->assign('title', 'New Domain');
?>
<?= $this->Form->create($rssDomain) ?>
<?= $this->Form->control('name') ?>
<?= $this->Form->control('url') ?>
<?= $this->Form->control('description') ?>
<?= $this->Form->button(__('Create'), ['class' => 'btn btn-primary btn-block ']) ?>
<?= $this->Form->end() ?>

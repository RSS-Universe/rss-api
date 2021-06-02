<?php
/**
 * @var AppView $this
 * @var RssDomain $rssDomain
 */

use App\Model\Entity\RssDomain;
use App\View\AppView;

$this->extend('/Base/edit');
$this->assign('title', 'Edit Domain');
?>
<?= $this->Form->create($rssDomain) ?>
<?php
echo $this->Form->control('name');
echo $this->Form->control('url');
echo $this->Form->control('description');
?>
<?= $this->Form->button(__('Edit'), ['class' => 'btn btn-primary btn-block ']) ?>
<?= $this->Form->end() ?>

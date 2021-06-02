<?php
/**
 * @var AppView $this
 */

use App\View\AppView;

$this->extend('/Base/base');
$edit_id = $this->fetch('edit_id');
?>
<? if ($edit_id): ?>
    <?= $this->Html->link('edit', ['action' => 'edit', $edit_id], ['class' => 'btn btn-primary btn-sm']) ?>
<? endif; ?>
<?= $this->fetch('content') ?>


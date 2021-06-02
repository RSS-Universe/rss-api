<?php
/**
 * @var AppView $this
 */

use App\View\AppView;

$this->extend('/Base/base');
$show_new = $this->fetch('show_new', true);
?>
<? if ($show_new): ?>
    <?= $this->Html->link('new', ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
<? endif; ?>
<?= $this->fetch('content') ?>


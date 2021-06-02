<?php
/**
 * @var AppView $this
 */

use App\View\AppView;
use Cake\Utility\Inflector;

$this->extend('/Base/base');
if (!$this->fetch('title')) $this->assign('title', 'New ' . Inflector::singularize($this->getRequest()->getParam('controller')));
?>
<?= $this->Html->link('cancel', $this->getRequest()->referer(), ['class' => 'btn btn-info btn-sm']) ?>
<?= $this->fetch('content') ?>

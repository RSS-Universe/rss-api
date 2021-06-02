<?php
/**
 * @var AppView $this
 */

use App\View\AppView;

$title = $this->fetch('title', $this->getRequest()->getParam('controller'));
?>
<div class="container">
    <h1 style="display: inline-block"> <?= $title ?> </h1>
    <?= $this->fetch('content') ?>
</div>

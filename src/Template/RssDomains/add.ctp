<?php
/**
 * @var AppView $this
 * @var RssDomain $rssDomain
 */

use App\Model\Entity\RssDomain;
use App\View\AppView;

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Rss Domains'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Domain Feeds'), ['controller' => 'DomainFeeds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Domain Feed'), ['controller' => 'DomainFeeds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rssDomains form large-9 medium-8 columns content">
    <?= $this->Form->create($rssDomain) ?>
    <fieldset>
        <legend><?= __('Add Rss Domain') ?></legend>
        <?php
        echo $this->Form->control('name');
        echo $this->Form->control('url');
        echo $this->Form->control('description');
        echo $this->Form->control('feed_count');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

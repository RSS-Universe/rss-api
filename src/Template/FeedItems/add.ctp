<?php
/**
 * @var AppView $this
 * @var FeedItem $feedItem
 */

use App\Model\Entity\FeedItem;
use App\View\AppView;

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Feed Items'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Domain Feeds'), ['controller' => 'DomainFeeds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Domain Feed'), ['controller' => 'DomainFeeds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="feedItems form large-9 medium-8 columns content">
    <?= $this->Form->create($feedItem) ?>
    <fieldset>
        <legend><?= __('Add Feed Item') ?></legend>
        <?php
        echo $this->Form->control('domain_feed_id', ['options' => $domainFeeds]);
        echo $this->Form->control('title');
        echo $this->Form->control('url');
        echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

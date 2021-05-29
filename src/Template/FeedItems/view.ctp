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
        <li><?= $this->Html->link(__('Edit Feed Item'), ['action' => 'edit', $feedItem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Feed Item'), ['action' => 'delete', $feedItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feedItem->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Feed Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Feed Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Domain Feeds'), ['controller' => 'DomainFeeds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Domain Feed'), ['controller' => 'DomainFeeds', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="feedItems view large-9 medium-8 columns content">
    <h3><?= h($feedItem->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($feedItem->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Domain Feed') ?></th>
            <td><?= $feedItem->has('domain_feed') ? $this->Html->link($feedItem->domain_feed->name, ['controller' => 'DomainFeeds', 'action' => 'view', $feedItem->domain_feed->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($feedItem->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Url') ?></th>
            <td><?= h($feedItem->url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($feedItem->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($feedItem->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($feedItem->description)); ?>
    </div>
</div>

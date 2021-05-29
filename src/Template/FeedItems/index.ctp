<?php
/**
 * @var AppView $this
 * @var FeedItem[]|CollectionInterface $feedItems
 */

use App\Model\Entity\FeedItem;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Feed Item'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Domain Feeds'), ['controller' => 'DomainFeeds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Domain Feed'), ['controller' => 'DomainFeeds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="feedItems index large-9 medium-8 columns content">
    <h3><?= __('Feed Items') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('domain_feed_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('title') ?></th>
            <th scope="col"><?= $this->Paginator->sort('url') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($feedItems as $feedItem): ?>
            <tr>
                <td><?= h($feedItem->id) ?></td>
                <td><?= $feedItem->has('domain_feed') ? $this->Html->link($feedItem->domain_feed->name, ['controller' => 'DomainFeeds', 'action' => 'view', $feedItem->domain_feed->id]) : '' ?></td>
                <td><?= h($feedItem->title) ?></td>
                <td><?= h($feedItem->url) ?></td>
                <td><?= h($feedItem->created) ?></td>
                <td><?= h($feedItem->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $feedItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $feedItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $feedItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feedItem->id)]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

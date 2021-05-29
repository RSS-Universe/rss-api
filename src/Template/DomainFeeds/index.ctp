<?php
/**
 * @var AppView $this
 * @var DomainFeed[]|CollectionInterface $domainFeeds
 */

use App\Model\Entity\DomainFeed;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Domain Feed'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Rss Domains'), ['controller' => 'RssDomains', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rss Domain'), ['controller' => 'RssDomains', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Feed Items'), ['controller' => 'FeedItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Feed Item'), ['controller' => 'FeedItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="domainFeeds index large-9 medium-8 columns content">
    <h3><?= __('Domain Feeds') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('rss_domain_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('url') ?></th>
            <th scope="col"><?= $this->Paginator->sort('items_count') ?></th>
            <th scope="col"><?= $this->Paginator->sort('fetch_in_minutes') ?></th>
            <th scope="col"><?= $this->Paginator->sort('last_fetch') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($domainFeeds as $domainFeed): ?>
            <tr>
                <td><?= h($domainFeed->id) ?></td>
                <td><?= $domainFeed->has('rss_domain') ? $this->Html->link($domainFeed->rss_domain->name, ['controller' => 'RssDomains', 'action' => 'view', $domainFeed->rss_domain->id]) : '' ?></td>
                <td><?= h($domainFeed->name) ?></td>
                <td><?= h($domainFeed->url) ?></td>
                <td><?= $this->Number->format($domainFeed->items_count) ?></td>
                <td><?= $this->Number->format($domainFeed->fetch_in_minutes) ?></td>
                <td><?= h($domainFeed->last_fetch) ?></td>
                <td><?= h($domainFeed->created) ?></td>
                <td><?= h($domainFeed->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $domainFeed->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $domainFeed->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $domainFeed->id], ['confirm' => __('Are you sure you want to delete # {0}?', $domainFeed->id)]) ?>
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

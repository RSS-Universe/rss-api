<?php
/**
 * @var AppView $this
 * @var RssDomain[]|CollectionInterface $rssDomains
 */

use App\Model\Entity\RssDomain;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Rss Domain'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Domain Feeds'), ['controller' => 'DomainFeeds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Domain Feed'), ['controller' => 'DomainFeeds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rssDomains index large-9 medium-8 columns content">
    <h3><?= __('Rss Domains') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('url') ?></th>
            <th scope="col"><?= $this->Paginator->sort('feed_count') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rssDomains as $rssDomain): ?>
            <tr>
                <td><?= h($rssDomain->id) ?></td>
                <td><?= h($rssDomain->name) ?></td>
                <td><?= h($rssDomain->url) ?></td>
                <td><?= $this->Number->format($rssDomain->feed_count) ?></td>
                <td><?= h($rssDomain->created) ?></td>
                <td><?= h($rssDomain->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $rssDomain->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rssDomain->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rssDomain->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rssDomain->id)]) ?>
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

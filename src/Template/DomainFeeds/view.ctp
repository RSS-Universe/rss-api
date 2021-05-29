<?php
/**
 * @var AppView $this
 * @var DomainFeed $domainFeed
 */

use App\Model\Entity\DomainFeed;
use App\View\AppView;

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Domain Feed'), ['action' => 'edit', $domainFeed->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Domain Feed'), ['action' => 'delete', $domainFeed->id], ['confirm' => __('Are you sure you want to delete # {0}?', $domainFeed->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Domain Feeds'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Domain Feed'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rss Domains'), ['controller' => 'RssDomains', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rss Domain'), ['controller' => 'RssDomains', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Feed Items'), ['controller' => 'FeedItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Feed Item'), ['controller' => 'FeedItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="domainFeeds view large-9 medium-8 columns content">
    <h3><?= h($domainFeed->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($domainFeed->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rss Domain') ?></th>
            <td><?= $domainFeed->has('rss_domain') ? $this->Html->link($domainFeed->rss_domain->name, ['controller' => 'RssDomains', 'action' => 'view', $domainFeed->rss_domain->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($domainFeed->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Url') ?></th>
            <td><?= h($domainFeed->url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Items Count') ?></th>
            <td><?= $this->Number->format($domainFeed->items_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fetch In Minutes') ?></th>
            <td><?= $this->Number->format($domainFeed->fetch_in_minutes) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Fetch') ?></th>
            <td><?= h($domainFeed->last_fetch) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($domainFeed->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($domainFeed->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($domainFeed->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Feed Items') ?></h4>
        <?php if (!empty($domainFeed->feed_items)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Domain Feed Id') ?></th>
                    <th scope="col"><?= __('Title') ?></th>
                    <th scope="col"><?= __('Url') ?></th>
                    <th scope="col"><?= __('Description') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($domainFeed->feed_items as $feedItems): ?>
                    <tr>
                        <td><?= h($feedItems->id) ?></td>
                        <td><?= h($feedItems->domain_feed_id) ?></td>
                        <td><?= h($feedItems->title) ?></td>
                        <td><?= h($feedItems->url) ?></td>
                        <td><?= h($feedItems->description) ?></td>
                        <td><?= h($feedItems->created) ?></td>
                        <td><?= h($feedItems->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'FeedItems', 'action' => 'view', $feedItems->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'FeedItems', 'action' => 'edit', $feedItems->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'FeedItems', 'action' => 'delete', $feedItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feedItems->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>

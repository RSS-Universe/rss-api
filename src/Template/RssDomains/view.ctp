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
        <li><?= $this->Html->link(__('Edit Rss Domain'), ['action' => 'edit', $rssDomain->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Rss Domain'), ['action' => 'delete', $rssDomain->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rssDomain->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rss Domains'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rss Domain'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Domain Feeds'), ['controller' => 'DomainFeeds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Domain Feed'), ['controller' => 'DomainFeeds', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rssDomains view large-9 medium-8 columns content">
    <h3><?= h($rssDomain->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($rssDomain->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($rssDomain->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Url') ?></th>
            <td><?= h($rssDomain->url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Feed Count') ?></th>
            <td><?= $this->Number->format($rssDomain->feed_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($rssDomain->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($rssDomain->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($rssDomain->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Domain Feeds') ?></h4>
        <?php if (!empty($rssDomain->domain_feeds)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Rss Domain Id') ?></th>
                    <th scope="col"><?= __('Name') ?></th>
                    <th scope="col"><?= __('Url') ?></th>
                    <th scope="col"><?= __('Description') ?></th>
                    <th scope="col"><?= __('Items Count') ?></th>
                    <th scope="col"><?= __('Fetch In Minutes') ?></th>
                    <th scope="col"><?= __('Last Fetch') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($rssDomain->domain_feeds as $domainFeeds): ?>
                    <tr>
                        <td><?= h($domainFeeds->id) ?></td>
                        <td><?= h($domainFeeds->rss_domain_id) ?></td>
                        <td><?= h($domainFeeds->name) ?></td>
                        <td><?= h($domainFeeds->url) ?></td>
                        <td><?= h($domainFeeds->description) ?></td>
                        <td><?= h($domainFeeds->items_count) ?></td>
                        <td><?= h($domainFeeds->fetch_in_minutes) ?></td>
                        <td><?= h($domainFeeds->last_fetch) ?></td>
                        <td><?= h($domainFeeds->created) ?></td>
                        <td><?= h($domainFeeds->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'DomainFeeds', 'action' => 'view', $domainFeeds->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'DomainFeeds', 'action' => 'edit', $domainFeeds->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'DomainFeeds', 'action' => 'delete', $domainFeeds->id], ['confirm' => __('Are you sure you want to delete # {0}?', $domainFeeds->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>

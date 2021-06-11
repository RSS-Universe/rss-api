<?php
/**
 * @var AppView $this
 * @var DomainFeed $domainFeed
 * @var FeedItem[] $feedItems
 */

use App\Model\Entity\DomainFeed;
use App\Model\Entity\FeedItem;
use App\View\AppView;

$this->extend('/Base/view');
$this->assign('title', $domainFeed->name);
?>
<?= $this->Text->autoParagraph(h($domainFeed->description)); ?>
<div class="table-responsive">
    <table class="table table-striped">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($domainFeed->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rss Domain') ?></th>
            <td><?= $domainFeed->has('rss_domain') ? $this->Html->link($domainFeed->rss_domain->name, ['controller' => 'RssDomains', 'action' => 'view', $domainFeed->rss_domain->id]) : '' ?></td>
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
</div>
<div class="row">
    <h4><?= __('Description') ?></h4>
    <?= $this->Text->autoParagraph(h($domainFeed->description)); ?>
</div>
<div class="related">
    <h4><?= __('Feed Items') ?></h4>
    <?php if (!empty($feedItems)): ?>

        <? $this->start('table_body') ?>
        <?php foreach ($feedItems as $feedItem): ?>
            <tr>
                <td>
                    <?= h($feedItem->title) ?><br/>
                    <?= h($feedItem->url) ?>
                </td>
                <td><?= h($feedItem->published) ?></td>
            </tr>
        <?php endforeach; ?>
        <? $this->end() ?>
        <?= $this->element('paginatedTableData', [
            'table_headers' => [
                $this->Paginator->sort('title'),
                $this->Paginator->sort('published'),
            ]
        ]) ?>

    <?php endif; ?>
</div>

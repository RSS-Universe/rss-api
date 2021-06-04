<?php
/**
 * @var AppView $this
 * @var DomainFeed[] $domainFeeds
 */

use App\Model\Entity\DomainFeed;
use App\View\AppView;

$this->extend('/Base/index');
$this->assign('title', 'Feeds');

?>

<? $this->start('table_body') ?>
<?php foreach ($domainFeeds as $domainFeed): ?>
    <tr>
        <td style="text-align: center;">
            <?= $this->ActiveIndicator->render($domainFeed->is_active) ?>
        </td>
        <td>
            <?= $this->Html->link($domainFeed->name, ['action' => 'view', $domainFeed->id]) ?><br/>
            <?= h($domainFeed->url) ?><br/>
            <?= h($domainFeed->description) ?>
        </td>
        <td style="white-space: nowrap"><?= $domainFeed->has('rss_domain') ? $this->Html->link($domainFeed->rss_domain->name, ['controller' => 'RssDomains', 'action' => 'view', $domainFeed->rss_domain->id]) : '' ?></td>
        <td><?= $this->Number->format($domainFeed->items_count) ?></td>
        <td><?= $this->Number->format($domainFeed->fetch_in_minutes) ?> minutes</td>
        <td><?= $domainFeed->last_fetch ? $domainFeed->last_fetch->timeAgoInWords() : 'Never Fetched' ?></td>
    </tr>
<?php endforeach; ?>
<? $this->end() ?>
<?= $this->element('paginatedTableData', [
    'table_headers' => [
        $this->Paginator->sort('is_active', 'Active'),
        $this->Paginator->sort('name'),
        $this->Paginator->sort('rss_domain_id', 'Domain'),
        $this->Paginator->sort('items_count', 'Items'),
        $this->Paginator->sort('fetch_in_minutes', 'Frequency'),
        $this->Paginator->sort('last_fetch'),
    ]
]) ?>


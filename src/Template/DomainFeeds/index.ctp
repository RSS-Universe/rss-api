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
        <td>
            <?= $this->Html->link($domainFeed->name, ['action' => 'view', $domainFeed->id]) ?><br/>
            <?= h($domainFeed->url) ?><br/>
            <?= h($domainFeed->description) ?>
        </td>
        <td style="white-space: nowrap"><?= $domainFeed->has('rss_domain') ? $this->Html->link($domainFeed->rss_domain->name, ['controller' => 'RssDomains', 'action' => 'view', $domainFeed->rss_domain->id]) : '' ?></td>
        <td><?= $this->Number->format($domainFeed->items_count) ?></td>
        <td><?= $this->Number->format($domainFeed->fetch_in_minutes) ?> minutes</td>
        <td><?= h($domainFeed->last_fetch) ?></td>
    </tr>
<?php endforeach; ?>
<? $this->end() ?>
<?= $this->element('paginatedTableData', [
    'table_headers' => [
        $this->Paginator->sort('name'),
        $this->Paginator->sort('rss_domain_id', 'Domain'),
        $this->Paginator->sort('items_count', 'Items'),
        $this->Paginator->sort('fetch_in_minutes', 'Frequency'),
        $this->Paginator->sort('last_fetch'),
    ]
]) ?>


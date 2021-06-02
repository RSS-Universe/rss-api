<?php
/**
 * @var AppView $this
 * @var FeedItem[] $feedItems
 */

use App\Model\Entity\FeedItem;
use App\View\AppView;

$this->extend('/Base/index');
$this->assign('title', 'Items');
$this->assign('show_new', false);

?>

<? $this->start('table_body') ?>
<?php foreach ($feedItems as $feedItem): ?>
    <tr>
        <td><?= $feedItem->has('domain_feed') ? $this->Html->link($feedItem->domain_feed->name, ['controller' => 'DomainFeeds', 'action' => 'view', $feedItem->domain_feed->id]) : '' ?></td>
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
        $this->Paginator->sort('domain_feed_id'),
        $this->Paginator->sort('title'),
        $this->Paginator->sort('published'),
    ]
]) ?>

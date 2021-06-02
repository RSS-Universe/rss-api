<?php
/**
 * @var AppView $this
 * @var RssDomain[] $rssDomains
 */

use App\Model\Entity\RssDomain;
use App\View\AppView;

$this->extend('/Base/index');
$this->assign('title', 'Domains');
?>

<? $this->start('table_body') ?>
<?php foreach ($rssDomains as $rssDomain): ?>
    <tr>
        <td><?= $this->Html->link($rssDomain->name, ['action' => 'view', $rssDomain->id]) ?></td>
        <td><?= h($rssDomain->url) ?></td>
        <td><?= $this->Number->format($rssDomain->feed_count) ?></td>
        <td><?= h($rssDomain->created) ?></td>
    </tr>
<?php endforeach; ?>
<? $this->end() ?>
<?= $this->element('paginatedTableData', [
    'table_headers' => [
        $this->Paginator->sort('name'),
        $this->Paginator->sort('url'),
        $this->Paginator->sort('feed_count', 'Feeds'),
        $this->Paginator->sort('created'),
    ]
]) ?>

<?php
/**
 * @var AppView $this
 * @var RssDomain $rssDomain
 * @var DomainFeed[] $domainFeeds
 */

use App\Model\Entity\DomainFeed;
use App\Model\Entity\RssDomain;
use App\View\AppView;

$this->extend('/Base/view');
$this->assign('title', $rssDomain->name);
$this->assign('edit_id', $rssDomain->id);
?>
<?= $this->Text->autoParagraph(h($rssDomain->description)); ?>
<div class="table-responsive">
    <table class="table table-striped">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($rssDomain->id) ?></td>
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
</div>

<div class="related">
    <h4 style="display: inline-block"><?= __('Domain Feeds') ?></h4>
    <?= $this->Html->link('new', [
        'controller' => 'DomainFeeds',
        'action' => 'add',
        $rssDomain->id
    ], ['class' => 'btn btn-primary btn-sm']) ?>
    <?php if (!empty($domainFeeds)): ?>
        <? $this->start('table_body') ?>
        <?php foreach ($domainFeeds as $domainFeed): ?>
            <tr>
                <td>
                    <?= $this->Html->link($domainFeed->name, [
                        'controller' => 'DomainFeeds',
                        'action' => 'view',
                        $domainFeed->id
                    ]) ?><br/>
                    <?= h($domainFeed->url) ?><br/>
                    <?= h($domainFeed->description) ?>
                </td>
                <td><?= $this->Number->format($domainFeed->items_count) ?></td>
                <td><?= $this->Number->format($domainFeed->fetch_in_minutes) ?> minutes</td>
                <td><?= h($domainFeed->last_fetch) ?></td>
            </tr>
        <?php endforeach; ?>
        <? $this->end() ?>
        <?= $this->element('paginatedTableData', [
            'table_headers' => [
                $this->Paginator->sort('name'),
                $this->Paginator->sort('items_count', 'Items'),
                $this->Paginator->sort('fetch_in_minutes', 'Frequency'),
                $this->Paginator->sort('last_fetch'),
            ]
        ]) ?>


    <?php endif; ?>
</div>

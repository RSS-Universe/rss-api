<?php
/**
 * @var AppView $this
 * @var RssDomain $rssDomain
 * @var DomainFeed[] $domainFeeds
 * @var ResultSet|Comment[] $comments
 */

use App\Model\Entity\DomainFeed;
use App\Model\Entity\RssDomain;
use App\View\AppView;
use Cake\ORM\ResultSet;
use Commentable\Model\Entity\Comment;

$this->extend('/Base/view');
$this->assign('title', $rssDomain->name);
?>
<?= $this->Text->autoParagraph(h($rssDomain->description)); ?>
<div class="table-responsive">
    <table class="table table-striped">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($rssDomain->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td>
                <?= $this->ActiveIndicator->render($rssDomain->is_active) ?>
                <?= $rssDomain->is_active ? 'Active' : 'Not Active' ?>
            </td>
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
            <td><?= h($rssDomain->created->timeAgoInWords()) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($rssDomain->modified->timeAgoInWords()) ?></td>
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
                <td style="text-align: center;">
                    <?= $this->ActiveIndicator->render($domainFeed->is_active) ?>
                </td>
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
                <td><?= $domainFeed->last_fetch ? $domainFeed->last_fetch->timeAgoInWords() : 'Never Fetched' ?></td>
            </tr>
        <?php endforeach; ?>
        <? $this->end() ?>
        <?= $this->element('paginatedTableData', [
            'table_headers' => [
                $this->Paginator->sort('is_active', 'Active'),
                $this->Paginator->sort('name'),
                $this->Paginator->sort('items_count', 'Items'),
                $this->Paginator->sort('fetch_in_minutes', 'Frequency'),
                $this->Paginator->sort('last_fetch'),
            ]
        ]) ?>
    <?php endif; ?>
</div>

<section>
    <h3>Comment</h3>
    <?= $this->Comment->renderForm('RssDomains', $rssDomain->id) ?>
</section>
<section class="pt-3">
    <?= $this->Comment->renderComments('RssDomains', $rssDomain->id) ?>
</section>

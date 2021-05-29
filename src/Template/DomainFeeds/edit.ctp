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
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $domainFeed->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $domainFeed->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('List Domain Feeds'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Rss Domains'), ['controller' => 'RssDomains', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rss Domain'), ['controller' => 'RssDomains', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Feed Items'), ['controller' => 'FeedItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Feed Item'), ['controller' => 'FeedItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="domainFeeds form large-9 medium-8 columns content">
    <?= $this->Form->create($domainFeed) ?>
    <fieldset>
        <legend><?= __('Edit Domain Feed') ?></legend>
        <?php
        echo $this->Form->control('rss_domain_id', ['options' => $rssDomains]);
        echo $this->Form->control('name');
        echo $this->Form->control('url');
        echo $this->Form->control('description');
        echo $this->Form->control('items_count');
        echo $this->Form->control('fetch_in_minutes');
        echo $this->Form->control('last_fetch');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

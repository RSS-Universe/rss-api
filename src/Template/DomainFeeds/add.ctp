<?php
/**
 * @var AppView $this
 * @var DomainFeed $domainFeed
 * @var RssDomain[] $rssDomains
 */

use App\Model\Entity\DomainFeed;
use App\Model\Entity\RssDomain;
use App\View\AppView;

$this->extend('/Base/add');
$this->assign('title', 'New Feed');
?>
<?= $this->Form->create($domainFeed) ?>
<?php
echo $this->Form->control('rss_domain_id', ['options' => $rssDomains, 'empty' => '(Choose Domain)']);
echo $this->Form->control('name');
echo $this->Form->control('url');
echo $this->Form->control('description');
echo $this->Form->control('fetch_in_minutes');
?>
<?= $this->Form->button(__('Create'), ['class' => 'btn btn-primary btn-block ']) ?>
<?= $this->Form->end() ?>

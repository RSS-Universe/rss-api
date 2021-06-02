<?php
/**
 * @var AppView $this
 * @var DomainFeed $domainFeed
 * @var RssDomain[] $rssDomains
 */

use App\Model\Entity\DomainFeed;
use App\Model\Entity\RssDomain;
use App\View\AppView;

$this->extend('/Base/edit');
$this->assign('title', 'Edit Feed');
?>
<?= $this->Form->create($domainFeed) ?>
<?php
echo $this->Form->control('name');
echo $this->Form->control('url');
echo $this->Form->control('description');
echo $this->Form->control('fetch_in_minutes');
?>
<?= $this->Form->button(__('Edit'), ['class' => 'btn btn-primary btn-block ']) ?>
<?= $this->Form->end() ?>

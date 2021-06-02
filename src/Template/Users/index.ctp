<?php
/**
 * @var AppView $this
 * @var User[] $users
 */

use App\Model\Entity\User;
use App\View\AppView;

$this->extend('/Base/index');
$this->assign('show_new', false);
?>

<? $this->start('table_body') ?>
<?php foreach ($users as $user): ?>
    <tr>
        <td><?= h($user->name) ?></td>
        <td><?= h($user->created) ?></td>
    </tr>
<?php endforeach; ?>
<? $this->end() ?>
<?= $this->element('paginatedTableData', [
    'table_headers' => [
        $this->Paginator->sort('name'),
        $this->Paginator->sort('created'),
    ]
]) ?>

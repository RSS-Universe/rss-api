<?php
declare(strict_types=1);

/**
 * @var AppView $this
 * @var string $model_name
 * @var string $model_name
 * @var string|int $model_identifier
 * @var string $parent_id
 */

use App\View\AppView;

$parent_id = $parent_id ?? null;
?>
<?= $this->Form->create(null, [
    'url' => [
        'plugin' => 'Commentable',
        'controller' => 'Comments',
        'action' => 'add'
    ]
]) ?>
<?= $this->Form->hidden('model_name', ['value' => $model_name]) ?>
<?= $this->Form->hidden('model_identifier', ['value' => $model_identifier]) ?>
<?= $this->Form->hidden('parent_id', ['value' => $parent_id]) ?>

<?= $this->Form->control('comment', [
    'label' => false,
    'type' => 'textarea'
]) ?>
<?= $this->Form->button(__('Leave Comment'), ['class' => 'btn btn-primary btn-block ']) ?>
<?= $this->Form->end() ?>

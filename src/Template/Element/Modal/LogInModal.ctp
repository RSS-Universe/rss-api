<?php
declare(strict_types=1);

/**
 * @var AppView $this
 * @var string $modal_name
 */

use App\View\AppView;

$this->extend('/Element/Modal/base_modal');
$this->assign('modal_name', $modal_name);
$this->assign('title', 'Log In');
$this->assign('show_footer', true);
$this->assign('show_cancel', true);
$this->assign('close_text', 'Cancel');
?>

<? $this->assign('body_open', $this->Form->create(null, [
    'url' => [
        'plugin' => null,
        'controller' => 'Users',
        'action' => 'login'
    ]
])); ?>
<?= $this->Form->control('email', ['required' => true]) ?>
<?= $this->Form->control('password', ['required' => true]) ?>
<? $this->assign('footer_content', $this->Form->button(__('Log In'), ['class' => 'btn btn-primary'])) ?>
<? $this->assign('body_close', $this->Form->end()) ?>

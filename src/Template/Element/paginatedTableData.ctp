<?php
declare(strict_types=1);

use App\View\AppView;

/**
 * @var AppView $this
 */
$table_headers = $table_headers ?? [];
$table_body = $this->fetch('table_body')
?>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <? foreach ($table_headers as $header): ?>
                <th scope="col">
                    <?= $header ?>
                </th>
            <? endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?= $table_body ?>
        </tbody>
    </table>
</div>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('First')) ?>
        <?= $this->Paginator->prev('< ' . __('Previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('Next') . ' >') ?>
        <?= $this->Paginator->last(__('Last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
</div>

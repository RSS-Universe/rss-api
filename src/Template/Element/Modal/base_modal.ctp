<?php
declare(strict_types=1);

/**
 * @var AppView $this
 */

use App\View\AppView;

$modal_name = $this->fetch('modal_name');
$title = $this->fetch('title');
$body_open = $this->fetch('body_open', '');
$body_close = $this->fetch('body_close', '');
$show_footer = $this->fetch('show_footer', true);
$show_cancel = $this->fetch('show_cancel', true);
$close_text = $this->fetch('close_text', 'Close');
$footer_content = $this->fetch('footer_content', '');
?>

<!-- Modal -->
<div class="modal fade" id="<?=$modal_name?>" tabindex="-1" role="dialog" aria-labelledby="<?=$modal_name?>Label"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php if ($title): ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="<?=$modal_name?>Label">
                        <?= $title ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?= $body_open ?>
            <div class="modal-body">
                <?= $this->fetch('content') ?>
            </div>
            <? if ($show_footer) : ?>
                <div class="modal-footer">
                    <? if ($show_cancel) : ?>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <?= $close_text ?>
                        </button>
                    <? endif; ?>
                    <?= $footer_content ?>
                </div>
            <? endif; ?>
            <?= $body_close ?>
        </div>
    </div>
</div>

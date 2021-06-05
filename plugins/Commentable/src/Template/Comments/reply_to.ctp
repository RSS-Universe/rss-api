<?php
declare(strict_types=1);

/**
 * @var AppView $this
 * @var Comment $reply
 * @var Comment $comment
 */

use App\View\AppView;
use Commentable\Model\Entity\Comment;

$parent_id = $parent_id ?? null;
?>
<div class="container">
    <h2>
        Replying to comment by
        <?= $comment->user->name ?>
    </h2>
    <section class="container">
        <div class="row">
            <div class="float-left pr-5">
                <div class="row pb-2">
                    <?= $this->Gravatar->image($comment->user->email, [
                        'size' => 64,
                        'alt' => $comment->user->name . ' Gravatar',
                        'class' => 'img-thumbnail'
                    ]) ?>
                </div>
            </div>
            <div class="float-left">
                <div class="row">
                    <h5 class="mt-0">
                        <small>
                            commented <?= $comment->created->timeAgoInWords() ?>
                        </small>
                    </h5>
                </div>
                <section class="comment-body">
                    <?= $this->Text->autoParagraph($this->Text->stripLinks($comment->comment)) ?>
                </section>
            </div>
        </div>
        <hr/>
    </section>
    <?= $this->Form->create($reply) ?>

    <?= $this->Form->control('comment', [
        'type' => 'textarea',
        'required' => true,
    ]) ?>
    <?= $this->Form->button(__('Reply to Comment'), ['class' => 'btn btn-primary btn-block ']) ?>
    <?= $this->Form->end() ?>
</div>

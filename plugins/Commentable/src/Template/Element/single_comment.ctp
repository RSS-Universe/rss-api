<?php
declare(strict_types=1);

/**
 * @var AppView $this
 * @var Comment $comment
 */

use App\View\AppView;
use Commentable\Model\Entity\Comment;

?>
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
            <div class="row">
                <div class="btn-group mr-2 btn-group-vertical" role="group"
                     aria-label="Comment Voting Controls">
                    <button type="button" class="btn btn-success">
                        <?= $this->Html->icon('thumbs-up') ?>
                    </button>
                    <button type="button" class="btn btn-primary disabled">
                        -896
                    </button>
                    <button type="button" class="btn btn-danger">
                        <?= $this->Html->icon('thumbs-down') ?>
                    </button>
                </div>
            </div>
        </div>
        <div class="float-left">
            <div class="row">
                <h5 class="mt-0">
                    <?= $comment->user->name ?>
                    <small>
                        commented <?= $comment->created->timeAgoInWords() ?>
                    </small>
                </h5>
                <?= $this->Comment->replyButton($comment->id) ?>
            </div>
            <section class="comment-body">
                <?= $this->Text->autoParagraph($this->Text->stripLinks($comment->comment)) ?>
            </section>
            <? if ($comment->children) : ?>
                <?= $this->Comment->renderCommentsList($comment->children) ?>
            <? endif; ?>
        </div>
    </div>
    <hr/>
</section>

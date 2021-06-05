<?php
declare(strict_types=1);

/**
 * @var AppView $this
 * @var Comment[] $comments
 */

use App\View\AppView;
use Commentable\Model\Entity\Comment;

?>
<?php if ($comments): ?>
    <?php foreach ($comments as $comment): ?>
        <div class="media">
            <?= $this->Gravatar->image($comment->user->email, [
                'size' => 64,
                'alt' => $comment->user->name . ' Gravatar',
                'class' => 'mr-3'
            ]) ?>
            <div class="media-body">
                <h5 class="mt-0">
                    <?= $comment->user->name ?>
                    <small>commented <?= $comment->created->timeAgoInWords() ?></small>
                </h5>
                <p class="lead"> <?= $this->Text->autoParagraph($this->Text->stripLinks($comment->comment)) ?></p>
                <hr/>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

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
        <?= $this->element('Commentable.single_comment', compact('comment')) ?>
    <?php endforeach; ?>
<?php endif; ?>

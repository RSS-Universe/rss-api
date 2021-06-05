<?php

namespace Commentable\View\Helper;

use Cake\Core\Exception\Exception;
use Cake\ORM\ResultSet;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\View\Helper;
use Commentable\Model\Behavior\CommentableBehavior;
use Commentable\Model\Entity\Comment;

/**
 * Comment helper
 */
class CommentHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'list_element_path' => 'Commentable.bootstrap_comment_list'
    ];

    public function renderForm(string $model_name, string $model_identifier, ?string $parent_id = null): string
    {
        return $this->getView()->element(
            'Commentable.comment_form',
            compact('model_identifier', 'model_name', 'parent_id')
        );
    }

    /**
     * @param ResultSet|Comment[] $comments
     * @param string|null $element_path
     * @return string
     */
    public function renderCommentsList($comments, ?string $element_path = null): string
    {
        $element_path = $element_path ?? $this->getConfig('list_element_path');
        return $this->getView()->element($element_path, compact('comments'));
    }

    public function renderComments(
        string $model_name,
        string $model_identifier,
        ?string $element_path = null
    ): string
    {
        /** @var Table&CommentableBehavior $table */
        $table = TableRegistry::getTableLocator()->get($model_name);
        if (!$table->hasBehavior('Commentable')) {
            throw new Exception("The model '{$model_name}' does not have the 'Commentable.Commentable' behavior");
        }
        $comments = $table->getComments($model_identifier);
        return $this->renderCommentsList($comments, $element_path);
    }
}

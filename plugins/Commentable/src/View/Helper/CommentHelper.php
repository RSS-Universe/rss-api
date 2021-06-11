<?php

namespace Commentable\View\Helper;

use App\View\Helper\ModalHelper;
use BootstrapUI\View\Helper\HtmlHelper;
use Cake\Core\Exception\Exception;
use Cake\ORM\ResultSet;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\View\Helper;
use Commentable\Model\Behavior\CommentableBehavior;
use Commentable\Model\Entity\Comment;

/**
 * Comment helper
 *
 * @property Helper\UrlHelper $Url
 * @property HtmlHelper $Html
 * @property ModalHelper $Modal
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

    protected $helpers = ['Url', 'Modal', 'Html'];

    public function renderForm(string $model_name, string $model_identifier, ?string $parent_id = null): string
    {
        return $this->getView()->element(
            'Commentable.comment_form',
            compact('model_identifier', 'model_name', 'parent_id')
        );
    }

    public function renderListComments(
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
        return $this->renderComments($comments, $element_path);
    }

    /**
     * @param ResultSet|Comment[] $comments
     * @param string|null $element_path
     * @return string
     */
    public function renderComments($comments, ?string $element_path = null): string
    {
        $element_path = $element_path ?? $this->getConfig('list_element_path');
        return $this->getView()->element($element_path, compact('comments'));
    }

    public function renderThreadedComments(
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
        $comments = $table->getComments($model_identifier)->find('threaded');
        return $this->renderComments($comments, $element_path);
    }

    public function replyButton(string $comment_id): string
    {
        $uri = $this->Url->build([
            'plugin' => 'commentable',
            'controller' => 'Comments',
            'action' => 'replyTo',
            $comment_id,
            '?' => [
                'return' => (string)$this->getView()->getRequest()->getUri()
            ]
        ]);

        $title = $this->Html->icon('reply') . 'reply';
        return $this->Modal->ajaxModalLink($uri, $title, [
            'class' => 'btn btn-sm btn-primary'
        ], true);
    }

    public function upVoteLink(string $comment_id): string
    {
        return $this->voteLink($comment_id, true);
    }

    protected function voteLink(string $comment_id, bool $is_upvote): string
    {
        $uri = $this->Url->build([
            'plugin' => 'commentable',
            'controller' => 'Comments',
            'action' => $is_upvote ? 'upvote' : 'downvote',
            $comment_id,
            '?' => [
                'return' => (string)$this->getView()->getRequest()->getUri()
            ]
        ]);

        $title = $this->Html->icon($is_upvote ? 'thumbs-up' : 'thumbs-down');
        return $this->Html->link($title, $uri, [
            'class' => 'btn btn-sm btn-' . ($is_upvote ? 'success' : 'danger'),
            'escape' => false,
        ]);
    }

    public function downVoteLink(string $comment_id): string
    {
        return $this->voteLink($comment_id, false);
    }
}

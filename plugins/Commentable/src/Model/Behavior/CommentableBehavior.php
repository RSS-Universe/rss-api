<?php

namespace Commentable\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use Commentable\Model\Table\CommentsTable;

/**
 * Commentable behavior
 */
class CommentableBehavior extends Behavior
{
    /**
     * @var CommentsTable
     */
    protected $CommentsTable;

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->CommentsTable = TableRegistry::getTableLocator()->get('Commentable.Comments');
        $this->getTable()->hasMany('Commentable.Comments', [
            'foreignKey' => 'model_identifier',
            'conditions' => [
                'Comments.model_name' => $this->getTable()->getAlias()
            ]
        ]);
    }

    /**
     * @param string $id
     * @return Query
     */
    public function getComments(string $id): Query
    {
        return $this->CommentsTable
            ->find()
            ->contain('Users')
            ->orderDesc('Comments.created')
            ->where([
                'Comments.model_name' => $this->getTable()->getAlias(),
                'Comments.model_identifier' => $id,
            ]);
    }

    public function comment(string $user_id, array $data, string $foreign_id, string $comment_id = null): void
    {
        $comment = $this->CommentsTable->newEntity([
            'model_name' => $this->getTable()->getAlias(),
            'model_identifier' => $foreign_id,
            'user_id' => $user_id,
            'parent_id' => $comment_id,
            'comment' => Hash::get($data, 'comment'),
        ]);
        $this->CommentsTable->saveOrFail($comment);
    }
}

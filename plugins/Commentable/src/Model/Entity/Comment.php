<?php

namespace Commentable\Model\Entity;

use App\Model\Entity\User;
use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * Comment Entity
 *
 * @property string $id
 * @property int $user_id
 * @property string $model_name
 * @property string $model_identifier
 * @property string|null $parent_id
 * @property int|null $lft
 * @property int|null $rght
 * @property string $comment
 * @property int|null $vote_positive
 * @property int|null $vote_count
 * @property int $vote_score
 * @property FrozenTime|null $created
 * @property FrozenTime|null $modified
 *
 * @property User $user
 * @property Comment $parent_comment
 * @property CommentVote[] $comment_votes
 * @property Comment[] $child_comments
 */
class Comment extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'model_name' => true,
        'model_identifier' => true,
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'comment' => true,
        'vote_positive' => true,
        'vote_count' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'parent_comment' => true,
        'comment_votes' => true,
        'child_comments' => true,
    ];

    public function _getVoteScore(): int
    {
        $down_votes = $this->vote_count - $this->vote_positive;

        return $this->vote_positive - $down_votes;
    }
}

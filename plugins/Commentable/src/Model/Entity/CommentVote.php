<?php

namespace Commentable\Model\Entity;

use App\Model\Entity\User;
use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * CommentVote Entity
 *
 * @property string $id
 * @property int $user_id
 * @property string $comment_id
 * @property bool $is_positive
 * @property FrozenTime|null $created
 * @property FrozenTime|null $modified
 *
 * @property User $user
 * @property Comment $comment
 */
class CommentVote extends Entity
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
        'comment_id' => true,
        'is_positive' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'comment' => true,
    ];
}

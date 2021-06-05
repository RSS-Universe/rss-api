<?php

namespace Commentable\Model\Entity;

use App\Model\Entity\User;
use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * Comment Entity
 *
 * @property string $id
 * @property string $model_name
 * @property string $model_identifier
 * @property int $user_id
 * @property string|null $parent_id
 * @property int $lft
 * @property int $rght
 * @property string|null $comment
 * @property FrozenTime|null $created
 * @property FrozenTime|null $modified
 *
 * @property User $user
 * @property Comment $parent_comment
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
        'model_name' => true,
        'model_identifier' => true,
        'user_id' => true,
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'comment' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'parent_comment' => true,
        'child_comments' => true,
    ];
}

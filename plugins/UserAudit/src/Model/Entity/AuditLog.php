<?php

namespace UserAudit\Model\Entity;

use App\Model\Entity\User;
use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * AuditLog Entity
 *
 * @property string $id
 * @property int|null $user_id
 * @property string|null $session_uid
 * @property string $class_name
 * @property string $context
 * @property string $action
 * @property array|null $diff
 * @property FrozenTime|null $created
 * @property FrozenTime|null $modified
 *
 * @property User $user
 */
class AuditLog extends Entity
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
        'session_uid' => true,
        'class_name' => true,
        'context' => true,
        'action' => true,
        'diff' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];
}

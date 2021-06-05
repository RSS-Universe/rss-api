<?php

namespace App\Model\Entity;

use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * RssDomain Entity
 *
 * @property string $id
 * @property bool|null $is_active
 * @property int $user_id
 * @property string $name
 * @property string $url
 * @property string|null $description
 * @property int $feed_count
 * @property FrozenTime|null $created
 * @property FrozenTime|null $modified
 *
 * @property User $user
 * @property DomainFeed[] $domain_feeds
 */
class RssDomain extends Entity
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
        'is_active' => true,
        'user_id' => true,
        'name' => true,
        'url' => true,
        'description' => true,
        'feed_count' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'domain_feeds' => true,
    ];

    public function _getIsActive($is_active):bool
    {
        return !!$is_active;
    }
}

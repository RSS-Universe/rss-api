<?php

namespace App\Model\Entity;

use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * DomainFeed Entity
 *
 * @property string $id
 * @property string $rss_domain_id
 * @property int $user_id
 * @property string $name
 * @property string $url
 * @property string|null $description
 * @property int $items_count
 * @property int $fetch_in_minutes
 * @property bool|null $is_active
 * @property FrozenTime|null $last_fetch
 * @property FrozenTime|null $created
 * @property FrozenTime|null $modified
 *
 * @property RssDomain $rss_domain
 * @property User $user
 * @property FeedItem[] $feed_items
 */
class DomainFeed extends Entity
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
        'rss_domain_id' => true,
        'user_id' => true,
        'name' => true,
        'url' => true,
        'description' => true,
        'items_count' => true,
        'fetch_in_minutes' => true,
        'is_active' => true,
        'last_fetch' => true,
        'created' => true,
        'modified' => true,
        'rss_domain' => true,
        'user' => true,
        'feed_items' => true,
    ];
}

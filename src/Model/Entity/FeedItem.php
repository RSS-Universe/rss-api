<?php

namespace App\Model\Entity;

use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * FeedItem Entity
 *
 * @property string $id
 * @property string $domain_feed_id
 * @property string|null $creator_id
 * @property string $title
 * @property string $url
 * @property string|null $description
 * @property FrozenTime $published
 * @property FrozenTime|null $created
 * @property FrozenTime|null $modified
 *
 * @property DomainFeed $domain_feed
 * @property Creator $creator
 * @property Category[] $categories
 */
class FeedItem extends Entity
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
        'domain_feed_id' => true,
        'creator_id' => true,
        'title' => true,
        'url' => true,
        'description' => true,
        'published' => true,
        'created' => true,
        'modified' => true,
        'domain_feed' => true,
        'creator' => true,
        'categories' => true,
    ];
}

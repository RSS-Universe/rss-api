<?php

namespace App\Model\Entity;

use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * Category Entity
 *
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property FrozenTime|null $created
 * @property FrozenTime|null $modified
 *
 * @property FeedItem[] $feed_items
 */
class Category extends Entity
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
        'name' => true,
        'slug' => true,
        'created' => true,
        'modified' => true,
        'feed_items' => true,
    ];
}

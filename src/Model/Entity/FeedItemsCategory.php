<?php

namespace App\Model\Entity;

use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * FeedItemsCategory Entity
 *
 * @property int $id
 * @property string $feed_item_id
 * @property string $category_id
 * @property FrozenTime|null $created
 * @property FrozenTime|null $modified
 *
 * @property FeedItem $feed_item
 * @property Category $category
 */
class FeedItemsCategory extends Entity
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
        'feed_item_id' => true,
        'category_id' => true,
        'created' => true,
        'modified' => true,
        'feed_item' => true,
        'category' => true,
    ];
}

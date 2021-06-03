<?php

namespace App\Model\Entity;

use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * RssDomain Entity
 *
 * @property string $id
 * @property string $name
 * @property string $url
 * @property string|null $description
 * @property int $feed_count
 * @property FrozenTime|null $created
 * @property FrozenTime|null $modified
 *
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
        'name' => true,
        'url' => true,
        'description' => true,
        'feed_count' => true,
        'created' => true,
        'modified' => true,
        'domain_feeds' => true,
    ];
}

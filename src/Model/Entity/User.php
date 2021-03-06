<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $password
 * @property bool $is_admin
 * @property bool $is_active
 * @property bool $is_email_verified
 * @property string|null $email_verification_code
 * @property FrozenTime|null $created
 * @property FrozenTime|null $modified
 * @property DomainFeed[] $domain_feeds
 * @property RssDomain[] $rss_domains
 */
class User extends Entity
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
        'email' => true,
        'password' => true,
        'is_admin' => true,
        'is_active' => true,
        'is_email_verified' => true,
        'email_verification_code' => true,
        'created' => true,
        'modified' => true,
        'domain_feeds' => true,
        'rss_domains' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    protected function _setPassword($value)
    {
        if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();

            return $hasher->hash($value);
        }
    }
}

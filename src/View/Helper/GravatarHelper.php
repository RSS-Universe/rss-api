<?php

namespace App\View\Helper;

use Cake\Utility\Hash;
use Cake\View\Helper;

/**
 * Gravatar helper
 *
 * @property Helper\HtmlHelper $Html
 */
class GravatarHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'size' => 80,
        'base_url' => 'https://www.gravatar.com/avatar/',
        'default_image' => 'https://www.axiumradonmitigations.com/wp-content/uploads/2015/01/icon-user-default.png'
    ];

    protected $helpers = ['Html'];

    public function image(string $email, array $options = []): string
    {
        $path = $this->url($email, $options);
        $size = Hash::get($options, 'size', $this->getConfig('size'));

        return $this->Html->image($path, array_merge([
            'width' => $size,
            'height' => $size,
        ], $options));
    }

    public function url(string $email, array $options = []): string
    {
        $hash = md5(strtolower(trim($email)));
        $size = Hash::get($options, 'size', $this->getConfig('size'));

        $query = '?' . http_build_query([
                's' => $size
            ]);
        return implode('', [
            $this->getConfig('base_url'),
            $hash,
            $query
        ]);
    }
}

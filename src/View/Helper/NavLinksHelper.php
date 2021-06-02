<?php

namespace App\View\Helper;

use Cake\View\Helper;

/**
 * NavLinks helper
 *
 * @property Helper\HtmlHelper $Html
 * @property Helper\UrlHelper $Url
 */
class NavLinksHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    protected $helpers = ['Html', 'Url'];

    /**
     * @param string $title
     * @param null|array|string $url
     * @return string
     */
    public function link(string $title, $url = null): string
    {
        $is_active = $this->getView()->getRequest()->getRequestTarget() === $this->Url->build($url);
        $title = $is_active ? $title . ' <span class="sr-only">(current)</span>' : $title;
        $li_class = $is_active ? 'nav-link active' : 'nav-link';
        $link = $this->Html->link($title, $url, ['class' => $li_class, 'escape' => false]);
        return $this->Html->tag('li', $link, ['class' => 'nav-item']);
    }
}

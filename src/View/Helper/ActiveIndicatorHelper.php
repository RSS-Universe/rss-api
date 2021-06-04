<?php

namespace App\View\Helper;

use BootstrapUI\View\Helper\HtmlHelper;
use Cake\View\Helper;

/**
 * ActiveIndicator helper
 *
 * @property HtmlHelper $Html
 */
class ActiveIndicatorHelper extends Helper
{
    protected $helpers = ['Html'];

    public function render(bool $is_active): string
    {
        $name = 'times-circle';
        $color = 'text-danger';
        if ($is_active) {
            $name = 'check-circle';
            $color = 'text-success';
        }
        return $this->Html->para(
            $color . ' d-inline',
            $this->Html->icon($name, ['iconSet' => 'far'])
        );
    }
}

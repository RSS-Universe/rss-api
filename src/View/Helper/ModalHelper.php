<?php

namespace App\View\Helper;

use Cake\Core\Exception\Exception;
use Cake\View\Helper;

/**
 * Modal helper
 * @property Helper\HtmlHelper $Html
 * @property Helper\FormHelper $Form
 */
class ModalHelper extends Helper
{
    protected $helpers = ['Form'];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'registered_modals' => [
            'LogInModal',
        ]
    ];

    /**
     * @param string $modal_name
     * @throws Exception
     */
    protected function ensureModalNameValidity(string $modal_name): void
    {
        $registered_modals = $this->getConfig('registered_modals');
        if (!in_array($modal_name, $registered_modals)) {
            throw new Exception("The modal id '${modal_name}' is not in the list of registered modals");
        }
    }

    public function load(string $modal_name): string
    {
        $this->ensureModalNameValidity($modal_name);

        return $this->getView()->element('Modal/' . $modal_name, compact('modal_name'));
    }

    public function toggleLink(string $modal_name, $title, array $options = []): string
    {
        $this->ensureModalNameValidity($modal_name);

        $options['type'] = 'button';
        $options['data-toggle'] = 'modal';
        $options['data-target'] = "#${modal_name}";
        return $this->Form->button($title, $options);
    }

    public function loadAjax():string
    {
        $this->getView()->Html->script('ajaxModal', ['block' => 'script']);
        return $this->getView()->element('Modal/ajax_modal');

    }

    public function ajaxModalLink(string $uri, $title, array $options = []): string
    {
        $options['type'] = 'button';
        $options['data-role'] = 'ajaxOpener';
        $options['data-uri'] = $uri;
        return $this->Form->button($title, $options);
    }
}

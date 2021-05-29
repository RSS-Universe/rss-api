<?php

namespace App\View\Helper;

use Cake\View\Helper;

/**
 * Auth helper
 */
class AuthHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function isLoggedIn(): bool
    {
        return $this->getView()->getRequest()->getSession()->read('Auth.User.id') !== null;

    }
}

<?php

namespace App\View\Helper;

use App\Model\Entity\User;
use Cake\Utility\Security;
use Cake\View\Helper;

/**
 * Auth helper
 *
 * @property Helper\HtmlHelper $Html
 * @property Helper\UrlHelper $Url
 */
class AuthHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    protected $helpers = ['Html', 'Url'];

    public function isLoggedIn(): bool
    {
        return $this->getView()->getRequest()->getSession()->read('Auth.User.id') !== null;
    }

    public function emailVerificationLink(User $user, string $title, array $options = []): string
    {
        $url = $this->emailVerificationUrl($user);
        return $this->Html->link($title, $url, $options);
    }

    public function emailVerificationUrl(User $user): string
    {
        return $this->Url->build([
            'controller' => 'users',
            'action' => 'email-verify',
            "?" => [
                'token' => Security::encrypt($user->email_verification_code, $user->email . Security::getSalt()),
                'id' => $user->id,
            ],
        ], [
            'escape' => false,
            'fullBase' => true,
        ]);
    }
}

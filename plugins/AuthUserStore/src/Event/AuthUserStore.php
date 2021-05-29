<?php
declare(strict_types=1);

namespace AuthUserStore\Event;

use App\Controller\AppController;
use App\Model\Entity\User;
use Cake\Event\Event;
use Cake\Event\EventListenerInterface;

/**
 * Class AuthUserStore
 * @package AuthUserStore\Event
 */
class AuthUserStore implements EventListenerInterface
{
    /**
     * @var User|null
     */
    protected static $user;

    public function implementedEvents(): array
    {
        return [
            'Authentication.afterIdentify' => 'authAfterIdentify',
            'Controller.initialize' => 'controllerInitialize',
        ];
    }

    public function authAfterIdentify(Event $event): void
    {
        /** @var User|null $user */
        $user = $event->getData('identity');
        self::$user = $user;
    }

    public function controllerInitialize(Event $event): void
    {
        /** @var AppController $controller */
        $controller = $event->getSubject();
        if ($controller->components()->has('Authentication')) {
            /** @var User|null $user */
            $user = $controller->Authentication->getIdentity();
            self::setUser($user);
        }

        if ($controller->components()->has('Auth')) {
            /** @var User|null $user */
            $user = $controller->Auth->user();
            self::setUser($user);
        }
    }

    public static function setUser($user): void
    {
        self::$user = is_array($user)
            ? new User($user)
            : $user;
    }

    /**
     * @return User|null
     */
    public static function getUser(): ?User
    {
        return self::$user;
    }
}

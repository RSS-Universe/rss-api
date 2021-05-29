<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\Entity\User;
use Cake\Mailer\Email;

/**
 * Class EmailSendingService
 * @package App\Service
 */
class EmailSendingService
{
    use SingletonTrait;

    public function registrationEmail(User $user)
    {
        $email = new Email('registration');
        $email->setTo($user->email, $user->name)
            ->setViewVars(compact('user'))
            ->send();
    }
}

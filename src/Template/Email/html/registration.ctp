<?php
/**
 * @var AppView $this
 * @var User $user
 */

use App\Model\Entity\User;
use App\View\AppView;

?>
Dear <?= $user->name ?>,
Thank you for registering. Please <?= $this->Auth->emailVerificationLink($user, 'click here') ?> to finish your registration.

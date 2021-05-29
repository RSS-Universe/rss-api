<?php
/**
 * @var AppView $this
 * @var User $user
 */

use App\Model\Entity\User;
use App\View\AppView;

?>
Dear <?= $user->name ?>,
Thank you for registering. Please go to <?= $this->Auth->emailVerificationUrl($user) ?> to finish your registration.

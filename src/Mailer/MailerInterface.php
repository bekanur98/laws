<?php

namespace App\Mailer;

use App\Entity\User;

/**
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 */
interface MailerInterface
{
    /**
     * Send an email to a user to confirm the account creation
     *
     * @param User $user
     *
     * @return void
     */
    public function sendConfirmationEmailMessage(User $user);

    /**
     * Send an email to a user to confirm the password reset
     *
     * @param User $user
     *
     * @return void
     */
    public function sendResettingEmailMessage(User $user);
}

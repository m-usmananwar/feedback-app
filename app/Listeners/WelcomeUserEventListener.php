<?php

namespace App\Listeners;

use App\Notifications\WelcomeUserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class WelcomeUserEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user = $event->user;

        $data = [
            "message" => "We are thrilled to have you as a member. Our team is dedicated to providing you with the best experience possible. If you have any questions, feel free to reach out to us.",
            "subject" => "Account created successfully",
        ];

        Notification::send($user, new WelcomeUserNotification($user, $data));
    }
}

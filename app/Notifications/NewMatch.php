<?php
// app/Notifications/NewMatch.php

namespace App\Notifications;

use App\Models\Member;
use Illuminate\Notifications\Notification;

class NewMatch extends Notification
{
    public function __construct(public Member $a, public Member $b)
    {
    }

    public function via($notifiable)
    {
        return ['database']; // Menyimpan di database untuk tampil di UI
    }

    public function toDatabase($notifiable)
    {
        $partner = ($notifiable->id === $this->a->user_id) ? $this->b : $this->a;

        return [
            'title'     => 'It\'s a match!',
            'message'   => 'You and ' . $partner->user->name . ' have liked each other.',
            'partner_id' => $partner->id,
        ];
    }
}

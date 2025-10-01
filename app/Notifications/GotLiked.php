<?php
// app/Notifications/GotLiked.php

namespace App\Notifications;

use App\Models\Member;
use Illuminate\Notifications\Notification;

class GotLiked extends Notification
{
    public function __construct(public Member $from)
    {
    }

    public function via($notifiable)
    {
        return ['database']; // Menyimpan di database untuk tampil di UI
    }

    public function toDatabase($notifiable)
    {
        return [
            'title'   => 'You got a like!',
            'message' => $this->from->user->name . ' has liked your profile.',
            'from_id' => $this->from->id,
        ];
    }
}

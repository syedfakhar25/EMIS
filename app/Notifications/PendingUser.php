<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Spatie\Activitylog\Traits\LogsActivity;

class PendingUser extends Notification
{
    use Queueable, LogsActivity;

    protected $usr;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $x)
    {
        $this->usr = $x;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {

        return ['database'];
    }



    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($user)
    {
        return [
            'data' => 'new user register verification pending',
            'user_id' => $this->usr->id,
            'user_name' => $this->usr->first_name . ' ' . $this->usr->middle_name . ' ' . $this->usr->last_name,
            'dep_name' => $this->usr->department->dep_name,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

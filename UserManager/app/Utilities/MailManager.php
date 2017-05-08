<?php

namespace App\Utilities;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MailManager extends Notification implements ShouldQueue {
    use Queueable;

    protected $token;

    /**
     * Create a new notification instance.
     *
     * SendActivationEmail constructor.
     * @param $token
     */
    public function __construct($token) {
        $this->token = $token;
        $this->onQueue('social');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        $message = new MailMessage;
        $message->subject('Activation required')
            ->from('usermanagerlaravel@gmail.com', 'UserManagerLaravel')
            ->greeting('Welcome dear Humam!')
            ->line('You need to activate your email before you can start using all of our services.')
            ->action('Activate', route('authenticated.activate', ['token' => $this->token]))
            ->line('Love you for using our application!');

        return ($message);

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
            //
        ];
    }
}

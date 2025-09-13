<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Application;
use Illuminate\Notifications\Messages\MailMessage;

class ApplicationStatusChanged extends Notification {
    use Queueable;

    protected $application;

    public function __construct(Application $application) {
        $this->application = $application;
    }

    public function via($notifiable) {
        return ['mail','database'];
    }

    public function toMail($notifiable) {
        return (new MailMessage)
            ->subject('Application Status Updated')
            ->line("Your application for \"{$this->application->tender->title}\" is now {$this->application->status}.")
            ->action('View Dashboard', url(route('dashboard')))
            ->line('Thank you.');
    }

    public function toArray($notifiable) {
        return [
            'application_id'=>$this->application->id,
            'status'=>$this->application->status,
            'tender_title'=>$this->application->tender->title
        ];
    }
}

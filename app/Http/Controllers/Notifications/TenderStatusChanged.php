<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Tender;
use Illuminate\Notifications\Messages\MailMessage;

class TenderStatusChanged extends Notification {
    use Queueable;

    protected $tender;

    public function __construct(Tender $tender) {
        $this->tender = $tender;
    }

    public function via($notifiable) {
        return ['mail','database'];
    }

    public function toMail($notifiable) {
        $status = ucfirst($this->tender->status);
        return (new MailMessage)
            ->subject("Tender {$status}: {$this->tender->title}")
            ->line("Your tender \"{$this->tender->title}\" has been {$this->tender->status}.")
            ->action('View Tender', url(route('tenders.show', $this->tender->id)))
            ->line('Thank you for using the Tender Management System.');
    }

    public function toArray($notifiable) {
        return [
            'tender_id' => $this->tender->id,
            'title' => $this->tender->title,
            'status' => $this->tender->status
        ];
    }
}

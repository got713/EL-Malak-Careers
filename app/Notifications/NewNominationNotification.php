<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewNominationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $jobId;
    protected $jobTitle;
    protected $count;

    public function __construct($jobId, $jobTitle, $count)
    {
        $this->jobId = $jobId;
        $this->jobTitle = $jobTitle;
        $this->count = $count;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'new_nomination',
            'job_id' => $this->jobId,
            'message' => "الإدارة قامت بترشيح {$this->count} كفاءات جديدة لوظيفة {$this->jobTitle}.",
            'link' => route('company.jobs.show', $this->jobId)
        ];
    }
}

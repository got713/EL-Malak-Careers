<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompanyFeedbackNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $jobId;
    protected $companyName;
    protected $candidateName;
    protected $status;

    public function __construct($jobId, $companyName, $candidateName, $status)
    {
        $this->jobId = $jobId;
        $this->companyName = $companyName;
        $this->candidateName = $candidateName;
        $this->status = $status;
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

    public function toDatabase(object $notifiable): array
    {
        $statusText = $this->status === 'accepted' ? 'قبول' : 'رفض';
        return [
            'type' => 'company_feedback',
            'job_id' => $this->jobId,
            'message' => "قامت شركة {$this->companyName} بـ {$statusText} المرشح {$this->candidateName}.",
            'link' => route('admin.jobs.show', $this->jobId)
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

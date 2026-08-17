<?php

namespace App\Notifications;

use App\Models\Interview;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InterviewScheduledNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected Interview $interview;
    protected string $jobTitle;
    protected string $companyName;

    public function __construct(Interview $interview, string $jobTitle, string $companyName)
    {
        $this->interview = $interview;
        $this->jobTitle = $jobTitle;
        $this->companyName = $companyName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $isOnline = $this->interview->type === 'online';

        $mail = (new MailMessage)
            ->subject(__('Interview Scheduled — :job', ['job' => $this->jobTitle]))
            ->greeting(__('Hello :name,', ['name' => $notifiable->first_name ?? $notifiable->name]))
            ->line(__('Great news! :company would like to invite you for an interview for the :job position.', [
                'company' => $this->companyName,
                'job' => $this->jobTitle,
            ]))
            ->line(__('Date & Time: :datetime', ['datetime' => $this->interview->scheduled_at->translatedFormat('l, d F Y — h:i A')]))
            ->line($isOnline
                ? __('Type: Online Interview')
                : __('Type: In-Person Interview'));

        if ($isOnline) {
            $mail->line(__('Meeting Link: :link', ['link' => $this->interview->location_link]));
        } else {
            $mail->line(__('Location: :location', ['location' => $this->interview->location_link]));
        }

        if ($this->interview->notes) {
            $mail->line(__('Additional Notes: :notes', ['notes' => $this->interview->notes]));
        }

        return $mail
            ->action(__('View Details'), route('dashboard'))
            ->line(__('Please make sure to be available on time. Good luck!'));
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'interview_scheduled',
            'job_id' => $this->interview->application->job_posting_id ?? null,
            'message' => __('An interview has been scheduled for you for the :job position at :company.', [
                'job' => $this->jobTitle,
                'company' => $this->companyName,
            ]),
            'link' => route('dashboard'),
        ];
    }
}

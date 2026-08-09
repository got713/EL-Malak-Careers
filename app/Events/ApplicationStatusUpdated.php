<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $applicationId;
    public $status;
    public $jobId;

    public function __construct($applicationId, $status, $jobId)
    {
        $this->applicationId = $applicationId;
        $this->status = $status;
        $this->jobId = $jobId;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('job.' . $this->jobId),
        ];
    }
    
    public function broadcastAs(): string
    {
        return 'ApplicationStatusUpdated';
    }
}

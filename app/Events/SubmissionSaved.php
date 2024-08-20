<?php

namespace App\Events;

use App\DTO\SubmissionDTO;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SubmissionSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $submission;



    public function __construct(SubmissionDTO $submissionDTO)
    {
        $this->submissionDTO = $submissionDTO;
    }

    public function broadcastOn()
    {
        return new Channel('submissions');
    }
}

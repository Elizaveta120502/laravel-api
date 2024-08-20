<?php

namespace App\Jobs;

use App\DTO\SubmissionDTO;
use App\Events\SubmissionSaved;
use App\Models\Submission;
use App\Services\SubmissionService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessSubmission implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public SubmissionDTO $submissionDTO;

    public function __construct(SubmissionDTO $submissionDTO)
    {
        $this->submissionDTO = $submissionDTO;
    }

    public function handle(SubmissionService $service)
    {
       $service->save($this->submissionDTO);
    }
}

<?php

namespace App\Listeners;

use App\Events\SubmissionSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogSubmissionSaved
{
    /**
     * Create the event listener.
     */

    public function handle(SubmissionSaved $event)
    {
        Log::info('Submission saved: ' . $event->submission->name . ' (' . $event->submission->email . ')');
    }
}

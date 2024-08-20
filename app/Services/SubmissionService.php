<?php

namespace App\Services;

use App\DTO\SubmissionDTO;
use App\Events\SubmissionSaved;
use App\Models\Submission;
use Illuminate\Support\Facades\Log;

class SubmissionService
{
    public function save(SubmissionDTO $dto)
    {
        try {
            $submission = Submission::create([
                'name' => $dto->name,
                'email' => $dto->email,
                'message' => $dto->message,
            ]);

            event(new SubmissionSaved($dto));

        } catch (\Exception $e) {
            Log::error('Failed to save submission: ' . $e->getMessage());
            throw $e;
        }
    }
}

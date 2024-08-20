<?php

namespace App\Http\Controllers;

use App\DTO\SubmissionDTO;
use App\Jobs\ProcessSubmission;
use Illuminate\Http\Request;

class SubmitController extends Controller
{
    public function submit(Request $request)
    {
        $dto = new SubmissionDTO($request->all());

        ProcessSubmission::dispatch($dto);

        return response()->json(['message' => 'Submission received!'], 200);
    }
}

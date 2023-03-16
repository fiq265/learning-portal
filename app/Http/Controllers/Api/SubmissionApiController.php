<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SubmissionAssignmentRequest;
use App\Http\Requests\SubmissionByAssigmentRequest;
use App\Http\Requests\SubmissionByAssigmentAndUserRequest;
use App\Http\Controllers\Controller;
use App\Services\SubmissionService;
use Illuminate\Http\Request;

class SubmissionApiController extends ApiController
{
    protected $submission;

    function __construct(SubmissionService $submission)
    {
        $this->submission = $submission;
    }

    public function index(SubmissionByAssigmentRequest $request)
    {
        $result = $this->submission->submissionList($request->validated());

        return $this->formatResponse($result);
    }

    public function store(SubmissionAssignmentRequest $request)
    {
        $result = $this->submission->submitAssignment($request->validated());

        return $this->formatResponse($result);
    }

    public function listByStudent(SubmissionByAssigmentAndUserRequest $request)
    {
        $result = $this->submission->submissionListByStudent($request->validated());

        return $this->formatResponse($result);
    }
}

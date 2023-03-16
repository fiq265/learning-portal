<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StudentGetAssignmentRequest;
use App\Http\Requests\GetAllAssignmentRequest;
use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use App\Http\Requests\DeleteAssignmentRequest;
use App\Http\Requests\AssignAssignmentRequest;
use App\Http\Controllers\Controller;
use App\Services\AssignmentService;
use Illuminate\Http\Request;

class AssignmentApiController extends ApiController
{
    protected $assignment;

    function __construct(AssignmentService $assignment)
    {
        $this->assignment = $assignment;
    }

    public function index(GetAllAssignmentRequest $request)
    {
        $result = $this->assignment->getAssignment($request->validated());

        return $this->formatResponse($result);
    }

    public function store(StoreAssignmentRequest $request)
    {
        $result = $this->assignment->createAssignment($request->validated());

        return $this->formatResponse($result);
    }

    public function update($id, UpdateAssignmentRequest $request)
    {
        $result = $this->assignment->updateAssignment($id, $request->validated());

        return $this->formatResponse($result);
    }

    public function destroy(DeleteAssignmentRequest $request)
    {
        $result = $this->assignment->deleteAssignment($request->validated());

        return $this->formatResponse($result);
    }

    public function assign(AssignAssignmentRequest $request)
    {
        $result = $this->assignment->assignAssignment($request->validated());

        return $this->formatResponse($result);
    }

    public function studentAssignment(StudentGetAssignmentRequest $request)
    {
        $result = $this->assignment->getStudentAssignment($request->validated());

        return $this->formatResponse($result);
    }

}

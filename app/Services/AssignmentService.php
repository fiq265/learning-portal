<?php

namespace App\Services;

use App\Models\Assignment;
use App\Models\FileUpload;
use App\Models\AssignmentUser;
use Carbon\Carbon;
use Exception;
use Auth;
use DB;

class AssignmentService extends GeneralService
{
	public function getAssignment($data){
		try {

            $assignments = Assignment::with('image')->where('user_id', $data['user_id'])->get();

            $results = [
                'count' => $assignments->count(),
                'data' => $this->toArray($assignments->toArray())
            ];

            if(!empty($results)){

                return $this->response(
                    200,
                    'Assignment successfully retrived.',
                    $results
                );

            }else{

                return $this->response(
                    404,
                    'Record not available.'
                );

            }

		} catch (Exception $e) {
            return $this->response(
                500,
                'Unexpected error occured.'
            );

        }
	}

    public function toArray($results)
    {
        $data = [];

        foreach($results as $key => $result)
        {   
            $image = null;

            if(!empty($result['image'])){
                $image = FileUpload::retrieveFile($result['image'][0]['path']);
            }

            $data[$key] = [
                'id'        => $result['id'],
                'title'     => ucwords($result['title']),
                'deadline'  => Carbon::parse($result['deadline'])->format('d/m/Y h:i A'),
                'file'      => $image
            ];
        }
        
        return $data;
    }

    public function createAssignment($data){
        try {

            DB::beginTransaction();

            $assignment = Assignment::create([
                'title'         => $data['title'],
                'description'   => $data['description'],
                'deadline'      => $data['deadline'],
                'user_id'       => Auth::user()->id
            ]);

            $attachment = $data['attachment'];
            
            if(isset($attachment)){
                $file = FileUpload::upload($attachment, 'uploads/assignment');
                    
                $file->model_id = $assignment->id;
                $file->model = 'App\Models\Assignment';
                $file->save();
            }

            DB::commit();

            return $this->response(
                200,
                'Assignment successfully created.'
            );

        } catch (Exception $e) {

            DB::rollBack();

            return $this->response(
                500,
                'Unexpected error occured.'
            );

        }
    }

    public function updateAssignment($id, $data){
        try {

            DB::beginTransaction();

            $assignment = Assignment::findOrFail($id);

            if(!empty($assignment)){
                $assignment->title          = $data['title'];
                $assignment->description    = $data['description'];
                $assignment->deadline       = $data['deadline'];
                $assignment->save();
            }

            DB::commit();

            return $this->response(
                200,
                'Assignment successfully updated.'
            );

        } catch (Exception $e) {

            DB::rollBack();

            return $this->response(
                500,
                'Unexpected error occured.'
            );

        }
    }

    public function deleteAssignment($data){
        try {

            DB::beginTransaction();

            $assignment = Assignment::findOrFail($data['assignment_id']);

            if(!empty($assignment)){

                AssignmentUser::where('assignment_id', $assignment->id)->delete();

                $assignment->delete();
            }

            DB::commit();

            return $this->response(
                200,
                'Assignment successfully deleted.'
            );

        } catch (Exception $e) {

            DB::rollBack();

            return $this->response(
                500,
                'Unexpected error occured.'
            );

        }
    }

    public function assignAssignment($data){
        try {

            DB::beginTransaction();

            $assignment = Assignment::find($data['assignment_id']);

            if(!empty($assignment) && count($data['user_id']) > 1){

                foreach($data['user_id'] as $user){
                    $assignment->user()->attach($user);
                }

            }else if(!empty($assignment) && count($data['user_id']) == 1){
                $assignment->user()->attach($data['user_id'][0]);
            }

            DB::commit();

            return $this->response(
                200,
                'User successfully assigned.'
            );

        } catch (Exception $e) {

            DB::rollBack();

            return $this->response(
                500,
                'Unexpected error occured.'
            );

        }
    }

    public function getStudentAssignment($data){
        try {

            DB::beginTransaction();

            $student_assignment = AssignmentUser::where('user_id', $data['user_id'])->pluck('assignment_id');
            
            if(!empty($student_assignment)){

                $assignments = Assignment::with('image')->whereIn('id', $student_assignment)->get();

            }

            $results = [
                'count' => $assignments->count(),
                'data' => $this->toArrayStudentAssignment($assignments->toArray())
            ];

            DB::commit();

            return $this->response(
                200,
                'User successfully assigned.',
                $results
            );

        } catch (Exception $e) {

            DB::rollBack();

            return $this->response(
                500,
                'Unexpected error occured.'
            );

        }
    }

    public function toArrayStudentAssignment($results)
    {
        $data = [];

        foreach($results as $key => $result)
        {   
            $image = null;

            if(!empty($result['image'])){
                $image = FileUpload::retrieveFile($result['image'][0]['path']);
            }

            $data[$key] = [
                'id'            => $result['id'],
                'title'         => ucwords($result['title']),
                'description'   => $result['description'],
                'deadline'      => $result['deadline'],
                'file'          => url('/') . $image
            ];
        }
        
        return $data;
    }

}
<?php

namespace App\Services;

use Spatie\Permission\Models\Permission;
use App\Models\Submission;
use App\Models\FileUpload;
use Carbon\Carbon;
use Exception;
use Auth;
use DB;

class SubmissionService extends GeneralService
{
    public function submissionList($data){
        try {

            $submissions = Submission::with('image')->where('assignment_id', $data['assignment_id'])->get();

            $results = [
                'count' => $submissions->count(),
                'data' => $this->toArray($submissions->toArray())
            ];

            if(!empty($results)){

                return $this->response(
                    200,
                    'Submission successfully retrived.',
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

    public function submissionListByStudent($data){
        try {

            $submissions = Submission::with('image')->where('assignment_id', $data['assignment_id'])->where('user_id', $data['user_id'])->get();

            $results = [
                'count' => $submissions->count(),
                'data' => $this->toArray($submissions->toArray())
            ];

            if(!empty($results)){

                return $this->response(
                    200,
                    'Submission successfully retrived.',
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
                'id'                => $result['id'],
                'notes'             => $result['notes'],
                'submitted_date'    => Carbon::parse($result['created_at'])->format('d/m/Y h:i A'),
                'file'              => url('/') . $image
            ];
        }
        
        return $data;
    }

	public function submitAssignment($data){
		try {

            DB::beginTransaction();

			$submission = Submission::create([
					'notes'			         => $data['notes'],
	                'assignment_id'          => $data['assignment_id'],
	                'user_id'                => Auth::user()->id,
	            ]);

			$attachment = $data['attachment'];
            
            if(isset($attachment)){
                $file = FileUpload::upload($attachment, 'uploads/submission');
                    
                $file->model_id = $submission->id;
                $file->model = 'App\Models\Submission';
                $file->save();
            }

            DB::commit();

            return $this->response(
                200,
                'Assignment successfully submitted.'
            );

		} catch (Exception $e) {

            DB::rollBack();

            return $this->response(
                    500,
                    'Unexpected error occured.'
                );

        }
	}
}
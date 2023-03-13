<?php

namespace App\Services;

use Spatie\Permission\Models\Permission;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Auth;
use DB;

class AuthService extends GeneralService
{
	public function register($data){
		try {

            DB::beginTransaction();

			$username_repetition_check = User::where('username', $data['username'])->first();

			if(!empty($username_repetition_check)){

				return $this->response(
                    500,
                    'Username already registered in this system.'
                );

			}

			$results = User::create([
					'username'			=> $data['username'],
	                'name'              => $data['name'],
	                'email'             => $data['email'],
	                'password'          => bcrypt($data['password']),
	                'is_active'         => true
	            ]);

			$results->assignRole(strtolower($data['role']));

            DB::commit();

            return $this->response(
                200,
                'User successfully registered.'
            );

		} catch (Exception $e) {

            DB::rollBack();

            return $this->response(
                    500,
                    'Unexpected error occured.'
                );

        }
	}

	public function login($data){
		try {

            if(!Auth::attempt($data)){
                return $this->response(
                    422,
                    'Username and password does not match with our record.'
                );
            }

            $user = User::where('username', $data['username'])->first();

            $results = [
                'email' => $user->username,
            	'name'	=> $user->name,
            	'token'	=> $user->createToken($data['username'])->plainTextToken
            ];

            if (!empty($results)) {
                return $this->response(
                    200,
                    'User successfully logged in.',
                    $results
                );
            }else {
                return $this->response(
                    500,
                    'Record Unavailable.'
                );
            }

        } catch (Exception $e) {

            return $this->response(
                    500,
                    'Unexpected error occured.'
                );

        }
	}
}
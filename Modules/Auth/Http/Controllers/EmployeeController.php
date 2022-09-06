<?php

namespace Modules\Auth\Http\Controllers;

use Modules\Mysql\Entities\Employee;
use JWTAuth;
use Illuminate\Http\Request;
use Modules\Auth\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Response;
use Modules\Auth\Http\Requests\Employee\RegisterPostRequest;
use Modules\Mysql\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;

class EmployeeController extends BaseController
{

    /**
    * Modules\Mysql\Repositories\EmployeeRepository
    */
    private $employeeRepo;

    public function __construct(
        EmployeeRepository $employeeRepository
    ) {
        $this->employeeRepo = $employeeRepository;
    }

    /**
     * If authenticate a user, provide jwt token 
     * @param Illuminate\Http\Request $request;
     * @return json
     */
    public function authenticate(Request $request){

        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'code' => Response::HTTP_UNAUTHORIZED,
                    'message' => __('auth::messages.invalid_credentials')
                ]);
            }

        } catch (JWTException $e) {
            return response()->json([
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => __('auth::messages.could_not_create_token')
            ]);
        }
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => __('auth::messages.success'),
            'token' => $token,
        ]);
    }

    /**
     * Register a user
     * @param Illuminate\Http\Request $request;
     * @return json
     */
    public function register(RegisterPostRequest $request){
        $user = $this->employeeRepo->store([
            'code' => $request->get('code'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        
        $token = JWTAuth::fromUser($user);
        $update = $this->employeeRepo->update($user['id'], [
            'web_token' => $token
        ]);
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => __('auth::messages.success'),
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * Get user's information
     * @param Illuminate\Http\Request $request;
     * @return json
     */
    public function getAuthenticatedUser(){
        try {
            if ($user = JWTAuth::parseToken()->authenticate()) {
                return response()->json([
                    'code' => Response::HTTP_OK,
                    'message' => __('auth::messages.success'),
                    'user' => $user,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'code' => Response::HTTP_UNAUTHORIZED,
                'message' => $e->getMessage()
            ]);
        }
        return response()->json([
            'code' => Response::HTTP_NOT_FOUND,
            'message' => __('auth::messages.user_not_found')
        ]);
    }

}
<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Responses\Response;


class AuthController extends Controller
{
    private UserService $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService= $userService;
    }

    public function login(Request $request)
    {
        $data= [];
        try{
            $data = $this->userService->login($request);
            return Response::Success($data['user'], $data['message']);
        }catch(\Throwable $th){
            $message= $th->getMessage();
            return Response::Error($data,$message);
        }
    }
 

    public function s(){
         
        return auth()->user()->role->name;
    }

    public function register(UserStoreRequest $request)
    {
        $data= [];
        try{
            $data = $this->userService->register($request->validated());
            return Response::Success($data['user'], $data['message']);
            }catch(\Throwable $th){
            $message= $th->getMessage();
            return Response::Error($data,$message);
        }
    }
     

    public function logout()
    {
        $data= [];
        try{
            $data = $this->userService->logout();
            return Response::Success($data['user'], $data['message'],$data['code']);
        }catch(\Throwable $th){
            $message= $th->getMessage();
            return Response::Error($data,$message);
        }
    }
}

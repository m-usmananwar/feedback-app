<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Contracts\UserRepositoryInterface;

class AuthController extends Controller
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function logIn(Request $request)
    {
        try{
            $data = $request->input();
            $this->repository->signInValidation($data)->validate();

            $user = $this->repository->getUser($data);
            throw_if(!$user, 'User not found against this email');

            if(Hash::check($data['password'], $user->password)) {
                $token = $user->createToken('api-token')->plainTextToken;
                return response()->success("User authenticated successfully", compact("user", "token"));
            } else {
                return response()->error("Invalid credentials", 401);
            }
        }catch(\Exception $e){
            return $this->handleException($e);
        }
    }

    public function register(Request $request)
    {
        try{
            $data = $request->input();
            $this->repository->storeValidation($data)->validate();

            $user = $this->repository->store($data);
            if(Hash::check($data['password'], $user->password)) {
                $token = $user->createToken('api-token')->plainTextToken;
                return response()->success("User authenticated successfully", compact("user", "token"));
            } else {
                return response()->error("Invalid credentials", 401);
            }
        }catch(\Exception $e){
            return $this->handleException($e);
        }
    }
    public function isEmailExists(Request $request)
    {
        $isExists = $this->repository->isEmailExists($request->email);
        $message = $isExists ? "Email already exists" : "Email not exists";
        return response()->success($message, compact('isExists'));
    }

    public function getCurrentUser(Request $request)
    {
        try {
            $user = $request->user();

            return response()->success("Current user", compact('user'));
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function logOut(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->success("User logged out successfully");
    }
}

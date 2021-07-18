<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidatorRequest;
use App\Http\Requests\signupValidatorRequest;
use App\Services\Interfaces\UserContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $userService;
    public function __construct(UserContract $userContract)
    {
        $this->userService = $userContract;
    }

    public function index()
    {
        return view('home');
    }

    public function login()
    {
        if(auth()->check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function authenticate(LoginValidatorRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json([ 'message'=> 'Login successful','status' => true]);
        }
        return response()->json([ 'message'=> 'The provided credentials do not match our records','status' => false]);
    }

    public function signup()
    {
        return view('auth.signup');
    }

    public function register(signupValidatorRequest $request)
    {
        return response()->json($this->userService->register($request));
    }

    public function logout()
    {
        try {
            Auth::logout();
            return response()->json([ 'success'=> 'Login successful','status' => true]);
        } catch (\Exception $e) {
            return response()->json([ 'message'=> 'Failed to logout','status' => false]);
        }

    }
}

<?php
/**
 * Created by Mahbubul Alam
 * Date: 7/17/21
 * Time: 7:54 PM
 */


namespace App\Services;


use App\Models\User;
use Illuminate\Http\Request;

class UserService implements Interfaces\UserContract
{
    public $userModel;
    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function register(Request $request)
    {
        $response = $this->userModel->create([
            'name' => $request->name,
            'company' => $request->company,
            'password' => bcrypt($request->password),
            'email' => $request->email,
        ]);
        if($response) {
            return [
                'status' => true,
                'message' => 'Sing up successful'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Sing up successful'
            ];
        }
    }
}

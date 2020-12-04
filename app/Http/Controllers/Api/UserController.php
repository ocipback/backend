<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function authFailed()
    {
        return response('tidak diautentikasi, pastikan otentikasi sudah benar',401);
    }

    public function register(Request  $request)
    {
    $validator = Validator::make($request->all(),[
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users|',
        'password' => 'required|string|min:8|confirmed'
    ]);

    if ($validator->fails()){
       return response(['errors' => $validator->errors()],422);
    }

    $user = new User();
    $user->first_name = $request->firstName;
    $user->last_name = $request->lastName;
    $user->email =$request->email;
    $user->password = bcrypt($request->password);
    $user->save();

    return $this->getResponse($user);


    }

    public function login(Request  $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()){
            return response(['errors' => $validator->errors()],422);
        }

        $credetials = \request(['email','password']);

        if (Auth::attempt($credetials)){
            $user  = $request->user();
           return $this->getResponse($user);
        }
    }
    public function logout(Request $request)
    {
         $request->user()->token()->revoke();
         return response('berhasil logout',200);
    }

    public function user(Request $request)
    {
        return $request->user();

    }

    private function getResponse(User $user){
        $tokenResult = $user->createToken("personal access token ");
        $token = $tokenResult->token;
        $token->expires_At = Carbon::now()->addWeeks(1);
        $token->save();

        return response([
            'accessToken' => $tokenResult->accessToken,
            'tokenType' => "Bearer",
            'expiresAt' => \Carbon\Carbon::parse($token->expires_At)->toDateTimeString()
        ],200);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(),[
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()){
            return response(['errors' => $validator->errors()],422);
        }

        $user->update($request->all());

    }
}

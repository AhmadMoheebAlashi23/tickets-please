<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginUserRequest;
use App\Http\Requests\ApiLoginRequest;
use App\Models\User;
use App\Traist\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    use ApiResponses;
    public function login(LoginUserRequest $request )
    {
       $request->validated($request->all());

       if(!Auth::attempt($request->only('email','password'))){

            return $this->error('Invaled credentials ',401);

       }

       $user=User::firstWhere('email',$request->email);

       return $this->ok(
        'Authenticated',[
            'token'=>$user->createToken(
                'Api is token for' . $user->email,
                ['*'],
                now()->addMonth())->plainTextToken
        ]
       );

    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return $this->ok('');
    }
}

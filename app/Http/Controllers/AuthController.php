<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate ([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required','min:11','numeric'],
            'national_id' => ['required','min:14','numeric'],
            'username' => ['required', 'string','min:4', 'max:50'],
            'gender' => ['required'],
            'type' => ['required'],
            'skills' => ['string'],
            'city' => ['required', 'string','min:4', 'max:50'],
            'street' => ['required', 'string','min:4', 'max:50'],
            'overview' => ['string','min:50', 'max:255'],
            'job' => ['required', 'string', 'max:50'],
            'university' => ['required', 'string', 'max:255'],
            'specialization' => ['required', 'string','min:4', 'max:255'],
            'experience' => ['required', 'string','min:4', 'max:255']

        ]);

        $user=User::create([
            'fname' => $fields['fname'],
            'lname' => $fields['lname'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'phone_number' => $fields[ 'phone_number'],
            'national_id' => $fields['national_id'],
            'username' => $fields['username'],
            'gender'  => $fields['gender' ],
            'type' => $fields['type'],
            'city' => $fields['city'],
            'street' => $fields['street'],
            // 'overview' => $fields[ 'overview'],
            // 'skills' => $fields['skills'],
            'job' => $fields['job'],
            'university'=> $fields['university'],
            'specialization'=> $fields['specialization'],
            'experience' => $fields['experience'],
        ]);

        $token =$user->createToken("usertoken")->plainTextToken;

        $response=[
            'user' =>$user ,
            'token' =>$token
        ];

        return  response( $response ,201);

    }


    public function login(Request $request){
        $fields = $request->validate ([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user=User::where('email', $fields['email'])->first();
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message'=>"Unauthorised"
            ],401);

        }

        $token =$user->createToken("usertoken")->plainTextToken;

        $response=[
            'user' =>$user ,
            'token' =>$token
        ];

        return  response( $response ,201);

    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response(
            ['message'=>"Logged Out"]
        ,201);
    }

}

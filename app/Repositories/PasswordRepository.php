<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

// Mailing Template

use App\Mail\ResetPasswordMail;

// Models

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class PasswordRepository {

    /**
     * Send Link user to confirmation reset password.
     * 
     * @param Request $request Object Request with email property
     * @return \Illuminate\Http\JsonResponse
    */
    public function sendPasswordReset($request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users'
            ]);

            if($validator->fails()) return response()->json(['errors' => json_decode($validator->errors()->toJson())], 400);

            $found_user = User::where('email', $request->email)->first();

            $token_temp = JWTAuth::fromUser($found_user);
            $urlResetPass = url('api/auth/password/update?token=' . $token_temp);

            $this->sendResetEmailUser($found_user->email, "{$found_user->name} {$found_user->lastname}", $urlResetPass);

            return response()->json(['msg' => 'Email Send Succesfully'], 201);
        } catch (\Throwable $th) {
            return response()->json(['errors' => $th->getMessage()], 400);
        }
    }

    public function updatePassword($request) 
    {
        try {
            
            $validator = Validator::make($request->all(), [
                'token' => 'required|string',
                'password' => 'required|string'
            ]);

            if(!$request->query('token')) return response()->json(['errors' => 'Not correct url'], 400);

            if($validator->fails()) return response()->json(['errors' => json_decode($validator->errors()->toJson())], 400);

            $user = JWTAuth::parseToken()->authenticate();

            if(!$user) return response()->json(['errors' => 'Invalid Token'], 400);

            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json(['state' => $user]);
        } catch (\Throwable $th) {
            return response()->json(['errors' => 'Invalid Token'], 400);
        }
    }

    /**
     * Send Email to user by reset password.
     * 
     * @param string $email
     * @param string $userName
     * @param string $linkRestcallback
     * @return void
    */
    protected function sendResetEmailUser (string $email, string $userName, string $linkRestcallback) {
        Mail::to($email)->send(new ResetPasswordMail(ucwords($userName), $linkRestcallback));
    }
}
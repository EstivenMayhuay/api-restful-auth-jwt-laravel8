<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

// Mailing Template

use App\Mail\ResetPasswordMail;

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
                'email' => 'required'
            ]);

            if($validator->fails()) return response()->json(['errors' => json_decode($validator->errors()->toJson())], 400);

            Mail::to('developerwebhairton@gmail.com')->send(new ResetPasswordMail());

            return response()->json(['email' => $request->email]);
        } catch (\Throwable $th) {
            return response()->json(['errors' => $th->getMessage()], 400);
        }
    }

    protected function sendEmail () {

    }

    protected function createTempToken () {

    }
}
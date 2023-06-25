<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// Models

use App\Models\User;

class AuthRepository {
    /**
     * Create new User.
     *
     * @param Request $request Object Request with the following properties name, lastname, email, password & birthday
     * @return \Illuminate\Http\JsonResponse
    */
    public function createUser ($request) {
        try {
            
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'lastname' => 'required',
                'birthday' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);

            if($validator->fails()) return response()->json(['errors' => json_decode($validator->errors()->toJson())], 400);

            $user = User::create(array_merge(
                $validator->validate(),
                ['password' => bcrypt($request->password)]
            ));

            return response()->json(['msg' => 'User Create Succesfully', 'user' => $user], 201);
        } catch (\Throwable $th) {
            return response()->json(['error', $th->getMessage()]);
        }
    }
}


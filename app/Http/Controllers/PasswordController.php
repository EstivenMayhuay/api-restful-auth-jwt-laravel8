<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Repositories
use App\Repositories\PasswordRepository;

class PasswordController extends Controller
{
    private $passwordRepository;

    public function __construct(PasswordRepository $passwordRepository)
    {
        $this->passwordRepository = $passwordRepository;
    }

    public function sendPasswordReset (Request $request) {
        return $this->passwordRepository->sendPasswordReset($request);
    }

    public function resetPassword (Request $request) {
        return $this->passwordRepository->updatePassword($request);
    }
}

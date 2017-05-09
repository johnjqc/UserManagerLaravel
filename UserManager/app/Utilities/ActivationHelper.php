<?php

namespace App\Utilities;

use App\Utilities\ActivationRepository;
use App\User;
use Illuminate\Support\Facades\Validator;

trait ActivationHelper {

    public function initiateEmailActivation(User $user) {
        if (!$this->validateEmail($user)) {
            return true;
        }
        $activationManager = new ActivationManager();
        $activationManager->createTokenAndSendEmail($user);
    }

    protected function validateEmail(User $user) {
        $validator = Validator::make(['email' => $user->email], ['email' => 'required|email']);
        if ($validator->fails()) {
            return false;
        }
        return true;
    }
}

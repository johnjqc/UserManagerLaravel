<?php

namespace App\Utilities;

use App\Model\Activation;
use App\User;
use App\Utilities\SendActivationEmail;
use Carbon\Carbon;

class ActivationManager {

    public function createTokenAndSendEmail(User $user) {
        $activations = Activation::where('user_id', $user->id)
            ->where('created_at', '>=', Carbon::now()->subHours(24))
            ->count();
        if ($activations >= 3) {
            return true;
        }
        if ($user->activated) {
            $user->update([
                'activated' => false
            ]);
        }
        $activation = self::createNewActivationToken($user);
        self::sendNewActivationEmail($user, $activation->token);
    }

    public function createNewActivationToken(User $user) {
        $activation             = new Activation;
        $activation->user_id    = $user->id;
        $activation->token      = str_random(64);
        $activation->save();

        return $activation;

    }

    public function sendNewActivationEmail(User $user, $token) {
        $user->notify(new MailManager($token));
    }

    public function deleteExpiredActivations() {
        Activation::where('created_at', '<=', Carbon::now()->subHours(72))->delete();
    }
}

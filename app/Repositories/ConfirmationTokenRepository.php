<?php

namespace App\Repositories;

use App\Models\ConfirmationToken;
use Carbon\Carbon;

class ConfirmationTokenRepository {
    public function create($data) {
        return ConfirmationToken::create($data);
    }

    public function findValidToken($userId, $settingKey, $token) {
        return ConfirmationToken::where('user_id', $userId)
            ->where('setting_key', $settingKey)
            ->where('token', $token)
            ->where('is_used', false)
            ->where('created_at', '>', Carbon::now()->subMinutes(15)) //Токен действителен 15 минут
            ->first();
    }

    public function markAsUsed($id) {
        $confirmationToken = ConfirmationToken::find($id);
        if ($confirmationToken) {
            $confirmationToken->is_used = true;
            $confirmationToken->save();
            return $confirmationToken;
        }
        return null;
    }
}


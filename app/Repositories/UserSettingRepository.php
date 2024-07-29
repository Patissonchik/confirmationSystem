<?php

namespace App\Repositories;

use App\Models\UserSetting;

class UserSettingRepository {
    public function findByUserAndKey($userId, $key) {
        return UserSetting::where('user_id', $userId)
                          ->where('setting_key', $key)
                          ->first();
    }

    public function updateOrCreate($userId, $key, $value) {
        return UserSetting::updateOrCreate(
            ['user_id' => $userId, 'setting_key' => $key],
            ['setting_value' => $value]
        );
    }

    public function delete($userId, $key) {
        $setting = $this->findByUserAndKey($userId, $key);
        if ($setting) {
            return $setting->delete();
        }
        return false;
    }
}

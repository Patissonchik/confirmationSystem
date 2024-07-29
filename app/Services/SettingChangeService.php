<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\UserSettingRepository;
use App\Repositories\ConfirmationTokenRepository;
use App\Services\NotificationService;
use Illuminate\Support\Str;

class SettingChangeService {
    protected $userRepository;
    protected $userSettingRepository;
    protected $confirmationTokenRepository;
    protected $notificationService;

    public function __construct(
        UserRepository $userRepository,
        UserSettingRepository $userSettingRepository,
        ConfirmationTokenRepository $confirmationTokenRepository,
        NotificationService $notificationService
    ) {
        $this->userRepository = $userRepository;
        $this->userSettingRepository = $userSettingRepository;
        $this->confirmationTokenRepository = $confirmationTokenRepository;
        $this->notificationService = $notificationService;
    }

    public function requestSettingChange($userId, $settingKey, $newValue, $method) {
        $user = $this->userRepository->find($userId);
        if (!$user) {
            throw new \Exception("User not found");
        }

        $token = Str::random(6);

        //Создание записи токена подтверждения
        $this->confirmationTokenRepository->create([
            'user_id' => $userId,
            'setting_key' => $settingKey,
            'token' => $token,
            'method' => $method,
        ]);

        //Отправка токена пользователю
        $this->notificationService->sendToken($user, $token, $method);
    }

    public function confirmSettingChange($userId, $settingKey, $token) {
        //Поиск валидного токена
        $confirmationToken = $this->confirmationTokenRepository->findValidToken($userId, $settingKey, $token);
        if (!$confirmationToken) {
            throw new \Exception("Invalid or expired token");
        }

        //Обновление настройки пользователя
        $this->userSettingRepository->updateOrCreate($userId, $settingKey, $confirmationToken->setting_value);

        //Пометка токена как использованного
        $this->confirmationTokenRepository->markAsUsed($confirmationToken->id);
    }
}

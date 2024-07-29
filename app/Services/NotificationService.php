<?php

namespace App\Services;

use App\Models\User;

class NotificationService {
    protected $smsService;
    protected $emailService;
    protected $telegramService;

    public function __construct(SmsService $smsService, EmailService $emailService, TelegramService $telegramService) {
        $this->smsService = $smsService;
        $this->emailService = $emailService;
        $this->telegramService = $telegramService;
    }

    public function sendToken(User $user, $token, $method) {
        $message = "Ваш код подтверждения: $token";
        switch ($method) {
            case 'sms':
                $this->smsService->send($user->phone, $message);
                break;
            case 'email':
                $this->emailService->send($user->email, 'Подтверждение изменения настроек', $message);
                break;
            case 'telegram':
                $this->telegramService->send($user->telegram_id, $message);
                break;
        }
    }
}


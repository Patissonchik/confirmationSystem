<?php

namespace App\Services;

use Twilio\Rest\Client;

class SmsService {
    protected $client;

    public function __construct() {
        // Инициализация клиента Twilio с SID и токеном
        $this->client = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
    }

    public function send($phone, $message) {
        try {
            $this->client->messages->create($phone, [
                'from' => env('TWILIO_FROM'),
                'body' => $message,
            ]);
        } catch (\Exception $e) {
            // Обработка ошибок
            //Log::error('Ошибка при отправке SMS: ' . $e->getMessage());
            throw $e; //Опционально: пробрасываем исключение дальше
        }
    }
}

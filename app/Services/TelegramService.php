<?php

namespace App\Services;

use Telegram\Bot\Api;

class TelegramService {
    protected $telegram;

    public function __construct() {
        // Инициализация Telegram API с токеном бота
        //$this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
    }

    public function send($chatId, $message) {
        try {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'HTML' // Указываем, если хотите использовать HTML-теги
            ]);
        } catch (\Exception $e) {
            //\Log::error('Ошибка при отправке сообщения в Telegram: ' . $e->getMessage());
            throw $e;
        }
    }
}


<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class EmailService {
    public function send($recipientEmail, $subject, $body) {
        Mail::raw($body, function ($message) use ($recipientEmail, $subject) {
            $message->to($recipientEmail)
                    ->subject($subject);
        });
    }

    public function sendUsingTemplate($recipientEmail, $subject, $data, $template) {
        Mail::send($template, $data, function ($message) use ($recipientEmail, $subject) {
            $message->to($recipientEmail)
                    ->subject($subject);
        });
    }
}

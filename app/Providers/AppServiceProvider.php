<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SmsService;
use App\Services\EmailService;
use App\Services\TelegramService;
use App\Services\NotificationService;
use App\Repositories\UserRepository;
use App\Repositories\UserSettingRepository;
use App\Repositories\ConfirmationTokenRepository;
use App\Services\SettingChangeService;

class AppServiceProvider extends ServiceProvider {
    public function register() {
        $this->app->singleton(SmsService::class, function ($app) {
            return new SmsService();
        });

        $this->app->singleton(EmailService::class, function ($app) {
            return new EmailService();
        });

        $this->app->singleton(TelegramService::class, function ($app) {
            return new TelegramService();
        });

        $this->app->singleton(NotificationService::class, function ($app) {
            return new NotificationService(
                $app->make(SmsService::class),
                $app->make(EmailService::class),
                $app->make(TelegramService::class)
            );
        });

        $this->app->singleton(UserRepository::class, function ($app) {
            return new UserRepository();
        });

        $this->app->singleton(UserSettingRepository::class, function ($app) {
            return new UserSettingRepository();
        });

        $this->app->singleton(ConfirmationTokenRepository::class, function ($app) {
            return new ConfirmationTokenRepository();
        });

        $this->app->singleton(SettingChangeService::class, function ($app) {
            return new SettingChangeService(
                $app->make(UserRepository::class),
                $app->make(UserSettingRepository::class),
                $app->make(ConfirmationTokenRepository::class),
                $app->make(NotificationService::class)
            );
        });
    }
}

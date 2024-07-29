<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'telegram_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function settings() {
        return $this->hasMany(UserSetting::class);
    }

    public function confirmationTokens() {
        return $this->hasMany(ConfirmationToken::class);
    }
}

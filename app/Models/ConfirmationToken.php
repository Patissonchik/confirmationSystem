<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmationToken extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'setting_key',
        'token',
        'method',
        'is_used',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('telegram_id')->nullable()->unique(); // Telegram ID для отправки сообщений
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }
};

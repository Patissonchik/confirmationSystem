<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('confirmation_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('setting_key');
            $table->string('token');
            $table->enum('method', ['sms', 'email', 'telegram']);
            $table->boolean('is_used')->default(false);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('confirmation_tokens');
    }
};


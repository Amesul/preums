<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('twitch_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('access_token');
            $table->timestamp('expires_at');
            $table->boolean('invalidated')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('twitch_tokens');
    }
};

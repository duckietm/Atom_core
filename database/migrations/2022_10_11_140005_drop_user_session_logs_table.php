<?php

use Atom\Core\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('users_session_logs');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('users_session_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('ip', 100)->default('127.0.0.1');
            $table->text('browser')->nullable();
            $table->timestamps();
        });
    }
};

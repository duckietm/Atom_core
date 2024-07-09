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
        Schema::create('website_user_guestbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'profile_id');
            $table->foreignIdFor(User::class);
            $table->string('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_user_guestbooks');
    }
};

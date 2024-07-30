<?php

use Atom\Core\Models\User;
use Atom\Core\Models\WebsiteHomeItem;
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
        Schema::create('user_website_home_item', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(WebsiteHomeItem::class);
            $table->decimal('left', 8, 2)->nullable()->default(null);
            $table->decimal('top', 8, 2)->nullable()->default(null);
            $table->json('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_website_home_item');
    }
};

<?php

use Atom\Core\Models\WebsiteHomeCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_home_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WebsiteHomeCategory::class);
            $table->string('name');
            $table->string('image_url')->nullable();
            $table->string('description')->nullable();
            $table->enum('type', ['sticker', 'background', 'widget', 'note']);
            $table->integer('count')->default(1);
            $table->integer('price')->default(0);
            $table->integer('currency_type')->nullable();
            $table->integer('currency_price')->default(0);
            $table->json('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_home_items');
    }
};

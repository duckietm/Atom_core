<?php

use Atom\Core\Models\WebsiteShopArticle;
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
        Schema::create('website_shop_article_features', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WebsiteShopArticle::class, 'article_id');
            $table->json('features');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_shop_article_features');
    }
};

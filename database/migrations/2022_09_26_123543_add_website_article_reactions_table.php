<?php

use Atom\Core\Models\User;
use Atom\Core\Models\WebsiteArticle;
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
        Schema::create('website_article_reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(WebsiteArticle::class, 'article_id');
            $table->string('reaction', 50);
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_article_reactions');
    }
};

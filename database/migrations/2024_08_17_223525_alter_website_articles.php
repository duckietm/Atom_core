<?php

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
        Schema::table('website_articles', function (Blueprint $table) {
            $table->boolean('is_published')
                ->default(false)
                ->after('full_story');
        });

        WebsiteArticle::query()->update(['is_published' => true]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_articles', function (Blueprint $table) {
            $table->dropColumn('is_published');
        });
    }
};

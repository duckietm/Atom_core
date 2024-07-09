<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('website_shop_article_features')->truncate();

        Schema::table('website_shop_article_features', function (Blueprint $table) {
            $table->renameColumn('features', 'content');
        });

        Schema::table('website_shop_article_features', function (Blueprint $table) {
            $table->string('content')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_shop_article_features', function (Blueprint $table) {
            $table->renameColumn('content', 'features');
        });

        Schema::table('website_shop_article_features', function (Blueprint $table) {
            $table->json('features')->change();
        });
    }
};

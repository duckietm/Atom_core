<?php

use Illuminate\Support\Facades\DB;
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
        DB::table('website_shop_article_features')
            ->truncate();

        DB::table('website_shop_articles')
            ->truncate();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

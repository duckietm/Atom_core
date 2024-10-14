<?php

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
        Schema::table('users', function (Blueprint $table) {
            $table->float('website_balance')->default(0)->change();
        });

        Schema::table('website_shop_articles', function (Blueprint $table) {
            $table->float('costs')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 
        });

        Schema::table('website_shop_articles', function (Blueprint $table) {
            // 
        });
    }
};

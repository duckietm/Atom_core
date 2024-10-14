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
            $table->timestamp('rank_expires_at')->nullable()->after('rank');
        });

        Schema::table('website_shop_articles', function (Blueprint $table) {
            $table->integer('rank_term')->nullable()->after('give_rank');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rank_expires_at');
        });

        Schema::table('website_shop_articles', function (Blueprint $table) {
            $table->dropColumn('rank_term');
        });
    }
};

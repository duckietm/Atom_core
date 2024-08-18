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
        Schema::table('website_home_items', function (Blueprint $table) {
            $table->integer('maximum_purchases')->default(-1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_home_items', function (Blueprint $table) {
            $table->dropColumn('maximum_purchases');
        });
    }
};

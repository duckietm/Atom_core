<?php

use Illuminate\Support\Facades\Schema;
use Atom\Core\Models\WebsiteShopCategory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('website_shop_articles', function (Blueprint $table) {
            $table->foreignIdFor(WebsiteShopCategory::class)->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_shop_articles', function (Blueprint $table) {
            $table->dropForeign(['website_shop_category_id']);
            $table->dropColumn('website_shop_category_id');
        });
    }
};

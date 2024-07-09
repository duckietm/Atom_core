<?php

use Atom\Core\Models\CatalogItem;
use Atom\Core\Models\WebsiteRareValueCategory;
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
        Schema::create('website_rare_values', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WebsiteRareValueCategory::class, 'category_id');
            $table->foreignIdFor(CatalogItem::class, 'item_id')->nullable();
            $table->string('name')->index();
            $table->string('credit_value')->nullable();
            $table->string('currency_value')->nullable();
            $table->string('currency_type')->default('diamonds');
            $table->string('furniture_icon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_rare_values');
    }
};

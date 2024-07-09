<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The items to be inserted into the database.
     */
    protected array $items = [
        ['country_code' => 'en', 'language' => 'English'],
        ['country_code' => 'da', 'language' => 'Danish'],
        ['country_code' => 'fi', 'language' => 'Finnish'],
        ['country_code' => 'de', 'language' => 'German'],
        ['country_code' => 'fr', 'language' => 'French'],
        ['country_code' => 'tr', 'language' => 'Turkish'],
        ['country_code' => 'se', 'language' => 'Swedish'],
        ['country_code' => 'nl', 'language' => 'Netherland'],
        ['country_code' => 'br', 'language' => 'Portuguese (Brazil)'],
        ['country_code' => 'it', 'language' => 'Italy'],
        ['country_code' => 'es', 'language' => 'Spain'],
        ['country_code' => 'no', 'language' => 'Norwegian'],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_languages', function (Blueprint $table) {
            $table->id();
            $table->string('country_code', 8)->unique();
            $table->string('language')->unique();
        });

        foreach ($this->items as $item) {
            DB::table('website_languages')->insert($item);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_languages');
    }
};

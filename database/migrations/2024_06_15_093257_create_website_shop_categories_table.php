<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The items that should be inserted into the table.
     */
    protected array $items = [
        [
            'name' => 'VIP',
            'slug' => 'vip',
            'icon' => 'https://i.imgur.com/YiI0I1i.png',
        ],
        [
            'name' => 'Currency',
            'slug' => 'currency',
            'icon' => 'https://i.imgur.com/YiI0I1i.png',
        ],
        [
            'name' => 'Badges',
            'slug' => 'badges',
            'icon' => 'https://i.imgur.com/YiI0I1i.png',
        ],
        [
            'name' => 'Rares',
            'slug' => 'rares',
            'icon' => 'https://i.imgur.com/YiI0I1i.png',
        ],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_shop_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->timestamps();
        });

        foreach ($this->items as $item) {
            DB::table('website_shop_categories')->insert(array_merge($item, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_shop_categories');
    }
};

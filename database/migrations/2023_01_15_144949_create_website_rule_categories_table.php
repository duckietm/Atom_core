<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The items to be inserted into the table.
     *
     * @return void
     */
    protected array $items = [
        [
            'name' => 'General Rules',
            'description' => 'The general rules of the hotel',
            'badge' => 'hotel',
        ],
        [
            'name' => 'Account Rules',
            'description' => 'The general account rules on Habbo',
            'badge' => 'hotel',
        ],
        [
            'name' => 'Hotel',
            'description' => 'Hotel rules & guidelines',
            'badge' => 'hotel',
        ],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_rule_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description');
            $table->string('badge');
            $table->timestamps();
        });

        foreach ($this->items as $item) {
            DB::table('website_rule_categories')->insert(array_merge($item, [
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
        Schema::dropIfExists('website_rule_categories');
    }
};

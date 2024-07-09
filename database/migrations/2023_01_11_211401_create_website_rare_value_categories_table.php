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
            'name' => 'Limited Edition',
            'badge' => 'hotel',
            'priority' => 1,
        ],
        [
            'name' => 'Ultra rares',
            'badge' => 'hotel',
            'priority' => 2,
        ],
        [
            'name' => 'Super rares',
            'badge' => 'hotel',
            'priority' => 3,
        ],
        [
            'name' => 'Regulars',
            'badge' => 'hotel',
            'priority' => 4,
        ],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_rare_value_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('badge');
            $table->unsignedInteger('priority')->default(1);
            $table->timestamps();
        });

        foreach ($this->items as $item) {
            DB::table('website_rare_value_categories')->insert(array_merge($item, [
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
        Schema::dropIfExists('website_rare_value_categories');
    }
};

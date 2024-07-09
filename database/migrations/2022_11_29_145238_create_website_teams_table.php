<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The items to insert into the table.
     */
    protected array $items = [
        ['rank_name' => 'DJ'],
        ['rank_name' => 'Wired Expert'],
        ['rank_name' => 'Event planner'],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_teams', function (Blueprint $table) {
            $table->id();
            $table->string('rank_name')->unique();
            $table->boolean('hidden_rank')->default(false);
            $table->string('badge')->nullable();
            $table->string('job_description')->nullable();
            $table->string('staff_color')->default('#327fa8');
            $table->string('staff_background')->default('staff-bg.png');
            $table->timestamps();
        });

        foreach ($this->items as $item) {
            DB::table('website_teams')->insert(array_merge($item, [
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
        Schema::dropIfExists('website_teams');
    }
};

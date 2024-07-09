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
        ['word' => 'fuck'],
        ['word' => 'idiot'],
        ['word' => 'retard'],
        ['word' => 'faggot'],
        ['word' => 'tranny'],
        ['word' => 'bitch'],
        ['word' => 'cunt'],
        ['word' => 'cock'],
        ['word' => 'pussy'],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_wordfilter', function (Blueprint $table) {
            $table->id();
            $table->string('word')->unique();
            $table->timestamps();
        });

        foreach ($this->items as $item) {
            DB::table('website_wordfilter')->insert(array_merge($item, [
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
        Schema::dropIfExists('website_wordfilter');
    }
};

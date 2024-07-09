<?php

use Atom\Core\Models\User;
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
        [
            'title' => 'Atom CMS has been installed',
            'slug' => 'atom-cms-has-been-installed',
            'short_story' => 'Welcome to your new hotel, we are super happy that you chose to use Atom CMS!',
            'full_story' => '<p>Welcome to your new hotel, we are super happy that you chose to use Atom CMS!</p>',
            'image' => 'https://i.imgur.com/uGLDOUu.png',
        ],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_articles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('short_story');
            $table->longText('full_story');
            $table->foreignIdFor(User::class)->nullable();
            $table->string('image');
            $table->timestamps();
        });

        foreach ($this->items as $item) {
            DB::table('website_articles')->insert(array_merge($item, [
                'user_id' => DB::table('users')->first()->id ?? null,
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
        Schema::dropIfExists('website_articles');
    }
};

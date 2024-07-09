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
        [
            'permission' => 'bypass_vpn',
            'min_rank' => '6',
            'description' => 'Min rank to bypass vpn blocker check',
        ],
        [
            'permission' => 'view_server_logs',
            'min_rank' => '7',
            'description' => 'Minimum required rank to access the log viewer',
        ],
        [
            'permission' => 'housekeeping_access',
            'min_rank' => '7',
            'description' => 'Minimum required rank to access the log viewer',
        ],
        [
            'permission' => 'delete_article_comments',
            'min_rank' => '7',
            'description' => 'Minimum required rank to delete article comments without being the author',
        ],
        [
            'permission' => 'manage_website_tickets',
            'min_rank' => '7',
            'description' => 'Minimum required rank to view and reply to others tickets',
        ],
        [
            'permission' => 'delete_website_tickets',
            'min_rank' => '7',
            'description' => 'Minimum required rank to delete others tickets',
        ],
        [
            'permission' => 'delete_website_ticket_replies',
            'min_rank' => '7',
            'description' => 'Minimum required rank to delete replies on a ticket',
        ],
        [
            'permission' => 'generate_logo',
            'min_rank' => '7',
            'description' => 'Minimum required rank to use the logo generator',
        ],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('permission')->unique();
            $table->string('min_rank')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        foreach ($this->items as $item) {
            DB::table('website_permissions')->insert(array_merge($item, [
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
        Schema::dropIfExists('website_permissions');
    }
};

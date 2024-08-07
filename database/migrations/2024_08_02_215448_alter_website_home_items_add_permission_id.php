<?php

use Atom\Core\Models\Permission;
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
        Schema::table('website_home_items', function (Blueprint $table) {
            $table->foreignIdFor(Permission::class)->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_home_items', function (Blueprint $table) {
            $table->dropForeignIdFor(Permission::class);
        });
    }
};

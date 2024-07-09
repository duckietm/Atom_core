<?php

use Atom\Core\Models\User;
use Atom\Core\Models\WebsiteHelpCenterCategory;
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
        Schema::create('website_help_center_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(WebsiteHelpCenterCategory::class, 'category_id')->nullable();
            $table->string('title');
            $table->text('content');
            $table->boolean('open')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_help_center_tickets');
    }
};

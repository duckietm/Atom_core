<?php

use Atom\Core\Models\User;
use Atom\Core\Models\WebsiteHelpCenterTicket;
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
        Schema::create('website_help_center_ticket_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WebsiteHelpCenterTicket::class, 'ticket_id');
            $table->foreignIdFor(User::class);
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_help_center_ticket_replies');
    }
};

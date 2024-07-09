<?php

use Atom\Core\Models\User;
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
        Schema::create('website_paypal_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable();
            $table->string('transaction_id');
            $table->string('status')->nullable();
            $table->string('description', 512)->nullable();
            $table->float('amount');
            $table->string('currency')->default('USD');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_paypal_transactions');
    }
};

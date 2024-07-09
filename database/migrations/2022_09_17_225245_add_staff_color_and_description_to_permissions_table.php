<?php

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
        Schema::table('permissions', function (Blueprint $table) {
            $table->string('job_description')->default('Here to help')->after('badge');
            $table->string('staff_color', 8)->default('#327fa8')->after('job_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('job_description');
            $table->dropColumn('staff_color');
        });
    }
};

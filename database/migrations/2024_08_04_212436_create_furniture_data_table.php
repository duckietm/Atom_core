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
        Schema::create('furniture_data', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['roomitemtypes', 'wallitemtypes']);
            $table->string('classname');
            $table->string('name')->default('duck');
            $table->integer('revision')->default(0);
            $table->string('description')->default('duck_desc');
            $table->string('category')->nullable();
            $table->integer('offerid')->default(-1);
            $table->integer('defaultdir')->default(0);
            $table->integer('xdim')->default(1);
            $table->integer('ydim')->default(1);
            $table->json('partcolors')->default('{}');
            $table->string('adurl')->nullable();
            $table->boolean('buyout')->default(0);
            $table->integer('rentofferid')->default(-1);
            $table->boolean('rentbuyout')->default(0);
            $table->boolean('bc')->default(0);
            $table->boolean('excludeddynamic')->default(0);
            $table->string('customparams')->nullable();
            $table->integer('specialtype')->default(0);
            $table->boolean('canstandon')->default(0);
            $table->boolean('cansiton')->default(0);
            $table->boolean('canlayon')->default(0);
            $table->string('furniline')->nullable();
            $table->string('environment')->nullable();
            $table->boolean('rare')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('furniture_data');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Creates the "factories" table, which stores information
     * about manufacturing plants (factory name + location).
     */
    public function up(): void
    {
        Schema::create('factories', function (Blueprint $table) {
            $table->id();

            // Factory name (e.g., Toyota Plant A)
            $table->string('name');

            // City or geographical location of the factory
            $table->string('location');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * Drops the "factories" table.
     */
    public function down(): void
    {
        Schema::dropIfExists('factories');
    }
};

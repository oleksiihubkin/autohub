<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Creates the "cars" table, which stores vehicle information
     * and links each car to a specific factory.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();

            // Car manufacturer (e.g., Toyota, BMW)
            $table->string('make');

            // Car model (e.g., Corolla, X5)
            $table->string('model');

            // Year of production
            $table->year('year');

            // Car color
            $table->string('color');

            // Car price with 2 decimal places
            $table->decimal('price', 10, 2);

            // Relationship: each car belongs to one factory
            $table->foreignId('factory_id')
                  ->constrained()        // references "factories" table
                  ->onDelete('cascade'); // delete cars if factory is deleted

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * Drops the "cars" table.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};

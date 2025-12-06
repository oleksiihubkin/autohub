<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * Creates the "reviews" table, which stores user ratings and
     * optional comments for cars.
     */
    public function up(): void {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // Relationship: each review belongs to a user
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete(); // delete reviews if user is removed

            // Relationship: each review belongs to a car
            $table->foreignId('car_id')
                  ->constrained()
                  ->cascadeOnDelete(); // delete reviews if car is removed

            // Rating from 1 to 5
            $table->unsignedTinyInteger('rating');

            // Optional text comment from the user
            $table->text('comment')->nullable();

            $table->timestamps();

            // Composite index to optimize filtering by car, user, rating
            $table->index(['car_id', 'user_id', 'rating']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * Drops the "reviews" table.
     */
    public function down(): void {
        Schema::dropIfExists('reviews');
    }
};

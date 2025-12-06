<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Creates the "dealers" table, which stores basic information
     * about car dealerships collaborating with factories.
     */
    public function up(): void
    {
        Schema::create('dealers', function (Blueprint $table) {
            $table->id();

            // Dealer's business/company name
            $table->string('name');

            // Optional contact phone number
            $table->string('phone')->nullable();

            // Optional contact email
            $table->string('email')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * Drops the "dealers" table.
     */
    public function down(): void
    {
        Schema::dropIfExists('dealers');
    }
};

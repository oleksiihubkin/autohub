<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Creates the pivot table "dealer_factory" for the many-to-many
     * relationship between dealers and factories.
     */
    public function up(): void
    {
        Schema::create('dealer_factory', function (Blueprint $table) {
            $table->id();

            // Foreign key: dealer side of the relationship
            $table->foreignId('dealer_id')
                  ->constrained()        // references "dealers" table
                  ->onDelete('cascade'); // delete pivot entries if dealer is removed

            // Foreign key: factory side of the relationship
            $table->foreignId('factory_id')
                  ->constrained()        // references "factories" table
                  ->onDelete('cascade'); // delete pivot entries if factory is removed

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * Drops the pivot table.
     */
    public function down(): void
    {
        Schema::dropIfExists('dealer_factory');
    }
};

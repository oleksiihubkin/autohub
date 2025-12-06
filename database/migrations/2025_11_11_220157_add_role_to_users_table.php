<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * Adds a "role" column to the users table, if it does not already exist.
     * The role is used for authorization logic (admin / user).
     */
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {

            // Add the role column only if it's missing
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')
                      ->default('user')  // default role for all users
                      ->after('email');  // place column after email for clarity

                // Index for faster filtering by role
                $table->index('role');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * Removes the role column and its index, but only if they exist.
     */
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {

            if (Schema::hasColumn('users', 'role')) {
                // Drop index before removing column
                $table->dropIndex(['role']);
                $table->dropColumn('role');
            }
        });
    }
};

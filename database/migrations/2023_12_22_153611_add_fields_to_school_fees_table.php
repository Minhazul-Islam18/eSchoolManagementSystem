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
        Schema::table('school_fees', function (Blueprint $table) {
            $table->after('amount', function (Blueprint $table) {
                $table->date('due_date')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_fees', function (Blueprint $table) {
            $table->date('due_date')->nullable();
        });
    }
};
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
        Schema::table('school_fee_student', function (Blueprint $table) {
            $table->after('due_amount', function (Blueprint $table) {
                $table->enum('status', ['Paid', 'Unpaid'])->default('Unpaid');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_fee__student', function (Blueprint $table) {
            $table->enum('status', ['Paid', 'Unpaid'])->default('Unpaid');
        });
    }
};

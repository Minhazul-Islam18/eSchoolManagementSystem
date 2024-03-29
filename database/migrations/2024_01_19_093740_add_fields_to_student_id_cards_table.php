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
        Schema::table('student_id_cards', function (Blueprint $table) {
            $table->after('id', function () use ($table) {
                $table->foreignId('school_id')->nullable()->constrained()->cascadeOnDelete();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_id_cards', function (Blueprint $table) {
            $table->dropConstrainedForeignId('school_id');
        });
    }
};

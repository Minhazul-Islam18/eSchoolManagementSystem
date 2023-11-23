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
        Schema::table('school_exams', function (Blueprint $table) {
            $table->after('school_class_id', function (Blueprint $table) {
                $table->foreignId('group_id')->nullable()->constrained('class_groups')->cascadeOnDelete();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_exams', function (Blueprint $table) {
            $table->foreignId('group_id')->nullable()->constrained('class_groups')->cascadeOnDelete();
        });
    }
};

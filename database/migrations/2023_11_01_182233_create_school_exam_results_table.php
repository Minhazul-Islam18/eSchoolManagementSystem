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
        Schema::create('school_exam_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id')->nullable()->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('student_id')->nullable()->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('school_exam_id')->nullable()->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('school_class_id')->nullable()->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('school_class_section_id')->nullable()->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('school_class_subject_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('theory');
            $table->string('mcq');
            $table->string('practical');
            $table->string('total');
            $table->string('grade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_exam_results');
    }
};

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
        Schema::create('school_staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->nullable()->constrained()->cascadeOnDelete();
            $table->enum('type', ['teacher', 'employee']);
            $table->boolean('status')->default(true);
            $table->string('name');
            $table->string('educational_qualification')->nullable();
            $table->text('address')->nullable();
            $table->string('image')->nullable();
            $table->string('gender');
            $table->text('others_info')->nullable();
            $table->timestamp('joined_at')->nullable();
            $table->timestamp('resigned_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_staff');
    }
};

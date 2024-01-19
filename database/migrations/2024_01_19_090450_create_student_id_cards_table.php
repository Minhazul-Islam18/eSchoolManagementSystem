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
        Schema::create('student_id_cards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('expire_date');
            $table->string('frontside_background_image')->nullable();
            $table->string('backside_background_image')->nullable();
            $table->string('signature')->nullable();
            $table->string('qr_code')->nullable();
            $table->text('backside_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_id_cards');
    }
};

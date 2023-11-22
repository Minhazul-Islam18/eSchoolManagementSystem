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
        if (!Schema::hasColumn('class_routines', 'group_id')) {
            Schema::table('class_routines', function (Blueprint $table) {
                $table->after('section_id', function (Blueprint $table) {
                    $table->foreignId('group_id')->nullable()->constrained('class_groups')->cascadeOnDelete();
                });
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('class_routines', function (Blueprint $table) {
            $table->after('section_id', function (Blueprint $table) {
                $table->foreignId('group_id')->nullable()->constrained('class_groups')->cascadeOnDelete();
            });
        });
    }
};

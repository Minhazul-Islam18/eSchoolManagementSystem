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
        Schema::table('schools', function (Blueprint $table) {
            $table->string('institute_name')->nullable();
            $table->string('institute_address')->nullable();
            $table->string('thana_or_upazilla')->nullable();
            $table->string('district')->nullable();
            $table->string('eiin_no')->nullable();
            $table->string('headteacher_number')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('alt_mobile_no')->nullable();
            $table->string('web_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropColumn('institute_name');
            $table->dropColumn('institute_address');
            $table->dropColumn('thana_or_upazilla');
            $table->dropColumn('district');
            $table->dropColumn('eiin_no');
            $table->dropColumn('headteacher_number');
            $table->dropColumn('mobile_no');
            $table->dropColumn('alt_mobile_no');
            $table->dropColumn('web_address');
        });
    }
};

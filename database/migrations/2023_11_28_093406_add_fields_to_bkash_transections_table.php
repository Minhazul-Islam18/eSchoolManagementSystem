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
        Schema::table('bkash_transections', function (Blueprint $table) {
            $table->after('payment_id', function (Blueprint $table) {
                $table->string('trx_id')->nullable();
                $table->string('customer_msisdn')->nullable();
                $table->string('transaction_reference')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bkash_transections', function (Blueprint $table) {
            $table->dropColumn('trx_id');
            $table->dropColumn('customer_msisdn');
            $table->dropColumn('transaction_reference');
        });
    }
};

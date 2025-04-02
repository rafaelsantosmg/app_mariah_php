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
        Schema::create('daily_movements', function (Blueprint $table) {
            $table->id();
        $table->float('opening_balance')->nullable();
        $table->float('closing_balance')->nullable();
        $table->float('total_sales');
        $table->float('cash_sales');
        $table->float('pix_sales');
        $table->float('debit_card_sales');
        $table->float('credit_card_sales_cash');
        $table->float('credit_card_sales_installment');
        $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_movements');
    }
};